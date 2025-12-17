<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RSIA Andini</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: url('<?= base_url('assets/images/galaxy.jpg'); ?>') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            width: 800px;
            height: 500px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            overflow: hidden;
        }

        .login-left {
            width: 50%;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }

        .login-left img {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
            border-radius: 50%;
            background: #fff;
            padding: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .login-left h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .login-left p {
            font-size: 18px;
        }

        .login-right {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 10px 40px;
            border: 2px solid #ddd;
            border-radius: 25px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 10px rgba(106, 17, 203, 0.2);
        }

        .form-group input.error {
            border-color: #e74c3c;
            animation: shake 0.5s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .form-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #888;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 25px;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-submit:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .btn-submit .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid #fff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            margin: 0 auto;
        }

        .btn-submit.loading .spinner {
            display: block;
        }

        .btn-submit.loading .btn-text {
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .create-account {
            text-align: center;
            margin-top: 20px;
        }

        .create-account a {
            color: #6a11cb;
            text-decoration: none;
            font-size: 14px;
        }

        .create-account a:hover {
            text-decoration: underline;
        }

        /* Custom SweetAlert2 styling */
        .swal2-popup {
            border-radius: 15px;
        }

        .swal2-title {
            font-size: 24px;
        }

        .swal2-icon {
            border-width: 3px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-left">
            <img src="<?= base_url('assets/images/coding.avif'); ?>" alt="Logo RSIA Andini">
            <h1>Moiz Apps</h1>
            <p>Sistem Informasi Rumah Sakit</p>
        </div>
        <div class="login-right">
            <h2>FORM LOGIN</h2>
            <form id="loginForm" action="<?= base_url('auth/login_process'); ?>" method="post">
                <div class="form-group">
                    <i class="fa fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Username" required
                        autocomplete="username">
                </div>
                <div class="form-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Password" required
                        autocomplete="current-password">
                </div>
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="btn-text">Login</span>
                    <div class="spinner"></div>
                </button>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Handle form submission
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const submitBtn = document.getElementById('submitBtn');

            // Show loading state
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });

        // Check for error/success messages from PHP
        <?php if ($this->session->flashdata('error')): ?>
            // Show error notification
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                html: '<p style="font-size: 16px; color: #555;"><?= $this->session->flashdata('error'); ?></p>',
                confirmButtonText: 'Coba Lagi',
                confirmButtonColor: '#e74c3c',
                timer: 5000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__shakeX'
                },
                didOpen: () => {
                    // Shake the input fields
                    document.getElementById('username').classList.add('error');
                    document.getElementById('password').classList.add('error');

                    // Remove error class after animation
                    setTimeout(() => {
                        document.getElementById('username').classList.remove('error');
                        document.getElementById('password').classList.remove('error');
                    }, 500);

                    // Focus on username field
                    document.getElementById('username').focus();
                    document.getElementById('username').select();
                }
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            // Show success notification
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                html: '<p style="font-size: 16px; color: #555;"><?= $this->session->flashdata('success'); ?></p>',
                confirmButtonText: 'OK',
                confirmButtonColor: '#27ae60',
                timer: 2000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                }
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('info')): ?>
            // Show info notification
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                html: '<p style="font-size: 16px; color: #555;"><?= $this->session->flashdata('info'); ?></p>',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3498db',
                timer: 3000,
                timerProgressBar: true
            });
        <?php endif; ?>

        // Auto-focus on username field
        window.addEventListener('load', function () {
            document.getElementById('username').focus();
        });

        // Clear error styling on input
        document.getElementById('username').addEventListener('input', function () {
            this.classList.remove('error');
        });

        document.getElementById('password').addEventListener('input', function () {
            this.classList.remove('error');
        });

        // Keyboard shortcut: Enter to submit
        document.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                document.getElementById('loginForm').submit();
            }
        });
    </script>
</body>

</html>