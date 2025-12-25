/**
 * Dashboard Antrian - Real-time Updates & Text-to-Speech
 * 
 * @package    MoizHospital
 * @subpackage Assets/JS
 * @author     Ahmad Tohar
 * @version    1.0.0
 */

let lastCallId = null;
let lastCallTimestamp = null;

/**
 * Initialize Dashboard
 */
function initDashboard() {
    console.log('🚀 Dashboard Antrian initialized');

    // Load initial data
    loadLatestCall();
    loadQueueList();

    // Set auto-refresh
    setInterval(function () {
        loadLatestCall();
        loadQueueList();
    }, REFRESH_INTERVAL);
}

/**
 * Load latest panggilan
 */
function loadLatestCall() {
    $.ajax({
        url: API_URL + 'get_latest_call',
        method: 'GET',
        dataType: 'json',
        data: {
            limit: 1
        },
        success: function (response) {
            if (response.success && response.data && response.data.length > 0) {
                const call = response.data[0];

                // Check if this is a new call
                const isNewCall = (lastCallId !== call.id || lastCallTimestamp !== call.terakhir_panggil);

                if (isNewCall) {
                    displayCurrentCall(call, true);

                    // Play text-to-speech
                    speakPanggilan(call);

                    // Update last call tracking
                    lastCallId = call.id;
                    lastCallTimestamp = call.terakhir_panggil;
                } else {
                    // Just update display without animation/sound
                    displayCurrentCall(call, false);
                }
            } else {
                displayEmptyCall();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error loading latest call:', error);
        }
    });
}

/**
 * Display current call
 */
function displayCurrentCall(call, animate = false) {
    const container = $('#currentCallContainer');

    const html = `
        <div class="current-call-card ${animate ? 'new-call-animation' : ''}">
            <div class="no-antrian-display">${call.no_antrian || '-'}</div>
            <div class="nama-pasien-display">${call.nm_pasien || '-'}</div>
            <div class="info-display">
                <div class="info-item">
                    <div class="info-item-label"><i class="fas fa-user-md"></i> Dokter</div>
                    <div class="info-item-value">${call.nm_dokter || '-'}</div>
                </div>
                <div class="info-item">
                    <div class="info-item-label"><i class="fas fa-clinic-medical"></i> Poli</div>
                    <div class="info-item-value">${call.nm_poli || '-'}</div>
                </div>
            </div>
        </div>
    `;

    container.html(html);
}

/**
 * Display empty state
 */
function displayEmptyCall() {
    const container = $('#currentCallContainer');

    const html = `
        <div class="empty-state">
            <i class="fas fa-clock"></i>
            <p>Menunggu Panggilan...</p>
        </div>
    `;

    container.html(html);
}

/**
 * Load queue list (antrian menunggu)
 */
function loadQueueList() {
    $.ajax({
        url: API_URL + 'get_antrian_menunggu',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.success && response.data && response.data.length > 0) {
                displayQueueList(response.data);
            } else {
                displayEmptyQueue();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error loading queue list:', error);
        }
    });
}

/**
 * Display queue list
 */
function displayQueueList(queue) {
    const container = $('#queueList');
    let html = '';

    // Limit to 10 items for display
    const displayQueue = queue.slice(0, 10);

    displayQueue.forEach(function (item) {
        html += `
            <div class="queue-item">
                <div class="queue-number">${item.no_antrian || '-'}</div>
                <div class="queue-info">
                    <div class="queue-name">${item.nm_pasien || '-'}</div>
                    <div class="queue-detail">
                        <i class="fas fa-user-md"></i> ${item.nm_dokter || '-'} 
                        | <i class="fas fa-clinic-medical"></i> ${item.nm_poli || '-'}
                    </div>
                </div>
            </div>
        `;
    });

    container.html(html);
}

/**
 * Display empty queue
 */
function displayEmptyQueue() {
    const container = $('#queueList');

    const html = `
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <p>Tidak ada antrian</p>
        </div>
    `;

    container.html(html);
}

/**
 * Text-to-Speech untuk panggilan
 */
function speakPanggilan(call) {
    // Check if ResponsiveVoice is loaded
    if (typeof responsiveVoice === 'undefined') {
        console.warn('ResponsiveVoice not loaded');
        return;
    }

    // Prepare text
    const text = `Nomor antrian ${call.no_antrian}, atas nama ${call.nm_pasien}, silakan menuju ${call.nm_poli}, dokter ${call.nm_dokter}`;

    console.log('🔊 Speaking:', text);

    // Speak with Indonesian Female voice
    responsiveVoice.speak(text, "Indonesian Female", {
        pitch: 1,
        rate: 0.85,
        volume: 1,
        onstart: function () {
            console.log('🎤 Speech started');
        },
        onend: function () {
            console.log('✅ Speech ended');
        },
        onerror: function (error) {
            console.error('❌ Speech error:', error);
        }
    });
}

/**
 * Manual trigger untuk test
 */
function testSpeak() {
    const testData = {
        no_antrian: 'A-001',
        nm_pasien: 'AHMAD TOHAR',
        nm_dokter: 'dr. Budi Santoso, Sp.PD',
        nm_poli: 'POLI UMUM'
    };

    speakPanggilan(testData);
}

// Expose to global for debugging
window.testSpeak = testSpeak;
window.speakPanggilan = speakPanggilan;
