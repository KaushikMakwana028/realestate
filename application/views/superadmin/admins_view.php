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
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h5 class="card-title mb-0 fw-bold">All Admins</h5>
                        <small class="text-muted">Super Admin Panel</small>
                    </div>
                    <span class="badge bg-primary">Super Admin View</span>
                </div>

                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <div class="position-relative flex-grow-1">
                        <input type="text" id="adminSearch" class="form-control ps-5 radius-30"
                            placeholder="Search by name, email, or business"
                            value="<?= htmlspecialchars($admin_search ?? '') ?>">
                        <span class="position-absolute top-50 translate-middle-y ms-3">
                            <i class="bx bx-search"></i>
                        </span>
                    </div>
                    <button id="adminSearchBtn" class="btn btn-primary radius-30 px-4">Search</button>
                </div>

                <div class="table-responsive mb-4">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Admin</th>
                                <th>Business</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Sites</th>
                                <th>Plots</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($super_admins)): ?>
                                <?php $i = $admin_start_index; ?>
                                <?php foreach ($super_admins as $admin): ?>
                                    <?php $is_active = ((int) ($admin->isActive ?? 0) === 1); ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td class="fw-semibold"><?= htmlspecialchars($admin->name ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($admin->business_name ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($admin->mobile ?? '-'); ?></td>
                                        <td>
                                            <?php if ($is_active): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-info"
                                                href="<?= base_url('superadmin/admin_sites/' . $admin->id); ?>"
                                                title="View all sites for this admin">
                                                <i class="bx bx-map"></i> <?= (int) ($admin->sites_count ?? 0); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-warning"
                                                href="<?= base_url('superadmin/admin_plots/' . $admin->id); ?>"
                                                title="View all plots for this admin">
                                                <i class="bx bx-grid-alt"></i> <?= (int) ($admin->plots_count ?? 0); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-sm <?= $is_active ? 'btn-outline-danger' : 'btn-outline-success'; ?> toggleAdminStatus"
                                                data-id="<?= (int) $admin->id; ?>"
                                                data-next-status="<?= $is_active ? 0 : 1; ?>">
                                                <?= $is_active ? 'Deactivate' : 'Activate'; ?>
                                            </button>

                                            <a class="btn btn-sm btn-primary ms-1 <?= $is_active ? '' : 'disabled'; ?>"
                                                href="<?= base_url('superadmin/login_as_admin/' . $admin->id); ?>"
                                                target="_blank">
                                                Login As
                                            </a>
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
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($admins_current_page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link"
                                href="<?= base_url('superadmin/admins?page=' . ($admins_current_page - 1) . $adminSearchParam) ?>">
                                Previous
                            </a>
                        </li>

                        <?php for ($p = 1; $p <= $admins_total_pages; $p++): ?>
                            <li class="page-item <?= ($p == $admins_current_page) ? 'active' : '' ?>">
                                <a class="page-link"
                                    href="<?= base_url('superadmin/admins?page=' . $p . $adminSearchParam) ?>">
                                    <?= $p ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= ($admins_current_page >= $admins_total_pages) ? 'disabled' : '' ?>">
                            <a class="page-link"
                                href="<?= base_url('superadmin/admins?page=' . ($admins_current_page + 1) . $adminSearchParam) ?>">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>
    .page-wrapper {
        background: #f4f6f9;
    }

    .card {
        border-radius: 12px;
    }

    .table th {
        font-weight: 600;
    }

    .table-hover tbody tr:hover {
        background: rgba(13, 110, 253, .05);
    }

    .pagination .page-item.active .page-link {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .pagination .page-link {
        border-radius: 8px;
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
