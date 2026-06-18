<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700;900&family=Noto+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Buyer Statement</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Noto Sans', sans-serif !important;
        }

        .font-display {
            font-family: 'Fraunces', 'Noto Sans', serif !important;
        }

        body {
            font-size: 12px;
            color: #20242B;
            background: #FAF8F4;
            padding: 28px 32px;
        }

        /* ── Colour palette ────────────────────────────── */
        .ink-debit {
            color: #8E3B2E;
        }

        .ink-credit {
            color: #1F6B45;
        }

        .ink-balance {
            color: #1F3A5C;
        }

        .ink-soft {
            color: #6B7280;
        }

        .ink-gold {
            color: #A6843C;
        }

        /* ═══════════════════════════════════════════════════
           LETTERHEAD
        ═══════════════════════════════════════════════════ */
        .letterhead {
            border-top: 3px solid #A6843C;
            padding: 18px 0 16px;
            margin-bottom: 0;
        }

        .lh-grid {
            display: table;
            width: 100%;
            border-spacing: 0;
        }

        /* --- Seal ---------------------------------------- */
        .lh-seal {
            display: table-cell;
            width: 66px;
            vertical-align: middle;
        }

        .lh-seal img,
        .seal-circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: block;
        }

        .lh-seal img {
            border: 2px solid #A6843C;
            object-fit: cover;
        }

        .seal-circle {
            border: 2px solid #A6843C;
            background: #FBF3DF;
            line-height: 52px;
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            color: #A6843C;
        }

        /* --- Company block ------------------------------- */
        .lh-company {
            display: table-cell;
            vertical-align: middle;
            padding-left: 14px;
            padding-right: 20px;
        }

        .company-name {
            font-size: 22px;
            font-weight: 700;
            color: #20242B;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            line-height: 1.1;
        }

        .company-tag {
            font-size: 9px;
            color: #6B7280;
            margin-top: 5px;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .company-gst {
            display: inline-block;
            margin-top: 6px;
            font-size: 8.5px;
            color: #A6843C;
            background: #FBF3DF;
            border: 1px solid #E8D9AA;
            border-radius: 3px;
            padding: 2px 7px;
            letter-spacing: 0.4px;
            font-weight: 600;
        }

        /* --- Divider between company and contacts -------- */
        .lh-divider {
            display: table-cell;
            width: 1px;
            background: #E2DBC9;
            padding: 0;
            vertical-align: stretch;
        }

        /* --- Contact block ------------------------------- */
        .lh-contact {
            display: table-cell;
            vertical-align: middle;
            padding-left: 20px;
            width: 290px;
        }

        /* Two-column contact grid */
        .contact-grid {
            display: table;
            width: 100%;
            border-spacing: 0 4px;
        }

        .cg-row {
            display: table-row;
        }

        .cg-icon {
            display: table-cell;
            width: 22px;
            vertical-align: middle;
            padding-right: 6px;
        }

        /* Inline SVG icon wrapper */
        .cg-icon svg {
            display: block;
            width: 14px;
            height: 14px;
            fill: none;
            stroke: #A6843C;
            stroke-width: 1.6;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .cg-label {
            display: table-cell;
            width: 64px;
            font-size: 8.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #9CA3AF;
            vertical-align: middle;
            white-space: nowrap;
        }

        .cg-value {
            display: table-cell;
            font-size: 10px;
            font-weight: 600;
            color: #20242B;
            vertical-align: middle;
            word-break: break-word;
        }

        .cg-value a {
            color: #1F3A5C;
            text-decoration: none;
        }

        /* Social badge pill */
        .social-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #F3F4F6;
            border: 1px solid #E2DBC9;
            border-radius: 20px;
            padding: 2px 8px 2px 5px;
            font-size: 9.5px;
            font-weight: 600;
            color: #20242B;
            text-decoration: none;
        }

        .social-pill svg {
            width: 12px;
            height: 12px;
            flex-shrink: 0;
        }

        .social-pill.fb {
            border-color: #BFD0F5;
            background: #EEF2FF;
            color: #1D4ED8;
        }

        .social-pill.ig {
            border-color: #F9C8D4;
            background: #FDF2F8;
            color: #9D174D;
        }

        /* ═══════════════════════════════════════════════════
           LETTERHEAD BOTTOM BORDER
        ═══════════════════════════════════════════════════ */
        .lh-bottom-rule {
            border: none;
            border-top: 1px solid #E2DBC9;
            margin: 14px 0 0;
        }

        /* ═══════════════════════════════════════════════════
           EYEBROW TITLE
        ═══════════════════════════════════════════════════ */
        .eyebrow-row {
            display: table;
            width: 100%;
            margin: 18px 0 16px;
        }

        .eyebrow-line {
            display: table-cell;
            border-bottom: 1px solid #E2DBC9;
            vertical-align: middle;
        }

        .eyebrow-label {
            display: table-cell;
            white-space: nowrap;
            padding: 0 18px;
            text-align: center;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #A6843C;
        }

        /* ═══════════════════════════════════════════════════
           BILLED TO / PERIOD
        ═══════════════════════════════════════════════════ */
        .billto-row {
            display: table;
            width: 100%;
            border: 1px solid #E2DBC9;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 18px;
        }

        .billto-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 14px 18px;
        }

        .billto-col-right {
            border-left: 1px solid #E2DBC9;
            background: #FDFAF3;
        }

        .billto-eyebrow {
            font-size: 8.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #9CA3AF;
            margin-bottom: 6px;
        }

        .billto-name {
            font-size: 18px;
            font-weight: 700;
            color: #20242B;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 0.3px;
        }

        .billto-period {
            font-size: 16px;
            font-weight: 700;
            color: #20242B;
        }

        .mini-grid {
            border-collapse: collapse;
        }

        .mini-grid td {
            padding: 2px 0;
            vertical-align: top;
            font-size: 10.5px;
        }

        .mini-grid .m-label {
            color: #9CA3AF;
            font-weight: 600;
            width: 82px;
            white-space: nowrap;
        }

        .mini-grid .m-colon {
            width: 10px;
            color: #9CA3AF;
        }

        .mini-grid .m-value {
            color: #20242B;
            font-weight: 700;
        }

        /* ═══════════════════════════════════════════════════
           LEDGER STRIP (STATS)
        ═══════════════════════════════════════════════════ */
        .ledger-strip {
            display: table;
            width: 100%;
            border: 1px solid #E2DBC9;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .ledger-cell {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            padding: 14px 10px;
            background: #FDFAF3;
        }

        .ledger-cell-mid {
            border-left: 1px solid #E2DBC9;
            border-right: 1px solid #E2DBC9;
            background: #fff;
        }

        .ledger-label {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.9px;
            color: #9CA3AF;
            margin-bottom: 5px;
        }

        .ledger-amount {
            font-size: 20px;
            font-weight: 700;
        }

        .ledger-sub {
            font-size: 8.5px;
            color: #B0A994;
            margin-top: 5px;
            font-weight: 600;
        }

        /* ═══════════════════════════════════════════════════
           INFO ROWS (Down Payment + Bank Details)
        ═══════════════════════════════════════════════════ */
        .info-block {
            border: 1px solid #E2DBC9;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 18px;
        }

        .info-row {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .info-row+.info-row {
            border-top: 1px solid #E2DBC9;
        }

        .info-label-cell {
            display: table-cell;
            width: 148px;
            padding: 11px 14px;
            vertical-align: middle;
            background: #F4EEDF;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #8A7A55;
            white-space: nowrap;
        }

        .info-value-cell {
            display: table-cell;
            padding: 11px 16px;
            vertical-align: middle;
        }

        /* Down payment value */
        .dp-amount {
            font-size: 16px;
            font-weight: 700;
            color: #1F6B45;
        }

        /* Bank details grid */
        .bank-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .bank-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #fff;
            border: 1px solid #E2DBC9;
            border-radius: 4px;
            padding: 5px 10px;
        }

        .bank-chip .bc-icon {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        .bank-chip .bc-icon svg {
            width: 14px;
            height: 14px;
            fill: none;
            stroke: #A6843C;
            stroke-width: 1.6;
            stroke-linecap: round;
            stroke-linejoin: round;
            display: block;
        }

        .bank-chip .bc-label {
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #9CA3AF;
        }

        .bank-chip .bc-value {
            font-size: 10px;
            font-weight: 700;
            color: #20242B;
        }

        /* ═══════════════════════════════════════════════════
           SECTION TITLE
        ═══════════════════════════════════════════════════ */
        .section-title {
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #20242B;
            border-bottom: 2px solid #A6843C;
            padding-bottom: 7px;
            margin: 20px 0 12px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .section-title svg {
            width: 14px;
            height: 14px;
            fill: none;
            stroke: #A6843C;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        /* ═══════════════════════════════════════════════════
           LEDGER TABLE
        ═══════════════════════════════════════════════════ */
        .ledger-wrap {
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #E2DBC9;
            margin-bottom: 24px;
        }

        .ledger-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .ledger-table th {
            background: #F4EEDF;
            color: #6B5C38;
            border-bottom: 2px solid #C9A85C;
            border-right: 1px solid #EAE3D2;
            padding: 10px 8px;
            font-size: 9px;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.7px;
        }

        .ledger-table th:last-child {
            border-right: none;
        }

        .ledger-table td {
            border: 1px solid #ECE6D8;
            padding: 9px 8px;
            font-size: 11px;
            color: #20242B;
        }

        .ledger-table tbody tr.row-payment:nth-child(even) {
            background-color: #FCFAF6;
        }

        .row-opening td {
            background-color: #FBF3DF;
        }

        .row-opening td:first-child {
            border-left: 3px solid #A6843C;
        }

        .total-row td {
            background: #F6F0E2;
            border-top: 2px solid #C9A85C;
            border-bottom: 2px solid #C9A85C;
            font-weight: 700;
            font-size: 11.5px;
            padding: 11px 8px;
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
            color: #8E3B2E;
            font-weight: 700;
        }

        .amt-credit {
            color: #1F6B45;
            font-weight: 700;
        }

        .tag-dr,
        .tag-cr {
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-left: 3px;
            padding: 1px 4px;
            border-radius: 2px;
        }

        .tag-dr {
            color: #8E3B2E;
            background: #F9ECEC;
        }

        .tag-cr {
            color: #1F6B45;
            background: #E8F4EE;
        }

        /* ═══════════════════════════════════════════════════
           FOOTER — improved signature layout
        ═══════════════════════════════════════════════════ */
        .footer {
            margin-top: 12px;
            border-top: 1px solid #E2DBC9;
            padding-top: 16px;
        }

        .footer-inner {
            display: table;
            width: 100%;
        }

        .footer-left {
            display: table-cell;
            vertical-align: bottom;
            font-size: 9px;
            color: #9CA3AF;
            line-height: 1.7;
        }

        .footer-left .gen-label {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 8px;
            color: #B0A994;
        }

        .footer-right {
            display: table-cell;
            vertical-align: bottom;
            text-align: right;
            width: 180px;
        }

        /* Signature box */
        .sign-box {
            display: inline-block;
            text-align: center;
            width: 180px;
        }

        .sign-img-area {
            height: 52px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-bottom: 0;
        }

        .sign-img-area img {
            max-height: 50px;
            max-width: 170px;
            object-fit: contain;
        }

        .sign-placeholder {
            height: 52px;
        }

        .sign-line {
            border: none;
            border-top: 1px solid #A6843C;
            margin: 0;
            width: 100%;
        }

        .sign-label {
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #9CA3AF;
            margin-top: 5px;
        }

        .sign-company {
            font-size: 11px;
            font-weight: 700;
            color: #20242B;
            margin-top: 3px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        /* ═══════════════════════════════════════════════════
           BOTTOM RULE
        ═══════════════════════════════════════════════════ */
        .bottom-rule {
            height: 3px;
            background: linear-gradient(90deg, #C9A85C, #A6843C, #8B6E30);
            margin-top: 16px;
            border-radius: 2px;
        }
    </style>
</head>

<body>
    <?php
    $admin_business = !empty($user->business_name) ? $user->business_name : '-';
    $admin_name     = !empty($user->name)           ? $user->name           : '-';
    $admin_mobile   = !empty($user->mobile)         ? $user->mobile         : '-';
    $admin_email    = !empty($user->email)          ? $user->email          : '-';
    $admin_address  = !empty($user->address)        ? $user->address        : '-';
    $admin_gst      = !empty($user->gst_number)     ? $user->gst_number     : '';
    $admin_facebook = !empty($user->facebook)       ? $user->facebook       : '';
    $admin_instagram = !empty($user->instagram)      ? $user->instagram      : '';

    if (!function_exists('get_social_username')) {
        function get_social_username($url)
        {
            if (empty($url)) return '';
            if (strpos($url, '/') === false && strpos($url, '.') === false) return trim($url);
            $query = parse_url($url, PHP_URL_QUERY);
            if ($query) {
                parse_str($query, $params);
                if (isset($params['id'])) return $params['id'];
            }
            $path = parse_url($url, PHP_URL_PATH);
            if ($path) {
                $trimmed = trim($path, '/');
                if ($trimmed !== '' && strtolower($trimmed) !== 'profile.php') {
                    $segments = explode('/', $trimmed);
                    $username = end($segments);
                    if (!empty($username)) return $username;
                }
            }
            $cleaned = preg_replace('/^(https?:\/\/)?(www\.)?(facebook\.com|instagram\.com)\//i', '', $url);
            return trim($cleaned, '/');
        }
    }

    if (!function_exists('get_social_link')) {
        function get_social_link($val, $platform)
        {
            if (empty($val)) return '';
            if (strpos($val, 'http://') === 0 || strpos($val, 'https://') === 0) return $val;
            if ($platform === 'facebook')  return 'https://www.facebook.com/'  . ltrim($val, '/');
            if ($platform === 'instagram') return 'https://www.instagram.com/' . ltrim($val, '/');
            return $val;
        }
    }
    ?>

    <!-- ══════════════ LETTERHEAD ══════════════ -->
    <div class="letterhead">
        <div class="lh-grid">

            <!-- Seal / Logo -->
            <div class="lh-seal">
                <?php if (!empty($user->profile_image_data_uri) || !empty($user->profile_image)):
                    if (!empty($user->profile_image_data_uri)) {
                        $logoSrc = (string)$user->profile_image_data_uri;
                    } else {
                        $logoPath = (string)$user->profile_image;
                        $isAbsoluteLogo = preg_match('/^https?:\/\//i', $logoPath);
                        $logoSrc = $isAbsoluteLogo ? $logoPath : base_url($logoPath);
                    }
                ?>
                    <img src="<?= $logoSrc ?>" alt="Logo">
                <?php else: ?>
                    <div class="seal-circle font-display">
                        <?= strtoupper(substr($admin_business, 0, 1)) ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Company Name -->
            <div class="lh-company">
                <div class="company-name font-display"><?= strtoupper($admin_business) ?></div>
                <div class="company-tag">Real Estate &amp; Property Management</div>
                <?php if (!empty($admin_gst)): ?>
                    <div class="company-gst">GSTIN: <?= htmlspecialchars($admin_gst) ?></div>
                <?php endif; ?>
            </div>

            <!-- Visual divider cell -->
            <div class="lh-divider"></div>

            <!-- Contact Details -->
            <div class="lh-contact">
                <div class="contact-grid">

                    <!-- Name -->
                    <div class="cg-row">
                        <div class="cg-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                            </svg>
                        </div>
                        <div class="cg-label">Name</div>
                        <div class="cg-value"><?= htmlspecialchars($admin_name) ?></div>
                    </div>

                    <!-- Mobile -->
                    <div class="cg-row">
                        <div class="cg-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="7" y="2" width="10" height="20" rx="2" />
                                <circle cx="12" cy="17" r="1" fill="#A6843C" stroke="none" />
                            </svg>
                        </div>
                        <div class="cg-label">Mobile</div>
                        <div class="cg-value"><?= htmlspecialchars($admin_mobile) ?></div>
                    </div>

                    <!-- Email -->
                    <div class="cg-row">
                        <div class="cg-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                                <path d="M2 7l10 7 10-7" />
                            </svg>
                        </div>
                        <div class="cg-label">Email</div>
                        <div class="cg-value"><?= htmlspecialchars($admin_email) ?></div>
                    </div>

                    <!-- Address -->
                    <div class="cg-row">
                        <div class="cg-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                <circle cx="12" cy="9" r="2.5" />
                            </svg>
                        </div>
                        <div class="cg-label">Address</div>
                        <div class="cg-value"><?= htmlspecialchars($admin_address) ?></div>
                    </div>

                    <!-- Social links -->
                    <?php if (!empty($admin_facebook) || !empty($admin_instagram)): ?>
                        <div class="cg-row">
                            <div class="cg-icon">
                                <!-- share icon -->
                                <svg viewBox="0 0 24 24">
                                    <circle cx="18" cy="5" r="3" />
                                    <circle cx="6" cy="12" r="3" />
                                    <circle cx="18" cy="19" r="3" />
                                    <path d="M8.59 13.51l6.83 3.98M15.41 6.51L8.59 10.49" />
                                </svg>
                            </div>
                            <div class="cg-label">Social</div>
                            <div class="cg-value" style="padding-top:1px;">
                                <?php if (!empty($admin_facebook)): ?>
                                    <a href="<?= htmlspecialchars(get_social_link($admin_facebook, 'facebook')) ?>" class="social-pill fb" target="_blank">
                                        <!-- Facebook F icon -->
                                        <svg viewBox="0 0 24 24" fill="#1877F2" stroke="none">
                                            <path d="M24 12.073C24 5.404 18.627 0 12 0S0 5.404 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047v-2.66c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.97h-1.513c-1.491 0-1.956.93-1.956 1.886v2.265h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z" />
                                        </svg>
                                        @<?= htmlspecialchars(get_social_username($admin_facebook)) ?>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($admin_instagram)): ?>
                                    <a href="<?= htmlspecialchars(get_social_link($admin_instagram, 'instagram')) ?>" class="social-pill ig" target="_blank" style="margin-left:<?= !empty($admin_facebook) ? '5px' : '0' ?>">
                                        <!-- Instagram gradient icon -->
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <defs>
                                                <linearGradient id="ig_grad" x1="0" y1="24" x2="24" y2="0" gradientUnits="userSpaceOnUse">
                                                    <stop offset="0%" stop-color="#F58529" />
                                                    <stop offset="50%" stop-color="#DD2A7B" />
                                                    <stop offset="100%" stop-color="#8134AF" />
                                                </linearGradient>
                                            </defs>
                                            <rect width="24" height="24" rx="6" fill="url(#ig_grad)" />
                                            <rect x="2" y="2" width="20" height="20" rx="5" fill="url(#ig_grad)" />
                                            <circle cx="12" cy="12" r="4.5" stroke="white" stroke-width="1.6" fill="none" />
                                            <circle cx="17.5" cy="6.5" r="1.2" fill="white" />
                                        </svg>
                                        @<?= htmlspecialchars(get_social_username($admin_instagram)) ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div><!-- /contact-grid -->
            </div><!-- /lh-contact -->

        </div><!-- /lh-grid -->
        <hr class="lh-bottom-rule">
    </div><!-- /letterhead -->

    <!-- ══════════════ TITLE ══════════════ -->
    <div class="eyebrow-row">
        <div class="eyebrow-line"></div>
        <div class="eyebrow-label">Statement of Account</div>
        <div class="eyebrow-line"></div>
    </div>

    <!-- ══════════════ PARTY DETAILS ══════════════ -->
    <?php
    $from = '-';
    $to   = '-';
    if (!empty($logs)) {
        $from = date('d/m/Y', strtotime($logs[0]->created_on));
        $to   = date('d/m/Y', strtotime(end($logs)->created_on));
    }
    if (isset($payment) && $payment->payment_mode === 'EMI') {
        $CI = &get_instance();
        $last_emi = $CI->db->select('emi_date')
            ->where('buyer_id', $buyer->id)
            ->order_by('emi_date', 'DESC')
            ->limit(1)
            ->get('emi_logs')
            ->row();
        if ($last_emi && !empty($last_emi->emi_date)) {
            $to = date('d/m/Y', strtotime($last_emi->emi_date));
        }
    }
    ?>

    <div class="billto-row">
        <div class="billto-col">
            <div class="billto-eyebrow">Billed To</div>
            <div class="billto-name font-display"><?= strtoupper($buyer->name ?? '-') ?></div>
            <table class="mini-grid">
                <tr>
                    <td class="m-label">Contact No</td>
                    <td class="m-colon">:</td>
                    <td class="m-value"><?= $buyer->mobile ?? '-' ?></td>
                </tr>
                <tr>
                    <td class="m-label">Address</td>
                    <td class="m-colon">:</td>
                    <td class="m-value"><?= $buyer->address ?? '-' ?></td>
                </tr>
            </table>
        </div>
        <div class="billto-col billto-col-right">
            <div class="billto-eyebrow">Statement Period</div>
            <div class="billto-period font-display"><?= $from ?> &nbsp;&mdash;&nbsp; <?= $to ?></div>
        </div>
    </div>

    <?php
    $total_debit      = 0;
    $total_credit     = 0;
    $opening_balance  = !empty($logs) ? (float)$logs[0]->total_price : 0;
    $running_balance  = $opening_balance;
    $total_debit      = $opening_balance;

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

    $percent_collected = $opening_balance > 0 ? round(($temp_credit / $opening_balance) * 100) : 0;
    ?>

    <!-- ══════════════ STAT STRIP ══════════════ -->
    <div class="ledger-strip">
        <div class="ledger-cell">
            <div class="ledger-label">Total Receivable</div>
            <div class="ledger-amount font-display ink-debit">&#8377; <?= number_format($opening_balance, 2) ?></div>
        </div>
        <div class="ledger-cell ledger-cell-mid">
            <div class="ledger-label">Total Received</div>
            <div class="ledger-amount font-display ink-credit">&#8377; <?= number_format($temp_credit, 2) ?></div>
            <div class="ledger-sub"><?= $percent_collected ?>% of total collected</div>
        </div>
        <div class="ledger-cell">
            <div class="ledger-label">Net Balance</div>
            <div class="ledger-amount font-display ink-balance">
                &#8377; <?= number_format(abs($temp_balance), 2) ?>
                <?= $temp_balance >= 0 ? '(Dr)' : '(Cr)' ?>
            </div>
        </div>
    </div>

    <!-- ══════════════ DOWN PAYMENT + BANK DETAILS BLOCK ══════════════ -->
    <?php
    $bank_name      = !empty($user->bank_name)       ? $user->bank_name       : '';
    $account_number = !empty($user->account_number)  ? $user->account_number  : '';
    $ifsc_code      = !empty($user->ifsc_code)        ? $user->ifsc_code        : '';
    $has_bank       = !empty($bank_name) || !empty($account_number) || !empty($ifsc_code);
    $has_dp         = $statement_down_payment > 0;

    if ($has_dp || $has_bank):
    ?>
        <div class="info-block">

            <?php if ($has_dp): ?>
                <div class="info-row">
                    <div class="info-label-cell">
                        <!-- rupee icon -->
                        <svg style="width:12px;height:12px;fill:none;stroke:#8A7A55;stroke-width:1.8;stroke-linecap:round;vertical-align:-2px;margin-right:4px;" viewBox="0 0 24 24">
                            <path d="M6 4h12M6 9h12M9 9c0 3.5 2.5 6 6 8M6 20l7-11" />
                        </svg>
                        Down Payment
                    </div>
                    <div class="info-value-cell">
                        <span class="dp-amount font-display">&#8377; <?= number_format($statement_down_payment, 2) ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($has_bank): ?>
                <div class="info-row">
                    <div class="info-label-cell">
                        <!-- bank icon -->
                        <svg style="width:12px;height:12px;fill:none;stroke:#8A7A55;stroke-width:1.8;stroke-linecap:round;vertical-align:-2px;margin-right:4px;" viewBox="0 0 24 24">
                            <path d="M3 21h18M3 10h18M5 10V7l7-4 7 4v3M9 21v-5h6v5" />
                        </svg>
                        Bank Details
                    </div>
                    <div class="info-value-cell">
                        <div class="bank-chips">
                            <?php if (!empty($bank_name)): ?>
                                <div class="bank-chip">
                                    <div class="bc-icon">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M3 21h18M3 10h18M5 10V7l7-4 7 4v3M9 21v-5h6v5" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="bc-label">Bank</div>
                                        <div class="bc-value"><?= htmlspecialchars($bank_name) ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($account_number)): ?>
                                <div class="bank-chip">
                                    <div class="bc-icon">
                                        <svg viewBox="0 0 24 24">
                                            <rect x="2" y="5" width="20" height="14" rx="2" />
                                            <path d="M2 10h20" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="bc-label">A/C No</div>
                                        <div class="bc-value"><?= htmlspecialchars($account_number) ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($ifsc_code)): ?>
                                <div class="bank-chip">
                                    <div class="bc-icon">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4" />
                                            <circle cx="12" cy="12" r="9" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="bc-label">IFSC</div>
                                        <div class="bc-value"><?= htmlspecialchars($ifsc_code) ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div><!-- /info-block -->
    <?php endif; ?>

    <!-- ══════════════ LEDGER TABLE ══════════════ -->
    <div class="section-title">
        <svg viewBox="0 0 24 24">
            <path d="M3 6h18M3 12h18M3 18h18" />
        </svg>
        Transaction Ledger
    </div>

    <div class="ledger-wrap">
        <table class="ledger-table">
            <thead>
                <tr>
                    <th style="width:11%">Date</th>
                    <th style="width:31%">Transaction Type</th>
                    <th style="width:18%">Debit (&#8377;)</th>
                    <th style="width:18%">Credit (&#8377;)</th>
                    <th style="width:22%">Running Balance</th>
                </tr>
            </thead>
            <tbody>

                <!-- Opening / Receivable Row -->
                <tr class="row-opening">
                    <td class="text-center">
                        <?= !empty($logs) ? date('d/m/Y', strtotime($logs[0]->created_on)) : '-' ?>
                    </td>
                    <td class="text-left"><strong>Receivable Beginning Balance</strong></td>
                    <td class="text-right amt-debit">&#8377; <?= number_format($opening_balance, 2) ?></td>
                    <td class="text-center" style="color:#C9B99A;">—</td>
                    <td class="text-right">
                        <strong>&#8377; <?= number_format($running_balance, 2) ?></strong>
                        <span class="tag-dr">Dr</span>
                    </td>
                </tr>

                <!-- Payment Rows -->
                <?php foreach ($logs as $log):
                    $credit = (float)($log->paid_amount ?? 0);
                    if ($credit <= 0) continue;
                    $running_balance -= $credit;
                    $total_credit    += $credit;
                ?>
                    <tr class="row-payment">
                        <td class="text-center"><?= date('d/m/Y', strtotime($log->created_on)) ?></td>
                        <td class="text-left"><?= !empty($log->notes) ? htmlspecialchars($log->notes) : 'Payment Received' ?></td>
                        <td class="text-center" style="color:#C9B99A;">—</td>
                        <td class="text-right amt-credit">&#8377; <?= number_format($credit, 2) ?></td>
                        <td class="text-right">
                            <strong>&#8377; <?= number_format(abs($running_balance), 2) ?></strong>
                            <?php if ($running_balance >= 0): ?>
                                <span class="tag-dr">Dr</span>
                            <?php else: ?>
                                <span class="tag-cr">Cr</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <!-- Total Row -->
                <tr class="total-row">
                    <td colspan="2" class="text-right" style="letter-spacing:1.5px;">TOTAL</td>
                    <td class="text-right">&#8377; <?= number_format($total_debit, 2) ?></td>
                    <td class="text-right">&#8377; <?= number_format($total_credit, 2) ?></td>
                    <td class="text-right">
                        &#8377; <?= number_format(abs($running_balance), 2) ?>
                        <?= $running_balance >= 0 ? '(Dr)' : '(Cr)' ?>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <!-- ══════════════ FOOTER ══════════════ -->
    <div class="footer">
        <div class="footer-inner">

            <div class="footer-left">
                <div>This is a system-generated statement.</div>
                <div class="gen-label" style="margin-top:4px;">
                    Generated on: <?= date('d/m/Y h:i A') ?>
                </div>
            </div>

            <div class="footer-right">
                <div class="sign-box">

                    <?php if (!empty($user->signature_data_uri)): ?>
                        <div class="sign-img-area">
                            <img src="<?= $user->signature_data_uri ?>" alt="Signature">
                        </div>
                    <?php else: ?>
                        <div class="sign-placeholder"></div>
                    <?php endif; ?>

                    <hr class="sign-line">
                    <div class="sign-label">Authorized Signature</div>
                    <div class="sign-company font-display">
                        <?= strtoupper($user->business_name ?? '') ?>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="bottom-rule"></div>

</body>

</html>