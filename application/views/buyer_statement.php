<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Party Statement</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 12px;
        color: #1a1a2e;
        background: #fff;
        padding: 20px;
    }

    /* ===== HEADER ===== */
    .header-wrapper {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        border-radius: 8px;
        padding: 20px 25px;
        margin-bottom: 20px;
        color: #fff;
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
        border-radius: 50%;
        border: 2px solid rgba(255,255,255,0.4);
        object-fit: cover;
    }

    .header-logo .logo-placeholder {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        border: 2px solid rgba(255,255,255,0.3);
        display: table-cell;
        vertical-align: middle;
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        color: #fff;
    }

    .header-content {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
    }

    .company-name {
        font-size: 20px;
        font-weight: bold;
        color: #ffffff;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .company-tagline {
        font-size: 10px;
        color: rgba(255,255,255,0.6);
        margin-top: 3px;
        letter-spacing: 0.5px;
    }

    .header-contact {
        display: table-cell;
        vertical-align: middle;
        text-align: right;
        width: 200px;
    }

    .contact-item {
        font-size: 10px;
        color: rgba(255,255,255,0.8);
        margin-bottom: 4px;
    }

    .contact-item span {
        color: #e94560;
        font-weight: bold;
        margin-right: 4px;
    }

    /* ===== DIVIDER ===== */
    .divider {
        height: 3px;
        background: linear-gradient(to right, #e94560, #0f3460, #e94560);
        border-radius: 2px;
        margin: 0 0 18px 0;
        border: none;
    }

    /* ===== TITLE ===== */
    .title-block {
        text-align: center;
        margin-bottom: 18px;
    }

    .title-block .title-text {
        font-size: 16px;
        font-weight: bold;
        color: #0f3460;
        letter-spacing: 1px;
        text-transform: uppercase;
        display: inline-block;
        padding: 6px 25px;
        border: 2px solid #0f3460;
        border-radius: 4px;
        background: #f0f4ff;
    }

    /* ===== PARTY INFO CARD ===== */
    .party-card {
        background: #f8faff;
        border: 1px solid #d0d8f0;
        border-left: 4px solid #0f3460;
        border-radius: 6px;
        padding: 14px 18px;
        margin-bottom: 18px;
    }

    .party-card-header {
        font-size: 13px;
        font-weight: bold;
        color: #0f3460;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px dashed #b0bce0;
        padding-bottom: 7px;
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
        color: #555;
        font-weight: bold;
        width: 100px;
        white-space: nowrap;
    }

    .info-grid .colon {
        width: 10px;
        color: #555;
    }

    .info-grid .value {
        color: #1a1a2e;
        font-weight: bold;
    }

    /* ===== STATS ROW ===== */
    .stats-row {
        display: table;
        width: 100%;
        margin-bottom: 18px;
        border-collapse: separate;
        border-spacing: 8px;
    }

    .stat-box {
        display: table-cell;
        background: #fff;
        border: 1px solid #d0d8f0;
        border-radius: 6px;
        padding: 10px 14px;
        text-align: center;
        width: 33.33%;
    }

    .stat-box.debit {
        border-top: 3px solid #e94560;
    }

    .stat-box.credit {
        border-top: 3px solid #28a745;
    }

    .stat-box.balance {
        border-top: 3px solid #0f3460;
    }

    .stat-label {
        font-size: 9px;
        color: #777;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 13px;
        font-weight: bold;
        color: #1a1a2e;
    }

    .stat-value.red   { color: #e94560; }
    .stat-value.green { color: #28a745; }
    .stat-value.blue  { color: #0f3460; }

    /* ===== LEDGER TABLE ===== */
    .table-title {
        font-size: 11px;
        font-weight: bold;
        color: #0f3460;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
        padding-left: 2px;
    }

    .ledger-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .ledger-table thead tr {
        background: linear-gradient(135deg, #1a1a2e, #0f3460);
        color: #fff;
    }

    .ledger-table th {
        padding: 9px 8px;
        font-size: 10px;
        text-align: center;
        font-weight: bold;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        border: 1px solid #0a2545;
    }

    .ledger-table td {
        border: 1px solid #d5ddf0;
        padding: 7px 8px;
        font-size: 11px;
        color: #1a1a2e;
    }

    .ledger-table tbody tr:nth-child(even) {
        background-color: #f5f7ff;
    }

    .ledger-table tbody tr:hover {
        background-color: #eef1fb;
    }

    /* Opening row */
    .row-opening {
        background-color: #fff8e1 !important;
    }

    /* Payment row */
    .row-payment td {
        background-color: #f0fff4;
    }

    /* Total row */
    .total-row {
        background: linear-gradient(135deg, #1a1a2e, #0f3460) !important;
        color: #fff !important;
    }

    .total-row td {
        background: transparent !important;
        color: #fff !important;
        font-weight: bold;
        border: 1px solid #0a2545;
        padding: 9px 8px;
        font-size: 11px;
    }

    .text-right  { text-align: right; }
    .text-center { text-align: center; }
    .text-left   { text-align: left; }

    /* Amount badges */
    .amt-debit {
        color: #c0392b;
        font-weight: bold;
    }

    .amt-credit {
        color: #27ae60;
        font-weight: bold;
    }

    .badge-dr {
        display: inline-block;
        background: #fdecea;
        color: #c0392b;
        border: 1px solid #f5c6cb;
        border-radius: 3px;
        padding: 1px 5px;
        font-size: 9px;
        font-weight: bold;
        margin-left: 3px;
    }

    .badge-cr {
        display: inline-block;
        background: #eafaf1;
        color: #27ae60;
        border: 1px solid #c3e6cb;
        border-radius: 3px;
        padding: 1px 5px;
        font-size: 9px;
        font-weight: bold;
        margin-left: 3px;
    }

    /* ===== FOOTER ===== */
    .footer {
        margin-top: 25px;
        border-top: 2px solid #d0d8f0;
        padding-top: 12px;
    }

    .footer-inner {
        display: table;
        width: 100%;
    }

    .footer-left {
        display: table-cell;
        vertical-align: bottom;
        font-size: 9px;
        color: #888;
    }

    .footer-right {
        display: table-cell;
        vertical-align: bottom;
        text-align: right;
    }

    .sign-line {
        border-top: 1px solid #333;
        width: 150px;
        margin-left: auto;
        margin-top: 30px;
        margin-bottom: 4px;
    }

    .sign-label {
        font-size: 10px;
        color: #555;
        text-align: center;
    }

    .generated-note {
        font-size: 8px;
        color: #aaa;
        margin-top: 6px;
    }
</style>
</head>

<body>

<!-- ================= HEADER ================= -->
<div class="header-wrapper">
    <div class="header-inner">

        <!-- Logo -->
        <div class="header-logo">
            <?php if (!empty($user->profile_image)) { ?>
                <img src="<?= base_url($user->profile_image) ?>" alt="Logo">
            <?php } else { ?>
                <div class="logo-placeholder">
                    <?= strtoupper(substr($user->business_name ?? 'B', 0, 1)) ?>
                </div>
            <?php } ?>
        </div>

        <!-- Company Name -->
        <div class="header-content">
            <div class="company-name">
                <?= strtoupper($user->business_name ?? '-') ?>
            </div>
            <div class="company-tagline">Real Estate &amp; Property Management</div>
        </div>

        <!-- Contact -->
        <div class="header-contact">
            <div class="contact-item">
                <span>&#9990;</span><?= $user->mobile ?? '-' ?>
            </div>
            <div class="contact-item">
                <span>&#9993;</span><?= $user->email ?? '-' ?>
            </div>
        </div>

    </div>
</div>

<!-- ================= DIVIDER ================= -->
<hr class="divider">

<!-- ================= TITLE ================= -->
<div class="title-block">
    <div class="title-text">&#128196; Party Statement</div>
</div>

<!-- ================= PARTY DETAILS ================= -->
<div class="party-card">
    <div class="party-card-header">
        &#128100; Party Information
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
   LOGIC — kept exactly as original
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
<div class="table-title">&#128203; Transaction Ledger</div>

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

        <!-- 🔹 OPENING / RECEIVABLE ROW — logic untouched -->
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

            <td class="text-center" style="color:#aaa;">—</td>

            <td class="text-right">
                <strong>&#8377; <?= number_format($running_balance, 2) ?></strong>
                <span class="badge-dr">Dr</span>
            </td>
        </tr>

        <!-- 🔹 PAYMENT ROWS — logic untouched -->
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
                &#9989; Payment Received
            </td>

            <td class="text-center" style="color:#aaa;">—</td>

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

        <!-- 🔹 TOTAL ROW — logic untouched -->
        <tr class="total-row">
            <td colspan="2" class="text-right">
                &#128200; TOTAL
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