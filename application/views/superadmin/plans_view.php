<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
            <div class="breadcrumb-title pe-3">Subscription Plans</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('superadmin/dashboard'); ?>"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Plans</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <button class="btn btn-primary px-4 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addPlanModal">
                    <i class="bx bx-plus-circle"></i> Add New Plan
                </button>
            </div>
        </div>

        <!-- Alerts -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class="bx bxs-check-circle"></i></div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Success</h6>
                        <div class="text-white"><?= $this->session->flashdata('success'); ?></div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class="bx bxs-x-circle"></i></div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Error</h6>
                        <div class="text-white"><?= $this->session->flashdata('error'); ?></div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Table Card -->
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Plan Name</th>
                                <th>Price</th>
                                <th>Duration (Days)</th>
                                <th>Description</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($plans)): ?>
                                <?php foreach ($plans as $index => $plan): ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><strong><?= htmlspecialchars($plan->name); ?></strong></td>
                                        <td>
                                            <?php if ($plan->price == 0): ?>
                                                <span class="badge bg-success">Free</span>
                                            <?php else: ?>
                                                Rs <?= number_format($plan->price, 2); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $plan->duration_days; ?> Days</td>
                                        <td>
                                            <span style="font-size: 13px; color: #6c757d; white-space: pre-line;">
                                                <?= htmlspecialchars($plan->description); ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-outline-warning btn-sm px-3 btn-edit-plan me-2"
                                                    data-id="<?= $plan->id; ?>"
                                                    data-name="<?= htmlspecialchars($plan->name); ?>"
                                                    data-price="<?= $plan->price; ?>"
                                                    data-duration="<?= $plan->duration_days; ?>"
                                                    data-description="<?= htmlspecialchars($plan->description); ?>"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editPlanModal">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </button>
                                            <a href="<?= base_url('superadmin/delete_plan/' . $plan->id); ?>" 
                                               class="btn btn-outline-danger btn-sm px-3" 
                                               onclick="return confirm('Are you sure you want to delete this plan?');">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No plans defined yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Plan Modal -->
<div class="modal fade" id="addPlanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="bx bx-purchase-tag-alt me-2 text-primary"></i>Add New Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('superadmin/add_plan'); ?>" method="POST">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Plan Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. 1 Month, 6 Month" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Price (INR) *</label>
                            <input type="number" name="price" class="form-control" min="0" step="0.01" placeholder="e.g. 299" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Duration (Days) *</label>
                            <input type="number" name="duration_days" class="form-control" min="1" placeholder="e.g. 30, 365" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Description (bullet points, one per line)</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="30 days full access&#10;Unlimited daily admin usage&#10;Manage complaints, AMC and sales"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Save Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Plan Modal -->
<div class="modal fade" id="editPlanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="bx bx-edit-alt me-2 text-warning"></i>Edit Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('superadmin/edit_plan'); ?>" method="POST">
                <input type="hidden" name="id" id="edit_plan_id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Plan Name *</label>
                            <input type="text" name="name" id="edit_plan_name" class="form-control" placeholder="e.g. 1 Month, 6 Month" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Price (INR) *</label>
                            <input type="number" name="price" id="edit_plan_price" class="form-control" min="0" step="0.01" placeholder="e.g. 299" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Duration (Days) *</label>
                            <input type="number" name="duration_days" id="edit_plan_duration" class="form-control" min="1" placeholder="e.g. 30, 365" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Description (bullet points, one per line)</label>
                            <textarea name="description" id="edit_plan_description" class="form-control" rows="4" placeholder="30 days full access&#10;Unlimited daily admin usage&#10;Manage complaints, AMC and sales"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning px-4 text-white" style="background: #eab308; border: none;">Update Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('.btn-edit-plan').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const price = $(this).data('price');
            const duration = $(this).data('duration');
            const description = $(this).data('description');

            $('#edit_plan_id').val(id);
            $('#edit_plan_name').val(name);
            $('#edit_plan_price').val(price);
            $('#edit_plan_duration').val(duration);
            $('#edit_plan_description').val(description);
        });
    });
</script>
