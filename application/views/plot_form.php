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
                        <li class="breadcrumb-item active" aria-current="page">Add New Plot</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Add Plot Card -->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Plot</h5>
                <hr>

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col">
                         <form id="addPlotForm" method="post" novalidate>

    <!-- Site Name Dropdown -->
    <div class="mb-3">
        <label for="siteName" class="form-label">Site Name</label>
        <select name="site_id" id="siteName" class="form-select" required>
            <option value="">Select Site</option>
            <?php if (isset($sites) && !empty($sites)): ?>
                <?php foreach ($sites as $site): ?>
                    <option value="<?= $site->id; ?>"><?= $site->name; ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <div class="invalid-feedback">Please select a site name.</div>
    </div>

    <!-- Plot Number -->
    <div class="mb-3">
        <label for="plotNumber" class="form-label">Plot Number</label>
        <input type="text" name="plot_number" class="form-control" id="plotNumber" placeholder="Enter plot number" required>
        <div class="invalid-feedback">Please enter the plot number.</div>
    </div>

    <!-- Size -->
    <div class="mb-3">
        <label for="plotSize" class="form-label">Size</label>
        <input type="text" name="size" class="form-control" id="plotSize" placeholder="Enter plot size (e.g. 1200 sq.ft)" required>
        <div class="invalid-feedback">Please enter the plot size.</div>
    </div>

    <!-- Dimension -->
    <div class="mb-3">
        <label for="plotDimension" class="form-label">Dimension</label>
        <input type="text" name="dimension" class="form-control" id="plotDimension" placeholder="Enter dimension (e.g. 30x40)" required>
        <div class="invalid-feedback">Please enter the plot dimension.</div>
    </div>

    <!-- Facing -->
    <div class="mb-3">
        <label for="plotFacing" class="form-label">Facing</label>
        <select name="facing" id="plotFacing" class="form-select" required>
            <option value="">Select Facing</option>
            <option value="East">East</option>
            <option value="West">West</option>
            <option value="North">North</option>
            <option value="South">South</option>
            <option value="North-East">North-East</option>
            <option value="North-West">North-West</option>
            <option value="South-East">South-East</option>
            <option value="South-West">South-West</option>
        </select>
        <div class="invalid-feedback">Please select the plot facing.</div>
    </div>

    <!-- Price -->
    <div class="mb-3">
        <label for="plotPrice" class="form-label">Price</label>
        <input type="number" name="price" class="form-control" id="plotPrice" placeholder="Enter price (₹)" min="0" required>
        <div class="invalid-feedback">Please enter the plot price.</div>
    </div>

    <!-- Submit Button -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary w-100">Save Plot</button>
    </div>

</form>



                        </div>
                    </div><!-- end row -->
                </div>

            </div>
        </div>

    </div>
</div>
