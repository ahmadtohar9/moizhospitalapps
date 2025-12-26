<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-cogs"></i> Pengaturan Display Antrian
            <small>Kelola tampilan dashboard antrian</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Setting Antrian</a></li>
            <li class="active">Pengaturan Display</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="icon fa fa-ban"></i> <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#global" aria-controls="global" role="tab" data-toggle="tab">
                    <i class="fa fa-globe"></i> Pengaturan Global
                </a>
            </li>
            <li role="presentation">
                <a href="#dokter" aria-controls="dokter" role="tab" data-toggle="tab">
                    <i class="fa fa-user-md"></i> Foto Dokter
                </a>
            </li>
            <li role="presentation">
                <a href="#preview" aria-controls="preview" role="tab" data-toggle="tab">
                    <i class="fa fa-eye"></i> Preview Dashboard
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="padding-top: 20px;">
            <!-- GLOBAL SETTINGS TAB -->
            <div role="tabpanel" class="tab-pane active" id="global">
                <form action="<?php echo base_url('antrian/pengaturanDisplayPoli/update_global_settings'); ?>" method="POST">
                    <div class="row">
                        <!-- LEFT COLUMN -->
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-hospital-o"></i> Informasi Rumah Sakit</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Nama Rumah Sakit <span class="text-danger">*</span></label>
                                        <input type="text" name="hospital_name" class="form-control" 
                                               value="<?php echo isset($global_settings['hospital_name']['value']) ? $global_settings['hospital_name']['value'] : 'RSUD PETALABUMI'; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Tema Warna</label>
                                        <select name="theme_color" class="form-control">
                                            <option value="pink-purple" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'pink-purple') ? 'selected' : ''; ?>>🌸 Pink + Purple</option>
                                            <option value="blue" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'blue') ? 'selected' : ''; ?>>💙 Blue</option>
                                            <option value="teal" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'teal') ? 'selected' : ''; ?>>🌊 Teal</option>
                                            <option value="orange-red" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'orange-red') ? 'selected' : ''; ?>>🔥 Orange + Red</option>
                                            <option value="green" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'green') ? 'selected' : ''; ?>>🌿 Green</option>
                                            <option value="indigo" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'indigo') ? 'selected' : ''; ?>>💜 Indigo</option>
                                            <option value="rose-gold" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'rose-gold') ? 'selected' : ''; ?>>🌹 Rose Gold</option>
                                            <option value="cyan" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'cyan') ? 'selected' : ''; ?>>🩵 Cyan</option>
                                            <option value="lime" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'lime') ? 'selected' : ''; ?>>🍋 Lime</option>
                                            <option value="amber" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'amber') ? 'selected' : ''; ?>>🟡 Amber</option>
                                            <option value="emerald" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'emerald') ? 'selected' : ''; ?>>💚 Emerald</option>
                                            <option value="fuchsia" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'fuchsia') ? 'selected' : ''; ?>>💗 Fuchsia</option>
                                            <option value="violet" <?php echo (isset($global_settings['theme_color']['value']) && $global_settings['theme_color']['value'] == 'violet') ? 'selected' : ''; ?>>🟣 Violet</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-youtube-play"></i> Video Settings</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="show_video" value="1" 
                                                   <?php echo (isset($global_settings['show_video']['value']) && $global_settings['show_video']['value'] == 'Ya') ? 'checked' : ''; ?>>
                                            Tampilkan Video
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Judul Video</label>
                                        <input type="text" name="video_title" class="form-control" 
                                               value="<?php echo isset($global_settings['video_title']['value']) ? $global_settings['video_title']['value'] : 'Video Informatif'; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>YouTube Embed URL</label>
                                        <input type="url" name="youtube_url" class="form-control" 
                                               value="<?php echo isset($global_settings['youtube_url']['value']) ? $global_settings['youtube_url']['value'] : ''; ?>" 
                                               placeholder="https://www.youtube.com/embed/VIDEO_ID">
                                        <small class="text-muted">
                                            <i class="fa fa-info-circle"></i> Gunakan URL embed, bukan URL watch. 
                                            Contoh: https://www.youtube.com/embed/jfKfPfyJRdk
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT COLUMN -->
                        <div class="col-md-6">
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-sliders"></i> Display Settings</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Auto Refresh Interval (ms)</label>
                                        <input type="number" name="auto_refresh_interval" class="form-control" 
                                               value="<?php echo isset($global_settings['auto_refresh_interval']['value']) ? $global_settings['auto_refresh_interval']['value'] : '3000'; ?>" 
                                               min="1000" step="1000">
                                        <small class="text-muted">Default: 3000ms (3 detik)</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Carousel Interval (ms)</label>
                                        <input type="number" name="carousel_interval" class="form-control" 
                                               value="<?php echo isset($global_settings['carousel_interval']['value']) ? $global_settings['carousel_interval']['value'] : '15000'; ?>" 
                                               min="5000" step="1000">
                                        <small class="text-muted">Default: 15000ms (15 detik)</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Scroll Duration (detik)</label>
                                        <input type="number" name="scroll_duration" class="form-control" 
                                               value="<?php echo isset($global_settings['scroll_duration']['value']) ? $global_settings['scroll_duration']['value'] : '60'; ?>" 
                                               min="10" step="5">
                                        <small class="text-muted">Default: 60 detik</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Max Pasien Display</label>
                                        <input type="number" name="max_patients_display" class="form-control" 
                                               value="<?php echo isset($global_settings['max_patients_display']['value']) ? $global_settings['max_patients_display']['value'] : '10'; ?>" 
                                               min="5" max="20">
                                        <small class="text-muted">Maksimal pasien yang ditampilkan per dokter</small>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="show_ticker" value="1" 
                                                   <?php echo (isset($global_settings['show_ticker']['value']) && $global_settings['show_ticker']['value'] == 'Ya') ? 'checked' : ''; ?>>
                                            Tampilkan Ticker Footer
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-volume-up"></i> Text-to-Speech</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="tts_enabled" value="1" 
                                                   <?php echo (isset($global_settings['tts_enabled']['value']) && $global_settings['tts_enabled']['value'] == 'Ya') ? 'checked' : ''; ?>>
                                            Aktifkan TTS
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label>Kecepatan TTS</label>
                                        <input type="number" name="tts_rate" class="form-control" 
                                               value="<?php echo isset($global_settings['tts_rate']['value']) ? $global_settings['tts_rate']['value'] : '0.65'; ?>" 
                                               min="0.1" max="2.0" step="0.05">
                                        <small class="text-muted">Range: 0.1 - 2.0 (Default: 0.65)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-save"></i> Simpan Pengaturan Global
                            </button>
                            <a href="<?php echo base_url('antrian/dashboard'); ?>" target="_blank" class="btn btn-success btn-lg">
                                <i class="fa fa-external-link"></i> Lihat Dashboard
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- DOKTER FOTO TAB -->
            <div role="tabpanel" class="tab-pane" id="dokter">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user-md"></i> Kelola Foto Dokter</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="tableDokter">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Kode Dokter</th>
                                    <th width="25%">Nama Dokter</th>
                                    <th width="20%">Foto</th>
                                    <th width="20%">Upload Foto</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($dokter_settings as $dokter): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $dokter['kd_dokter']; ?></td>
                                    <td><?php echo $dokter['nm_dokter']; ?></td>
                                    <td class="text-center">
                                        <?php if ($dokter['foto_path']): ?>
                                            <img src="<?php echo base_url($dokter['foto_path']); ?>" 
                                                 alt="<?php echo $dokter['nm_dokter']; ?>" 
                                                 class="img-circle" 
                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                 id="preview-<?php echo $dokter['kd_dokter']; ?>">
                                        <?php else: ?>
                                            <img src="<?php echo base_url('assets/dist/img/user1-128x128.jpg'); ?>" 
                                                 alt="Default" 
                                                 class="img-circle" 
                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                 id="preview-<?php echo $dokter['kd_dokter']; ?>">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="file" 
                                               class="form-control upload-foto" 
                                               data-kd-dokter="<?php echo $dokter['kd_dokter']; ?>" 
                                               accept="image/jpeg,image/png">
                                    </td>
                                    <td>
                                        <?php if ($dokter['foto_path']): ?>
                                            <button class="btn btn-danger btn-sm btn-delete-foto" 
                                                    data-kd-dokter="<?php echo $dokter['kd_dokter']; ?>">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- PREVIEW TAB -->
            <div role="tabpanel" class="tab-pane" id="preview">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-eye"></i> Preview Dashboard</h3>
                        <div class="box-tools">
                            <button class="btn btn-success btn-sm" onclick="window.open('<?php echo base_url('antrian/dashboard'); ?>', '_blank')">
                                <i class="fa fa-external-link"></i> Buka di Tab Baru
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <iframe src="<?php echo base_url('antrian/dashboard'); ?>" 
                                style="width: 100%; height: 600px; border: 2px solid #ddd; border-radius: 5px;">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#tableDokter').DataTable({
        "pageLength": 25,
        "order": [[1, 'asc']]
    });

    // Upload foto dokter
    $('.upload-foto').on('change', function() {
        var file = this.files[0];
        var kd_dokter = $(this).data('kd-dokter');
        var $input = $(this);
        
        if (!file) return;
        
        // Validate file type
        if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
            Swal.fire({
                icon: 'error',
                title: 'Format Tidak Valid',
                text: 'Hanya file JPG/PNG yang diperbolehkan!',
                timer: 3000,
                showConfirmButton: false
            });
            $input.val('');
            return;
        }
        
        // Validate file size (max 2MB)
        if (file.size > 2048000) {
            Swal.fire({
                icon: 'error',
                title: 'File Terlalu Besar',
                text: 'Ukuran file maksimal 2MB!',
                timer: 3000,
                showConfirmButton: false
            });
            $input.val('');
            return;
        }
        
        var formData = new FormData();
        formData.append('foto', file);
        formData.append('kd_dokter', kd_dokter);
        
        $.ajax({
            url: '<?php echo base_url("antrian/pengaturanDisplayPoli/upload_foto_dokter"); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                Swal.fire({
                    title: 'Uploading...',
                    text: 'Mohon tunggu',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                var res = JSON.parse(response);
                
                if (res.success) {
                    // Update preview image
                    $('#preview-' + kd_dokter).attr('src', res.foto_path + '?t=' + new Date().getTime());
                    
                    // Show button hapus if not exists
                    var $row = $input.closest('tr');
                    if ($row.find('.btn-delete-foto').length === 0) {
                        $row.find('td:last').html(
                            '<button class="btn btn-danger btn-sm btn-delete-foto" data-kd-dokter="' + kd_dokter + '">' +
                            '<i class="fa fa-trash"></i> Hapus</button>'
                        );
                        
                        // Re-bind delete event
                        bindDeleteEvent();
                    }
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: res.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                    
                    // Clear input
                    $input.val('');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: res.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat upload',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });
    });

    // Delete foto function
    function bindDeleteEvent() {
        $('.btn-delete-foto').off('click').on('click', function() {
            var kd_dokter = $(this).data('kd-dokter');
            var $button = $(this);
            
            Swal.fire({
                title: 'Hapus Foto?',
                text: 'Foto dokter akan dihapus',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('<?php echo base_url("antrian/pengaturanDisplayPoli/delete_foto_dokter"); ?>', {
                        kd_dokter: kd_dokter
                    }, function(response) {
                        var res = JSON.parse(response);
                        
                        if (res.success) {
                            // Update preview to default
                            $('#preview-' + kd_dokter).attr('src', '<?php echo base_url("assets/dist/img/user1-128x128.jpg"); ?>');
                            
                            // Remove delete button
                            $button.remove();
                            
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Foto berhasil dihapus',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: res.message,
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        });
    }
    
    // Initial bind
    bindDeleteEvent();
});
</script>
