<div class="page-wrapper sa-dash-page">
    <div class="page-content container-fluid">

        <section class="sa-dash-hero">
            <div>
                <p class="sa-dash-kicker">Head Office</p>
                <h3>Super Admin Dashboard</h3>
                <p class="sa-dash-sub">Live view across admins, site operations, plots, and pending media actions.</p>
            </div>
            <div class="sa-dash-actions">
                <a href="<?= base_url('superadmin/admins'); ?>" class="btn sa-btn-outline">
                    <i class="bx bx-user-circle"></i> Admin Directory
                </a>
                <a href="<?= base_url('superadmin/sites'); ?>" class="btn sa-btn-solid">
                    <i class="bx bx-map-alt"></i> Site Directory
                </a>
            </div>
        </section>

        <section class="row g-3 mb-4">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="sa-metric sa-metric-admin">
                    <div class="sa-metric-icon"><i class="bx bx-user"></i></div>
                    <div class="sa-metric-label">Total Admins</div>
                    <div class="sa-metric-value"><?= (int) ($admins_count ?? 0) ?></div>
                    <div class="sa-metric-foot">Last 7 days: <?= (int) ($admins_last_week ?? 0) ?></div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="sa-metric sa-metric-site">
                    <div class="sa-metric-icon"><i class="bx bx-buildings"></i></div>
                    <div class="sa-metric-label">Total Sites</div>
                    <div class="sa-metric-value"><?= (int) ($sites_count ?? 0) ?></div>
                    <div class="sa-metric-foot">Last 7 days: <?= (int) ($sites_last_week ?? 0) ?></div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="sa-metric sa-metric-plot">
                    <div class="sa-metric-icon"><i class="bx bx-grid-alt"></i></div>
                    <div class="sa-metric-label">Total Plots</div>
                    <div class="sa-metric-value"><?= (int) ($plots_count ?? 0) ?></div>
                    <div class="sa-metric-foot">Last 7 days: <?= (int) ($plots_last_week ?? 0) ?></div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <div class="sa-metric sa-metric-pending">
                    <div class="sa-metric-icon"><i class="bx bx-image-alt"></i></div>
                    <div class="sa-metric-label">Pending Images</div>
                    <div class="sa-metric-value"><?= (int) ($image_requests_pending ?? 0) ?></div>
                    <div class="sa-metric-foot">Needs review from HQ</div>
                </div>
            </div>
        </section>

        <section class="row g-3">
            <div class="col-12 col-xl-7">
                <div class="card sa-status-card">
                    <div class="card-body">
                        <div class="sa-card-title">
                            <h5><i class="bx bx-map-pin me-1"></i>Map Listing Status</h5>
                            <span class="sa-pill"><?= (int) ($maps_uploaded ?? 0) ?> / <?= (int) ($maps_total ?? 0) ?> Uploaded</span>
                        </div>

                        <?php
                        $mapsTotal = max(0, (int) ($maps_total ?? 0));
                        $mapsUploaded = max(0, (int) ($maps_uploaded ?? 0));
                        $mapsPending = max(0, (int) ($maps_pending ?? 0));
                        $uploadPercent = ($mapsTotal > 0) ? round(($mapsUploaded / $mapsTotal) * 100) : 0;
                        ?>

                        <div class="sa-progress-wrap">
                            <div class="sa-progress-labels">
                                <span>Upload Progress</span>
                                <strong><?= $uploadPercent ?>%</strong>
                            </div>
                            <div class="progress sa-progress">
                                <div class="progress-bar" role="progressbar" style="width: <?= $uploadPercent ?>%" aria-valuenow="<?= $uploadPercent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <div class="sa-stat-line">
                                    <span>Total Sites</span>
                                    <strong><?= $mapsTotal ?></strong>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="sa-stat-line success">
                                    <span>Maps Uploaded</span>
                                    <strong><?= $mapsUploaded ?></strong>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="sa-stat-line danger">
                                    <span>Maps Pending</span>
                                    <strong><?= $mapsPending ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-5">
                <div class="card sa-quick-card">
                    <div class="card-body">
                        <h5 class="mb-3"><i class="bx bx-compass me-1"></i>Quick Navigation</h5>
                        <a href="<?= base_url('superadmin/admins'); ?>" class="sa-quick-link">
                            <span><i class="bx bx-user"></i> Manage Admin Accounts</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </a>
                        <a href="<?= base_url('superadmin/sites'); ?>" class="sa-quick-link">
                            <span><i class="bx bx-map"></i> Review Site Directory</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </a>
                        <a href="<?= base_url('superadmin/profile'); ?>" class="sa-quick-link">
                            <span><i class="bx bx-shield-quarter"></i> Update Super Admin Profile</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
    .sa-dash-page {
        background: linear-gradient(180deg, #f3f6f8 0%, #f9fbfc 100%);
        min-height: calc(100vh - 80px);
        padding-bottom: 28px;
    }

    .sa-dash-hero {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 22px;
        border-radius: 16px;
        margin-bottom: 16px;
        background: linear-gradient(105deg, #111827 0%, #1f2937 52%, #0f766e 100%);
        color: #fff;
        box-shadow: 0 12px 26px rgba(17, 24, 39, 0.22);
    }

    .sa-dash-kicker {
        margin: 0;
        font-size: 11px;
        font-weight: 700;
        opacity: 0.9;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .sa-dash-hero h3 {
        margin: 4px 0 6px;
        font-weight: 800;
        font-size: 28px;
        letter-spacing: 0.2px;
        color: #f8fafc;
        text-shadow: 0 2px 10px rgba(2, 6, 23, 0.4);
    }

    .sa-dash-sub {
        margin: 0;
        opacity: 0.95;
        color: #e2e8f0;
        font-size: 13px;
        max-width: 560px;
    }

    .sa-dash-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .sa-btn-outline,
    .sa-btn-solid {
        border-radius: 12px;
        padding: 8px 14px;
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .sa-btn-outline {
        border: 1px solid rgba(153, 246, 228, 0.65);
        color: #ecfeff;
        background: rgba(15, 23, 42, 0.32);
        backdrop-filter: blur(2px);
    }

    .sa-btn-outline:hover {
        background: rgba(15, 23, 42, 0.52);
        color: #fff;
        border-color: rgba(45, 212, 191, 0.9);
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.28);
    }

    .sa-btn-solid {
        background: #ecfdf5;
        color: #0f766e;
        border: 1px solid #a7f3d0;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .sa-btn-solid:hover {
        background: #d1fae5;
        border-color: #6ee7b7;
        color: #065f46;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(6, 95, 70, 0.22);
    }

    .sa-metric {
        border-radius: 15px;
        border: 1px solid #dbe5ea;
        background: #fff;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.07);
        padding: 18px;
        min-height: 164px;
        position: relative;
        overflow: hidden;
    }

    .sa-metric::after {
        content: "";
        position: absolute;
        right: -18px;
        top: -20px;
        width: 92px;
        height: 92px;
        border-radius: 50%;
        opacity: 0.16;
    }

    .sa-metric-admin::after {
        background: #0f766e;
    }

    .sa-metric-site::after {
        background: #10b981;
    }

    .sa-metric-plot::after {
        background: #ef4444;
    }

    .sa-metric-pending::after {
        background: #f59e0b;
    }

    .sa-metric-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 14px;
        color: #fff;
    }

    .sa-metric-admin .sa-metric-icon {
        background: linear-gradient(135deg, #14b8a6, #0f766e);
    }

    .sa-metric-site .sa-metric-icon {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .sa-metric-plot .sa-metric-icon {
        background: linear-gradient(135deg, #f43f5e, #e11d48);
    }

    .sa-metric-pending .sa-metric-icon {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .sa-metric-label {
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .sa-metric-value {
        font-size: 35px;
        font-weight: 800;
        line-height: 1.1;
        margin: 8px 0 10px;
        color: #0f172a;
    }

    .sa-metric-foot {
        font-size: 12px;
        font-weight: 600;
        color: #475569;
    }

    .sa-status-card,
    .sa-quick-card {
        border: 1px solid #dbe5ea;
        border-radius: 15px;
        box-shadow: 0 10px 22px rgba(15, 23, 42, 0.07);
    }

    .sa-card-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
    }

    .sa-card-title h5 {
        margin: 0;
        font-weight: 800;
        color: #0f172a;
    }

    .sa-pill {
        font-size: 11px;
        font-weight: 700;
        background: #e6fffa;
        color: #0f766e;
        border: 1px solid #99f6e4;
        border-radius: 999px;
        padding: 6px 11px;
    }

    .sa-progress-wrap {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px;
        margin-bottom: 14px;
    }

    .sa-progress-labels {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #475569;
        margin-bottom: 8px;
    }

    .sa-progress {
        height: 10px;
        border-radius: 999px;
        background: #e2e8f0;
    }

    .sa-progress .progress-bar {
        background: linear-gradient(90deg, #14b8a6, #0f766e);
        border-radius: 999px;
    }

    .sa-stat-line {
        border: 1px solid #dbe5ea;
        border-radius: 10px;
        background: #f8fafb;
        padding: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        font-weight: 700;
        color: #334155;
    }

    .sa-stat-line.success {
        border-color: #bbf7d0;
        background: #f0fdf4;
    }

    .sa-stat-line.danger {
        border-color: #fecaca;
        background: #fff1f2;
    }

    .sa-quick-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #dbe5ea;
        background: #f8fafb;
        border-radius: 10px;
        padding: 12px 13px;
        color: #0f172a;
        font-weight: 700;
        font-size: 13px;
        text-decoration: none;
        margin-bottom: 10px;
    }

    .sa-quick-link span {
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .sa-quick-link:hover {
        background: #edfdfa;
        color: #0f766e;
        border-color: #99f6e4;
    }

    @media (max-width: 992px) {
        .sa-dash-hero {
            flex-direction: column;
            align-items: flex-start;
        }

        .sa-dash-hero h3 {
            font-size: 24px;
        }
    }

    @media (max-width: 576px) {
        .sa-dash-hero {
            padding: 16px;
        }

        .sa-dash-hero h3 {
            font-size: 20px;
        }

        .sa-metric-value {
            font-size: 28px;
        }
    }
</style>
