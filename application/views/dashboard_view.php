<!-- Custom Dashboard Styles -->
<style>
    /* ===== GLOBAL DASHBOARD STYLES ===== */
    .dashboard-page .page-content {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f2 100%);
        min-height: 100vh;
        padding: 24px;
    }

    /* ===== GREETING BANNER ===== */
    .greeting-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 32px 40px;
        color: #fff;
        position: relative;
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.4);
    }

    .greeting-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .greeting-banner::after {
        content: '';
        position: absolute;
        bottom: -60%;
        left: 10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .greeting-banner h2 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
        position: relative;
        z-index: 1;
    }

    .greeting-banner p {
        font-size: 15px;
        opacity: 0.85;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .greeting-banner .banner-icon {
        font-size: 80px;
        opacity: 0.15;
        position: absolute;
        right: 40px;
        top: 50%;
        transform: translateY(-50%);
    }

    /* ===== COUNTER CARDS ===== */
    .counter-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        cursor: pointer;
        background: #fff;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
    }

    .counter-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    }

    .counter-card .card-body {
        padding: 28px;
        position: relative;
        z-index: 1;
    }

    .counter-card .card-decoration {
        position: absolute;
        top: -30px;
        right: -30px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        opacity: 0.08;
        transition: all 0.4s ease;
    }

    .counter-card:hover .card-decoration {
        transform: scale(1.3);
        opacity: 0.12;
    }

    .counter-card .card-decoration-2 {
        position: absolute;
        bottom: -20px;
        left: -20px;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        opacity: 0.05;
    }

    .counter-card .counter-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        transition: all 0.3s ease;
    }

    .counter-card:hover .counter-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .counter-card .counter-label {
        font-size: 13px;
        font-weight: 500;
        color: #8492a6;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .counter-card .counter-value {
        font-size: 32px;
        font-weight: 800;
        color: #1a1a2e;
        line-height: 1;
        margin-bottom: 10px;
    }

    .counter-card .counter-change {
        font-size: 12px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .counter-change.positive {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .counter-change.negative {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
    }

    .counter-change.warning {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
    }

    /* Card color variants */
    .counter-card.card-sites .counter-icon {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
    }

    .counter-card.card-sites .card-decoration,
    .counter-card.card-sites .card-decoration-2 {
        background: #10b981;
    }

    .counter-card.card-sites .counter-value {
        color: #059669;
    }

    .counter-card.card-plots .counter-icon {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.35);
    }

    .counter-card.card-plots .card-decoration,
    .counter-card.card-plots .card-decoration-2 {
        background: #3b82f6;
    }

    .counter-card.card-plots .counter-value {
        color: #2563eb;
    }

    .counter-card.card-users .counter-icon {
        background: linear-gradient(135deg, #f43f5e, #e11d48);
        color: #fff;
        box-shadow: 0 6px 20px rgba(244, 63, 94, 0.35);
    }

    .counter-card.card-users .card-decoration,
    .counter-card.card-users .card-decoration-2 {
        background: #f43f5e;
    }

    .counter-card.card-users .counter-value {
        color: #e11d48;
    }

    .counter-card.card-inquiry .counter-icon {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #fff;
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.35);
    }

    .counter-card.card-inquiry .card-decoration,
    .counter-card.card-inquiry .card-decoration-2 {
        background: #f59e0b;
    }

    .counter-card.card-inquiry .counter-value {
        color: #d97706;
    }

    .counter-card.card-images .counter-icon {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: #fff;
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.35);
    }

    .counter-card.card-images .card-decoration,
    .counter-card.card-images .card-decoration-2 {
        background: #8b5cf6;
    }

    .counter-card.card-images .counter-value {
        color: #7c3aed;
    }

    /* ===== DATA SECTION CARDS ===== */
    .data-card {
        border: none;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .data-card:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .data-card .card-body {
        padding: 28px;
    }

    .data-card .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .data-card .section-title .title-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    .data-card .main-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .data-card .main-stat-value {
        font-size: 30px;
        font-weight: 800;
        color: #1a1a2e;
        line-height: 1.1;
    }

    .data-card .main-stat-label {
        font-size: 13px;
        color: #8492a6;
        font-weight: 500;
    }

    /* Stat mini cards */
    .stat-mini-card {
        border: 1px solid #f0f2f5;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        background: #fafbfc;
    }

    .stat-mini-card:hover {
        border-color: transparent;
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .stat-mini-card.mini-success:hover {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-color: #a7f3d0;
    }

    .stat-mini-card.mini-primary:hover {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border-color: #93c5fd;
    }

    .stat-mini-card.mini-warning:hover {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border-color: #fcd34d;
    }

    .stat-mini-card.mini-danger:hover {
        background: linear-gradient(135deg, #fef2f2, #fecaca);
        border-color: #fca5a5;
    }

    .stat-mini-card .mini-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin: 0 auto 12px;
    }

    .stat-mini-card .mini-value {
        font-size: 22px;
        font-weight: 800;
        color: #1a1a2e;
        margin-bottom: 4px;
    }

    .stat-mini-card .mini-label {
        font-size: 12px;
        font-weight: 600;
        color: #8492a6;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ===== PROGRESS INDICATOR ===== */
    .progress-thin {
        height: 4px;
        border-radius: 10px;
        background: #f0f2f5;
        overflow: hidden;
        margin-top: 16px;
    }

    .progress-thin .progress-bar {
        border-radius: 10px;
        transition: width 1.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* ===== REVIEW BUTTON ===== */
    .btn-review {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        color: #fff;
        border: none;
        padding: 8px 20px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-review:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        color: #fff;
    }

    /* ===== PULSE ANIMATION ===== */
    .pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        position: relative;
    }

    .pulse-dot::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: inherit;
        animation: pulse-ring 2s infinite;
    }

    @keyframes pulse-ring {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        100% {
            transform: scale(2.5);
            opacity: 0;
        }
    }

    /* ===== FADE-IN ANIMATION ===== */
    .fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up:nth-child(1) {
        animation-delay: 0.05s;
    }

    .fade-in-up:nth-child(2) {
        animation-delay: 0.15s;
    }

    .fade-in-up:nth-child(3) {
        animation-delay: 0.25s;
    }

    .fade-in-up:nth-child(4) {
        animation-delay: 0.35s;
    }

    /* ===== SPARKLE LINE ===== */
    .sparkle-line {
        width: 40px;
        height: 4px;
        border-radius: 4px;
        margin-top: 6px;
    }

    /* ===== DIVIDER ===== */
    .section-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 32px 0 24px;
    }

    .section-divider .divider-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, #e2e8f0, transparent);
    }

    .section-divider .divider-text {
        font-size: 13px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* ===== LIVE INDICATOR ===== */
    .live-indicator {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        color: #10b981;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .live-indicator .live-dot {
        width: 6px;
        height: 6px;
        background: #10b981;
        border-radius: 50%;
        animation: blink 1.5s infinite;
    }

    @keyframes blink {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.3;
        }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .greeting-banner {
            padding: 24px;
        }

        .greeting-banner h2 {
            font-size: 22px;
        }

        .greeting-banner .banner-icon {
            display: none;
        }

        .counter-card .counter-value {
            font-size: 26px;
        }

        .data-card .main-stat-value {
            font-size: 24px;
        }
    }
</style>

<!-- ===== START PAGE WRAPPER ===== -->
<div class="page-wrapper dashboard-page">
    <div class="page-content">

        <!-- ===========================
             GREETING BANNER
        ============================ -->
        <div class="greeting-banner fade-in-up">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2>
👋 Welcome back, 
<?= !empty($this->admin['user_name']) 
        ? htmlspecialchars($this->admin['user_name']) 
        : 'Admin'; ?>!
</h2>

<p>Here's what's happening with your dashboard today.</p>

                </div>
                <div class="d-none d-md-block">
                    <span class="live-indicator">
                        <span class="live-dot"></span> Live Overview
                    </span>
                </div>
            </div>
            <i class="bx bx-grid-alt banner-icon"></i>
        </div>

        <!-- ===========================
             DASHBOARD COUNTER CARDS
        ============================ -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-2">

            <!-- Total Sites -->
            <div class="col fade-in-up">
                <div class="card counter-card card-sites h-100">
                    <div class="card-decoration"></div>
                    <div class="card-decoration-2"></div>
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div>
                                <p class="counter-label">Total Sites</p>
                                <h4 class="counter-value"><?= $sites_count ?></h4>
                                <span class="counter-change positive">
                                    <i class="bx bx-trending-up"></i> +<?= $sites_last_week ?> this week
                                </span>
                            </div>
                            <div class="counter-icon">
                                <i class="bx bx-building-house"></i>
                            </div>
                        </div>
                        <div class="progress-thin">
                            <div class="progress-bar" role="progressbar"
                                style="width: 72%; background: linear-gradient(90deg, #10b981, #34d399);"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Plots -->
            <div class="col fade-in-up">
                <div class="card counter-card card-plots h-100">
                    <div class="card-decoration"></div>
                    <div class="card-decoration-2"></div>
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div>
                                <p class="counter-label">Total Plots</p>
                                <h4 class="counter-value"><?= $plots_count ?></h4>
                                <span class="counter-change positive">
                                    <i class="bx bx-trending-up"></i> +<?= $plots_last_week ?> this week
                                </span>
                            </div>
                            <div class="counter-icon">
                                <i class="bx bx-map-alt"></i>
                            </div>
                        </div>
                        <div class="progress-thin">
                            <div class="progress-bar" role="progressbar"
                                style="width: 58%; background: linear-gradient(90deg, #3b82f6, #60a5fa);"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Users / Admins -->
            <div class="col fade-in-up">
                <div class="card counter-card card-users h-100">
                    <div class="card-decoration"></div>
                    <div class="card-decoration-2"></div>
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div>
                                <?php if (!empty($is_superadmin)): ?>
                                    <p class="counter-label">Total Admins</p>
                                    <h4 class="counter-value"><?= $admins_count ?? 0 ?></h4>
                                <?php else: ?>
                                    <p class="counter-label">Total Users</p>
                                    <h4 class="counter-value"><?= $users_count ?></h4>
                                <?php endif; ?>
                                <span class="counter-change negative">
                                    <i class="bx bx-trending-up"></i>
                                    +<?php if (!empty($is_superadmin)): ?>
                                        <?= $admins_last_week ?? 0 ?>
                                    <?php else: ?>
                                        <?= $users_last_week ?>
                                    <?php endif; ?> this week
                                </span>
                            </div>
                            <div class="counter-icon">
                                <i class="bx bx-user-circle"></i>
                            </div>
                        </div>
                        <div class="progress-thin">
                            <div class="progress-bar" role="progressbar"
                                style="width: 45%; background: linear-gradient(90deg, #f43f5e, #fb7185);"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Inquiry (Admin) -->
            <?php if (empty($is_superadmin)): ?>
                <div class="col fade-in-up">
                    <div class="card counter-card card-inquiry h-100">
                        <div class="card-decoration"></div>
                        <div class="card-decoration-2"></div>
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div>
                                    <p class="counter-label">Total Inquiry</p>
                                    <h4 class="counter-value"><?= $Inquiry_count ?></h4>
                                    <span class="counter-change warning">
                                        <i class="bx bx-trending-down"></i> <?= $inquiry_last_week ?> this week
                                    </span>
                                </div>
                                <div class="counter-icon">
                                    <i class="bx bx-message-rounded-dots"></i>
                                </div>
                            </div>
                            <div class="progress-thin">
                                <div class="progress-bar" role="progressbar"
                                    style="width: 63%; background: linear-gradient(90deg, #f59e0b, #fbbf24);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Image Requests (Super Admin) -->
            <?php if (!empty($is_superadmin)): ?>
                <div class="col fade-in-up">
                    <div class="card counter-card card-images h-100">
                        <div class="card-decoration"></div>
                        <div class="card-decoration-2"></div>
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div>
                                    <p class="counter-label">Image Requests</p>
                                    <h4 class="counter-value"><?= $image_requests_pending ?? 0 ?></h4>
                                    <span class="counter-change warning">
                                        <span class="pulse-dot" style="background: #f59e0b;"></span>
                                        Pending approvals
                                    </span>
                                </div>
                                <div class="counter-icon">
                                    <i class="bx bx-image-add"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="<?= base_url('superadmin/sites'); ?>" class="btn-review">
                                    <i class="bx bx-show"></i> Review Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
        <!-- END DASHBOARD CARDS -->


        <!-- ===========================
             SECTION DIVIDER
        ============================ -->
        <div class="section-divider">
            <div class="divider-line"></div>
            <span class="divider-text">📊 Detailed Analytics</span>
            <div class="divider-line" style="background: linear-gradient(90deg, transparent, #e2e8f0);"></div>
        </div>


        <!-- ===========================
             DATA SECTION
        ============================ -->
        <div class="row g-4">

            <?php if (empty($is_superadmin)): ?>

                <!-- ATTENDANCE DATA -->
                <div class="col-md-6 fade-in-up">
                    <div class="card data-card h-100">
                        <div class="card-body">

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="section-title">
                                    <span class="title-dot"
                                        style="background: linear-gradient(135deg, #10b981, #059669);"></span>
                                    Attendance Data
                                </h6>
                                <span class="live-indicator">
                                    <span class="live-dot"></span> Live
                                </span>
                            </div>

                            <div class="d-flex align-items-center gap-3 mb-4 p-3 rounded-4"
                                style="background: linear-gradient(135deg, #f0fdf4, #dcfce7);">
                                <div class="main-stat-icon"
                                    style="background: linear-gradient(135deg, #10b981, #059669); color: #fff; box-shadow: 0 6px 20px rgba(16,185,129,0.3);">
                                    <i class="bx bx-calendar-check"></i>
                                </div>
                                <div>
                                    <h3 class="main-stat-value"><?= $attendance_total ?></h3>
                                    <p class="main-stat-label mb-0">Total Attendance Records</p>
                                </div>
                            </div>

                            <div class="row row-cols-1 row-cols-lg-2 g-3">
                                <div class="col">
                                    <div class="stat-mini-card mini-warning">
                                        <div class="mini-icon" style="background: rgba(245,158,11,0.12); color: #f59e0b;">
                                            <i class="bx bx-time-five"></i>
                                        </div>
                                        <div class="mini-value"><?= $attendance_pending ?></div>
                                        <div class="mini-label">Pending</div>
                                        <div class="sparkle-line"
                                            style="background: linear-gradient(90deg, #f59e0b, #fbbf24); margin: 8px auto 0;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="stat-mini-card mini-success">
                                        <div class="mini-icon" style="background: rgba(16,185,129,0.12); color: #10b981;">
                                            <i class="bx bx-check-shield"></i>
                                        </div>
                                        <div class="mini-value"><?= $attendance_approved ?></div>
                                        <div class="mini-label">Approved</div>
                                        <div class="sparkle-line"
                                            style="background: linear-gradient(90deg, #10b981, #34d399); margin: 8px auto 0;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- EXPENSES DATA -->
                <div class="col-md-6 fade-in-up">
                    <div class="card data-card h-100">
                        <div class="card-body">

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="section-title">
                                    <span class="title-dot"
                                        style="background: linear-gradient(135deg, #3b82f6, #2563eb);"></span>
                                    Expenses Data
                                </h6>
                                <span class="badge rounded-pill"
                                    style="background: rgba(59,130,246,0.1); color: #3b82f6; font-size: 11px; padding: 6px 14px;">
                                    This Month
                                </span>
                            </div>

                            <div class="d-flex align-items-center gap-3 mb-4 p-3 rounded-4"
                                style="background: linear-gradient(135deg, #eff6ff, #dbeafe);">
                                <div class="main-stat-icon"
                                    style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: #fff; box-shadow: 0 6px 20px rgba(59,130,246,0.3);">
                                    <i class="bx bx-rupee"></i>
                                </div>
                                <div>
                                    <h3 class="main-stat-value">₹<?= number_format($total_expense) ?></h3>
                                    <p class="main-stat-label mb-0">Total Expense This Month</p>
                                </div>
                            </div>

                            <div class="row row-cols-1 row-cols-lg-2 g-3">
                                <div class="col">
                                    <div class="stat-mini-card mini-success">
                                        <div class="mini-icon" style="background: rgba(16,185,129,0.12); color: #10b981;">
                                            <i class="bx bx-check-double"></i>
                                        </div>
                                        <div class="mini-value">₹<?= number_format($approved_expense) ?></div>
                                        <div class="mini-label">Approved</div>
                                        <div class="sparkle-line"
                                            style="background: linear-gradient(90deg, #10b981, #34d399); margin: 8px auto 0;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="stat-mini-card mini-warning">
                                        <div class="mini-icon" style="background: rgba(245,158,11,0.12); color: #f59e0b;">
                                            <i class="bx bx-loader-circle"></i>
                                        </div>
                                        <div class="mini-value">₹<?= number_format($pending_expense) ?></div>
                                        <div class="mini-label">Pending</div>
                                        <div class="sparkle-line"
                                            style="background: linear-gradient(90deg, #f59e0b, #fbbf24); margin: 8px auto 0;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            <?php endif; ?>

            <!-- MAP DATA -->
            <div class="col-md-6 fade-in-up">
                <div class="card data-card h-100">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="section-title">
                                <span class="title-dot"
                                    style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);"></span>
                                Map Data
                            </h6>
                            <span class="badge rounded-pill"
                                style="background: rgba(139,92,246,0.1); color: #8b5cf6; font-size: 11px; padding: 6px 14px;">
                                <i class="bx bx-map-pin"></i> Geographic
                            </span>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-4 p-3 rounded-4"
                            style="background: linear-gradient(135deg, #f5f3ff, #ede9fe);">
                            <div class="main-stat-icon"
                                style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: #fff; box-shadow: 0 6px 20px rgba(139,92,246,0.3);">
                                <i class="bx bx-map"></i>
                            </div>
                            <div>
                                <h3 class="main-stat-value"><?= $maps_total ?? 0 ?></h3>
                                <p class="main-stat-label mb-0">Total Maps Available</p>
                            </div>
                        </div>

                        <div class="row row-cols-1 row-cols-lg-2 g-3">
                            <div class="col">
                                <div class="stat-mini-card mini-warning">
                                    <div class="mini-icon" style="background: rgba(245,158,11,0.12); color: #f59e0b;">
                                        <i class="bx bx-hourglass"></i>
                                    </div>
                                    <div class="mini-value"><?= $maps_pending ?? 0 ?></div>
                                    <div class="mini-label">Pending</div>
                                    <div class="sparkle-line"
                                        style="background: linear-gradient(90deg, #f59e0b, #fbbf24); margin: 8px auto 0;">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="stat-mini-card mini-success">
                                    <div class="mini-icon" style="background: rgba(16,185,129,0.12); color: #10b981;">
                                        <i class="bx bx-check-circle"></i>
                                    </div>
                                    <div class="mini-value"><?= $maps_uploaded ?? 0 ?></div>
                                    <div class="mini-label">Approved</div>
                                    <div class="sparkle-line"
                                        style="background: linear-gradient(90deg, #10b981, #34d399); margin: 8px auto 0;">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- END DATA SECTION -->

    </div><!-- end page-content -->
</div>
<!-- end page wrapper -->


<!-- ===== COUNTER ANIMATION SCRIPT ===== -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Animate counters
        document.querySelectorAll('.counter-value, .main-stat-value, .mini-value').forEach(function (el) {
            const raw = el.textContent.trim();
            const prefix = raw.match(/^[^\d]*/)[0];   // e.g. ₹
            const suffix = raw.match(/[^\d]*$/)[0];
            const numeric = raw.replace(/[^\d]/g, '');

            if (!numeric) return;

            const target = parseInt(numeric, 10);
            const duration = 1200;
            const startTime = performance.now();

            el.textContent = prefix + '0' + suffix;

            function step(now) {
                const elapsed = now - startTime;
                const progress = Math.min(elapsed / duration, 1);
                // easeOutExpo
                const eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                const current = Math.floor(eased * target);
                el.textContent = prefix + current.toLocaleString('en-IN') + suffix;
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        });

        // Animate progress bars
        document.querySelectorAll('.progress-bar').forEach(function (bar) {
            const w = bar.style.width;
            bar.style.width = '0%';
            setTimeout(function () { bar.style.width = w; }, 400);
        });
    });
</script>