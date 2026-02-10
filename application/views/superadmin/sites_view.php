<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Sites</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title mb-0">All Sites (Super Admin)</h5>
                    <div class="text-muted">View sites, expenses, and images</div>
                </div>
                
                <!-- Search Form - IMPORTANT: Use GET method -->
                <form method="GET" action="<?= base_url('superadmin/sites'); ?>" class="d-lg-flex align-items-center mb-3 gap-3">
                    <div class="position-relative">
                        <input type="text" name="search" class="form-control ps-5 radius-30"
                            placeholder="Search Site" 
                            value="<?= !empty($site_search) ? htmlspecialchars($site_search) : '' ?>">
                        <span class="position-absolute top-50 product-show translate-middle-y">
                            <i class="bx bx-search"></i>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary radius-30 px-4">Search</button>
                    <?php if (!empty($site_search)): ?>
                        <a href="<?= base_url('superadmin/sites'); ?>" class="btn btn-secondary radius-30 px-4">Clear</a>
                    <?php endif; ?>
                </form>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Index</th>
                                <th>Site</th>
                                <th>Admin</th>
                                <th>Location</th>
                                <th>Total Plots</th>
                                <th>Images</th>
                                <th>Listed Map</th>
                                <th>Action</th>
                                <th>Upload Map</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($super_sites)): ?>
                                <?php
                                $i = $site_start_index;
                                foreach ($super_sites as $site): ?>
                                    <?php
                                    $img_status = $site->site_images_status ?? '';
                                    $has_images = !empty($site->site_images) && $site->site_images !== 'NULL' && $site->site_images !== 'null';
                                    $has_approved_images = ($img_status === 'approve') && $has_images;
                                    $has_map = !empty($site->site_map);
                                    $listed_map = $has_map;

                                    $reasons = [];
                                    if (!$has_map) {
                                        $reasons[] = 'Map not uploaded';
                                    }
                                    $reason_text = implode(' | ', $reasons);
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= htmlspecialchars($site->name ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($site->admin_name ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($site->location ?? '-'); ?></td>
                                        <td><?= $site->total_plots ?? 0; ?></td>
                                        <td>
                                            <?php if ($img_status === 'pending'): ?>
                                                <span class="badge bg-warning">Pending</span>
                                                <button type="button" class="btn btn-sm btn-outline-primary ms-2 reviewImages"
                                                    data-id="<?= $site->id; ?>"
                                                    data-bs-toggle="modal" data-bs-target="#siteImagesReviewModal">
                                                    Review
                                                </button>
                                            <?php elseif ($img_status === 'reject'): ?>
                                                <span class="badge bg-danger">Reject</span>
                                            <?php elseif ($has_approved_images): ?>
                                                <span class="badge bg-success">Approve</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">No Images</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($listed_map): ?>
                                                <span class="badge bg-success">Yes</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary mapReason"
                                                    data-reason="<?= htmlspecialchars($reason_text); ?>"
                                                    style="cursor:pointer;">No</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary viewSiteDetail"
                                                data-id="<?= $site->id; ?>">View</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success uploadSiteMap"
                                                data-id="<?= $site->id; ?>"
                                                onclick="document.getElementById('siteMapSiteId').value='<?= $site->id; ?>';"
                                                data-bs-toggle="modal" data-bs-target="#siteMapUploadModal">
                                                Upload Map
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center text-muted">
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

                <?php if ($sites_total_pages > 1): ?>
                    <div class="d-flex justify-content-center mt-3">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <!-- Previous Button -->
                                <li class="page-item <?= ($sites_current_page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link"
                                        href="<?= base_url('superadmin/sites?page=' . max(1, $sites_current_page - 1) . (!empty($site_search) ? '&search=' . urlencode($site_search) : '')) ?>">
                                        &laquo; Prev
                                    </a>
                                </li>

                                <!-- Page Numbers -->
                                <?php for ($i = 1; $i <= $sites_total_pages; $i++): ?>
                                    <?php if ($i == 1 || $i == $sites_total_pages || ($i >= $sites_current_page - 2 && $i <= $sites_current_page + 2)): ?>
                                        <li class="page-item <?= ($i == $sites_current_page) ? 'active' : '' ?>">
                                            <a class="page-link"
                                                href="<?= base_url('superadmin/sites?page=' . $i . (!empty($site_search) ? '&search=' . urlencode($site_search) : '')) ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php elseif ($i == $sites_current_page - 3 || $i == $sites_current_page + 3): ?>
                                        <li class="page-item disabled">
                                            <span class="page-link">...</span>
                                        </li>
                                    <?php endif; ?>
                                <?php endfor; ?>

                                <!-- Next Button -->
                                <li class="page-item <?= ($sites_current_page >= $sites_total_pages) ? 'disabled' : '' ?>">
                                    <a class="page-link"
                                        href="<?= base_url('superadmin/sites?page=' . min($sites_total_pages, $sites_current_page + 1) . (!empty($site_search) ? '&search=' . urlencode($site_search) : '')) ?>">
                                        Next &raquo;
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Map Upload Modal -->
        <div class="modal fade" id="siteMapUploadModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="siteMapUploadForm" method="post" action="<?= base_url('superadmin/upload_site_map'); ?>" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Upload Site Map (JSON)</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="siteMapSiteId" name="site_id" value="" required>
                            <div class="mb-3">
                                <label class="form-label">JSON File</label>
                                <input type="file" class="form-control" id="siteMapFile" name="site_map"
                                    accept=".json,.geojson" required>
                                <div class="form-text">Upload a valid JSON map file for this site.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="uploadMapBtn">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Site Detail Modal -->
        <div class="modal fade" id="siteDetailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Site Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="siteDetailContent">Loading...</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Site Images Review Modal -->
        <div class="modal fade" id="siteImagesReviewModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Review Site Images</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="reviewSiteId" value="">
                        <div id="pendingImagesContainer" class="d-flex flex-wrap gap-2"></div>
                        <div class="mt-3">
                            <label class="form-label">Reject Reason (required if reject)</label>
                            <input type="text" id="rejectReason" class="form-control" placeholder="Enter reject reason">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="rejectImagesBtn">Reject</button>
                        <button type="button" class="btn btn-success" id="approveImagesBtn">Approve</button>
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
        border-radius: 6px;
        padding: 6px 12px;
        margin: 0 2px;
        text-decoration: none;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
    }

    .table-responsive {
        margin-bottom: 20px;
    }

    .badge {
        padding: 5px 10px;
        font-size: 0.85em;
        font-weight: 500;
    }
    
    .card-title {
        font-weight: 600;
    }
    
    /* SweetAlert Customization */
    .swal2-popup {
        border-radius: 10px;
    }
    
    .swal2-success {
        border-color: #28a745;
    }
    
    .swal2-error {
        border-color: #dc3545;
    }

    /* Site Detail Modal styling */
    .site-detail-header {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        background: linear-gradient(135deg, #f4f7ff 0%, #f9fbff 100%);
        border-radius: 12px;
        margin-bottom: 16px;
    }

    .site-detail-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        font-size: 18px;
    }

    .site-detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .site-detail-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        background: #eef2ff;
        color: #3730a3;
        font-weight: 600;
    }

    .site-detail-card {
        border: 1px solid #eef2f7;
        border-radius: 12px;
        padding: 14px;
        background: #fff;
        margin-bottom: 16px;
    }

    .site-detail-card h6 {
        font-weight: 700;
        margin-bottom: 12px;
        color: #1f2937;
    }

    .site-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px 16px;
    }

    .site-detail-label {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .site-detail-value {
        font-size: 14px;
        color: #111827;
        font-weight: 600;
        word-break: break-word;
    }

    .site-detail-images {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .site-detail-images img {
        width: 96px;
        height: 96px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    .site-detail-table {
        margin-bottom: 0;
    }

    .site-detail-table th {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        color: #6b7280;
        border-bottom: 1px solid #e5e7eb;
    }

    .site-detail-table td {
        font-size: 13px;
        color: #111827;
    }

    @media (max-width: 767px) {
        .site-detail-grid {
            grid-template-columns: 1fr;
        }
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
    document.getElementById('siteMapUploadForm')?.addEventListener('submit', async function(e) {
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
    document.getElementById('siteMapUploadModal')?.addEventListener('hidden.bs.modal', function() {
        const form = document.getElementById('siteMapUploadForm');
        if (form) {
            form.reset();
            const submitBtn = document.getElementById('uploadMapBtn');
            submitBtn.innerHTML = 'Upload';
            submitBtn.disabled = false;
        }
    });

    // Handle view site detail button (if needed)
    document.addEventListener('click', function(e) {
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

                const hasMap =
                    site.has_map === true ||
                    (site.site_map && site.site_map !== "NULL" && site.site_map !== "null" && site.site_map !== "");
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
    document.querySelector('input[name="search"]')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.form.submit();
        }
    });

    // Initialize tooltips if any
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        if (typeof Swal === 'undefined') {
            console.warn('SweetAlert2 is not loaded. Using fallback alerts.');
        }
    });

    // Show reason when Listed Map is No
    document.addEventListener('click', function(e) {
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

    // Review pending images
    document.addEventListener('click', async function(e) {
        const btn = e.target.closest('.reviewImages');
        if (!btn) return;
        const siteId = btn.getAttribute('data-id');
        document.getElementById('reviewSiteId').value = siteId;
        document.getElementById('rejectReason').value = '';
        const container = document.getElementById('pendingImagesContainer');
        container.innerHTML = '';

        try {
            const formData = new FormData();
            formData.append('site_id', siteId);
            const response = await fetch('<?= base_url('superadmin/site_images_pending'); ?>', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            if (data.status && Array.isArray(data.pending_images)) {
                data.pending_images.forEach((img) => {
                    const div = document.createElement('div');
                    div.innerHTML = '<img src="<?= base_url(); ?>' + img + '" style="width:100px;height:100px;object-fit:cover;border-radius:6px;">';
                    container.appendChild(div);
                });
            }
        } catch (e) {
            console.error(e);
        }
    });

    async function handleImageAction(action) {
        const siteId = document.getElementById('reviewSiteId').value;
        const reason = document.getElementById('rejectReason').value.trim();
        if (action === 'reject' && !reason) {
            showSweetAlert('error', 'Required', 'Please enter a reject reason');
            return;
        }

        const formData = new FormData();
        formData.append('site_id', siteId);
        formData.append('action', action);
        formData.append('reason', reason);

        try {
            const response = await fetch('<?= base_url('superadmin/site_images_action'); ?>', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            if (data.status) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message || 'Updated',
                        confirmButtonText: 'OK'
                    }).then(() => window.location.reload());
                } else {
                    alert(data.message || 'Updated');
                    window.location.reload();
                }
            } else {
                showSweetAlert('error', 'Failed', data.message || 'Action failed');
            }
        } catch (e) {
            showSweetAlert('error', 'Error', 'An error occurred');
        }
    }

    document.getElementById('approveImagesBtn')?.addEventListener('click', () => handleImageAction('approve'));
    document.getElementById('rejectImagesBtn')?.addEventListener('click', () => handleImageAction('reject'));
</script>
