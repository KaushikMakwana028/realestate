<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/ico">
    <link href="<?= base_url('assets/css/pace.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/js/pace.min.js') ?>"></script>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/sass/app.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Real Estate | Verify OTP</title>
    <style>
        :root {
            --bg-base: #0b1220;
            --bg-mid: #0f1f3d;
            --bg-top: #1e3a5f;
            --panel: #ffffff;
            --muted: #4b5563;
            --line: #d9e1ea;
            --danger: #dc2626;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Manrope', sans-serif;
            background:
                radial-gradient(1000px 520px at 15% 10%, rgba(59, 130, 246, 0.2), transparent 62%),
                radial-gradient(900px 500px at 88% 90%, rgba(251, 191, 36, 0.2), transparent 58%),
                linear-gradient(145deg, var(--bg-base), var(--bg-mid) 45%, var(--bg-top));
        }

        .otp-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .otp-card {
            width: 100%;
            max-width: 440px;
            background: #fff;
            border-radius: 24px;
            padding: 40px 36px;
            box-shadow: 0 40px 100px rgba(2, 6, 23, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.15);
            animation: fadeInUp 0.5s ease both;
        }

        .otp-logo-wrap {
            display: inline-flex;
            background: linear-gradient(180deg, #fff, #f1f5f9);
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 8px 12px;
            margin-bottom: 20px;
        }

        .otp-logo {
            height: 46px;
            max-width: 220px;
            object-fit: contain;
            display: block;
        }

        .otp-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0f172a, #1e40af);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 26px;
            color: #fff;
        }

        .otp-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 30px;
            margin: 0 0 6px;
            color: #111827;
            text-align: center;
        }

        .otp-sub {
            font-size: 14px;
            color: var(--muted);
            text-align: center;
            margin: 0 0 24px;
        }

        .otp-sub strong {
            color: #0f172a;
        }

        .alert {
            border-radius: 10px;
            font-size: 13px;
            padding: 10px 12px;
            margin-bottom: 16px;
        }

        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 6px;
        }

        .otp-input {
            width: 100%;
            border: 1.5px solid var(--line);
            border-radius: 12px;
            padding: 14px;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 10px;
            text-align: center;
            background: #f8fafc;
            color: #0f172a;
            transition: 0.2s ease;
        }

        .otp-input:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            outline: none;
            background: #fff;
        }

        .btn-verify {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-weight: 700;
            font-size: 15px;
            color: #fff;
            background: linear-gradient(135deg, #0f172a, #1e40af, #0b132f);
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.26);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-verify:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.32);
        }

        .back-row {
            text-align: center;
            margin-top: 16px;
        }

        .back-row a {
            font-size: 13px;
            color: #1d4ed8;
            font-weight: 600;
            text-decoration: none;
        }

        .back-row a:hover {
            text-decoration: underline;
        }

        .resend-row {
            text-align: center;
            margin-top: 12px;
            font-size: 13px;
            color: var(--muted);
        }

        .timer {
            font-weight: 700;
            color: #0f172a;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/ico">
    <link href="<?= base_url('assets/css/pace.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/js/pace.min.js') ?>"></script>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/sass/app.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Real Estate | Verify OTP</title>
    <style>
        :root {
            --bg-base: #0b1220;
            --bg-mid: #0f1f3d;
            --bg-top: #1e3a5f;
            --panel: #ffffff;
            --muted: #4b5563;
            --line: #d9e1ea;
            --danger: #dc2626;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Manrope', sans-serif;
            background:
                radial-gradient(1000px 520px at 15% 10%, rgba(59, 130, 246, 0.2), transparent 62%),
                radial-gradient(900px 500px at 88% 90%, rgba(251, 191, 36, 0.2), transparent 58%),
                linear-gradient(145deg, var(--bg-base), var(--bg-mid) 45%, var(--bg-top));
        }

        .otp-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .otp-card {
            width: 100%;
            max-width: 440px;
            background: #fff;
            border-radius: 24px;
            padding: 40px 36px;
            box-shadow: 0 40px 100px rgba(2, 6, 23, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.15);
            animation: fadeInUp 0.5s ease both;
        }

        .otp-logo-wrap {
            display: inline-flex;
            background: linear-gradient(180deg, #fff, #f1f5f9);
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 8px 12px;
            margin-bottom: 20px;
        }

        .otp-logo {
            height: 46px;
            max-width: 220px;
            object-fit: contain;
            display: block;
        }

        .otp-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0f172a, #1e40af);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 26px;
            color: #fff;
        }

        .otp-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 30px;
            margin: 0 0 6px;
            color: #111827;
            text-align: center;
        }

        .otp-sub {
            font-size: 14px;
            color: var(--muted);
            text-align: center;
            margin: 0 0 24px;
        }

        .otp-sub strong {
            color: #0f172a;
        }

        .alert {
            border-radius: 10px;
            font-size: 13px;
            padding: 10px 12px;
            margin-bottom: 16px;
        }

        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 6px;
        }

        .otp-input {
            width: 100%;
            border: 1.5px solid var(--line);
            border-radius: 12px;
            padding: 14px;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 10px;
            text-align: center;
            background: #f8fafc;
            color: #0f172a;
            transition: 0.2s ease;
        }

        .otp-input:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            outline: none;
            background: #fff;
        }

        .btn-verify {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-weight: 700;
            font-size: 15px;
            color: #fff;
            background: linear-gradient(135deg, #0f172a, #1e40af, #0b132f);
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.26);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-verify:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.32);
        }

        .back-row {
            text-align: center;
            margin-top: 16px;
        }

        .back-row a {
            font-size: 13px;
            color: #1d4ed8;
            font-weight: 600;
            text-decoration: none;
        }

        .back-row a:hover {
            text-decoration: underline;
        }

        .resend-row {
            text-align: center;
            margin-top: 12px;
            font-size: 13px;
            color: var(--muted);
        }

        .timer {
            font-weight: 700;
            color: #0f172a;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }
    </style>
</head>

<body>
    <div class="otp-shell">
        <div class="otp-card">
            <div class="otp-logo-wrap d-flex align-items-center gap-2 justify-content-center mb-3">
                <div class="p-2 rounded-3 text-white" style="background: linear-gradient(135deg, #6366f1, #4f46e5); display: flex; align-items: center; justify-content: center; width: 44px; height: 44px;">
                    <i class="bx bx-buildings fs-3"></i>
                </div>
                <span class="fw-bold fs-3" style="color: #0f172a; font-family: 'Poppins', sans-serif;">SiteDesk</span>
            </div>

            <div class="otp-icon"><i class="bx bx-message-detail"></i></div>

            <h2 class="otp-title">Verify OTP</h2>
            <p class="otp-sub">
                We sent a 6-digit OTP to <strong><?= $masked_mobile ?></strong>.<br>
                Please enter it below to continue.
            </p>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <?php
            // Decide which route based on otp_type
            $otp_type = !empty($otp_type) ? $otp_type : 'login';
            $action = ($otp_type === 'register')
                ? base_url('verify-register-otp')
                : base_url('verify-login-otp');

            $back_url = ($otp_type === 'register')
                ? base_url('register')
                : base_url('login');

            $resend_url = base_url('resend-otp/' . $otp_type);
            ?>

            <form action="<?= $action ?>" method="POST">
                <div class="field">
                    <label>Enter OTP</label>
                    <input type="text" name="otp" class="otp-input"
                        maxlength="6" placeholder="------"
                        autocomplete="one-time-code" autofocus required>
                </div>

                <button type="submit" class="btn-verify">
                    <i class="bx bx-check-shield me-1"></i> Verify & Continue
                </button>
            </form>

            <div class="resend-row">
                Didn't receive OTP? Resend in <span class="timer" id="timer">30s</span>
            </div>

            <div class="back-row">
                <a href="<?= $back_url ?>">&#8592; Go back</a>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        // Countdown timer
        let seconds = 30;
        const timerEl = document.getElementById('timer');
        const interval = setInterval(() => {
            seconds--;
            timerEl.textContent = seconds + 's';
            if (seconds <= 0) {
                clearInterval(interval);
                timerEl.innerHTML = '<a href="<?= $resend_url ?>" style="color:#1d4ed8;font-weight:700;text-decoration:none;">Resend OTP</a>';
            }
        }, 1000);

        // Auto-submit when 6 digits entered
        document.querySelector('input[name="otp"]').addEventListener('input', function() {
            if (this.value.length === 6) {
                this.closest('form').submit();
            }
        });
    </script>
</body>

</html>
