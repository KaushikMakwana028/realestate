<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Admins</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title mb-0">All Admins</h5>
                    <div class="text-muted">Super Admin View</div>
                </div>
                <div class="d-lg-flex align-items-center mb-3 gap-3">
                    <div class="position-relative">
                        <input type="text" id="adminSearch" class="form-control ps-5 radius-30"
                            placeholder="Search Admin">
                        <span class="position-absolute top-50 product-show translate-middle-y"><i
                                class="bx bx-search"></i></span>
                    </div>
                    <button type="button" id="adminSearchBtn" class="btn btn-primary radius-30 px-4">Search</button>
                </div>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Index</th>
                                <th>Admin</th>
                                <th>Business</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Sites</th>
                                <th>Plots</th>
                                <th>Users</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="superAdminTable">
                            <?php if (!empty($super_admins)): ?>
                                <?php
                                $i = $admin_start_index;
                                foreach ($super_admins as $admin): ?>

                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $admin->name ?? '-'; ?></td>
                                        <td><?= $admin->business_name ?? '-'; ?></td>
                                        <td><?= $admin->mobile ?? '-'; ?></td>
                                        <td><?= $admin->email ?? '-'; ?></td>
                                        <td><?= $admin->sites_count ?? 0; ?></td>
                                        <td><?= $admin->plots_count ?? 0; ?></td>
                                        <td><?= $admin->users_count ?? 0; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary viewAdmin"
                                                data-id="<?= $admin->id; ?>">View</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center text-muted">No admins found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php
                // ---- Build search param ONLY when search is not empty ----
                $adminSearchParam = !empty($admin_search)
                    ? '&search=' . urlencode($admin_search)
                    : '';
                ?>

                <nav>
                    <ul class="pagination justify-content-center mt-3" id="adminPagination">

                        <!-- Previous -->
                        <li class="page-item <?= ($admins_current_page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link"
                                href="<?= base_url('superadmin/admins?page=' . ($admins_current_page - 1) . $adminSearchParam) ?>">
                                Previous
                            </a>
                        </li>

                        <!-- Page numbers -->
                        <?php for ($p = 1; $p <= $admins_total_pages; $p++): ?>
                            <li class="page-item <?= ($p == $admins_current_page) ? 'active' : '' ?>">
                                <a class="page-link"
                                    href="<?= base_url('superadmin/admins?page=' . $p . $adminSearchParam) ?>">
                                    <?= $p ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <!-- Next -->
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

        <div class="modal fade" id="adminDetailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Admin Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="adminDetailHeader" class="mb-3"></div>
                        <div id="adminDetailSites"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .pagination .page-link {
        color: #0d6efd;
        border-radius: 8px;
        padding: 6px 12px;
    }

    /* Space between table and pagination */
    .table-responsive {
        margin-bottom: 25px;
    }

    #adminPagination {
        margin-top: 10px;
    }
</style>

<script>
    document.getElementById("adminSearchBtn").addEventListener("click", function () {
        let q = document.getElementById("adminSearch").value.trim();
        window.location.href = "<?= base_url('superadmin/admins') ?>?search=" + encodeURIComponent(q);
    });

    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".viewAdmin");
        if (!btn) return;
        const adminId = btn.getAttribute("data-id");

        const headerEl = document.getElementById("adminDetailHeader");
        const sitesEl = document.getElementById("adminDetailSites");
        if (!headerEl || !sitesEl) return;
        headerEl.innerHTML = "Loading...";
        sitesEl.innerHTML = "";

        if (typeof bootstrap !== "undefined" && bootstrap.Modal) {
            const modalEl = document.getElementById("adminDetailModal");
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }

        fetch("<?= base_url('superadmin/get_admin_detail/'); ?>" + adminId)
            .then((r) => r.json())
            .then((data) => {
                if (!data.status) {
                    headerEl.innerHTML = `<div class="text-danger">${data.message || "Failed to load"}</div>`;
                    return;
                }

                const admin = data.admin || {};
                const sites = data.sites || [];

                headerEl.innerHTML = `
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <div class="badge bg-primary">${admin.name || "-"}</div>
                        <div class="text-muted">${admin.business_name || "-"}</div>
                        <div class="text-muted">${admin.email || "-"}</div>
                        <div class="text-muted">${admin.mobile || "-"}</div>
                    </div>
                `;

                if (!sites.length) {
                    sitesEl.innerHTML = `<div class="text-muted">No sites found for this admin.</div>`;
                    return;
                }

                const siteCards = sites.map((s) => {
                    const images = (s.images || []).map((img) =>
                        `<img src="<?= base_url(); ?>${img}" style="width:70px;height:70px;object-fit:cover;border-radius:6px;margin:4px;">`
                    ).join("") || "<div class='text-muted'>No images</div>";

                    const plots = (s.plots || []).map((p) => `
                        <tr>
                            <td>${p.plot_number || "-"}</td>
                            <td>${p.size || "-"}</td>
                            <td>${p.dimension || "-"}</td>
                            <td>${p.facing || "-"}</td>
                            <td>${p.price || "-"}</td>
                            <td>${p.status || "-"}</td>
                        </tr>
                    `).join("") || `<tr><td colspan="6" class="text-muted">No plots</td></tr>`;

                    return `
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="mb-2">${s.name || "-"}</h6>
                                <div class="mb-2 text-muted">${s.location || "-"}</div>
                                <div class="mb-2"><strong>Total Plots:</strong> ${s.total_plots || 0}</div>
                                <div class="mb-3">${images}</div>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Plot No</th>
                                                <th>Size</th>
                                                <th>Dimension</th>
                                                <th>Facing</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>${plots}</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    `;
                }).join("");

                sitesEl.innerHTML = siteCards;
            })
            .catch(() => {
                headerEl.innerHTML = `<div class="text-danger">Error loading details</div>`;
            });
    });
</script>
