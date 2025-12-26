/**
 * Laporan Chat - Interactive JavaScript
 * Modern chat-based reporting system
 */

(function () {
    'use strict';

    // State management
    const state = {
        currentFilters: null,
        currentData: null,
        messageHistory: [],
        isTyping: false,
        isRecording: false,
        recognition: null
    };

    // DOM Elements
    const elements = {
        chatMessages: null,
        chatInput: null,
        btnSend: null,
        btnAttach: null,
        btnVoice: null,
        btnHelp: null,
        btnClearChat: null,
        typingIndicator: null,
        quickSuggestions: null,
        quickActionsMenu: null,
        exportModal: null
    };

    /**
     * Initialize the application
     */
    function init() {
        // Cache DOM elements
        cacheElements();

        // Bind events
        bindEvents();

        // Auto-resize textarea
        autoResizeTextarea();

        console.log('Laporan Chat initialized successfully');
    }

    /**
     * Cache DOM elements
     */
    function cacheElements() {
        elements.chatMessages = document.getElementById('chatMessages');
        elements.chatInput = document.getElementById('chatInput');
        elements.btnSend = document.getElementById('btnSend');
        elements.btnAttach = document.getElementById('btnAttach');
        elements.btnVoice = document.getElementById('btnVoice');
        elements.btnHelp = document.getElementById('btnHelp');
        elements.btnClearChat = document.getElementById('btnClearChat');
        elements.typingIndicator = document.getElementById('typingIndicator');
        elements.quickSuggestions = document.getElementById('quickSuggestions');
        elements.quickActionsMenu = document.getElementById('quickActionsMenu');
        elements.exportModal = document.getElementById('exportModal');

        // Initialize speech recognition
        initSpeechRecognition();
    }

    /**
     * Bind event listeners
     */
    function bindEvents() {
        // Send message
        elements.btnSend.addEventListener('click', handleSendMessage);
        elements.chatInput.addEventListener('keydown', handleInputKeydown);

        // Quick suggestions
        document.querySelectorAll('.suggestion-chip').forEach(chip => {
            chip.addEventListener('click', handleSuggestionClick);
        });

        // Voice input
        elements.btnVoice.addEventListener('click', toggleVoiceRecording);

        // Quick actions menu
        elements.btnAttach.addEventListener('click', toggleQuickActionsMenu);
        document.querySelectorAll('.quick-action').forEach(action => {
            action.addEventListener('click', handleQuickAction);
        });

        // Header buttons
        elements.btnHelp.addEventListener('click', () => sendMessage('Bantuan'));
        elements.btnClearChat.addEventListener('click', handleClearChat);

        // Export modal
        document.getElementById('closeExportModal').addEventListener('click', closeExportModal);
        document.getElementById('exportExcel').addEventListener('click', handleExportExcel);
        document.getElementById('exportPdf').addEventListener('click', handleExportPdf);

        // Close modals on outside click
        elements.exportModal.addEventListener('click', (e) => {
            if (e.target === elements.exportModal) {
                closeExportModal();
            }
        });

        // Close quick actions menu on outside click
        document.addEventListener('click', (e) => {
            if (!elements.btnAttach.contains(e.target) &&
                !elements.quickActionsMenu.contains(e.target)) {
                elements.quickActionsMenu.style.display = 'none';
            }
        });
    }

    /**
     * Handle send message
     */
    function handleSendMessage() {
        const message = elements.chatInput.value.trim();

        if (message === '') {
            return;
        }

        sendMessage(message);
        elements.chatInput.value = '';
        elements.chatInput.style.height = 'auto';
    }

    /**
     * Handle input keydown
     */
    function handleInputKeydown(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            handleSendMessage();
        }
    }

    /**
     * Handle suggestion click
     */
    function handleSuggestionClick(e) {
        const message = e.currentTarget.dataset.message;
        sendMessage(message);
    }

    /**
     * Handle quick action
     */
    function handleQuickAction(e) {
        const action = e.currentTarget.dataset.action;
        elements.quickActionsMenu.style.display = 'none';

        const messages = {
            'today': 'Tampilkan laporan hari ini',
            'week': 'Tampilkan laporan minggu ini',
            'month': 'Tampilkan laporan bulan ini',
            'custom': 'Bantuan',
            'stats': 'Berapa jumlah pasien bulan ini?'
        };

        if (messages[action]) {
            sendMessage(messages[action]);
        }
    }

    /**
     * Toggle quick actions menu
     */
    function toggleQuickActionsMenu() {
        const isVisible = elements.quickActionsMenu.style.display === 'block';
        elements.quickActionsMenu.style.display = isVisible ? 'none' : 'block';
    }

    /**
     * Send message to server
     */
    function sendMessage(message) {
        // Add user message to chat
        addUserMessage(message);

        // Show typing indicator
        showTypingIndicator();

        // Send to server
        $.ajax({
            url: CONTROLLER_URL + 'process_chat',
            type: 'POST',
            data: { message: message },
            dataType: 'json',
            success: function (response) {
                hideTypingIndicator();
                handleResponse(response);
            },
            error: function (xhr, status, error) {
                hideTypingIndicator();
                addBotMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'error');
                console.error('Error:', error);
            }
        });

        // Store in history
        state.messageHistory.push({
            type: 'user',
            message: message,
            timestamp: new Date()
        });
    }

    /**
     * Handle server response
     */
    function handleResponse(response) {
        if (!response.success) {
            addBotMessage(response.message || 'Terjadi kesalahan', 'error');
            return;
        }

        // Store in history
        state.messageHistory.push({
            type: 'bot',
            response: response,
            timestamp: new Date()
        });

        // Handle different response types
        switch (response.type) {
            case 'text':
                addBotMessage(response.message);
                break;

            case 'table':
                addBotMessage(response.message);
                addDataTable(response.data, response.count);
                state.currentFilters = response.filters;
                state.currentData = response.data;
                break;

            case 'export':
                addBotMessage(response.message);
                showExportModal();
                break;

            default:
                addBotMessage(response.message);
        }

        // Update suggestions
        if (response.suggestions && response.suggestions.length > 0) {
            updateSuggestions(response.suggestions);
        }
    }

    /**
     * Add user message to chat
     */
    function addUserMessage(message) {
        const messageHtml = `
            <div class="message user-message">
                <div class="message-content">
                    <div class="message-bubble">
                        ${escapeHtml(message)}
                    </div>
                    <div class="message-time">${getCurrentTime()}</div>
                </div>
                <div class="message-avatar">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        `;

        elements.chatMessages.insertAdjacentHTML('beforeend', messageHtml);
        scrollToBottom();
    }

    /**
     * Add bot message to chat
     */
    function addBotMessage(message, type = 'normal') {
        // Convert markdown-style formatting to HTML
        const formattedMessage = formatMessage(message);

        const messageHtml = `
            <div class="message bot-message">
                <div class="message-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="message-content">
                    <div class="message-bubble ${type === 'error' ? 'error-message' : ''}">
                        ${formattedMessage}
                    </div>
                    <div class="message-time">${getCurrentTime()}</div>
                </div>
            </div>
        `;

        elements.chatMessages.insertAdjacentHTML('beforeend', messageHtml);
        scrollToBottom();
    }

    /**
     * Add data table to chat
     */
    function addDataTable(data, count) {
        if (!data || data.length === 0) {
            return;
        }

        let tableHtml = `
            <div class="message bot-message">
                <div class="message-avatar">
                    <i class="fas fa-table"></i>
                </div>
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="data-table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Rawat</th>
                                        <th>No. RM</th>
                                        <th>Nama Pasien</th>
                                        <th>Dokter</th>
                                        <th>Poli</th>
                                        <th>Penjamin</th>
                                        <th>Tgl Registrasi</th>
                                        <th>Status Bayar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
        `;

        data.forEach((row, index) => {
            const statusBayarClass = row.status_bayar === 'Sudah Bayar' ? 'badge-success' : 'badge-warning';
            const statusClass = row.stts === 'Sudah' ? 'badge-success' : 'badge-warning';

            tableHtml += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${escapeHtml(row.no_rawat)}</td>
                    <td>${escapeHtml(row.no_rkm_medis)}</td>
                    <td>${escapeHtml(row.nm_pasien)}</td>
                    <td>${escapeHtml(row.nm_dokter)}</td>
                    <td>${escapeHtml(row.nm_poli)}</td>
                    <td>${escapeHtml(row.png_jawab)}</td>
                    <td>${formatDate(row.tgl_registrasi)}</td>
                    <td><span class="table-badge ${statusBayarClass}">${escapeHtml(row.status_bayar)}</span></td>
                    <td><span class="table-badge ${statusClass}">${escapeHtml(row.stts)}</span></td>
                </tr>
            `;
        });

        tableHtml += `
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="message-time">${getCurrentTime()}</div>
                </div>
            </div>
        `;

        elements.chatMessages.insertAdjacentHTML('beforeend', tableHtml);
        scrollToBottom();
    }

    /**
     * Show typing indicator
     */
    function showTypingIndicator() {
        state.isTyping = true;
        elements.typingIndicator.style.display = 'flex';
        scrollToBottom();
    }

    /**
     * Hide typing indicator
     */
    function hideTypingIndicator() {
        state.isTyping = false;
        elements.typingIndicator.style.display = 'none';
    }

    /**
     * Update quick suggestions
     */
    function updateSuggestions(suggestions) {
        elements.quickSuggestions.innerHTML = '';

        suggestions.forEach(suggestion => {
            const chip = document.createElement('button');
            chip.className = 'suggestion-chip';
            chip.dataset.message = suggestion;

            // Add icon based on suggestion content
            let icon = 'fa-comment';
            if (suggestion.toLowerCase().includes('export') || suggestion.toLowerCase().includes('download')) {
                icon = 'fa-download';
            } else if (suggestion.toLowerCase().includes('berapa') || suggestion.toLowerCase().includes('jumlah')) {
                icon = 'fa-chart-bar';
            } else if (suggestion.toLowerCase().includes('tampilkan') || suggestion.toLowerCase().includes('laporan')) {
                icon = 'fa-table';
            } else if (suggestion.toLowerCase().includes('bantuan') || suggestion.toLowerCase().includes('help')) {
                icon = 'fa-question-circle';
            }

            chip.innerHTML = `<i class="fas ${icon}"></i> ${escapeHtml(suggestion)}`;
            chip.addEventListener('click', handleSuggestionClick);

            elements.quickSuggestions.appendChild(chip);
        });
    }

    /**
     * Show export modal
     */
    function showExportModal() {
        elements.exportModal.style.display = 'flex';
    }

    /**
     * Close export modal
     */
    function closeExportModal() {
        elements.exportModal.style.display = 'none';
    }

    /**
     * Handle export to Excel
     */
    function handleExportExcel() {
        if (!state.currentData || state.currentData.length === 0) {
            alert('Tidak ada data untuk diexport. Silakan tampilkan laporan terlebih dahulu.');
            return;
        }

        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = CONTROLLER_URL + 'export_excel';

        const filtersInput = document.createElement('input');
        filtersInput.type = 'hidden';
        filtersInput.name = 'filters';
        filtersInput.value = JSON.stringify(state.currentFilters || {});

        form.appendChild(filtersInput);
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);

        closeExportModal();
        addBotMessage('✅ Export Excel sedang diproses. File akan segera didownload.');
    }

    /**
     * Handle export to PDF
     */
    function handleExportPdf() {
        if (!state.currentData || state.currentData.length === 0) {
            alert('Tidak ada data untuk diexport. Silakan tampilkan laporan terlebih dahulu.');
            return;
        }

        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = CONTROLLER_URL + 'export_pdf';
        form.target = '_blank'; // Open in new tab

        const filtersInput = document.createElement('input');
        filtersInput.type = 'hidden';
        filtersInput.name = 'filters';
        filtersInput.value = JSON.stringify(state.currentFilters || {});

        form.appendChild(filtersInput);
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);

        closeExportModal();
        addBotMessage('📄 Export PDF sedang diproses. File akan segera didownload.');
    }

    /**
     * Handle clear chat
     */
    function handleClearChat() {
        if (confirm('Apakah Anda yakin ingin menghapus semua chat?')) {
            // Keep only welcome message
            const welcomeMessage = elements.chatMessages.querySelector('.welcome-message').parentElement;
            elements.chatMessages.innerHTML = '';
            elements.chatMessages.appendChild(welcomeMessage);

            // Reset state
            state.messageHistory = [];
            state.currentFilters = null;
            state.currentData = null;

            // Reset suggestions
            updateSuggestions([
                'Tampilkan laporan hari ini',
                'Tampilkan laporan bulan ini',
                'Berapa jumlah pasien hari ini?',
                'Bantuan'
            ]);
        }
    }

    /**
     * Initialize speech recognition
     */
    function initSpeechRecognition() {
        if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
            console.warn('Speech recognition not supported');
            elements.btnVoice.style.display = 'none';
            return;
        }

        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        state.recognition = new SpeechRecognition();
        state.recognition.lang = 'id-ID';
        state.recognition.continuous = false;
        state.recognition.interimResults = false;

        state.recognition.onstart = function () {
            state.isRecording = true;
            elements.btnVoice.classList.add('recording');
        };

        state.recognition.onresult = function (event) {
            const transcript = event.results[0][0].transcript;
            elements.chatInput.value = transcript;
            elements.chatInput.focus();

            // Auto-send after voice input
            setTimeout(() => {
                handleSendMessage();
            }, 500);
        };

        state.recognition.onerror = function (event) {
            console.error('Speech recognition error:', event.error);
            state.isRecording = false;
            elements.btnVoice.classList.remove('recording');

            if (event.error === 'no-speech') {
                addBotMessage('Tidak ada suara terdeteksi. Silakan coba lagi.');
            } else if (event.error === 'not-allowed') {
                addBotMessage('Akses microphone ditolak. Silakan izinkan akses microphone di browser.');
            }
        };

        state.recognition.onend = function () {
            state.isRecording = false;
            elements.btnVoice.classList.remove('recording');
        };
    }

    /**
     * Toggle voice recording
     */
    function toggleVoiceRecording() {
        if (!state.recognition) {
            alert('Speech recognition tidak didukung di browser ini.');
            return;
        }

        if (state.isRecording) {
            state.recognition.stop();
        } else {
            state.recognition.start();
        }
    }

    /**
     * Auto-resize textarea
     */
    function autoResizeTextarea() {
        elements.chatInput.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });
    }

    /**
     * Scroll to bottom of chat
     */
    function scrollToBottom() {
        setTimeout(() => {
            elements.chatMessages.scrollTop = elements.chatMessages.scrollHeight;
        }, 100);
    }

    /**
     * Format message (markdown-style to HTML)
     */
    function formatMessage(message) {
        // Escape HTML first
        let formatted = escapeHtml(message);

        // Bold: **text** -> <strong>text</strong>
        formatted = formatted.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

        // Italic: *text* -> <em>text</em>
        formatted = formatted.replace(/\*(.*?)\*/g, '<em>$1</em>');

        // Line breaks
        formatted = formatted.replace(/\n/g, '<br>');

        return formatted;
    }

    /**
     * Escape HTML
     */
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return String(text).replace(/[&<>"']/g, m => map[m]);
    }

    /**
     * Get current time
     */
    function getCurrentTime() {
        const now = new Date();
        return now.getHours().toString().padStart(2, '0') + ':' +
            now.getMinutes().toString().padStart(2, '0');
    }

    /**
     * Format date
     */
    function formatDate(dateString) {
        if (!dateString) return '-';

        const date = new Date(dateString);
        const options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };

        return date.toLocaleDateString('id-ID', options);
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
