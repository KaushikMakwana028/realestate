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
                        <li class="breadcrumb-item active" aria-current="page">Edit Plot</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Edit Plot Card -->
        <div class="card admin-form-card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Plot</h5>
                <hr>

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col">
                            <form id="editPlotForm" method="post"  novalidate>

                                <!-- Hidden ID -->
                                <input type="hidden" name="id" value="<?= isset($plots->id) ? $plots->id : ''; ?>">

                                <!-- Site Name Dropdown -->
                                <div class="mb-3">
                                    <label for="siteName" class="form-label">Site Name</label>
                                    <select name="site_id" id="siteName" class="form-select" required>
                                        <option value="">Select Site</option>
                                        <?php if (isset($sites) && !empty($sites)): ?>
                                            <?php foreach ($sites as $site): ?>
                                                <option value="<?= $site->id; ?>"
                                                    <?= isset($plots->site_id) && $plots->site_id == $site->id ? 'selected' : ''; ?>>
                                                    <?= $site->name; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="invalid-feedback">Please select a site name.</div>
                                </div>

                                <!-- Plot Number -->
                                <div class="mb-3">
                                    <label for="plotNumber" class="form-label">Plot Number</label>
                                    <input type="text" name="plot_number" class="form-control" id="plotNumber"
                                           placeholder="Enter plot number"
                                           value="<?= isset($plots->plot_number) ? htmlspecialchars($plots->plot_number) : ''; ?>" required>
                                    <div class="invalid-feedback">Please enter the plot number.</div>
                                </div>

                                <!-- Size -->
                                <div class="mb-3">
                                    <label for="plotSize" class="form-label">Size</label>
                                    <input type="text" name="size" class="form-control" id="plotSize"
                                           placeholder="Enter plot size (e.g. 1200 sq.ft)"
                                           value="<?= isset($plots->size) ? htmlspecialchars($plots->size) : ''; ?>" required>
                                    <div class="invalid-feedback">Please enter the plot size.</div>
                                </div>

                                <!-- Dimension -->
                                <div class="mb-3">
                                    <label for="plotDimension" class="form-label">Dimension</label>
                                    <input type="text" name="dimension" class="form-control" id="plotDimension"
                                           placeholder="Enter dimension (e.g. 30x40)"
                                           value="<?= isset($plots->dimension) ? htmlspecialchars($plots->dimension) : ''; ?>" required>
                                    <div class="invalid-feedback">Please enter the plot dimension.</div>
                                </div>

                                <!-- Facing -->
                                <div class="mb-3">
                                    <label for="plotFacing" class="form-label">Facing</label>
                                    <select name="facing" id="plotFacing" class="form-select" required>
                                        <option value="">Select Facing</option>
                                        <?php
                                        $facings = [
                                            'East', 'West', 'North', 'South',
                                            'North-East', 'North-West', 'South-East', 'South-West'
                                        ];
                                        foreach ($facings as $face): ?>
                                            <option value="<?= $face; ?>"
                                                <?= isset($plots->facing) && $plots->facing == $face ? 'selected' : ''; ?>>
                                                <?= $face; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">Please select the plot facing.</div>
                                </div>

                                <!-- Price -->
                                <div class="mb-3">
                                    <label for="plotPrice" class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" id="plotPrice"
                                           placeholder="Enter price (₹)" min="0"
                                           value="<?= isset($plots->price) ? htmlspecialchars($plots->price) : ''; ?>" required>
                                    <div class="invalid-feedback">Please enter the plot price.</div>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="plotStatus" class="form-label">Status</label>
                                    <select name="status" id="plotStatus" class="form-select" required>
                                        <option value="">Select Status</option>
                                        <option value="available" <?= isset($plots->status) && $plots->status == 'available' ? 'selected' : ''; ?>>Available</option>
                                        <option value="sold" <?= isset($plots->status) && $plots->status == 'sold' ? 'selected' : ''; ?>>Sold</option>
                                        <option value="pending" <?= isset($plots->status) && $plots->status == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                    </select>
                                    <div class="invalid-feedback">Please select the plot status.</div>
                                </div>

                                <!-- Submit Button -->
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Update Plot</button>
                                </div>

                            </form>
                        </div>
                    </div><!-- end row -->
                </div>

            </div>
        </div>

    </div>
</div>
