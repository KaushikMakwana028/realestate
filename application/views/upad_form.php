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
                        <li class="breadcrumb-item active" aria-current="page">Add UPAD</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- UPAD Form Card -->
        <div class="card admin-form-card">
            <div class="card-body p-4">
                <h5 class="card-title">Add UPAD</h5>
                <hr>

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col">

                            <form id="addUpadForm" method="post" class="needs-validation" novalidate>

                                <!-- Select User -->
                                <div class="mb-3">
                                    <label for="userSelect" class="form-label">Select User</label>
                                    <select name="user_id" id="userSelect" class="form-control" required>
                                        <option value="">-- Select User --</option>

                                        <?php if (!empty($admin)) : ?>
                                            <option value="<?= $admin->id; ?>">
                                                <?= $admin->name; ?>
                                            </option>
                                        <?php endif; ?>

                                    </select>
                                    <div class="invalid-feedback">Please select a user.</div>
                                </div>

                                <!-- UPAD Amount -->
                                <div class="mb-3">
                                    <label for="upadAmount" class="form-label">UPAD Amount (INR)</label>
                                    <input type="number"
                                           name="amount"
                                           class="form-control"
                                           id="upadAmount"
                                           placeholder="Enter amount"
                                           min="1"
                                           required>
                                    <div class="invalid-feedback">Please enter a valid UPAD amount.</div>
                                </div>

                                <!-- Notes -->
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea name="notes" id="notes" rows="3" class="form-control"
                                              placeholder="Enter notes (optional)"></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">Save UPAD</button>
                                </div>

                            </form>

                        </div>
                    </div><!-- end row -->
                </div>

            </div>
        </div>

    </div>
</div>
