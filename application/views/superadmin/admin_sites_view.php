<div class="page-wrapper bg-light">
    <div class="page-content container-fluid">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"><i
                                class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('superadmin/admins'); ?>">Admins</a></li>
                    <li class="breadcrumb-item active">Admin Sites</li>
                </ol>
            </nav>
        </div>

        <div class="card border-0 shadow-sm radius-10">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                    <div>
                        <h5 class="mb-1 fw-bold">Sites - <?= htmlspecialchars($admin_info->name ?? 'Admin'); ?></h5>
                        <small class="text-muted"><?= htmlspecialchars($admin_info->business_name ?? '-'); ?></small>
                    </div>
                    <a href="<?= base_url('superadmin/admins'); ?>" class="btn btn-sm btn-outline-secondary">Back</a>
                </div>

                <form method="GET" action="<?= base_url('superadmin/admin_sites/' . (int) ($admin_info->id ?? 0)); ?>"
                    class="d-lg-flex align-items-center mb-3 gap-3">
                    <div class="position-relative flex-grow-1">
                        <input type="text" name="search" class="form-control ps-5 radius-30" placeholder="Search site"
                            value="<?= htmlspecialchars($admin_sites_search ?? ''); ?>">
                        <span class="position-absolute top-50 translate-middle-y ms-3"><i
                                class="bx bx-search"></i></span>
                    </div>
                    <button type="submit" class="btn btn-primary radius-30 px-4">Search</button>
                </form>

                <div class="table-responsive">
                    <table class="table align-middle mb-0 modern-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Site</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Total Plots</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Map</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php if (!empty($admin_sites)): ?>
                                <?php $i = $admin_sites_start_index; ?>
                                <?php foreach ($admin_sites as $site): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td class="text-center">
                                            <?= htmlspecialchars($site->name ?? '-'); ?>
                                        </td>

                                        <td class="text-center">
                                            <?= htmlspecialchars($site->location ?? '-'); ?>
                                        </td>

                                        <td class="text-center">
                                            <?= (int) ($site->total_plots ?? 0); ?>
                                        </td>

                                        <td class="text-center">
                                            <?php if (!empty($site->primary_image)): ?>

                                                <div class="d-flex flex-column align-items-center">

                                                    <!-- Image -->
                                                    <a href="<?= base_url($site->primary_image); ?>" target="_blank">
                                                        <img src="<?= base_url($site->primary_image); ?>" alt="Site Image"
                                                            class="img-thumbnail border-0 shadow-sm"
                                                            style="width:75px;height:75px;object-fit:cover;">
                                                    </a>

                                                    <!-- Small Download Link -->
                                                    <a href="<?= base_url('superadmin/download_site_image/' . (int) $site->id); ?>"
                                                        class="text-primary small mt-1 text-decoration-none">
                                                        <i class="bx bx-download"></i> Download
                                                    </a>

                                                </div>

                                            <?php else: ?>
                                                <span class="badge bg-light text-secondary">No Image</span>
                                            <?php endif; ?>
                                        </td>



                                        <td class="text-center">

                                            <?php if (!empty($site->site_map)): ?>

                                                <a href="<?= base_url($site->site_map); ?>" target="_blank"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="bx bx-map"></i> View Map
                                                </a>

                                            <?php else: ?>

                                                <?php if (!empty($site->primary_image)): ?>

                                                    <!-- Image exists → Allow Upload -->
                                                    <button type="button" class="btn btn-sm btn-outline-primary uploadMapBtn"
                                                        data-site-id="<?= $site->id; ?>">
                                                        <i class="bx bx-upload"></i> Upload Map
                                                    </button>

                                                <?php else: ?>

                                                    <!-- Image NOT exists → Disable -->
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" disabled
                                                        title="Upload image first">
                                                        <i class="bx bx-block"></i> Upload Map
                                                    </button>

                                                    <div class="text-danger small mt-1">
                                                        Image required
                                                    </div>

                                                <?php endif; ?>

                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No sites found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php $searchParam = !empty($admin_sites_search) ? '&search=' . urlencode($admin_sites_search) : ''; ?>
                <nav class="mt-3">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($admin_sites_current_page <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link"
                                href="<?= base_url('superadmin/admin_sites/' . (int) ($admin_info->id ?? 0) . '?page=' . ($admin_sites_current_page - 1) . $searchParam); ?>">
                                Previous
                            </a>
                        </li>
                        <?php for ($p = 1; $p <= $admin_sites_total_pages; $p++): ?>
                            <li class="page-item <?= ($p == $admin_sites_current_page) ? 'active' : ''; ?>">
                                <a class="page-link"
                                    href="<?= base_url('superadmin/admin_sites/' . (int) ($admin_info->id ?? 0) . '?page=' . $p . $searchParam); ?>">
                                    <?= $p; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        <li
                            class="page-item <?= ($admin_sites_current_page >= $admin_sites_total_pages) ? 'disabled' : ''; ?>">
                            <a class="page-link"
                                href="<?= base_url('superadmin/admin_sites/' . (int) ($admin_info->id ?? 0) . '?page=' . ($admin_sites_current_page + 1) . $searchParam); ?>">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Upload Map Modal -->
<div class="modal fade" id="uploadMapModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="uploadMapForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Site Map</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="site_id" id="modalSiteId">

                    <div class="mb-3">
                        <label class="form-label">Select Map File (JSON / GeoJSON)</label>
                        <input type="file" name="site_map" class="form-control" accept=".json,.geojson" required>
                    </div>

                    <div id="uploadMapMessage"></div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-upload"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
    .modern-table thead th {
        background: #ffffff;
        font-weight: 600;
        font-size: 14px;
        color: #6c757d;
        border-bottom: 1px solid #e9ecef;
        padding: 14px 18px;
    }

    .modern-table td {
        padding: 18px;
        font-size: 14px;
        border-bottom: 1px solid #f1f3f5;
    }

    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    .modern-table tbody tr:hover {
        background-color: #f8f9fa;
        transition: 0.2s ease;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        // Open modal
        document.querySelectorAll(".uploadMapBtn").forEach(button => {
            button.addEventListener("click", function () {
                let siteId = this.getAttribute("data-site-id");
                document.getElementById("modalSiteId").value = siteId;

                let modal = new bootstrap.Modal(document.getElementById("uploadMapModal"));
                modal.show();
            });
        });

        // Upload form submit
        document.getElementById("uploadMapForm").addEventListener("submit", function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("<?= base_url('superadmin/upload_site_map'); ?>", {
                method: "POST",
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    let msgDiv = document.getElementById("uploadMapMessage");

                    if (data.status) {
                        msgDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        msgDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                    }
                })
                .catch(() => {
                    document.getElementById("uploadMapMessage").innerHTML =
                        `<div class="alert alert-danger">Upload failed</div>`;
                });
        });

    });
</script>