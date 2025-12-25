<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Antrian Pasien</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(-45deg, #4c1d95, #6d28d9, #7c3aed, #a855f7);
            background-size: 400% 400%;
            animation: gradientShift 20s ease infinite;
            color: #fff;
            overflow: hidden;
            height: 100vh;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .container {
            height: 100vh;
            display: grid;
            grid-template-rows: auto 1fr auto auto;
            padding: 8px;
            gap: 8px;
        }

        /* HEADER */
        .header {
            background: linear-gradient(135deg, #ec4899, #f472b6);
            backdrop-filter: blur(20px);
            padding: 12px 25px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 8px 30px rgba(236, 72, 153, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .header h1 {
            font-size: 26px;
            font-weight: 900;
            color: white;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .header p {
            font-size: 12px;
            opacity: 0.95;
            color: white;
        }

        .datetime {
            font-size: 19px;
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        /* MIDDLE ROW */
        .middle {
            display: grid;
            grid-template-columns: 28% 72%;
            gap: 8px;
            overflow: hidden;
        }

        .card {
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        /* CURRENT CALL - PINK */
        .current-call {
            background: linear-gradient(135deg, #ec4899, #f472b6);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .call-title {
            font-size: 15px;
            font-weight: 800;
            color: white;
            margin-bottom: 12px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .doctor-photo {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            border: 4px solid white;
            margin-bottom: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .queue-number {
            font-size: 48px;
            font-weight: 900;
            color: white;
            margin-bottom: 8px;
            animation: pulse 2s ease-in-out infinite;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.08);
            }
        }

        .patient-name {
            font-size: 20px;
            font-weight: 800;
            color: white;
            margin-bottom: 10px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .call-details {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 10px 15px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .detail-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin: 4px 0;
            font-size: 13px;
            font-weight: 700;
            color: white;
        }

        /* VIDEO - BLUE */
        .video-card {
            background: linear-gradient(135deg, #7c3aed, #a855f7);
            display: flex;
            flex-direction: column;
        }

        .video-title {
            font-size: 15px;
            font-weight: 800;
            color: white;
            margin-bottom: 10px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .video-container {
            flex: 1;
            border-radius: 10px;
            overflow: hidden;
            background: #000;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        .video-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* BOTTOM - DOCTOR CARDS - BLUE */
        .bottom {
            background: linear-gradient(135deg, #7c3aed, #a855f7);
            border-radius: 12px;
            padding: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            max-height: 280px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .bottom-title {
            font-size: 17px;
            font-weight: 800;
            color: white;
            margin-bottom: 10px;
            flex-shrink: 0;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .doctor-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            flex: 1;
            overflow: hidden;
            align-items: start;
        }

        .doctor-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .doctor-header {
            background: linear-gradient(135deg, #ec4899, #f472b6);
            color: white;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 8px;
            box-shadow: 0 4px 15px rgba(236, 72, 153, 0.4);
        }

        .doctor-name {
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 3px;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        .doctor-poli {
            font-size: 11px;
            opacity: 0.95;
            font-weight: 600;
        }

        .patient-list {
            flex: 1;
            overflow: hidden;
            padding-right: 4px;
            position: relative;
        }

        .patient-list-inner {
            animation: scrollUp 60s linear infinite;
        }

        .patient-list-inner:hover {
            animation-play-state: paused;
        }

        @keyframes scrollUp {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-50%);
            }
        }

        .patient-item {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 7px;
            margin-bottom: 5px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        /* WAITING - PINK */
        .patient-item.waiting {
            background: linear-gradient(135deg, #ec4899, #f472b6);
            color: white;
            border-left: 3px solid white;
            box-shadow: 0 3px 12px rgba(236, 72, 153, 0.4);
        }

        /* CALLED - BLUE */
        .patient-item.called {
            background: linear-gradient(135deg, #7c3aed, #a855f7);
            color: white;
            border-left: 3px solid white;
            box-shadow: 0 3px 12px rgba(168, 85, 247, 0.4);
        }

        .patient-item i {
            font-size: 11px;
        }

        .patient-number {
            font-weight: 900;
            min-width: 45px;
        }

        .patient-name-small {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: rgba(255, 255, 255, 0.7);
        }

        .empty-state i {
            font-size: 45px;
            margin-bottom: 10px;
            opacity: 0.6;
        }

        .empty-state p {
            font-size: 14px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.8);
        }

        /* FOOTER TICKER - PINK */
        .footer-ticker {
            background: linear-gradient(135deg, #ec4899, #f472b6);
            backdrop-filter: blur(20px);
            padding: 10px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(236, 72, 153, 0.4);
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .ticker-content {
            display: flex;
            gap: 35px;
            animation: tickerScroll 60s linear infinite;
            white-space: nowrap;
        }

        @keyframes tickerScroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .ticker-item {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 700;
            color: white;
        }

        .ticker-doctor {
            color: white;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        .ticker-count {
            background: rgba(255, 255, 255, 0.3);
            padding: 3px 10px;
            border-radius: 15px;
            font-weight: 800;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- HEADER - PINK -->
        <div class="header">
            <div>
                <h1><?php echo $hospital_name; ?></h1>
                <p>Dashboard Antrian Rawat Jalan</p>
            </div>
            <div class="datetime" id="datetime">Loading...</div>
        </div>

        <!-- MIDDLE ROW -->
        <div class="middle">
            <!-- CURRENT CALL - PINK -->
            <div class="card current-call">
                <div class="call-title">
                    <i class="fas fa-bullhorn"></i> SEDANG DIPANGGIL
                </div>
                <div id="currentCallContent">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada panggilan</p>
                    </div>
                </div>
            </div>

            <!-- VIDEO - BLUE -->
            <div class="card video-card">
                <div class="video-title">
                    <i class="fas fa-video"></i> Video Informatif
                </div>
                <div class="video-container">
                    <iframe id="youtubeVideo" loading="lazy"
                        data-src="https://www.youtube.com/embed/jfKfPfyJRdk?autoplay=1&mute=1&loop=1&playlist=jfKfPfyJRdk&controls=0&modestbranding=1"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>

        <!-- BOTTOM - DOCTOR CARDS - BLUE -->
        <div class="bottom">
            <div class="bottom-title">
                <i class="fas fa-users"></i> Antrian Per Dokter
            </div>
            <div class="doctor-grid" id="doctorGrid"></div>
        </div>

        <!-- FOOTER TICKER - PINK -->
        <div class="footer-ticker">
            <div class="ticker-content" id="tickerContent"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const API_URL = '<?php echo base_url("antrian/"); ?>';
        const REFRESH_INTERVAL = 3000;
        const CAROUSEL_INTERVAL = 15000;

        let lastCallId = null;
        let allDoctorQueues = [];
        let currentSlide = 0;

        $(document).ready(function () {
            updateDateTime();
            loadLatestCall();
            loadAllQueues();

            setTimeout(function () {
                const iframe = document.getElementById('youtubeVideo');
                if (iframe && iframe.dataset.src) {
                    iframe.src = iframe.dataset.src;
                }
            }, 1000);

            setInterval(function () {
                updateDateTime();
                loadLatestCall();
                loadAllQueues();
            }, REFRESH_INTERVAL);

            setInterval(function () {
                if (allDoctorQueues.length > 4) {
                    nextSlide();
                }
            }, CAROUSEL_INTERVAL);
        });

        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
                hour: '2-digit', minute: '2-digit', second: '2-digit'
            };
            $('#datetime').text(now.toLocaleDateString('id-ID', options));
        }

        function loadLatestCall() {
            $.ajax({
                url: API_URL + 'api/latest_call',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success && response.data && response.data.length > 0) {
                        const call = response.data[0];
                        const storedLastCallId = localStorage.getItem('lastCallId');
                        const storedLastCallTime = localStorage.getItem('lastCallTime');
                        const isNewCall = (call.id && (storedLastCallId !== String(call.id) || storedLastCallTime !== call.terakhir_panggil));

                        if (isNewCall) {
                            displayCurrentCall(call);
                            speakPanggilan(call);
                            localStorage.setItem('lastCallId', call.id);
                            localStorage.setItem('lastCallTime', call.terakhir_panggil);
                        } else {
                            displayCurrentCall(call);
                        }
                    } else {
                        displayEmptyCall();
                    }
                }
            });
        }

        function displayCurrentCall(call) {
            const html = `
                <img src="<?php echo base_url('assets/dist/img/user1-128x128.jpg'); ?>" class="doctor-photo">
                <div class="queue-number">${call.no_antrian}</div>
                <div class="patient-name">${call.nm_pasien}</div>
                <div class="call-details">
                    <div class="detail-row"><i class="fas fa-hospital"></i> ${call.nm_poli}</div>
                    <div class="detail-row"><i class="fas fa-user-md"></i> ${call.nm_dokter}</div>
                </div>
            `;
            $('#currentCallContent').html(html);
        }

        function displayEmptyCall() {
            $('#currentCallContent').html('<div class="empty-state"><i class="fas fa-inbox"></i><p>Belum ada panggilan</p></div>');
        }

        function loadAllQueues() {
            $.ajax({
                url: API_URL + 'api/doctor_queues',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success && response.data) {
                        allDoctorQueues = response.data;
                        displayDoctorCards();
                        updateTicker();
                    }
                }
            });
        }

        function displayDoctorCards() {
            if (allDoctorQueues.length === 0) {
                $('#doctorGrid').html('<div class="empty-state" style="grid-column: 1 / -1;"><i class="fas fa-user-md"></i><p>Tidak ada antrian</p></div>');
                return;
            }

            const start = currentSlide * 4;
            const doctorsToShow = allDoctorQueues.slice(start, start + 4);

            let html = '';
            doctorsToShow.forEach(doctor => {
                html += `
                    <div class="doctor-card">
                        <div class="doctor-header">
                            <div class="doctor-name">${doctor.nm_dokter}</div>
                            <div class="doctor-poli">${doctor.nm_poli}</div>
                        </div>
                        <div class="patient-list">
                `;

                if (doctor.patients && doctor.patients.length > 0) {
                    // Filter only waiting patients (not called yet)
                    const waitingPatients = doctor.patients.filter(p => p.status_panggil !== 'Dipanggil');
                    const totalWaiting = waitingPatients.length;
                    const patientsToShow = waitingPatients.slice(0, 10);
                    const remaining = totalWaiting - 10;

                    let patientItems = '';
                    patientsToShow.forEach(patient => {
                        patientItems += `
                            <div class="patient-item waiting">
                                <i class="fas fa-clock"></i>
                                <span class="patient-number">${patient.no_antrian}</span>
                                <span class="patient-name-small">${patient.nm_pasien}</span>
                            </div>
                        `;
                    });

                    if (remaining > 0) {
                        patientItems += `<div style="text-align: center; padding: 8px; font-weight: 800; color: white;">+${remaining} pasien lagi</div>`;
                    }

                    if (patientsToShow.length > 3) {
                        html += `<div class="patient-list-inner">${patientItems}${patientItems}</div>`;
                    } else {
                        html += patientItems;
                    }
                } else {
                    html += '<div class="empty-state"><p>Tidak ada pasien</p></div>';
                }

                html += '</div></div>';
            });

            $('#doctorGrid').html(html);
        }

        function nextSlide() {
            const totalSlides = Math.ceil(allDoctorQueues.length / 4);
            currentSlide = (currentSlide + 1) % totalSlides;
            displayDoctorCards();
            updateTicker();
        }

        function updateTicker() {
            if (allDoctorQueues.length === 0) {
                $('#tickerContent').html('<span class="ticker-item">Tidak ada antrian</span>');
                return;
            }

            let totalPatients = 0;
            let html = '';

            allDoctorQueues.forEach(doctor => {
                const waitingCount = doctor.patients ? doctor.patients.filter(p => p.status_panggil !== 'Dipanggil').length : 0;
                totalPatients += waitingCount;

                html += `
                    <div class="ticker-item">
                        <span class="ticker-doctor"><i class="fas fa-user-md"></i> ${doctor.nm_dokter}</span>
                        <span class="ticker-count">${waitingCount} pasien</span>
                    </div>
                `;
            });

            const summary = `<div class="ticker-item" style="font-weight: 900;"><i class="fas fa-chart-bar"></i> TOTAL: ${allDoctorQueues.length} Dokter | ${totalPatients} Pasien Menunggu</div>`;

            const duplicated = html + html;
            $('#tickerContent').html(summary + duplicated);
        }

        function speakPanggilan(call) {
            if (!('speechSynthesis' in window)) return;
            window.speechSynthesis.cancel();

            const text = `Nomor antrian ${call.no_antrian}, atas nama ${call.nm_pasien}, silakan menuju ${call.nm_poli}, ${call.nm_dokter}`;
            const utterance = new SpeechSynthesisUtterance(text);

            const voices = window.speechSynthesis.getVoices();
            const indonesianVoice = voices.find(voice => voice.lang.includes('id-ID') || voice.lang.includes('id'));
            if (indonesianVoice) utterance.voice = indonesianVoice;

            utterance.lang = 'id-ID';
            utterance.rate = 0.65;
            utterance.pitch = 1.0;
            utterance.volume = 1.0;

            window.speechSynthesis.speak(utterance);
        }
    </script>
</body>

</html>