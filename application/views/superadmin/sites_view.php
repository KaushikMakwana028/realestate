<div class="page-wrapper bg-light">
    <div class="page-content container-fluid">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Sites</li>
                </ol>
            </nav>
        </div>

        <div class="card border-0 shadow-sm radius-10">
            <div class="card-body">

                <div class="d-flex flex-column flex-md-row align-items-start align-md-items-center justify-content-between mb-4 gap-2">
                    <div>
                        <h5 class="card-title mb-1 fw-bold">📍 All Sites (Super Admin)</h5>
                        <small class="text-muted">View sites, expenses, and images</small>
                    </div>
                </div>

                <!-- Search -->
                <div class="mb-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-8 col-lg-9">
                            <div class="position-relative">
                                <input type="text" id="siteSearch" class="form-control ps-5 radius-6" placeholder="Search Site by name or location" value="">
                                <span class="position-absolute top-50 translate-middle-y ms-3">
                                    <i class="bx bx-search"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <button type="button" id="siteSearchBtn" class="btn btn-primary radius-6 w-100">Search</button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive mb-4">
                    <table class="table align-middle table-hover table-sm">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Site Name</th>
                                <th width="15%">Admin</th>
                                <th width="15%">Location</th>
                                <th width="10%" class="text-center">Plots</th>
                                <th width="12%" class="text-center">Images</th>
                                <th width="12%" class="text-center">Map</th>
                                <th width="10%" class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody id="superAdminSitesTable">
                            <?php if (!empty($super_sites)): ?>
                                <?php $i = $site_start_index; ?>

                                <?php foreach ($super_sites as $site): ?>

                                    <?php
                                    $img_status = $site->site_images_status ?? '';
                                    $has_images = !empty($site->site_images) &&
                                        $site->site_images !== 'NULL' &&
                                        $site->site_images !== 'null';

                                    $has_approved_images = ($img_status === 'approve') && $has_images;
                                    $has_map = !empty($site->site_map) &&
                                        $site->site_map !== 'NULL' &&
                                        $site->site_map !== 'null';

                                    $reason_text = !$has_map ? 'Map not uploaded' : '';
                                    ?>

                                    <tr>
                                        <td class="fw-semibold"><?= $i++; ?></td>
                                        <td class="fw-semibold"><?= htmlspecialchars($site->name ?? '-'); ?></td>
                                        <td><small><?= htmlspecialchars($site->admin_name ?? '-'); ?></small></td>
                                        <td><small><?= htmlspecialchars($site->location ?? '-'); ?></small></td>
                                        <td class="text-center"><span class="badge bg-info"><?= $site->total_plots ?? 0; ?></span></td>

                                        <td class="text-center">
                                            <?php if ($img_status === 'pending'): ?>
                                                <span class="badge bg-warning-light text-warning">Pending</span>

                                            <?php elseif ($img_status === 'reject'): ?>
                                                <span class="badge bg-danger-light text-danger">Rejected</span>

                                            <?php elseif ($has_approved_images): ?>
                                                <span class="badge bg-success-light text-success">Approved</span>
                                                <a href="<?= base_url('superadmin/download_site_image/' . $site->id); ?>" class="btn btn-sm btn-outline-success ms-1 mt-1" title="Download Image">
                                                    <i class="bx bx-download"></i>
                                                </a>

                                            <?php else: ?>
                                                <span class="badge bg-secondary-light text-secondary">No Images</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <?php if ($has_map): ?>
                                                <span class="badge bg-success-light text-success">✓ Yes</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary-light text-secondary mapReason"
                                                    data-reason="<?= htmlspecialchars($reason_text); ?>" style="cursor:pointer;">
                                                    ✗ No
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button class="btn btn-primary viewSiteDetail" data-id="<?= $site->id; ?>" title="View Details">
                                                    <i class="bx bx-show"></i>
                                                </button>
                                                <button type="button" class="btn btn-success uploadSiteMap"
                                                    data-id="<?= $site->id; ?>"
                                                    data-has-images="<?= $has_approved_images ? '1' : '0'; ?>"
                                                    data-has-map="<?= $has_map ? '1' : '0'; ?>"
                                                    data-bs-toggle="modal" data-bs-target="#siteMapUploadModal" title="Upload Map">
                                                    <i class="bx bx-upload"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">
                                        <?php if (!empty($site_search)): ?>
                                            No sites found for "<?= htmlspecialchars($site_search) ?>"
                                        <?php else: ?>
                                            No sites found. Please add some sites first.
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav>
                    <ul class="pagination justify-content-center" id="sitePagination">
                    </ul>
                </nav>

            </div>
        </div>

        <!-- =================== MODALS (UNCHANGED BUT SAFE) =================== -->

        <!-- Map Upload Modal -->
        <div class="modal fade" id="siteMapUploadModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <form id="siteMapUploadForm" method="post" action="<?= base_url('superadmin/upload_site_map'); ?>"
                        enctype="multipart/form-data">

                        <div class="modal-header bg-light border-bottom">
                            <h5 class="modal-title fw-bold">📤 Upload Site Map</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body p-4">
                            <input type="hidden" id="siteMapSiteId" name="site_id" required>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Select JSON File</label>
                                <input type="file" class="form-control form-control-lg" id="siteMapFile" name="site_map"
                                    accept=".json,.geojson" required>
                                <div class="form-text mt-2">
                                    <small>Upload a valid JSON or GeoJSON map file</small>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-top bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary" id="uploadMapBtn">
                                <i class="bx bx-upload me-2"></i>Upload Map
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Site Detail Modal -->
        <div class="modal fade" id="siteDetailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-light border-bottom">
                        <h5 class="modal-title fw-bold">🏢 Site Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div id="siteDetailContent" class="text-center py-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-3 text-muted">Loading site details...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>


<style>
    /* ===== PAGE LAYOUT ===== */
    .page-wrapper {
        padding-bottom: 40px;
    }

    .page-content {
        padding-top: 20px;
    }

    /* ===== CARD STYLING ===== */
    .card {
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
        background-color: #f9fafb;
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

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0b5ed7;
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

    /* ===== MODAL STYLING ===== */
    .modal-content {
        border-radius: 10px;
    }

    .modal-header {
        padding: 16px 24px;
    }

    .modal-body {
        padding: 24px;
    }

    .modal-footer {
        padding: 16px 24px;
    }

    .modal-title {
        font-size: 16px;
        color: #1f2937;
    }

    /* ===== SITE DETAIL VIEW ===== */
    .site-detail-header {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        background: linear-gradient(135deg, #f0f4ff 0%, #f9fbff 100%);
        border-radius: 10px;
        margin-bottom: 20px;
        border: 1px solid #e0e7ff;
    }

    .site-detail-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        font-size: 18px;
        color: #1f2937;
    }

    .site-detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
    }

    .site-detail-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        background: #f3f4f6;
        color: #374151;
        font-weight: 600;
    }

    .site-detail-card {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 18px;
        background: white;
        margin-bottom: 20px;
    }

    .site-detail-card h6 {
        font-weight: 700;
        margin-bottom: 16px;
        color: #1f2937;
        font-size: 15px;
    }

    .site-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .site-detail-label {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 6px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .site-detail-value {
        font-size: 14px;
        color: #111827;
        font-weight: 600;
        word-break: break-word;
    }

    .site-detail-images {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 12px;
    }

    .site-detail-images img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .site-detail-images img:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .site-detail-table {
        margin-bottom: 0;
        font-size: 13px;
    }

    .site-detail-table th {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        color: #6b7280;
        border-bottom: 2px solid #e5e7eb;
        padding: 10px;
        font-weight: 600;
    }

    .site-detail-table td {
        font-size: 13px;
        color: #374151;
        padding: 10px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .site-detail-grid {
            grid-template-columns: 1fr;
        }

        .site-detail-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .site-detail-meta {
            width: 100%;
        }

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

        .site-detail-images {
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        }

        .site-detail-images img {
            height: 80px;
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

    /* ===== SCROLLBAR STYLING ===== */
    .table-responsive::-webkit-scrollbar {
        height: 6px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<!-- SweetAlert Integration -->
<script>
    // Check if SweetAlert is available
    function showSweetAlert(icon, title, text, timer = 2000) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: icon,
                title: title,
                text: text,
                timer: timer,
                timerProgressBar: true,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false
            });
        } else {
            // Fallback to regular alert
            alert(title + ': ' + text);
        }
    }

    // Show confirmation dialog
    function showConfirmDialog(title, text, confirmButtonText = 'Yes') {
        return new Promise((resolve) => {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    resolve(result.isConfirmed);
                });
            } else {
                // Fallback
                const confirmed = confirm(title + ': ' + text);
                resolve(confirmed);
            }
        });
    }

    // Form handler for map upload with SweetAlert
    document.getElementById('siteMapUploadForm')?.addEventListener('submit', async function (e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const submitBtn = document.getElementById('uploadMapBtn');
        const originalText = submitBtn.innerHTML;

        // Validate file
        const fileInput = document.getElementById('siteMapFile');
        if (!fileInput.files || fileInput.files.length === 0) {
            showSweetAlert('error', 'Error', 'Please select a JSON file first');
            return;
        }

        // Check file type
        const fileName = fileInput.files[0].name;
        const fileExt = fileName.split('.').pop().toLowerCase();
        if (!['json', 'geojson'].includes(fileExt)) {
            showSweetAlert('error', 'Invalid File', 'Please upload a valid JSON or GeoJSON file');
            return;
        }

        // Show loading SweetAlert
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Uploading...',
                html: 'Please wait while we upload your map file',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        } else {
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Uploading...';
            submitBtn.disabled = true;
        }

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            // Close loading SweetAlert
            if (typeof Swal !== 'undefined') {
                Swal.close();
            }

            if (data.status) {
                // Success with SweetAlert
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message || 'Map uploaded successfully',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#0d6efd'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Close modal and reload page
                            const modal = bootstrap.Modal.getInstance(document.getElementById('siteMapUploadModal'));
                            if (modal) modal.hide();
                            window.location.reload();
                        }
                    });
                } else {
                    // Fallback
                    alert('Map uploaded successfully!');
                    const modal = bootstrap.Modal.getInstance(document.getElementById('siteMapUploadModal'));
                    if (modal) modal.hide();
                    window.location.reload();
                }
            } else {
                // Error with SweetAlert
                showSweetAlert('error', 'Upload Failed', data.message || 'Failed to upload map. Please try again.');

                // Reset button if not using SweetAlert
                if (typeof Swal === 'undefined') {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            }
        } catch (error) {
            console.error('Error:', error);

            // Close loading if using SweetAlert
            if (typeof Swal !== 'undefined') {
                Swal.close();
            }

            // Show error
            showSweetAlert('error', 'Error', 'An error occurred while uploading. Please try again.');

            // Reset button if not using SweetAlert
            if (typeof Swal === 'undefined') {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        }
    });

    // Reset form when modal closes
    document.getElementById('siteMapUploadModal')?.addEventListener('hidden.bs.modal', function () {
        const form = document.getElementById('siteMapUploadForm');
        if (form) {
            form.reset();
            const submitBtn = document.getElementById('uploadMapBtn');
            submitBtn.innerHTML = 'Upload';
            submitBtn.disabled = false;
        }
    });

    // Prevent modal opening when site images are not approved/uploaded
    document.getElementById('siteMapUploadModal')?.addEventListener('show.bs.modal', function (e) {
        const triggerBtn = e.relatedTarget;
        if (!triggerBtn || !triggerBtn.classList.contains('uploadSiteMap')) return;

        const hasImages = triggerBtn.getAttribute('data-has-images') === '1';
        const siteId = triggerBtn.getAttribute('data-id');

        if (!hasImages) {
            e.preventDefault();
            showSweetAlert('warning', 'Images Not Uploaded', 'Please upload and approve site images before uploading map JSON.');
            return;
        }

        const siteIdInput = document.getElementById('siteMapSiteId');
        if (siteIdInput) {
            siteIdInput.value = siteId || '';
        }
    });

    // Handle view site detail button (if needed)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.viewSiteDetail');
        if (!btn) return;
        const siteId = btn.getAttribute('data-id');
        const content = document.getElementById('siteDetailContent');
        content.innerHTML = 'Loading...';

        const modalEl = document.getElementById('siteDetailModal');
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }

        fetch('<?= base_url('superadmin/get_site_detail/'); ?>' + siteId)
            .then((r) => r.json())
            .then((data) => {
                if (!data.status) {
                    content.innerHTML = '<div class="text-danger">' + (data.message || 'Failed to load') + '</div>';
                    return;
                }

                const site = data.site || {};
                const images = data.images || [];
                const expenses = data.expenses || [];
                const plots = data.plots || [];

                const imageHtml = images.length
                    ? images.map((img) => `<img src="<?= base_url(); ?>${img}" alt="Site Image">`).join('')
                    : '<div class="text-muted">No images</div>';

                const expenseRows = expenses.length
                    ? expenses.map((e) => `
                        <tr>
                            <td>${e.description || '-'}</td>
                            <td>${e.date || '-'}</td>
                            <td>${e.amount || '-'}</td>
                            <td>${e.status || '-'}</td>
                        </tr>
                    `).join('')
                    : '<tr><td colspan="4" class="text-muted">No expenses</td></tr>';

                const plotRows = plots.length
                    ? plots.map((p) => `
                        <tr>
                            <td>${p.plot_number || '-'}</td>
                            <td>${p.size || '-'}</td>
                            <td>${p.dimension || '-'}</td>
                            <td>${p.facing || '-'}</td>
                            <td>${p.price || '-'}</td>
                            <td>${p.status || '-'}</td>
                        </tr>
                    `).join('')
                    : '<tr><td colspan="6" class="text-muted">No plots</td></tr>';

                const hasMap = !!(
                    site.site_map &&
                    site.site_map !== "NULL" &&
                    site.site_map !== "null" &&
                    site.site_map !== ""
                );
                const mapBadge = hasMap
                    ? `<span class="badge bg-success">Map Uploaded</span>`
                    : `<span class="badge bg-secondary">No Map</span>`;

                content.innerHTML = `
                    <div class="site-detail-header">
                        <div class="site-detail-title">
                            <i class="bx bx-building-house"></i>
                            ${site.name || 'Site'}
                        </div>
                        <div class="site-detail-meta">
                            <span class="site-detail-chip"><i class="bx bx-user"></i> ${site.admin_name || '-'}</span>
                            <span class="site-detail-chip"><i class="bx bx-map-pin"></i> ${site.location || '-'}</span>
                            ${mapBadge}
                        </div>
                    </div>

                    <div class="site-detail-card">
                        <h6>Basic Info</h6>
                        <div class="site-detail-grid">
                            <div>
                                <div class="site-detail-label">Site Name</div>
                                <div class="site-detail-value">${site.name || '-'}</div>
                            </div>
                            <div>
                                <div class="site-detail-label">Admin</div>
                                <div class="site-detail-value">${site.admin_name || '-'}</div>
                            </div>
                            <div>
                                <div class="site-detail-label">Location</div>
                                <div class="site-detail-value">${site.location || '-'}</div>
                            </div>
                            <div>
                                <div class="site-detail-label">Area</div>
                                <div class="site-detail-value">${site.area || '-'}</div>
                            </div>
                            <div>
                                <div class="site-detail-label">Total Plots</div>
                                <div class="site-detail-value">${site.total_plots || '-'}</div>
                            </div>
                            <div>
                                <div class="site-detail-label">Map</div>
                                <div class="site-detail-value">${hasMap ? 'Uploaded' : 'Not Uploaded'}</div>
                            </div>
                        </div>
                    </div>

                    <div class="site-detail-card">
                        <h6>Images</h6>
                        <div class="site-detail-images">${imageHtml}</div>
                    </div>

                    <div class="site-detail-card">
                        <h6>Plots</h6>
                        <div class="table-responsive">
                            <table class="table table-sm site-detail-table">
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
                                <tbody>${plotRows}</tbody>
                            </table>
                        </div>
                    </div>

                    <div class="site-detail-card">
                        <h6>Expenses</h6>
                        <div class="table-responsive">
                            <table class="table table-sm site-detail-table">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>${expenseRows}</tbody>
                            </table>
                        </div>
                    </div>
                `;
            })
            .catch(() => {
                content.innerHTML = '<div class="text-danger">Error loading details</div>';
            });
    });

    // Handle Enter key in search
    document.querySelector('input[name="search"]')?.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.form.submit();
        }
    });

    // Initialize tooltips if any
    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        if (typeof Swal === 'undefined') {
            console.warn('SweetAlert2 is not loaded. Using fallback alerts.');
        }
    });

    // Show reason when Listed Map is No
    document.addEventListener('click', function (e) {
        const badge = e.target.closest('.mapReason');
        if (!badge) return;
        const reason = badge.getAttribute('data-reason') || 'Not available';
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Reason',
                text: reason,
                icon: 'info',
                confirmButtonText: 'OK'
            });
        } else {
            alert('Reason: ' + reason);
        }
    });


</script>
