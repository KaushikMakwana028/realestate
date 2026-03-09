<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Buyer Statement</title>

        <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1f2937;
            background: #fff;
            padding: 18px;
        }
        .header-wrapper {
            background: #f3f8ff;
            border: 1px solid #d8e6f7;
            border-radius: 10px;
            padding: 16px 20px;
            margin-bottom: 14px;
            color: #1f2937;
        }
        .header-inner {
            display: table;
            width: 100%;
        }
        .header-logo {
            display: table-cell;
            vertical-align: middle;
            width: 70px;
        }
        .header-logo img {
            width: 55px;
            height: 55px;
            border-radius: 8px;
            border: 1px solid #d6e4f3;
            object-fit: cover;
            background: #fff;
        }
        .header-logo .logo-placeholder {
            width: 55px;
            height: 55px;
            border-radius: 8px;
            background: #0f2b46;
            border: 1px solid #0b2238;
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #fff;
        }
        .header-content {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #0f2b46;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }
        .company-tagline {
            font-size: 10px;
            color: #64748b;
            margin-top: 3px;
            letter-spacing: 0.2px;
        }
        .header-contact {
            display: table-cell;
            vertical-align: middle;
            text-align: left;
            width: 290px;
            background: #fff;
            border: 1px solid #dce7f5;
            border-radius: 8px;
            padding: 9px 10px;
        }
        .contact-item {
            font-size: 10px;
            color: #334155;
            margin-bottom: 4px;
            word-wrap: break-word;
        }
        .contact-item .contact-label {
            color: #0f2b46;
            font-weight: bold;
            display: inline-block;
            width: 58px;
        }
        .divider {
            height: 2px;
            background: #dce8f6;
            border-radius: 2px;
            margin: 0 0 12px 0;
            border: none;
        }
        .title-block {
            text-align: center;
            margin-bottom: 12px;
        }
        .title-block .title-text {
            font-size: 14px;
            font-weight: bold;
            color: #0f2b46;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            display: inline-block;
            padding: 6px 18px;
            border: 1px solid #cfe0f4;
            border-radius: 20px;
            background: #f7fbff;
        }
        .party-card {
            background: #f9fcff;
            border: 1px solid #d9e8f8;
            border-left: 3px solid #0f2b46;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 12px;
        }
        .party-card-header {
            font-size: 12px;
            font-weight: bold;
            color: #0f2b46;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border-bottom: 1px dashed #cad8ea;
            padding-bottom: 6px;
        }
        .info-grid {
            width: 100%;
            border-collapse: collapse;
        }
        .info-grid td {
            padding: 4px 6px;
            vertical-align: top;
            font-size: 11px;
        }
        .info-grid .label {
            color: #64748b;
            font-weight: bold;
            width: 100px;
            white-space: nowrap;
        }
        .info-grid .colon {
            width: 10px;
            color: #64748b;
        }
        .info-grid .value {
            color: #1f2937;
            font-weight: bold;
        }
        .stats-row {
            display: table;
            width: 100%;
            margin-bottom: 12px;
            border-collapse: separate;
            border-spacing: 6px;
        }
        .stat-box {
            display: table-cell;
            background: #fff;
            border: 1px solid #d7e4f3;
            border-radius: 8px;
            padding: 8px 10px;
            text-align: center;
            width: 33.33%;
        }
        .stat-box.debit {
            border-top: 3px solid #ef4444;
        }
        .stat-box.credit {
            border-top: 3px solid #16a34a;
        }
        .stat-box.balance {
            border-top: 3px solid #0f2b46;
        }
        .stat-label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 3px;
        }
        .stat-value {
            font-size: 13px;
            font-weight: bold;
            color: #1f2937;
        }
        .stat-value.red {
            color: #dc2626;
        }
        .stat-value.green {
            color: #15803d;
        }
        .stat-value.blue {
            color: #0f2b46;
        }
        .table-title {
            font-size: 11px;
            font-weight: bold;
            color: #0f2b46;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 6px;
            padding-left: 2px;
        }
        .down-payment-box {
            border: 1px solid #cae7d4;
            border-left: 3px solid #16a34a;
            background: #f3fff6;
            border-radius: 8px;
            padding: 8px 12px;
            margin: 2px 0 8px 0;
        }
        .down-payment-label {
            font-size: 10px;
            color: #166534;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 2px;
            font-weight: bold;
        }
        .down-payment-value {
            font-size: 14px;
            font-weight: bold;
            color: #15803d;
        }
        .ledger-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .ledger-table thead tr {
            background: #0f2b46;
            color: #fff;
        }
        .ledger-table th {
            padding: 9px 8px;
            font-size: 10px;
            text-align: center;
            font-weight: bold;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            border: 1px solid #123a5e;
        }
        .ledger-table td {
            border: 1px solid #dbe6f5;
            padding: 7px 8px;
            font-size: 11px;
            color: #1f2937;
        }
        .ledger-table tbody tr:nth-child(even) {
            background-color: #f9fbff;
        }
        .ledger-table tbody tr:hover {
            background-color: #f1f6fd;
        }
        .row-opening {
            background-color: #fff9eb !important;
        }
        .row-payment td {
            background-color: #f4fff7;
        }
        .total-row {
            background: #0f2b46 !important;
            color: #fff !important;
        }
        .total-row td {
            background: transparent !important;
            color: #fff !important;
            font-weight: bold;
            border: 1px solid #123a5e;
            padding: 9px 8px;
            font-size: 11px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .amt-debit {
            color: #c2410c;
            font-weight: bold;
        }
        .amt-credit {
            color: #15803d;
            font-weight: bold;
        }
        .badge-dr {
            display: inline-block;
            background: #fff0ed;
            color: #c2410c;
            border: 1px solid #fecaca;
            border-radius: 3px;
            padding: 1px 5px;
            font-size: 9px;
            font-weight: bold;
            margin-left: 3px;
        }
        .badge-cr {
            display: inline-block;
            background: #ecfdf3;
            color: #15803d;
            border: 1px solid #bbf7d0;
            border-radius: 3px;
            padding: 1px 5px;
            font-size: 9px;
            font-weight: bold;
            margin-left: 3px;
        }
        .footer {
            margin-top: 16px;
            border-top: 1px solid #d6e4f5;
            padding-top: 10px;
        }
        .footer-inner {
            display: table;
            width: 100%;
        }
        .footer-left {
            display: table-cell;
            vertical-align: bottom;
            font-size: 9px;
            color: #64748b;
        }
        .footer-right {
            display: table-cell;
            vertical-align: bottom;
            text-align: right;
        }
        .sign-line {
            border-top: 1px solid #475569;
            width: 150px;
            margin-left: auto;
            margin-top: 24px;
            margin-bottom: 4px;
        }
        .sign-label {
            font-size: 10px;
            color: #475569;
            text-align: center;
        }
        .generated-note {
            font-size: 8px;
            color: #94a3b8;
            margin-top: 6px;
        }
    </style>
</head>

<body>
    <?php
    $admin_business = !empty($user->business_name) ? $user->business_name : '-';
    $admin_name = !empty($user->name) ? $user->name : '-';
    $admin_mobile = !empty($user->mobile) ? $user->mobile : '-';
    $admin_email = !empty($user->email) ? $user->email : '-';
    $admin_address = !empty($user->address) ? $user->address : '-';
    ?>

    <!-- ================= HEADER ================= -->
    <div class="header-wrapper">
        <div class="header-inner">

            <!-- Logo -->
            <div class="header-logo">
                <?php if (!empty($user->profile_image_data_uri) || !empty($user->profile_image)) {
                    if (!empty($user->profile_image_data_uri)) {
                        $logoSrc = (string) $user->profile_image_data_uri;
                    } else {
                        $logoPath = (string) $user->profile_image;
                        $isAbsoluteLogo = preg_match('/^https?:\/\//i', $logoPath);
                        $logoSrc = $isAbsoluteLogo ? $logoPath : base_url($logoPath);
                    }
                ?>
                    <img src="<?= $logoSrc ?>" alt="Logo">
                <?php } else { ?>
                    <div class="logo-placeholder">
                        <?= strtoupper(substr($admin_business, 0, 1)) ?>
                    </div>
                <?php } ?>
            </div>

            <!-- Company Name -->
            <div class="header-content">
                <div class="company-name">
                    <?= strtoupper($admin_business) ?>
                </div>
                <div class="company-tagline">Real Estate &amp; Property Management</div>
            </div>

            <!-- Contact -->
            <div class="header-contact">
                <div class="contact-item">
                    <span class="contact-label">Name</span>: <?= htmlspecialchars($admin_name) ?>
                </div>
                <div class="contact-item">
                    <span class="contact-label">Mobile</span>: <?= htmlspecialchars($admin_mobile) ?>
                </div>
                <div class="contact-item">
                    <span class="contact-label">Email</span>: <?= htmlspecialchars($admin_email) ?>
                </div>
                <div class="contact-item">
                    <span class="contact-label">Address</span>: <?= htmlspecialchars($admin_address) ?>
                </div>
            </div>

        </div>
    </div>

    <!-- ================= DIVIDER ================= -->
    <hr class="divider">

    <!-- ================= TITLE ================= -->
    <div class="title-block">
        <div class="title-text">Buyer Statement</div>
    </div>

    <!-- ================= PARTY DETAILS ================= -->
    <div class="party-card">
        <div class="party-card-header">
            Party Information
        </div>

        <?php
        $from = '-';
        $to   = '-';
        if (!empty($logs)) {
            $from = date('d/m/Y', strtotime(reset($logs)->created_on));
            $to   = date('d/m/Y', strtotime(end($logs)->created_on));
        }
        ?>

        <table class="info-grid">
            <tr>
                <td class="label">Party Name</td>
                <td class="colon">:</td>
                <td class="value"><?= strtoupper($buyer->name ?? '-') ?></td>

                <td class="label">Contact No</td>
                <td class="colon">:</td>
                <td class="value"><?= $buyer->mobile ?? '-' ?></td>
            </tr>
            <tr>
                <td class="label">Address</td>
                <td class="colon">:</td>
                <td class="value"><?= $buyer->address ?? '-' ?></td>

                <td class="label">Duration</td>
                <td class="colon">:</td>
                <td class="value"><?= $from ?> &nbsp;to&nbsp; <?= $to ?></td>
            </tr>
        </table>
    </div>

    <?php
    /* ===================================================
   LOGIC kept exactly as original
   =================================================== */
    $total_debit  = 0;
    $total_credit = 0;

    $opening_balance = !empty($logs) ? (float)$logs[0]->total_price : 0;
    $running_balance = $opening_balance;
    $total_debit     = $opening_balance;

    // Pre-calculate totals for stat boxes
    $temp_balance = $opening_balance;
    $temp_credit  = 0;
    foreach ($logs as $log) {
        $c = (float)($log->paid_amount ?? 0);
        if ($c <= 0) continue;
        $temp_balance -= $c;
        $temp_credit  += $c;
    }

    $statement_down_payment = (float)($payment->down_payment ?? 0);
    if ($statement_down_payment <= 0) {
        foreach ($logs as $lg) {
            $n = strtolower((string)($lg->notes ?? ''));
            if (strpos($n, 'down') !== false) {
                $statement_down_payment = (float)($lg->paid_amount ?? 0);
                break;
            }
        }
    }
    ?>

    <!-- ================= STATS ROW ================= -->
    <div class="stats-row">
        <div class="stat-box debit">
            <div class="stat-label">Total Receivable</div>
            <div class="stat-value red">&#8377; <?= number_format($opening_balance, 2) ?></div>
        </div>
        <div class="stat-box credit">
            <div class="stat-label">Total Received</div>
            <div class="stat-value green">&#8377; <?= number_format($temp_credit, 2) ?></div>
        </div>
        <div class="stat-box balance">
            <div class="stat-label">Net Balance</div>
            <div class="stat-value blue">
                &#8377; <?= number_format(abs($temp_balance), 2) ?>
                <?= $temp_balance >= 0 ? '(Dr)' : '(Cr)' ?>
            </div>
        </div>
    </div>

    <!-- ================= LEDGER TABLE ================= -->
    <?php if ($statement_down_payment > 0): ?>
        <div class="down-payment-box">
            <div class="down-payment-label">Down Payment</div>
            <div class="down-payment-value">&#8377; <?= number_format($statement_down_payment, 2) ?></div>
        </div>
    <?php endif; ?>

    <div class="table-title">Transaction Ledger</div>

    <table class="ledger-table">
        <thead>
            <tr>
                <th style="width:12%">Date</th>
                <th style="width:30%">Transaction Type</th>
                <th style="width:18%">Debit (&#8377;)</th>
                <th style="width:18%">Credit (&#8377;)</th>
                <th style="width:22%">Running Balance</th>
            </tr>
        </thead>

        <tbody>

            <!-- OPENING / RECEIVABLE ROW -->
            <tr class="row-opening">
                <td class="text-center">
                    <?= !empty($logs)
                        ? date('d/m/Y', strtotime($logs[0]->created_on))
                        : '-' ?>
                </td>

                <td class="text-left">
                    <strong>Receivable Beginning Balance</strong>
                </td>

                <td class="text-right amt-debit">
                    &#8377; <?= number_format($opening_balance, 2) ?>
                </td>

                <td class="text-center" style="color:#aaa;">-</td>

                <td class="text-right">
                    <strong>&#8377; <?= number_format($running_balance, 2) ?></strong>
                    <span class="badge-dr">Dr</span>
                </td>
            </tr>

            <!-- PAYMENT ROWS -->
            <?php foreach ($logs as $log) :

                $credit = (float)($log->paid_amount ?? 0);
                if ($credit <= 0) continue;

                $running_balance -= $credit;
                $total_credit    += $credit;
            ?>
                <tr class="row-payment">
                    <td class="text-center">
                        <?= date('d/m/Y', strtotime($log->created_on)) ?>
                    </td>

                    <td class="text-left">
                        Payment Received
                    </td>

                    <td class="text-center" style="color:#aaa;">-</td>

                    <td class="text-right amt-credit">
                        &#8377; <?= number_format($credit, 2) ?>
                    </td>

                    <td class="text-right">
                        <strong>&#8377; <?= number_format(abs($running_balance), 2) ?></strong>
                        <?php if ($running_balance >= 0): ?>
                            <span class="badge-dr">Dr</span>
                        <?php else: ?>
                            <span class="badge-cr">Cr</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

            <!-- TOTAL ROW -->
            <tr class="total-row">
                <td colspan="2" class="text-right">
                    TOTAL
                </td>

                <td class="text-right">
                    &#8377; <?= number_format($total_debit, 2) ?>
                </td>

                <td class="text-right">
                    &#8377; <?= number_format($total_credit, 2) ?>
                </td>

                <td class="text-right">
                    &#8377; <?= number_format(abs($running_balance), 2) ?>
                    <?= $running_balance >= 0 ? '(Dr)' : '(Cr)' ?>
                </td>
            </tr>

        </tbody>
    </table>

    <!-- ================= FOOTER ================= -->
    <div class="footer">
        <div class="footer-inner">
            <div class="footer-left">
                <div>This is a system-generated statement.</div>
                <div class="generated-note">
                    Generated on: <?= date('d/m/Y h:i A') ?>
                </div>
            </div>
            <div class="footer-right">
                <div class="sign-line"></div>
                <div class="sign-label">Authorized Signature</div>
                <div class="sign-label" style="font-weight:bold; margin-top:2px;">
                    <?= strtoupper($user->business_name ?? '') ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
