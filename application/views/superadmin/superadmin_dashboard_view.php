<!--start page wrapper -->
<div class="page-wrapper bg-light">
    <div class="page-content container-fluid">

        <!-- Header Section -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="fw-bold text-dark">🏢 Head Office Overview</h4>
            <div class="d-flex gap-2">
                <a href="<?= base_url('superadmin/admins'); ?>" class="btn btn-sm btn-outline-primary">
                    <i class="bx bx-user"></i> Admin Directory
                </a>
                <a href="<?= base_url('superadmin/sites'); ?>" class="btn btn-sm btn-outline-primary">
                    <i class="bx bx-map"></i> Site Directory
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-4">

            <div class="col">
                <div class="card radius-10 shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <p class="mb-1 text-secondary">Total Admins</p>
                        <h3 class="fw-bold text-primary"><?= $admins_count ?? 0 ?></h3>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <p class="mb-1 text-secondary">Total Sites</p>
                        <h3 class="fw-bold text-success"><?= $sites_count ?? 0 ?></h3>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <p class="mb-1 text-secondary">Total Plots</p>
                        <h3 class="fw-bold text-danger"><?= $plots_count ?? 0 ?></h3>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <p class="mb-1 text-secondary">Pending Image Requests</p>
                        <h3 class="fw-bold text-warning"><?= $image_requests_pending ?? 0 ?></h3>
                        <p class="mb-0 font-13 text-warning">
                            <i class="bx bx-time-five"></i> Requires review
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Map Listing Status -->
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="mb-3 fw-bold">🗺️ Map Listing Status</h6>

                        <div class="d-flex justify-content-between border rounded p-2 mb-2 bg-white">
                            <span>Total Sites</span>
                            <strong><?= $maps_total ?? 0 ?></strong>
                        </div>

                        <div class="d-flex justify-content-between border rounded p-2 mb-2 bg-white">
                            <span>Maps Uploaded</span>
                            <strong class="text-success"><?= $maps_uploaded ?? 0 ?></strong>
                        </div>

                        <div class="d-flex justify-content-between border rounded p-2 bg-white">
                            <span>Maps Pending</span>
                            <strong class="text-danger"><?= $maps_pending ?? 0 ?></strong>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--end page wrapper -->