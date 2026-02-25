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
                <input type="hidden" id="admin_id" value="<?= $admin_info->id; ?>">
                <div class="d-flex flex-column flex-md-row align-items-start align-md-items-center justify-content-between mb-4 gap-2">
                    <div>
                        <h5 class="card-title mb-1 fw-bold">📍 Sites - <?= htmlspecialchars($admin_info->name ?? 'Admin'); ?></h5>
                        <small class="text-muted"><?= htmlspecialchars($admin_info->business_name ?? '-'); ?></small>
                    </div>
                    <a href="<?= base_url('superadmin/admins'); ?>" class="btn btn-sm btn-outline-secondary">← Back to Admins</a>
                </div>

                <div class="mb-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-8 col-lg-9">
                            <div class="position-relative">
                                <input type="text" id="adminSiteSearch" class="form-control ps-5 radius-6"
                                    placeholder="Search site by name or location" value="">
                                <span class="position-absolute top-50 translate-middle-y ms-3"><i
                                        class="bx bx-search"></i></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <button type="button" id="adminSiteSearchBtn" class="btn btn-primary radius-6 w-100">Search</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive mb-4">
                    <table class="table align-middle table-hover table-sm">
                        <thead class="table-light">
                            <tr>
                                <th width="8%">#</th>
                                <th width="30%">Site</th>
                                <th width="25%">Location</th>
                                <th width="12%" class="text-center">Plots</th>
                                <th width="12%" class="text-center">Image</th>
                                <th width="12%" class="text-center">Map</th>
                            </tr>
                        </thead>
                        <tbody id="adminSitesTable">
                        </tbody>


                    </table>
                </div>

                <nav class="mt-3">
                    <ul class="pagination justify-content-center" id="adminSitesPagination"></ul>
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

    .badge.bg-warning-light {
        background-color: #fef3c7 !important;
        color: #d97706 !important;
    }

    .badge.bg-success-light {
        background-color: #d1fae5 !important;
        color: #059669 !important;
    }

    .badge.bg-danger-light {
        background-color: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .badge.bg-secondary-light {
        background-color: #e5e7eb !important;
        color: #6b7280 !important;
    }

    .badge.bg-info {
        background-color: #dbeafe !important;
        color: #0284c7 !important;
    }

    /* ===== BUTTON STYLING ===== */
    .btn {
        border-radius: 6px;
        font-weight: 500;
        font-size: 13px;
        padding: 6px 12px;
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

    /* ===== MODAL STYLING ===== */
    .modal-content {
        border-radius: 10px;
    }

    .modal-header {
        padding: 16px 24px;
        background-color: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }

    .modal-body {
        padding: 24px;
    }

    .modal-footer {
        padding: 16px 24px;
        background-color: #f9fafb;
        border-top: 1px solid #e5e7eb;
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
    const currentAdminId = <?= (int) ($admin_info->id ?? 0); ?>;
</script>


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