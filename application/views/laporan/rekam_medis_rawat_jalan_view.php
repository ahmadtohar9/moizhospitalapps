<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/laporan_chat.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="chat-container">
        <!-- Header -->
        <div class="chat-header">
            <div class="header-content">
                <div class="header-left">
                    <div class="header-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div class="header-info">
                        <h1>Asisten Laporan Rekam Medis</h1>
                        <p class="header-subtitle">Rawat Jalan - Powered by AI Assistant</p>
                    </div>
                </div>
                <div class="header-right">
                    <button class="btn-icon" id="btnHelp" title="Bantuan">
                        <i class="fas fa-question-circle"></i>
                    </button>
                    <button class="btn-icon" id="btnClearChat" title="Hapus Chat">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Chat Messages Area -->
        <div class="chat-messages" id="chatMessages">
            <!-- Welcome Message -->
            <div class="message bot-message welcome-message">
                <div class="message-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="welcome-text">
                            <h2>👋 Halo, <?= $user_name ?>!</h2>
                            <p>Selamat datang di <strong>Asisten Laporan Rekam Medis Rawat Jalan</strong></p>
                            <p>Saya siap membantu Anda mengakses laporan dengan mudah. Cukup ketik perintah dalam bahasa
                                natural!</p>
                        </div>
                        <div class="quick-examples">
                            <h3>💡 Contoh Perintah:</h3>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> "Tampilkan laporan hari ini"</li>
                                <li><i class="fas fa-check-circle"></i> "Berapa pasien bulan ini?"</li>
                                <li><i class="fas fa-check-circle"></i> "Laporan per asuransi hari ini"</li>
                                <li><i class="fas fa-check-circle"></i> "Pasien dr Ahmad"</li>
                            </ul>
                        </div>
                    </div>
                    <div class="message-time"><?= date('H:i') ?></div>
                </div>
            </div>
        </div>

        <!-- Typing Indicator -->
        <div class="typing-indicator" id="typingIndicator" style="display: none;">
            <div class="message-avatar">
                <i class="fas fa-robot"></i>
            </div>
            <div class="typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <!-- Quick Suggestions -->
        <div class="quick-suggestions" id="quickSuggestions">
            <button class="suggestion-chip" data-message="Tampilkan laporan hari ini">
                <i class="fas fa-calendar-day"></i> Laporan Hari Ini
            </button>
            <button class="suggestion-chip" data-message="Laporan per asuransi hari ini">
                <i class="fas fa-hospital"></i> Per Asuransi
            </button>
            <button class="suggestion-chip" data-message="Berapa jumlah pasien hari ini?">
                <i class="fas fa-chart-bar"></i> Statistik
            </button>
            <button class="suggestion-chip" data-message="Bantuan">
                <i class="fas fa-question-circle"></i> Bantuan
            </button>
        </div>

        <!-- Input Area -->
        <div class="chat-input-container">
            <div class="chat-input-wrapper">
                <button class="btn-attach" id="btnAttach" title="Quick Actions">
                    <i class="fas fa-plus-circle"></i>
                </button>
                <button class="btn-voice" id="btnVoice" title="Voice Input">
                    <i class="fas fa-microphone"></i>
                </button>
                <textarea class="chat-input" id="chatInput"
                    placeholder="Ketik perintah Anda di sini... (contoh: tampilkan laporan hari ini)"
                    rows="1"></textarea>
                <button class="btn-send" id="btnSend" title="Kirim">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            <div class="input-hint">
                <i class="fas fa-lightbulb"></i>
                <span>Tip: Gunakan bahasa natural seperti berbicara dengan asisten, atau klik <i
                        class="fas fa-microphone"></i> untuk voice input</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="chat-footer">
            <div class="footer-content">
                <div class="footer-left">
                    <span>© <?= date('Y') ?> SIMRS Moiz Hospital</span>
                </div>
                <div class="footer-right">
                    <span>Laporan Chat v1.0 | Powered by Natural Language Processing</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Menu -->
    <div class="quick-actions-menu" id="quickActionsMenu" style="display: none;">
        <div class="quick-action" data-action="today">
            <i class="fas fa-calendar-day"></i>
            <span>Laporan Hari Ini</span>
        </div>
        <div class="quick-action" data-action="week">
            <i class="fas fa-calendar-week"></i>
            <span>Laporan Minggu Ini</span>
        </div>
        <div class="quick-action" data-action="month">
            <i class="fas fa-calendar-alt"></i>
            <span>Laporan Bulan Ini</span>
        </div>
        <div class="quick-action" data-action="custom">
            <i class="fas fa-filter"></i>
            <span>Filter Kustom</span>
        </div>
        <div class="quick-action" data-action="stats">
            <i class="fas fa-chart-pie"></i>
            <span>Statistik</span>
        </div>
    </div>

    <!-- Export Modal -->
    <div class="modal" id="exportModal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-download"></i> Export Laporan</h2>
                <button class="modal-close" id="closeExportModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>Pilih format export yang Anda inginkan:</p>
                <div class="export-options">
                    <button class="export-btn excel-btn" id="exportExcel">
                        <i class="fas fa-file-excel"></i>
                        <span>Export ke Excel</span>
                        <small>Format .xlsx</small>
                    </button>
                    <button class="export-btn pdf-btn" id="exportPdf">
                        <i class="fas fa-file-pdf"></i>
                        <span>Export ke PDF</span>
                        <small>Format .pdf</small>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // BASE_URL already defined in template header
        var CONTROLLER_URL = BASE_URL + 'laporan/RekamMedisRawaJalan/';
    </script>
    <script src="<?= base_url('assets/js/laporan_chat.js') ?>"></script>
</body>

</html>