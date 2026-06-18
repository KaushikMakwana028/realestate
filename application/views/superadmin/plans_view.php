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
        <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.95rem;">
                        <thead style="background: #f8faff; border-bottom: 2px solid #eef3fa;">
                            <tr>
                                <th style="padding: 1rem 1rem; font-weight: 600; color: #1a2a4a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">#</th>
                                <th style="padding: 1rem 1rem; font-weight: 600; color: #1a2a4a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Plan Name</th>
                                <th style="padding: 1rem 1rem; font-weight: 600; color: #1a2a4a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Price</th>
                                <th style="padding: 1rem 1rem; font-weight: 600; color: #1a2a4a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Duration</th>
                                <th style="padding: 1rem 1rem; font-weight: 600; color: #1a2a4a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Description</th>
                                <th class="text-center" style="padding: 1rem 1rem; font-weight: 600; color: #1a2a4a; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($plans)): ?>
                                <?php foreach ($plans as $index => $plan): ?>
                                    <tr style="border-bottom: 1px solid #f0f4fc; transition: all 0.2s;">
                                        <td style="padding: 1rem 1rem; font-weight: 500; color: #5a6e8a;"><?= $index + 1; ?></td>
                                        <td style="padding: 1rem 1rem;">
                                            <strong style="color: #0b1a33; font-size: 1rem;"><?= htmlspecialchars($plan->name); ?></strong>
                                        </td>
                                        <td style="padding: 1rem 1rem;">
                                            <?php if ($plan->price == 0): ?>
                                                <span class="badge" style="background: #e3f5ec; color: #0d6b4a; padding: 0.4rem 1.2rem; border-radius: 30px; font-weight: 600;">Free</span>
                                            <?php else: ?>
                                                <span style="font-weight: 700; color: #1a3d7c; font-size: 1rem;">₹ <?= number_format($plan->price, 2); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="padding: 1rem 1rem;">
                                            <span style="background: #f0f4fe; padding: 0.25rem 1rem; border-radius: 30px; font-weight: 500; font-size: 0.85rem; color: #1a3d7c;">
                                                <?= $plan->duration_days; ?> Days
                                            </span>
                                        </td>
                                        <td style="padding: 1rem 1rem; max-width: 280px;">
                                            <span style="font-size: 0.85rem; color: #4a5f7a; white-space: pre-line; line-height: 1.6; display: inline-block;">
                                                <?= htmlspecialchars($plan->description); ?>
                                            </span>
                                        </td>
                                        <td class="text-center" style="padding: 1rem 1rem;">
                                            <button class="btn btn-outline-warning btn-sm px-3 me-1 btn-edit-plan"
                                                style="border-radius: 40px; border-color: #f0d68a; color: #7a641a; font-weight: 500; padding: 0.35rem 1.2rem;"
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
                                                style="border-radius: 40px; border-color: #f8d7da; color: #a13d4a; font-weight: 500; padding: 0.35rem 1.2rem;"
                                                onclick="return confirm('Are you sure you want to delete this plan?');">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5" style="font-size: 0.95rem; letter-spacing: 0.3px;">
                                        <i class="bx bx-package" style="font-size: 2.5rem; display: block; margin-bottom: 0.5rem; opacity: 0.4;"></i>
                                        No plans defined yet.
                                    </td>
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
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content" style="border: none; border-radius: 24px; box-shadow: 0 30px 60px -20px rgba(0,0,0,0.3);">
            <div class="modal-header" style="border-bottom: 1px solid #f0f4fc; padding: 1.5rem 2rem 0.8rem 2rem;">
                <h5 class="modal-title fw-bold" style="color: #0b1a33; font-size: 1.4rem;">
                    <i class="bx bx-purchase-tag-alt me-2" style="color: #1a3d7c;"></i>Add New Plan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('superadmin/add_plan'); ?>" method="POST">
                <div class="modal-body" style="padding: 1.8rem 2rem 1.2rem 2rem;">
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-bold" style="font-size: 0.85rem; color: #1a2a4a;">Plan Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" style="border-radius: 14px; border: 1px solid #e6edf5; padding: 0.7rem 1.2rem; background: #fafcff;" placeholder="e.g. 1 Month, 6 Month" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 0.85rem; color: #1a2a4a;">Price (INR) <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" style="border-radius: 14px; border: 1px solid #e6edf5; padding: 0.7rem 1.2rem; background: #fafcff;" min="0" step="0.01" placeholder="e.g. 299" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 0.85rem; color: #1a2a4a;">Duration (Days) <span class="text-danger">*</span></label>
                            <input type="number" name="duration_days" class="form-control" style="border-radius: 14px; border: 1px solid #e6edf5; padding: 0.7rem 1.2rem; background: #fafcff;" min="1" placeholder="e.g. 30, 365" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold" style="font-size: 0.85rem; color: #1a2a4a;">Description (bullet points, one per line)</label>
                            <textarea name="description" class="form-control" style="border-radius: 14px; border: 1px solid #e6edf5; padding: 0.7rem 1.2rem; background: #fafcff; resize: vertical;" rows="4" placeholder="30 days full access&#10;Unlimited daily admin usage&#10;Manage complaints, AMC and sales"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #f0f4fc; padding: 1rem 2rem 1.8rem 2rem;">
                    <button type="button" class="btn btn-secondary" style="border-radius: 40px; background: #f0f4fe; border: none; color: #1a2a4a; font-weight: 500; padding: 0.5rem 2rem;" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="border-radius: 40px; background: #1a3d7c; border: none; font-weight: 600; padding: 0.5rem 2.5rem; box-shadow: 0 8px 18px -6px rgba(26, 61, 124, 0.25);">Save Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Plan Modal -->
<div class="modal fade" id="editPlanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content" style="border: none; border-radius: 24px; box-shadow: 0 30px 60px -20px rgba(0,0,0,0.3);">
            <div class="modal-header" style="border-bottom: 1px solid #f0f4fc; padding: 1.5rem 2rem 0.8rem 2rem;">
                <h5 class="modal-title fw-bold" style="color: #0b1a33; font-size: 1.4rem;">
                    <i class="bx bx-edit-alt me-2" style="color: #eab308;"></i>Edit Plan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('superadmin/edit_plan'); ?>" method="POST">
                <input type="hidden" name="id" id="edit_plan_id">
                <div class="modal-body" style="padding: 1.8rem 2rem 1.2rem 2rem;">
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-bold" style="font-size: 0.85rem; color: #1a2a4a;">Plan Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="edit_plan_name" class="form-control" style="border-radius: 14px; border: 1px solid #e6edf5; padding: 0.7rem 1.2rem; background: #fafcff;" placeholder="e.g. 1 Month, 6 Month" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 0.85rem; color: #1a2a4a;">Price (INR) <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="edit_plan_price" class="form-control" style="border-radius: 14px; border: 1px solid #e6edf5; padding: 0.7rem 1.2rem; background: #fafcff;" min="0" step="0.01" placeholder="e.g. 299" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="font-size: 0.85rem; color: #1a2a4a;">Duration (Days) <span class="text-danger">*</span></label>
                            <input type="number" name="duration_days" id="edit_plan_duration" class="form-control" style="border-radius: 14px; border: 1px solid #e6edf5; padding: 0.7rem 1.2rem; background: #fafcff;" min="1" placeholder="e.g. 30, 365" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold" style="font-size: 0.85rem; color: #1a2a4a;">Description (bullet points, one per line)</label>
                            <textarea name="description" id="edit_plan_description" class="form-control" style="border-radius: 14px; border: 1px solid #e6edf5; padding: 0.7rem 1.2rem; background: #fafcff; resize: vertical;" rows="4" placeholder="30 days full access&#10;Unlimited daily admin usage&#10;Manage complaints, AMC and sales"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #f0f4fc; padding: 1rem 2rem 1.8rem 2rem;">
                    <button type="button" class="btn btn-secondary" style="border-radius: 40px; background: #f0f4fe; border: none; color: #1a2a4a; font-weight: 500; padding: 0.5rem 2rem;" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn" style="border-radius: 40px; background: #eab308; border: none; color: #1a2a4a; font-weight: 600; padding: 0.5rem 2.5rem; box-shadow: 0 8px 18px -6px rgba(234, 179, 8, 0.35);">Update Plan</button>
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