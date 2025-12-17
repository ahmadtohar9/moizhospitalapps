<style>
.menu-link {
    color: #333;
    padding: 10px 15px;
    display: block;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.menu-link:hover {
    background-color: #ffcccb; /* Warna hover lembut */
    color: #000;
}

.menu-link.active {
    background-color: #ff4e50; /* Warna aktif */
    color: white;
    font-weight: bold;
}
</style>

<style>
    .nav-tabs li.active-tab a {
        background-color: #ff4d4d;
        color: white !important;
        font-weight: bold;
        border: 1px solid #d43f3a;
    }
</style>


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

        <!-- Menu Tab -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                  <?php if (!empty($tabs)): ?>
                    <?php foreach ($tabs as $label => $uri): ?>
                      <li role="presentation">
                        <a href="javascript:void(0);" class="menu-link"
                           data-menu="<?= $uri ?>" data-form="<?= $uri ?>">
                           <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <li><a href="#">Tidak ada menu aktif</a></li>
                  <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Form Container -->
        <div class="row">
            <div class="col-md-12">
                <div id="form-container" class="box box-primary">
                    <div class="box-body">
                        <div id="form-content">
                            <p>Pilih menu di atas untuk memuat form.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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

        $('#form-content').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Memuat form...</div>');

        $.ajax({
            url: requestUrl,
            type: "GET",
            success: function (response) {
                console.log("✅ Form berhasil dimuat:", menuUrl);
                $('#form-content').html(response);
            },
            error: function (xhr) {
                console.error('❌ Gagal memuat form:', xhr.status, xhr.statusText);
                $('#form-content').html('<p class="text-center text-danger">Gagal memuat form. Silakan coba lagi.</p>');
            }
        });
    }

    $('.menu-link').on('click', function () {
        const menuUrl = $(this).data('menu');

        // Aktifkan warna merah degradasi
        $('.nav-tabs li').removeClass('active-tab');
        $(this).parent().addClass('active-tab');

        loadForm(menuUrl);
    });

    // Load menu pertama saat halaman dimuat
    let firstMenu = $('.menu-link').first();
    if (firstMenu.length > 0) {
        firstMenu.click();
    }
});

</script>
