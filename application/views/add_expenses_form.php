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
                        <li class="breadcrumb-item active" aria-current="page">Add New Expenses</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Add Plot Card -->
        <div class="card admin-form-card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Expenses</h5>
                <hr>

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col">
                        <form id="addexpForm" method="post" enctype="multipart/form-data" novalidate>

    
                        
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

    <div class="mb-3 d-none" id="expenseImageFieldWrap">
        <label for="expenseImage" class="form-label">Expense Image</label>
        <input type="file" name="expense_image" class="form-control" id="expenseImage" accept="image/*">
        <div class="form-text">Upload image for this expense (optional).</div>
        <div id="expenseImagePreview" class="mt-2"></div>
    </div>

   
    <div class="mb-3">
        <label for="expPrice" class="form-label">Price</label>
        <input type="number" name="price" class="form-control" id="expPrice" placeholder="Enter price (INR)" min="0" required>
        <div class="invalid-feedback">Please enter the Amount.</div>
    </div>

   
    <div class="mb-3">
        <label for="expDescription" class="form-label">Description</label>
        <textarea name="description" id="expDescription" class="form-control" placeholder="Enter expense description" rows="3" required></textarea>
        <div class="invalid-feedback">Please enter a description.</div>
    </div>

    
    <div class="mb-3">
        <label for="expDate" class="form-label">Date</label>
        <input type="date" name="date" id="expDate" class="form-control" required>
        <div class="invalid-feedback">Please select a date.</div>
    </div>

    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary w-100">Save Expenses</button>
    </div>

</form>




                        </div>
                    </div><!-- end row -->
                </div>

            </div>
        </div>

    </div>
</div>
