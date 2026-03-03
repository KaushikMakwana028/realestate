<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/ico">

    <link href="<?= base_url('assets/plugins/simplebar/css/simplebar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/metismenu/css/metisMenu.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/pace.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/js/pace.min.js') ?>"></script>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap-extended.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/sass/app.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/sass/dark-theme.css') ?>">
    <link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>Real Estate | Login</title>

    <style>
        :root {
            --bg-base: #0b1220;
            --bg-mid: #0f1f3d;
            --bg-top: #1e3a5f;
            --panel: #ffffff;
            --panel-soft: #f8fafc;
            --text: #0f172a;
            --muted: #4b5563;
            --line: #d9e1ea;
            --danger: #dc2626;
            --gold: #b45309;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Manrope', sans-serif;
            color: var(--text);
            background:
                radial-gradient(1000px 520px at 15% 10%, rgba(59, 130, 246, 0.2), transparent 62%),
                radial-gradient(900px 500px at 88% 90%, rgba(251, 191, 36, 0.2), transparent 58%),
                linear-gradient(145deg, var(--bg-base), var(--bg-mid) 45%, var(--bg-top));
            position: relative;
            overflow-x: hidden;
        }

        .login-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            z-index: 1;
        }

        .login-grid {
            width: 100%;
            max-width: 1060px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(2, 6, 23, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(8px);
            display: grid;
            grid-template-columns: 48% 52%;
            animation: fadeInUp 0.55s ease both;
        }

        .showcase {
            background:
                linear-gradient(170deg, rgba(11, 18, 32, 0.85), rgba(15, 31, 61, 0.86)),
                url('<?= base_url("assets/images/login_background.avif") ?>') center/cover no-repeat;
            padding: 34px;
            color: #e5e7eb;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .showcase-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 8px 12px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            width: fit-content;
        }

        .showcase-title {
            margin: 24px 0 10px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 52px;
            line-height: 0.92;
            color: #f8fafc;
        }

        .showcase-copy {
            margin: 0;
            max-width: 320px;
            color: rgba(248, 250, 252, 0.88);
            font-size: 14px;
            line-height: 1.7;
        }

        .showcase-points {
            margin-top: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .point {
            padding: 8px 12px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.24);
            background: rgba(255, 255, 255, 0.12);
            font-size: 12px;
            color: #f8fafc;
        }

        .form-zone {
            background: linear-gradient(180deg, var(--panel), var(--panel-soft));
            padding: 36px 34px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-logo-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: flex-start;
            background: linear-gradient(180deg, #ffffff, #f1f5f9);
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 8px 12px;
            margin-bottom: 14px;
            width: fit-content;
        }

        .brand-logo {
            display: block;
            width: auto;
            height: 54px;
            max-width: 260px;
            object-fit: contain;
        }

        .title {
            margin: 0;
            font-family: 'Cormorant Garamond', serif;
            font-size: 34px;
            line-height: 1.05;
            color: #111827;
        }

        .subtitle {
            margin: 6px 0 18px;
            color: var(--muted);
            font-size: 14px;
        }

        .field {
            margin-bottom: 14px;
        }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 6px;
        }

        .input {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 11px 12px;
            font-size: 14px;
            background: #fff;
            color: #0f172a;
            transition: 0.2s ease;
        }

        .input:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            outline: none;
        }

        .password-wrap {
            position: relative;
        }

        .toggle-password {
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            padding: 0;
        }

        .toggle-password:hover {
            color: #0f172a;
        }

        .error {
            font-size: 12px;
            color: var(--danger);
            margin-top: 4px;
            min-height: 16px;
        }

        .forgot-row {
            text-align: right;
            margin: -2px 0 16px;
        }

        .forgot-link {
            text-decoration: none;
            font-size: 13px;
            color: #1d4ed8;
            font-weight: 600;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #0f172a, #1e40af, #0b132f);
            background-size: 170% 170%;
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.26);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-position 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.32);
            background-position: 100% 20%;
        }

        .signup-row {
            margin-top: 14px;
            text-align: center;
            color: var(--muted);
            font-size: 14px;
        }

        .signup-row a {
            text-decoration: none;
            color: var(--gold);
            font-weight: 700;
        }

        .signup-row a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            font-size: 13px;
            padding: 10px 12px;
            margin-bottom: 12px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 992px) {
            .login-grid {
                grid-template-columns: 1fr;
                max-width: 660px;
            }

            .showcase {
                padding: 28px;
            }

            .showcase-title {
                font-size: 40px;
            }

            .form-zone {
                padding: 28px;
            }
        }

        @media (max-width: 576px) {
            .login-shell {
                padding: 14px;
            }

            .showcase-title {
                font-size: 34px;
            }

            .title {
                font-size: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="login-shell">
        <div class="login-grid">
            <aside class="showcase">
                <div>
                    <div class="showcase-badge">
                        <i class="bx bx-shield-quarter"></i>
                        Secure Workspace
                    </div>
                    <h1 class="showcase-title">Manage Real Estate With Precision</h1>
                    <p class="showcase-copy">
                        Sign in to access site dashboards, buyer records, plot updates, and financial activity in one place.
                    </p>
                    <div class="showcase-points">
                        <span class="point">Centralized Data</span>
                        <span class="point">Smart Tracking</span>
                        <span class="point">Fast Workflow</span>
                    </div>
                </div>
            </aside>

            <section class="form-zone">
                <div class="brand-logo-wrap">
                    <img src="<?= base_url('assets/images/main_logo.png') ?>" class="brand-logo" alt="Main Logo">
                </div>
                <h2 class="title">Welcome Back</h2>
                <p class="subtitle">Login to continue to your account.</p>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                <?php endif; ?>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= $error; ?></div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">
                    <div class="field">
                        <label for="mobile">Mobile Number</label>
                        <input id="mobile" type="text" name="mobile" value="<?= set_value('mobile'); ?>" class="input" placeholder="Enter mobile number" required>
                        <div class="error"><?= form_error('mobile'); ?></div>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <div class="password-wrap">
                            <input id="password" type="password" name="password" class="input" placeholder="Enter password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i id="eyeIcon" class="bx bx-hide"></i>
                            </button>
                        </div>
                        <div class="error"><?= form_error('password'); ?></div>
                    </div>

                    <div class="forgot-row">
                        <a href="<?= base_url('forgot-password'); ?>" class="forgot-link">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-login">Sign In</button>

                    <div class="signup-row">
                        Don't have an account?
                        <a href="<?= base_url('register'); ?>">Create Account</a>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/simplebar/js/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/metismenu/js/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') ?>"></script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>

    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (!pwd || !icon) return;

            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            } else {
                pwd.type = 'password';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            }
        }
    </script>
</body>

</html>