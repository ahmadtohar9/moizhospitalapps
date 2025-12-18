<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-refresh"></i> System Update
            <small>Auto-Update System</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">System Update</li>
        </ol>
    </section>

    <section class="content">
        <!-- Version Info Box -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-code-fork"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Current Version</span>
                        <span class="info-box-number"><?= $current_version; ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            Build: <?= $build; ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green" id="latest-version-box">
                    <span class="info-box-icon"><i class="fa fa-cloud-download"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Latest Version</span>
                        <span class="info-box-number" id="latest-version">
                            <i class="fa fa-spinner fa-spin"></i> Checking...
                        </span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description" id="update-status">
                            Checking for updates...
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-database"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pending Migrations</span>
                        <span class="info-box-number"><?= $pending_migrations; ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= $pending_migrations > 0 ? '50' : '100'; ?>%">
                            </div>
                        </div>
                        <span class="progress-description">
                            <?= $executed_migrations; ?> executed
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Release Date</span>
                        <span class="info-box-number"
                            style="font-size: 18px;"><?= date('d M Y', strtotime($release_date)); ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <?= count($update_history); ?> updates installed
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Panel -->
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary" id="update-panel">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-refresh"></i> System Update</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" onclick="checkUpdate()">
                                <i class="fa fa-refresh"></i> Refresh
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="update-content">
                            <div class="text-center" style="padding: 50px 0;">
                                <i class="fa fa-spinner fa-spin fa-3x text-muted"></i>
                                <p class="text-muted" style="margin-top: 20px;">Checking for updates...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Developer Tools (Push to GitHub) -->
                <!-- Hanya muncul di Localhost / IP Lokal -->
                <?php if ($_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1'): ?>
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-code"></i> Developer Mode (Localhost Only)</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Commit Message</label>
                                <input type="text" class="form-control" id="commit_message"
                                    placeholder="Auto update from Admin Panel">
                            </div>
                            <button class="btn btn-danger btn-block" onclick="pushToGithub()">
                                <i class="fa fa-github"></i> Push Local Changes to GitHub
                            </button>

                            <div id="push-output"
                                style="margin-top:15px; background:#222; color:#0f0; padding:10px; font-family:monospace; white-space:pre-wrap; display:none; max-height:200px; overflow:auto;">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Changelog Box -->
                <div class="box box-info collapsed-box" id="changelog-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-file-text-o"></i> Changelog</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" id="changelog-content" style="max-height: 500px; overflow-y: auto;">
                        <p class="text-muted">Click to expand and view changelog...</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- System Info -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info-circle"></i> System Info</h3>
                    </div>
                    <div class="box-body" id="system-info">
                        <div class="text-center" style="padding: 20px 0;">
                            <i class="fa fa-spinner fa-spin fa-2x text-muted"></i>
                        </div>
                    </div>
                </div>

                <!-- Update History -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-history"></i> Update History</h3>
                    </div>
                    <div class="box-body" style="max-height: 400px; overflow-y: auto;">
                        <?php if (empty($update_history)): ?>
                            <p class="text-muted text-center">No update history yet</p>
                        <?php else: ?>
                            <ul class="timeline">
                                <?php foreach (array_slice($update_history, 0, 10) as $history): ?>
                                    <li>
                                        <i class="fa fa-check bg-green"></i>
                                        <div class="timeline-item">
                                            <span class="time">
                                                <i class="fa fa-clock-o"></i>
                                                <?= date('d M Y H:i', strtotime($history['timestamp'])); ?>
                                            </span>
                                            <h3 class="timeline-header">
                                                Updated to v<?= $history['to_version']; ?>
                                            </h3>
                                            <div class="timeline-body">
                                                From v<?= $history['from_version']; ?> by <?= $history['user']; ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Update Progress Modal -->
<div class="modal fade" id="updateProgressModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><i class="fa fa-refresh fa-spin"></i> Updating System...</h4>
            </div>
            <div class="modal-body">
                <div id="update-progress">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" id="progress-bar"
                            style="width: 0%">
                            <span id="progress-text">0%</span>
                        </div>
                    </div>
                    <div id="update-steps" style="margin-top: 20px;">
                        <!-- Steps will be added here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Check update on page load
        checkUpdate();

        // Load system info
        loadSystemInfo();

        // Load changelog when expanded
        $('#changelog-box').on('expanded.boxwidget', function () {
            if ($('#changelog-content p.text-muted').length > 0) {
                loadChangelog();
            }
        });
    });

    function checkUpdate() {
        $('#latest-version').html('<i class="fa fa-spinner fa-spin"></i> Checking...');
        $('#update-status').text('Checking for updates...');

        $.ajax({
            url: '<?= base_url('systemupdate/check_update'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    $('#latest-version').text(response.latest_version);

                    if (response.has_update) {
                        $('#latest-version-box').removeClass('bg-green').addClass('bg-orange');
                        $('#update-status').html('<strong>Update available!</strong>');
                        showUpdateAvailable(response);
                    } else {
                        $('#latest-version-box').removeClass('bg-orange').addClass('bg-green');
                        $('#update-status').text('You are up to date!');
                        showUpToDate();
                    }
                } else {
                    $('#latest-version').text('Error');
                    $('#update-status').text(response.message);
                    showError(response.message);
                }
            },
            error: function () {
                $('#latest-version').text('Error');
                $('#update-status').text('Failed to check update');
                showError('Failed to connect to update server');
            }
        });
    }

    function showUpdateAvailable(data) {
        var html = `
        <div class="callout callout-warning">
            <h4><i class="fa fa-exclamation-triangle"></i> Update Available!</h4>
            <p>A new version <strong>v${data.latest_version}</strong> is available. You are currently running <strong>v${data.current_version}</strong>.</p>
        </div>
        
        <div class="alert alert-info">
            <h4><i class="fa fa-info-circle"></i> What's New?</h4>
            <div style="max-height: 200px; overflow-y: auto;">
                <pre style="background: transparent; border: none; padding: 0;">${escapeHtml(data.changelog || 'Loading changelog...')}</pre>
            </div>
        </div>
        
        <div class="alert alert-warning">
            <h4><i class="fa fa-warning"></i> Before You Update</h4>
            <ul>
                <li>System will automatically backup database and important files</li>
                <li>Update process may take 1-2 minutes</li>
                <li>Do not close this page during update</li>
                <li>You may need to clear browser cache after update</li>
            </ul>
        </div>
        
        <div class="text-center" style="margin-top: 30px;">
            <button class="btn btn-success btn-lg" onclick="runUpdate('${data.current_version}', '${data.latest_version}')">
                <i class="fa fa-download"></i> Update Now
            </button>
            <button class="btn btn-default btn-lg" onclick="checkUpdate()">
                <i class="fa fa-refresh"></i> Check Again
            </button>
        </div>
    `;

        $('#update-content').html(html);
    }

    function showUpToDate() {
        var html = `
        <div class="callout callout-success">
            <h4><i class="fa fa-check-circle"></i> You're Up to Date!</h4>
            <p>Your system is running the latest version.</p>
        </div>
        
        <div class="text-center" style="padding: 30px 0;">
            <i class="fa fa-check-circle fa-5x text-success"></i>
            <h3 style="margin-top: 20px;">No updates available</h3>
            <p class="text-muted">Your system is up to date with the latest features and security patches.</p>
            
            <div style="margin-top: 30px;">
                <button class="btn btn-default" onclick="checkUpdate()">
                    <i class="fa fa-refresh"></i> Check Again
                </button>
            </div>
        </div>
    `;

        $('#update-content').html(html);
    }

    function showError(message) {
        var html = `
        <div class="callout callout-danger">
            <h4><i class="fa fa-times-circle"></i> Error</h4>
            <p>${message}</p>
        </div>
        
        <div class="text-center" style="padding: 30px 0;">
            <button class="btn btn-primary" onclick="checkUpdate()">
                <i class="fa fa-refresh"></i> Try Again
            </button>
        </div>
    `;

        $('#update-content').html(html);
    }

    function runUpdate(fromVersion, toVersion) {
        // Confirm
        if (!confirm('Are you sure you want to update the system?\n\nThe system will automatically backup before updating.')) {
            return;
        }

        // Show progress modal
        $('#updateProgressModal').modal('show');
        $('#progress-bar').css('width', '0%');
        $('#progress-text').text('0%');
        $('#update-steps').html('<p class="text-muted"><i class="fa fa-spinner fa-spin"></i> Initializing update...</p>');

        // Run update
        $.ajax({
            url: '<?= base_url('systemupdate/run_update'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                from_version: fromVersion,
                to_version: toVersion
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('#progress-bar').css('width', '100%').removeClass('active');
                    $('#progress-text').text('100%');

                    var stepsHtml = '<div class="alert alert-success"><i class="fa fa-check-circle"></i> <strong>Update completed successfully!</strong></div>';
                    stepsHtml += '<ul class="list-unstyled">';

                    if (response.steps) {
                        response.steps.forEach(function (step) {
                            var icon = step.status === 'success' ? 'check text-success' : 'times text-danger';
                            stepsHtml += `<li><i class="fa fa-${icon}"></i> ${step.step}</li>`;
                        });
                    }

                    stepsHtml += '</ul>';
                    stepsHtml += '<div class="text-center" style="margin-top: 20px;"><button class="btn btn-primary" onclick="location.reload()"><i class="fa fa-refresh"></i> Reload Page</button></div>';

                    $('#update-steps').html(stepsHtml);
                } else {
                    $('#progress-bar').removeClass('progress-bar-striped active').addClass('progress-bar-danger');
                    $('#update-steps').html(`
                    <div class="alert alert-danger">
                        <i class="fa fa-times-circle"></i> <strong>Update failed!</strong><br>
                        ${response.message}
                    </div>
                    <div class="text-center">
                        <button class="btn btn-default" onclick="$('#updateProgressModal').modal('hide')">Close</button>
                    </div>
                `);
                }
            },
            error: function () {
                $('#progress-bar').removeClass('progress-bar-striped active').addClass('progress-bar-danger');
                $('#update-steps').html(`
                <div class="alert alert-danger">
                    <i class="fa fa-times-circle"></i> <strong>Update failed!</strong><br>
                    Failed to connect to server
                </div>
                <div class="text-center">
                    <button class="btn btn-default" onclick="$('#updateProgressModal').modal('hide')">Close</button>
                </div>
            `);
            }
        });
    }

    function loadChangelog() {
        $('#changelog-content').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading changelog...</div>');

        $.ajax({
            url: '<?= base_url('systemupdate/get_changelog'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    $('#changelog-content').html(response.changelog);
                } else {
                    $('#changelog-content').html('<p class="text-danger">Failed to load changelog</p>');
                }
            },
            error: function () {
                $('#changelog-content').html('<p class="text-danger">Failed to load changelog</p>');
            }
        });
    }

    function loadSystemInfo() {
        $.ajax({
            url: '<?= base_url('systemupdate/get_system_info'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    var data = response.data;
                    var html = `
                    <table class="table table-condensed">
                        <tr>
                            <td><i class="fa fa-code"></i> PHP Version</td>
                            <td class="text-right"><strong>${data.php_version}</strong></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-fire"></i> CodeIgniter</td>
                            <td class="text-right"><strong>${data.ci_version}</strong></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-server"></i> Server</td>
                            <td class="text-right"><small>${data.server_software}</small></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-git"></i> Git</td>
                            <td class="text-right">
                                ${data.git_available ? '<span class="label label-success">Available</span>' : '<span class="label label-danger">Not Available</span>'}
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-hdd-o"></i> Disk Space</td>
                            <td class="text-right"><strong>${formatBytes(data.disk_free_space)}</strong> free</td>
                        </tr>
                    </table>
                `;
                    $('#system-info').html(html);
                }
            }
        });
    }

    function formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';
        var k = 1024;
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        var i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function (m) { return map[m]; });
    }

    function pushToGithub() {
        var msg = $('#commit_message').val();

        if (!confirm('Push perubahan local ke GitHub?')) return;

        var $btn = $('button[onclick="pushToGithub()"]');
        var $out = $('#push-output');

        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Pushing...');
        $out.show().text('Starting git push process...');

        $.ajax({
            url: '<?= base_url('systemupdate/git_push'); ?>',
            type: 'POST',
            data: { message: msg },
            dataType: 'json',
            success: function (res) {
                $out.text(res.data);
                if (res.status === 'success') {
                    toastr.success('Berhasil push ke GitHub!');
                } else {
                    toastr.error('Gagal push. Cek log.');
                }
            },
            error: function (xhr) {
                $out.text('Error: ' + xhr.statusText + '\n' + xhr.responseText);
                toastr.error('Koneksi error');
            },
            complete: function () {
                $btn.prop('disabled', false).html('<i class="fa fa-github"></i> Push Local Changes to GitHub');
            }
        });
    }
</script>

<style>
    .timeline {
        position: relative;
        margin: 0 0 30px 0;
        padding: 0;
        list-style: none;
    }

    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #ddd;
        left: 31px;
        margin: 0;
        border-radius: 2px;
    }

    .timeline>li {
        position: relative;
        margin-right: 10px;
        margin-bottom: 15px;
    }

    .timeline>li>.timeline-item {
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        border-radius: 3px;
        margin-top: 0;
        background: #fff;
        color: #444;
        margin-left: 60px;
        margin-right: 15px;
        padding: 10px;
        position: relative;
    }

    .timeline>li>.fa {
        width: 30px;
        height: 30px;
        font-size: 15px;
        line-height: 30px;
        position: absolute;
        color: #666;
        background: #d2d6de;
        border-radius: 50%;
        text-align: center;
        left: 18px;
        top: 0;
    }

    .timeline>li>.timeline-item>.time {
        color: #999;
        float: right;
        padding: 0;
        font-size: 12px;
    }

    .timeline>li>.timeline-item>.timeline-header {
        margin: 0;
        color: #555;
        border-bottom: 1px solid #f4f4f4;
        padding-bottom: 10px;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.1;
    }

    .timeline>li>.timeline-item>.timeline-body {
        padding-top: 10px;
        font-size: 13px;
    }
</style>