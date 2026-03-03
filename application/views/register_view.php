<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets/images/title_logo.png') ?>" type="image/png">

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

    <title>Real Estate | Register</title>

    <style>
        :root {
            --bg-ink: #0b1220;
            --bg-navy: #0f1f3d;
            --bg-slate: #1f365d;
            --card: #f8fafc;
            --card-soft: #ffffff;
            --text: #0f172a;
            --muted: #4b5563;
            --line: #dbe2ea;
            --accent: #b45309;
            --accent-soft: #f59e0b;
            --danger: #dc2626;
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
                radial-gradient(900px 500px at 10% 10%, rgba(56, 189, 248, 0.18), transparent 65%),
                radial-gradient(900px 500px at 90% 90%, rgba(245, 158, 11, 0.22), transparent 60%),
                linear-gradient(140deg, var(--bg-ink), var(--bg-navy) 45%, var(--bg-slate));
            position: relative;
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            width: 420px;
            height: 420px;
            border-radius: 36% 64% 60% 40% / 46% 33% 67% 54%;
            z-index: 0;
            filter: blur(2px);
            pointer-events: none;
            animation: floatShape 9s ease-in-out infinite;
        }

        body::before {
            top: -120px;
            left: -120px;
            background: rgba(96, 165, 250, 0.2);
        }

        body::after {
            bottom: -140px;
            right: -140px;
            background: rgba(251, 191, 36, 0.2);
            animation-delay: 1.5s;
        }

        @keyframes floatShape {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(5deg);
            }
        }

        .auth-shell {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .auth-grid {
            width: 100%;
            max-width: 1120px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(2, 6, 23, 0.5);
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.15);
            display: grid;
            grid-template-columns: 44% 56%;
            backdrop-filter: blur(8px);
        }

        .hero-panel {
            background:
                linear-gradient(170deg, rgba(11, 18, 32, 0.9), rgba(15, 31, 61, 0.92)),
                url('<?= base_url("assets/images/register_background.jpeg") ?>') center/cover no-repeat;
            color: #e5e7eb;
            padding: 42px 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            isolation: isolate;
        }

        .hero-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(10deg, rgba(15, 23, 42, 0.15), rgba(15, 23, 42, 0.65));
            z-index: -1;
        }

        .brand-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            width: fit-content;
        }

        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 48px;
            line-height: 0.95;
            margin: 22px 0 10px;
            color: #f8fafc;
        }

        .hero-copy {
            font-size: 14px;
            line-height: 1.7;
            color: rgba(248, 250, 252, 0.88);
            max-width: 290px;
            margin: 0;
        }

        .hero-metrics {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            flex-wrap: wrap;
        }

        .metric {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 10px 12px;
            min-width: 96px;
        }

        .metric .value {
            display: block;
            font-weight: 700;
            font-size: 18px;
            color: #f8fafc;
        }

        .metric .label {
            font-size: 11px;
            color: rgba(248, 250, 252, 0.82);
        }

        .form-panel {
            background: linear-gradient(180deg, var(--card-soft), var(--card));
            padding: 34px 34px 30px;
            display: flex;
            flex-direction: column;
        }

        .form-head {
            margin-bottom: 16px;
        }

        .logo {
            height: 46px;
            margin-bottom: 12px;
        }

        .form-title {
            font-size: 30px;
            font-family: 'Cormorant Garamond', serif;
            margin: 0;
            color: #111827;
        }

        .form-subtitle {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field.span-2 {
            grid-column: span 2;
        }

        .field label {
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
        }

        .required-star {
            color: #dc2626;
            margin-left: 2px;
        }

        .input {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 11px 12px;
            background: #fff;
            color: #0f172a;
            transition: all 0.2s ease;
            box-shadow: 0 1px 0 rgba(15, 23, 42, 0.02);
        }

        .input:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            outline: none;
        }

        textarea.input {
            min-height: 92px;
            resize: vertical;
        }

        .password-wrap {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            padding: 0;
        }

        .toggle-password:hover {
            color: #0f172a;
        }

        .error {
            font-size: 12px;
            color: var(--danger);
            line-height: 1.2;
        }

        .action-row {
            margin-top: 16px;
        }

        .btn-create {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #0f172a, #1e40af, #0b132f);
            background-size: 170% 170%;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-position 0.3s ease;
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.26);
        }

        .btn-create:hover {
            transform: translateY(-1px);
            background-position: 100% 20%;
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.32);
        }

        .signin-row {
            margin-top: 14px;
            text-align: center;
            font-size: 14px;
            color: var(--muted);
        }

        .signin-row a {
            text-decoration: none;
            color: var(--accent);
            font-weight: 700;
        }

        .signin-row a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            font-size: 13px;
            padding: 10px 12px;
            margin-bottom: 14px;
        }

        .fade-in {
            animation: fadeInUp 0.55s ease both;
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(10px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 992px) {
            .auth-grid {
                grid-template-columns: 1fr;
                max-width: 680px;
            }

            .hero-panel {
                padding: 28px;
            }

            .hero-title {
                font-size: 38px;
            }

            .form-panel {
                padding: 26px;
            }
        }

        @media (max-width: 576px) {
            .auth-shell {
                padding: 14px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .field.span-2 {
                grid-column: span 1;
            }

            .hero-title {
                font-size: 34px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-shell">
        <div class="auth-grid fade-in">
            <aside class="hero-panel">
                <div>
                    <div class="brand-pill">
                        <i class="bx bx-building-house"></i>
                        Real Estate CRM
                    </div>
                    <h1 class="hero-title">Grow Every Site Like a Brand</h1>
                    <p class="hero-copy">
                        Register your account to manage projects, inquiries, plots, and customer records from one clean workspace.
                    </p>
                    <div class="hero-metrics">
                        <div class="metric">
                            <span class="value">24/7</span>
                            <span class="label">Access</span>
                        </div>
                        <div class="metric">
                            <span class="value">100%</span>
                            <span class="label">Cloud Ready</span>
                        </div>
                        <div class="metric">
                            <span class="value">Fast</span>
                            <span class="label">Onboarding</span>
                        </div>
                    </div>
                </div>
            </aside>

            <section class="form-panel">
                <div class="form-head">
                    <img src="<?= base_url('assets/images/title_logo.png') ?>" class="logo" alt="Logo">
                    <h2 class="form-title">Create Your Account</h2>
                    <p class="form-subtitle">Complete the form below to start managing properties.</p>
                </div>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                <?php endif; ?>

                <form action="<?= base_url('login/sign_up') ?>" method="post">
                    <div class="form-grid">
                        <div class="field">
                            <label for="full_name">Full Name <span class="required-star">*</span></label>
                            <input id="full_name" type="text" name="full_name" class="input" value="<?= set_value('full_name'); ?>" placeholder="Enter your full name" required>
                            <div class="error"><?= form_error('full_name'); ?></div>
                        </div>

                        <div class="field">
                            <label for="business_name">Business Name <span class="required-star">*</span></label>
                            <input id="business_name" type="text" name="business_name" class="input" value="<?= set_value('business_name'); ?>" placeholder="Enter business name" required>
                            <div class="error"><?= form_error('business_name'); ?></div>
                        </div>

                        <div class="field">
                            <label for="mobile">Mobile Number <span class="required-star">*</span></label>
                            <input id="mobile" type="text" name="mobile" class="input" value="<?= set_value('mobile'); ?>" placeholder="Enter mobile number" required>
                            <div class="error">
                                <?= form_error('mobile'); ?>
                                <?= isset($mobile_error) ? $mobile_error : ''; ?>
                            </div>
                        </div>

                        <div class="field">
                            <label for="email">Email Address</label>
                            <input id="email" type="email" name="email" class="input" value="<?= set_value('email'); ?>" placeholder="Enter email address (optional)">
                            <div class="error">
                                <?= form_error('email'); ?>
                                <?= isset($email_error) ? $email_error : ''; ?>
                            </div>
                        </div>

                        <div class="field span-2">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" class="input" placeholder="Enter your address (optional)"><?= set_value('address'); ?></textarea>
                            <div class="error"><?= form_error('address'); ?></div>
                        </div>

                        <div class="field span-2">
                            <label for="password">Password <span class="required-star">*</span></label>
                            <div class="password-wrap">
                                <input id="password" type="password" name="password" class="input" placeholder="Enter password" required>
                                <button class="toggle-password" type="button" onclick="togglePassword()">
                                    <i id="eyeIcon" class="bx bx-hide"></i>
                                </button>
                            </div>
                            <div class="error"><?= form_error('password'); ?></div>
                        </div>
                    </div>

                    <div class="action-row">
                        <button type="submit" class="btn-create">Create Account</button>
                    </div>

                    <div class="signin-row">
                        Already have an account?
                        <a href="<?= base_url('login'); ?>">Sign In</a>
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
