<?php $this->load->view('partials/admin_form_theme'); ?>
<div class="page-wrapper admin-form-page">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Site</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Edit Site Card -->
        <div class="card admin-form-card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Site</h5>
                <hr>

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col">
                            <form id="editSiteForm" method="post" enctype="multipart/form-data" action="<?= base_url('site/update_site/' . $site->id); ?>" class="needs-validation" novalidate>
                                <input type="hidden" name="isActive" value="<?= isset($site->isActive) ? (int)$site->isActive : 1; ?>">

                                <!-- Site Name -->
                                <div class="mb-3">
                                    <label for="siteName" class="form-label">Site Name</label>
                                    <input 
                                        type="text" 
                                        name="site_name" 
                                        class="form-control" 
                                        id="siteName" 
                                        value="<?= isset($site->name) ? htmlspecialchars($site->name) : ''; ?>" 
                                        placeholder="Enter site name" 
                                        required
                                    >
                                    <div class="invalid-feedback">Please enter the site name.</div>
                                </div>

                                <!-- Location -->
                                <div class="mb-3">
                                    <label for="siteLocation" class="form-label">Location</label>
                                    <input 
                                        type="text" 
                                        name="location" 
                                        class="form-control" 
                                        id="siteLocation" 
                                        value="<?= isset($site->location) ? htmlspecialchars($site->location) : ''; ?>" 
                                        placeholder="Enter site location" 
                                        required
                                    >
                                    <div class="invalid-feedback">Please enter the site location.</div>
                                </div>

                                <!-- Area -->
                                <div class="mb-3">
                                    <label for="siteArea" class="form-label">Area</label>
                                    <input 
                                        type="text" 
                                        name="area" 
                                        class="form-control" 
                                        id="siteArea" 
                                        value="<?= isset($site->area) ? htmlspecialchars($site->area) : ''; ?>" 
                                        placeholder="Enter total area (e.g. 1200 sq.ft)" 
                                        required
                                    >
                                    <div class="invalid-feedback">Please enter the total area.</div>
                                </div>

                                <!-- Total Plots -->
                                <div class="mb-3">
                                    <label for="totalPlots" class="form-label">Total Plots</label>
                                    <input 
                                        type="number" 
                                        name="total_plots" 
                                        class="form-control" 
                                        id="totalPlots" 
                                        value="<?= isset($site->total_plots) ? htmlspecialchars($site->total_plots) : ''; ?>" 
                                        placeholder="Enter total plots" 
                                        min="1" 
                                        required
                                    >
                                    <div class="invalid-feedback">Please enter the number of plots.</div>
                                </div>

                                <!-- Site Images -->
                                <div class="mb-3">
                                    <label for="siteImages" class="form-label">Site Images</label>
                                    <input type="file" name="site_images[]" class="form-control" id="siteImages" accept="image/*" multiple>
                                    <small class="text-muted">You can add more images.</small>
                                    <div class="mt-2">
                                        <?php
                                        $img_status = $site->site_images_status ?? '';
                                        $has_images = !empty($images);
                                        if (!empty($img_status) && $has_images):
                                        ?>
                                            <span class="badge bg-<?= $img_status === 'approve' ? 'success' : ($img_status === 'reject' ? 'danger' : 'warning'); ?>">
                                                <?= ucfirst($img_status); ?>
                                            </span>
                                            <?php if ($img_status === 'reject' && !empty($site->site_images_reason)): ?>
                                                <span class="text-danger ms-2"><?= htmlspecialchars($site->site_images_reason); ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($images)): ?>
                                        <div class="mt-2 d-flex flex-wrap gap-2">
                                            <?php foreach ($images as $img): ?>
                                                <img src="<?= base_url($img); ?>" alt="Site Image" style="width:80px;height:80px;object-fit:cover;border-radius:6px;">
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($pending_images)): ?>
                                        <div class="mt-2 d-flex flex-wrap gap-2">
                                            <?php foreach ($pending_images as $img): ?>
                                                <div style="position:relative;">
                                                    <img src="<?= base_url($img); ?>" alt="Pending Image" style="width:80px;height:80px;object-fit:cover;border-radius:6px;opacity:0.7;">
                                                    <span class="badge bg-warning" style="position:absolute;bottom:4px;left:4px;">Pending</span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div id="siteImagesPreview" class="mt-2 d-flex flex-wrap gap-2"></div>
                                </div>

                              

                                <!-- Submit Button -->
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Update Site</button>
                                </div>

                            </form>
                        </div>
                    </div><!-- end row -->
                </div>

            </div>
        </div>

    </div>
</div>
