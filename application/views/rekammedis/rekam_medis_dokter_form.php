<div class="content-wrapper">
    <section class="content-header">
        <h1>Rekam Medis Dokter</h1>
    </section>

    <section class="content">
        <!-- Box Data Pasien -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Data Pasien</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong><i class="fa fa-hospital-o"></i> No. Rawat:</strong>
                        <p id="no_rawat_display"><?= $detail_pasien['no_rawat']; ?></p>
                        <input type="hidden" id="no_rawat" name="no_rawat" value="<?= $detail_pasien['no_rawat']; ?>">
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-id-card"></i> No. RM:</strong>
                        <p><?= $detail_pasien['no_rkm_medis']; ?></p>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-user-circle"></i> Nama Pasien:</strong>
                        <p><?= $detail_pasien['nm_pasien']; ?></p>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-venus-mars"></i> Jenis Kelamin:</strong>
                        <p><?= ($detail_pasien['jk'] == 'P') ? 'Perempuan' : 'Laki-laki'; ?></p>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-birthday-cake"></i> Umur:</strong>
                        <p><?= $detail_pasien['umur']; ?></p>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-user-md"></i> Dokter:</strong>
                        <p><?= $detail_pasien['nm_dokter']; ?></p>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-building"></i> Poliklinik:</strong>
                        <p><?= $detail_pasien['nm_poli']; ?></p>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="fa fa-shield"></i> Penanggung Jawab:</strong>
                        <p><?= $detail_pasien['png_jawab']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Box Menu Rekam Medis -->
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Menu Rekam Medis</h3>
            </div>
            <div class="box-body">
                <ul class="nav nav-tabs">
                    <?php foreach ($rekam_medis_menus as $menu => $url): ?>
                        <li><a href="#" class="menu-link" data-menu="<?= $url ?>"><?= $menu ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <div id="form-content" style="margin-top: 20px;"></div>
            </div>
        </div>
    </section>
</div>

<script>
    const loadFormUrl = "<?= base_url('RekamMedisRalanController/loadForm') ?>";

    function loadForm(menuUrl) {
        const noRawat = $('#no_rawat').val();
        const encodedMenuUrl = menuUrl.replace(/\//g, '~');
        const requestUrl = `${loadFormUrl}/${encodedMenuUrl}?no_rawat=${encodeURIComponent(noRawat)}`;

        $('#form-content').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Memuat form...</div>');

        $.ajax({
            url: requestUrl,
            type: "GET",
            success: function (response) {
                $('#form-content').html(response);
            },
            error: function () {
                $('#form-content').html('<div class="alert alert-danger">Gagal memuat form.</div>');
            }
        });
    }

    $(document).ready(function () {
        $('.menu-link').on('click', function (e) {
            e.preventDefault(); // Hindari reload halaman
            const menuUrl = $(this).data('menu');

            $('.nav-tabs li').removeClass('active');
            $(this).parent().addClass('active');

            loadForm(menuUrl);
        });

        // Otomatis klik tab pertama saat halaman dimuat
        $('.menu-link').first().trigger('click');
    });
</script>
