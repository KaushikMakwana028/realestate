<!--start page wrapper -->
<div class="page-wrapper bg-light">
    <div class="page-content container-fluid">

        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row align-items-start align-md-items-center justify-content-between mb-4 gap-3">
            <h4 class="fw-bold text-dark">🏢 Head Office Overview</h4>
            <div class="d-flex gap-2 flex-wrap">
                <a href="<?= base_url('superadmin/admins'); ?>" class="btn btn-sm btn-outline-primary radius-6">
                    <i class="bx bx-user"></i> Admin Directory
                </a>
                <a href="<?= base_url('superadmin/sites'); ?>" class="btn btn-sm btn-outline-primary radius-6">
                    <i class="bx bx-map"></i> Sites Directory
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-4">

            <div class="col">
                <div class="card radius-10 shadow-sm border-0 h-100 stat-card">
                    <div class="card-body text-center">
                        <div class="stat-icon bg-primary-light mb-3">
                            <i class="bx bx-user text-primary"></i>
                        </div>
                        <p class="mb-2 text-muted fw-semibold">Total Admins</p>
                        <h3 class="fw-bold text-primary"><?= $admins_count ?? 0 ?></h3>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 shadow-sm border-0 h-100 stat-card">
                    <div class="card-body text-center">
                        <div class="stat-icon bg-success-light mb-3">
                            <i class="bx bx-map text-success"></i>
                        </div>
                        <p class="mb-2 text-muted fw-semibold">Total Sites</p>
                        <h3 class="fw-bold text-success"><?= $sites_count ?? 0 ?></h3>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 shadow-sm border-0 h-100 stat-card">
                    <div class="card-body text-center">
                        <div class="stat-icon bg-danger-light mb-3">
                            <i class="bx bx-grid-alt text-danger"></i>
                        </div>
                        <p class="mb-2 text-muted fw-semibold">Total Plots</p>
                        <h3 class="fw-bold text-danger"><?= $plots_count ?? 0 ?></h3>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 shadow-sm border-0 h-100 stat-card stat-card-warning">
                    <div class="card-body text-center">
                        <div class="stat-icon bg-warning-light mb-3">
                            <i class="bx bx-time-five text-warning"></i>
                        </div>
                        <p class="mb-2 text-muted fw-semibold">Pending Images</p>
                        <h3 class="fw-bold text-warning"><?= $image_requests_pending ?? 0 ?></h3>
                    </div>
                </div>
            </div>

        </div>

        <!-- Map Listing Status -->
        <div class="row">
            <div class="col-lg-6 col-xl-5">
                <div class="card shadow-sm border-0 radius-10">
                    <div class="card-body">
                        <h6 class="mb-4 fw-bold text-dark">
                            <i class="bx bx-map"></i> Map Listing Status
                        </h6>

                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 stat-row">
                            <span class="text-muted fw-semibold">Total Sites</span>
                            <span class="badge bg-light-primary text-primary px-3 py-2"><?= $maps_total ?? 0 ?></span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center p-3 mb-3 stat-row">
                            <span class="text-muted fw-semibold">Maps Uploaded</span>
                            <span class="badge bg-success-light text-success px-3 py-2"><?= $maps_uploaded ?? 0 ?></span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center p-3 stat-row">
                            <span class="text-muted fw-semibold">Maps Pending</span>
                            <span class="badge bg-danger-light text-danger px-3 py-2"><?= $maps_pending ?? 0 ?></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--end page wrapper -->

<style>
    /* ===== PAGE WRAPPER ===== */
    .page-wrapper {
        background: #f9fafb;
        padding-bottom: 40px;
    }

    .page-content {
        padding-top: 20px;
    }

    /* ===== CARD STYLING ===== */
    .card {
        border-radius: 10px;
        border: none;
        transition: all 0.3s ease;
    }

    .card-body {
        padding: 24px;
    }

    .stat-card {
        border: 1px solid #e5e7eb !important;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08) !important;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 24px;
    }

    .bg-primary-light {
        background-color: #dbeafe !important;
    }

    .bg-success-light {
        background-color: #d1fae5 !important;
    }

    .bg-danger-light {
        background-color: #fee2e2 !important;
    }

    .bg-warning-light {
        background-color: #fef3c7 !important;
    }

    .bg-light-primary {
        background-color: #dbeafe !important;
    }

    /* ===== STAT ROW ===== */
    .stat-row {
        border-radius: 8px;
        background-color: #f9fafb;
        border: 1px solid #f3f4f6;
    }

    /* ===== BADGE ===== */
    .badge {
        padding: 6px 14px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 6px;
    }

    .badge.text-primary {
        color: #1e40af !important;
    }

    .badge.text-success {
        color: #059669 !important;
    }

    .badge.text-danger {
        color: #dc2626 !important;
    }

    .badge.text-warning {
        color: #d97706 !important;
    }

    /* ===== BUTTON ===== */
    .btn {
        border-radius: 6px;
        font-weight: 500;
        font-size: 13px;
        padding: 6px 14px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .page-content {
            padding: 12px;
        }

        .card-body {
            padding: 16px;
        }

        .stat-card h3 {
            font-size: 24px;
        }
    }

    @media (max-width: 576px) {
        .page-content {
            padding: 8px;
        }

        .card-body {
            padding: 12px;
        }

        .stat-card h3 {
            font-size: 20px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }
    }

    /* ===== CUSTOM UTILITIES ===== */
    .radius-6 {
        border-radius: 6px;
    }

    .radius-10 {
        border-radius: 10px;
    }

    .fw-bold {
        font-weight: 700;
    }

    .fw-semibold {
        font-weight: 600;
    }
</style>