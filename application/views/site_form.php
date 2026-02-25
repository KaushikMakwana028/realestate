<div class="page-wrapper">
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
                        <li class="breadcrumb-item active" aria-current="page">Add New Site</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Add Site Card -->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Site</h5>
                <hr>

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col">
                            <form id="addSiteForm" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

                                <!-- Site Name -->
                                <div class="mb-3">
                                    <label for="siteName" class="form-label">Site Name</label>
                                    <input type="text" name="site_name" class="form-control" id="siteName" placeholder="Enter site name" required>
                                    <div class="invalid-feedback">Please enter the site name.</div>
                                </div>

                                <!-- Location -->
                                <div class="mb-3">
                                    <label for="siteLocation" class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control" id="siteLocation" placeholder="Enter site location" required>
                                    <div class="invalid-feedback">Please enter the site location.</div>
                                </div>

                                <!-- Area -->
                                <div class="mb-3">
                                    <label for="siteArea" class="form-label">Area</label>
                                    <input type="text" name="area" class="form-control" id="siteArea" placeholder="Enter total area (e.g. 1200 sq.ft)" required>
                                    <div class="invalid-feedback">Please enter the total area.</div>
                                </div>

                                <!-- Total Plots -->
                                <div class="mb-3">
                                    <label for="totalPlots" class="form-label">Total Plots</label>
                                    <input type="number" name="total_plots" class="form-control" id="totalPlots" placeholder="Enter total plots" min="1" required>
                                    <div class="invalid-feedback">Please enter the number of plots.</div>
                                </div>

                                <!-- Site Images -->
                                <div class="mb-3">
                                    <label for="siteImages" class="form-label">Site Images</label>
                                    <input type="file" name="site_images[]" class="form-control" id="siteImages" accept="image/*" multiple>
                                    <small class="text-muted">You can select multiple images.</small>
                                    <div id="siteImagesPreview" class="mt-2 d-flex flex-wrap gap-2"></div>
                                </div>

                                <!-- Submit Button -->
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Save Site</button>
                                </div>

                            </form>
                        </div>
                    </div><!-- end row -->
                </div>

            </div>
        </div>

    </div>
</div>
