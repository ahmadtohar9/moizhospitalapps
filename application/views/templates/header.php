<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($title) ? $title : 'Admin Dashboard'; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/Ionicons/css/ionicons.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/autocomplete.css'); ?>">
    <!-- DataTables CSS -->
    <link rel="stylesheet"
        href="<?= base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- jQuery UI CSS dari CDN -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/vendor/signature-pad/signature-modal.css') ?>">
    <script src="<?= base_url('assets/vendor/signature-pad/signature_pad.umd.min.js') ?>"></script>

    <script>
        const BASE_URL = '<?= base_url() ?>';
    </script>

    <style>
        .ui-autocomplete {
            position: absolute;
            z-index: 1050;
            max-height: 250px;
            overflow-y: auto;
            overflow-x: hidden;
            border: 1px solid #ddd;
            background-color: #ffffff;
            padding: 5px;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .ui-menu-item {
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            color: #333;
        }

        .ui-state-active {
            background-color: #007bff;
            color: white;
        }

        /* Fix Select2 in Bootstrap Modal */
        .select2-container {
            z-index: 9999 !important;
        }

        .select2-dropdown {
            z-index: 10000 !important;
        }
    </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="<?= base_url(); ?>" class="logo">
                <span class="logo-mini"><b>Moiz</b></span>
                <span class="logo-lg"><b>Moiz</b> Apps</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="user-image"
                                    alt="User Image">
                                <span class="hidden-xs"><?= isset($nama_user) ? $nama_user : 'User'; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?= base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle"
                                        alt="User Image">
                                    <p><?= isset($nama_user) ? $nama_user : 'User'; ?> - Admin</p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= base_url('profile'); ?>"
                                            class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= base_url('auth/logout'); ?>" class="btn btn-default btn-flat">Sign
                                            out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>