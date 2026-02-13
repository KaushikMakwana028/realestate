<div class="page-wrapper bg-light">
    <div class="page-content container-fluid">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('dashboard'); ?>">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Admins</li>
                </ol>
            </nav>
        </div>

        <div class="card border-0 shadow-sm radius-10">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row align-items-start align-md-items-center justify-content-between mb-4 gap-2">
                    <div>
                        <h5 class="card-title mb-1 fw-bold">👥 All Admins</h5>
                        <small class="text-muted">Super Admin Panel</small>
                    </div>
                    <span class="badge bg-primary px-3 py-2">Super Admin View</span>
                </div>

                <div class="mb-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-8 col-lg-9">
                            <div class="position-relative">
                                <input type="text" id="adminSearch" class="form-control ps-5 radius-6"
                                    placeholder="Search by name, email, or business"
                                    value="<?= htmlspecialchars($admin_search ?? '') ?>">
                                <span class="position-absolute top-50 translate-middle-y ms-3">
                                    <i class="bx bx-search"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <button id="adminSearchBtn" class="btn btn-primary radius-6 w-100">Search</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive mb-4">
                    <table class="table align-middle table-hover table-sm">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%">Admin</th>
                                <th width="20%">Business</th>
                                <th width="15%">Mobile</th>
                                <th width="10%" class="text-center">Status</th>
                                <th width="12%" class="text-center">Sites</th>
                                <th width="12%" class="text-center">Plots</th>
                                <th width="12%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="superAdminTable">
                            <?php if (!empty($super_admins)): ?>
                                <?php $i = $admin_start_index; ?>
                                <?php foreach ($super_admins as $admin): ?>
                                    <?php $is_active = ((int) ($admin->isActive ?? 0) === 1); ?>
                                    <tr>
                                        <td class="fw-semibold"><?= $i++; ?></td>
                                        <td class="fw-semibold"><?= htmlspecialchars($admin->name ?? '-'); ?></td>
                                        <td><small><?= htmlspecialchars($admin->business_name ?? '-'); ?></small></td>
                                        <td><small><?= htmlspecialchars($admin->mobile ?? '-'); ?></small></td>
                                        <td class="text-center">
                                            <?php if ($is_active): ?>
                                                <span class="badge bg-success-light text-success">✓ Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger-light text-danger">✗ Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-outline-info"
                                                href="<?= base_url('superadmin/admin_sites/' . $admin->id); ?>"
                                                title="View all sites for this admin">
                                                <i class="bx bx-map"></i> <span class="badge bg-info"><?= (int) ($admin->sites_count ?? 0); ?></span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-outline-warning"
                                                href="<?= base_url('superadmin/admin_plots/' . $admin->id); ?>"
                                                title="View all plots for this admin">
                                                <i class="bx bx-grid-alt"></i> <span class="badge bg-warning"><?= (int) ($admin->plots_count ?? 0); ?></span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button"
                                                    class="btn <?= $is_active ? 'btn-outline-danger' : 'btn-outline-success'; ?> toggleAdminStatus"
                                                    data-id="<?= (int) $admin->id; ?>"
                                                    data-next-status="<?= $is_active ? 0 : 1; ?>"
                                                    title="<?= $is_active ? 'Deactivate Admin' : 'Activate Admin'; ?>">
                                                    <i class="bx <?= $is_active ? 'bx-x' : 'bx-check'; ?>"></i>
                                                </button>

                                                <a class="btn btn-outline-primary <?= $is_active ? '' : 'disabled'; ?>"
                                                    href="<?= base_url('superadmin/login_as_admin/' . $admin->id); ?>"
                                                    target="_blank"
                                                    title="Login as this admin">
                                                    <i class="bx bx-log-in"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">No admins found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php $adminSearchParam = !empty($admin_search) ? '&search=' . urlencode($admin_search) : ''; ?>

                <nav>
                    <ul class="pagination justify-content-center" id="adminPagination">
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>
    /* ===== PAGE LAYOUT ===== */
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
        margin-bottom: 30px;
        overflow: hidden;
    }

    .card-body {
        padding: 24px;
    }

    .card-title {
        font-weight: 700;
        font-size: 18px;
        color: #1f2937;
    }

    /* ===== TABLE STYLING ===== */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background-color: #f9fafb;
        border-bottom: 2px solid #e5e7eb;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #374151;
        padding: 12px 8px;
    }

    .table tbody td {
        padding: 12px 8px;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
    }

    .table tbody tr:hover {
        background-color: #f9fafb !important;
    }

    .table-sm tbody td {
        padding: 10px 8px;
        font-size: 13px;
    }

    /* ===== BADGE STYLING ===== */
    .badge {
        padding: 5px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 6px;
    }

    .badge.bg-success-light {
        background-color: #d1fae5 !important;
        color: #059669 !important;
    }

    .badge.bg-danger-light {
        background-color: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .badge.bg-info {
        background-color: #dbeafe !important;
        color: #0284c7 !important;
    }

    .badge.bg-warning {
        background-color: #fef3c7 !important;
        color: #d97706 !important;
    }

    /* ===== BUTTON STYLING ===== */
    .btn {
        border-radius: 6px;
        font-weight: 500;
        font-size: 13px;
        padding: 6px 12px;
    }

    .btn-group-sm .btn {
        padding: 5px 8px;
        margin: 0 2px;
    }

    .btn-group-sm .btn i {
        font-size: 16px;
    }

    /* ===== SEARCH BAR ===== */
    .form-control {
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        padding: 8px 14px;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .form-control.ps-5 {
        padding-left: 38px;
    }

    /* ===== PAGINATION ===== */
    .pagination {
        gap: 4px;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }

    .pagination .page-link {
        color: #0d6efd;
        border-radius: 6px;
        padding: 6px 12px;
        margin: 0 2px;
        text-decoration: none;
        border: 1px solid transparent;
    }

    .pagination .page-link:hover {
        background-color: #f3f4f6;
        border-color: #0d6efd;
    }

    .pagination .page-item.disabled .page-link {
        color: #d1d5db;
        pointer-events: none;
        cursor: not-allowed;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .card-body {
            padding: 16px;
        }

        .btn {
            padding: 5px 10px;
            font-size: 12px;
        }

        .table thead th,
        .table tbody td {
            padding: 8px 6px;
            font-size: 12px;
        }
    }

    @media (max-width: 576px) {
        .page-content {
            padding: 10px;
        }

        .card-body {
            padding: 12px;
        }

        .table thead th,
        .table tbody td {
            padding: 6px 4px;
            font-size: 11px;
        }

        .badge {
            padding: 4px 8px;
            font-size: 11px;
        }

        .btn {
            padding: 4px 8px;
            font-size: 11px;
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

<script>
    document.getElementById("adminSearchBtn").addEventListener("click", function () {
        const q = document.getElementById("adminSearch").value.trim();
        window.location.href = "<?= base_url('superadmin/admins') ?>?search=" + encodeURIComponent(q);
    });

    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".toggleAdminStatus");
        if (!btn) return;

        const adminId = btn.getAttribute("data-id");
        const nextStatus = btn.getAttribute("data-next-status");
        const actionText = nextStatus === "1" ? "activate" : "deactivate";

        if (!confirm("Are you sure you want to " + actionText + " this admin?")) {
            return;
        }

        fetch("<?= base_url('superadmin/change_admin_status/'); ?>" + adminId, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "isActive=" + encodeURIComponent(nextStatus)
        })
            .then(r => r.json())
            .then(data => {
                if (!data.status) {
                    alert(data.message || "Failed to update admin status");
                    return;
                }
                window.location.reload();
            })
            .catch(() => {
                alert("Error while updating admin status");
            });
    });
</script>
