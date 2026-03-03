<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/ico">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap-extended.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <title>Forgot Password</title>
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            min-height: 100vh;
        }
        .wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 460px;
            padding: 32px;
        }
        .title {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            margin-bottom: 6px;
            color: #111827;
        }
        .sub {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 24px;
        }
        .btn-main {
            background: #0f172a;
            border: none;
            color: #fff;
            padding: 10px 14px;
            border-radius: 8px;
            width: 100%;
        }
        .btn-main:hover {
            background: #1e293b;
            color: #fff;
        }
        .back-link {
            font-size: 14px;
            color: #0f172a;
            text-decoration: none;
            font-weight: 500;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .error {
            color: #dc3545;
            font-size: 13px;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card-box">
            <div class="title">Forgot Password</div>
            <div class="sub">Enter your email or mobile number to reset password.</div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= $success; ?></div>
            <?php endif; ?>

            <?php if (empty($verified_user_id)): ?>
                <form method="post" action="<?= base_url('forgot-password'); ?>">
                    <input type="hidden" name="step" value="verify">
                    <div class="mb-3">
                        <label class="form-label">Email or Mobile</label>
                        <input type="text" name="identifier" class="form-control" value="<?= set_value('identifier'); ?>" placeholder="Enter email or mobile" required>
                        <?= form_error('identifier'); ?>
                    </div>
                    <button type="submit" class="btn btn-main">Verify Account</button>
                </form>
            <?php else: ?>
                <form method="post" action="<?= base_url('forgot-password'); ?>">
                    <input type="hidden" name="step" value="reset">
                    <input type="hidden" name="user_id" value="<?= (int) $verified_user_id; ?>">
                    <input type="hidden" name="identifier" value="<?= html_escape($identifier); ?>">

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
                        <?= form_error('new_password'); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password" required>
                        <?= form_error('confirm_password'); ?>
                    </div>
                    <button type="submit" class="btn btn-main">Update Password</button>
                </form>
            <?php endif; ?>

            <div class="mt-3 text-center">
                <a class="back-link" href="<?= base_url('login'); ?>">Back to Login</a>
            </div>
        </div>
    </div>
</body>
</html>
