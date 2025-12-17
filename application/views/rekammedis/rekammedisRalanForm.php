<div class="content-wrapper">
    <section class="content-header">
        <h1><?= $title ?></h1>
    </section>

    <!-- Informasi Pasien -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user"></i> Informasi Pasien</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <!-- Baris 1 -->
                            <div class="col-md-3">
                                <strong><i class="fa fa-hospital-o"></i> No. Rawat:</strong>
                                <p id="no_rawat_display"><?= $detail_pasien['no_rawat'] ?></p>
                                <input type="hidden" id="no_rawat" name="no_rawat" value="<?= $detail_pasien['no_rawat'] ?>">
                            </div>
                            <div class="col-md-3">
                                <strong><i class="fa fa-id-card"></i> No. RM:</strong>
                                <p><?= $detail_pasien['no_rkm_medis'] ?></p>
                            </div>
                            <div class="col-md-3">
                                <strong><i class="fa fa-user-circle"></i> Nama Pasien:</strong>
                                <p><?= $detail_pasien['nm_pasien'] ?></p>
                            </div>
                            <div class="col-md-3">
                                <strong><i class="fa fa-venus-mars"></i> Jenis Kelamin:</strong>
                                <p><?= ($detail_pasien['jk'] == 'P') ? 'Perempuan' : 'Laki-laki'; ?></p>
                            </div>
                            <!-- Baris 2 -->
                            <div class="col-md-3">
                                <strong><i class="fa fa-birthday-cake"></i> TglLahir & Umur:</strong>
                                <p><?= $detail_pasien['tgl_lahir'] ?> / <?= $detail_pasien['umur'] ?></p>
                            </div>
                            <div class="col-md-3">
                                <strong><i class="fa fa-user-md"></i> Dokter:</strong>
                                <p><?= $detail_pasien['nm_dokter'] ?></p>
                            </div>
                            <div class="col-md-3">
                                <strong><i class="fa fa-building"></i> Poliklinik:</strong>
                                <p><?= $detail_pasien['nm_poli'] ?></p>
                            </div>
                            <div class="col-md-3">
                                <strong><i class="fa fa-shield"></i> Penanggung Jawab:</strong>
                                <p><?= $detail_pasien['png_jawab'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Horizontal Scroll -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> Menu Rekam Medis</h3>
                    </div>
                    <div class="box-body">
                        <!-- Horizontal Scroll Menu -->
                        <div class="menu-scroll-container">
                            <div class="menu-scroll-wrapper">
                                <?php if (!empty($tabs)): ?>
                                    <?php foreach ($tabs as $label => $uri): ?>
                                        <div class="menu-item" data-menu="<?= $uri ?>">
                                            <div class="menu-icon">
                                                <i class="fa fa-stethoscope"></i>
                                            </div>
                                            <div class="menu-text"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center text-muted">
                                        <p>Tidak ada menu aktif</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="scroll-arrows">
                                <button class="scroll-arrow scroll-left"><i class="fa fa-chevron-left"></i></button>
                                <button class="scroll-arrow scroll-right"><i class="fa fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="row">
            <div class="col-md-12">
                <div id="form-container" class="box box-primary">
                    <div class="box-body">
                        <div id="form-content">
                            <p class="text-center text-muted">Pilih menu di atas untuk memuat form.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Load CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/panelMenuRekamMedis.css') ?>">

<script>
$(document).ready(function () {
    const loadFormUrl = "<?= base_url('rekammedisRalanController/loadForm') ?>";

    function loadForm(menuUrl) {
        const noRawat = $('#no_rawat').val();

        if (!menuUrl) {
            console.error("⚠️ Menu URL tidak valid!");
            return;
        }

        // Perbaiki encoding dan pastikan path sesuai
        const encodedMenuUrl = menuUrl.replace(/\//g, '~');
        const requestUrl = `${loadFormUrl}/${encodedMenuUrl}?no_rawat=${encodeURIComponent(noRawat)}`;

        console.log("🔄 Memuat form:", requestUrl);

        $('#form-content').html(`
            <div class="text-center" style="padding: 40px;">
                <div class="loading-spinner"></div>
                <p style="margin-top: 15px; color: #666;">Memuat form...</p>
            </div>
        `);

        $.ajax({
            url: requestUrl,
            type: "GET",
            success: function (response) {
                console.log("✅ Form berhasil dimuat:", menuUrl);
                $('#form-content').html(response);
            },
            error: function (xhr) {
                console.error('❌ Gagal memuat form:', xhr.status, xhr.statusText);
                $('#form-content').html(`
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-exclamation-triangle"></i> Gagal memuat form. Silakan coba lagi.
                    </div>
                `);
            }
        });
    }

    // Menu item click handler
    $('.menu-item').on('click', function () {
        const menuUrl = $(this).data('menu');

        // Update active state (warna merah seperti yang lama)
        $('.menu-item').removeClass('active');
        $(this).addClass('active');

        loadForm(menuUrl);
    });

    // Scroll arrows functionality
    $('.scroll-left').on('click', function () {
        $('.menu-scroll-wrapper').animate({
            scrollLeft: '-=200'
        }, 300);
    });

    $('.scroll-right').on('click', function () {
        $('.menu-scroll-wrapper').animate({
            scrollLeft: '+=200'
        }, 300);
    });

    // Load menu pertama saat halaman dimuat
    let firstMenu = $('.menu-item').first();
    if (firstMenu.length > 0) {
        firstMenu.click();
    }
});
</script>