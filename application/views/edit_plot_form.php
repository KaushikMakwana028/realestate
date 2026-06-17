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
                            <form id="editPlotForm" method="post" novalidate>

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
                                        value="<?= isset($plots->dimension) ? htmlspecialchars($plots->dimension) : ''; ?>">
                                    <div class="invalid-feedback">Please enter the plot dimension.</div>
                                </div>

                                <!-- Facing -->
                                <div class="mb-3">
                                    <label for="plotFacing" class="form-label">Facing</label>
                                    <select name="facing" id="plotFacing" class="form-select">
                                        <option value="">Select Facing</option>
                                        <?php
                                        $facings = [
                                            'East',
                                            'West',
                                            'North',
                                            'South',
                                            'North-East',
                                            'North-West',
                                            'South-East',
                                            'South-West'
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

                                <!-- Buyer Details Button (Visible only when status is sold) -->
                                <div class="mb-3 d-none" id="buyerDetailsBtnWrap">
                                    <button type="button" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2" id="btnEditBuyerDetails">
                                        <i class="bx bx-user-circle fs-5"></i> Buyer & Payment Details
                                    </button>
                                </div>

                                <!-- Action Buttons -->
                                <div class="row g-2 mb-3">
                                    <div class="col-sm-6">
                                        <a href="<?= base_url('plots/' . ($plots->site_id ?? '')); ?>" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-2">
                                            <i class="bx bx-arrow-back fs-5"></i> Back to Plots
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary w-100">Update Plot</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div><!-- end row -->
                </div>

            </div>
        </div>

    </div>
</div>

<?php
// Extract existing buyer & payment details if available
$admin_id = $this->admin['user_id'] ?? '';
$b_name = isset($buyer->name) ? htmlspecialchars($buyer->name) : '';
$b_mobile = isset($buyer->mobile) ? htmlspecialchars($buyer->mobile) : '';
$b_email = isset($buyer->email) ? htmlspecialchars($buyer->email) : '';
$b_address = isset($buyer->address) ? htmlspecialchars($buyer->address) : '';
$b_aadhar = isset($buyer->aadhar) ? htmlspecialchars($buyer->aadhar) : '';
$b_user_id = isset($buyer->user_id) ? htmlspecialchars($buyer->user_id) : '';

$p_mode = isset($payment_details->payment_mode) ? htmlspecialchars($payment_details->payment_mode) : 'CASH';
$p_total = isset($payment_details->total_price) ? htmlspecialchars($payment_details->total_price) : '';
$p_down = isset($payment_details->down_payment) ? htmlspecialchars($payment_details->down_payment) : '0';
$p_remain = isset($payment_details->remaining_amount) ? htmlspecialchars($payment_details->remaining_amount) : '';
$p_duration = isset($payment_details->emi_duration) ? htmlspecialchars($payment_details->emi_duration) : '';
$p_start = isset($payment_details->emi_start_date) ? htmlspecialchars($payment_details->emi_start_date) : '';
$p_inst = isset($payment_details->installment_amount) ? htmlspecialchars($payment_details->installment_amount) : '';
$p_notes = isset($payment_details->notes) ? htmlspecialchars($payment_details->notes) : '';
?>

<!-- Buyer Details Modal -->
<div class="modal fade" id="buyerDetailsModal" tabindex="-1" aria-labelledby="buyerDetailsModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title d-flex align-items-center gap-2 text-white" id="buyerDetailsModalLabel">
                    <i class="bx bx-user-plus fs-4"></i> Buyer & Payment Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="buyerDetailsForm" novalidate>
                    <!-- Row 1: Name & Mobile -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="modalBuyerName" class="form-label fw-bold">Buyer Name <span class="text-danger">*</span></label>
                            <input type="text" id="modalBuyerName" class="form-control" required placeholder="Enter buyer's full name" value="<?= $b_name; ?>">
                            <div class="invalid-feedback">Please enter the buyer's name.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="modalBuyerMobile" class="form-label fw-bold">Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" id="modalBuyerMobile" class="form-control" required placeholder="Enter 10-digit mobile" pattern="[0-9]{10}" value="<?= $b_mobile; ?>">
                            <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                        </div>
                    </div>

                    <!-- Row 2: Email & Aadhar -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="modalBuyerEmail" class="form-label fw-bold">Email Address</label>
                            <input type="email" id="modalBuyerEmail" class="form-control" placeholder="Enter email address" value="<?= $b_email; ?>">
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="modalBuyerAadhar" class="form-label fw-bold">Aadhar Number</label>
                            <input type="text" id="modalBuyerAadhar" class="form-control" placeholder="Enter 12-digit Aadhar number" pattern="[0-9]{12}" value="<?= $b_aadhar; ?>">
                            <div class="invalid-feedback">Please enter a valid 12-digit Aadhar number.</div>
                        </div>
                    </div>

                    <!-- Row 3: Address -->
                    <div class="mb-3">
                        <label for="modalBuyerAddress" class="form-label fw-bold">Address</label>
                        <textarea id="modalBuyerAddress" class="form-control" rows="2" placeholder="Enter full address"><?= $b_address; ?></textarea>
                        <div class="invalid-feedback">Please enter the address.</div>
                    </div>

                    <hr class="my-4">
                    <h6 class="mb-3 text-primary d-flex align-items-center gap-2">
                        <i class="bx bx-credit-card fs-5"></i> Payment Details
                    </h6>

                    <!-- Row 4: Agent & Payment Mode -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="modalBuyerAgent" class="form-label fw-bold">Assigned Agent/User <span class="text-danger">*</span></label>
                            <select id="modalBuyerAgent" class="form-select" required>
                                <option value="">Select Agent</option>
                                <option value="admin" <?= ($b_user_id == $admin_id || empty($b_user_id)) ? 'selected' : ''; ?>>Self / Admin</option>
                                <?php if (isset($users) && !empty($users)): ?>
                                    <?php foreach ($users as $u): ?>
                                        <option value="<?= $u->id; ?>" <?= $b_user_id == $u->id ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($u->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">Please select an agent.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="modalPaymentMode" class="form-label fw-bold">Payment Mode <span class="text-danger">*</span></label>
                            <select id="modalPaymentMode" class="form-select" required>
                                <option value="CASH" <?= $p_mode === 'CASH' ? 'selected' : ''; ?>>CASH</option>
                                <option value="EMI" <?= $p_mode === 'EMI' ? 'selected' : ''; ?>>EMI</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 5: Total Price & Down Payment & Remaining Amount -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="modalTotalPrice" class="form-label fw-bold">Total Price <span class="text-danger">*</span></label>
                            <input type="number" id="modalTotalPrice" class="form-control" required min="0" value="<?= $p_total; ?>">
                            <div class="invalid-feedback">Please enter a valid price.</div>
                        </div>
                        <div class="col-md-4">
                            <label for="modalDownPayment" class="form-label fw-bold">Down Payment</label>
                            <input type="number" id="modalDownPayment" class="form-control" min="0" value="<?= $p_down; ?>">
                            <div class="invalid-feedback">Please enter a valid down payment.</div>
                        </div>
                        <div class="col-md-4">
                            <label for="modalRemainingAmount" class="form-label fw-bold">Remaining Amount</label>
                            <input type="number" id="modalRemainingAmount" class="form-control bg-light" readonly value="<?= $p_remain; ?>">
                        </div>
                    </div>

                    <!-- EMI Fields Group (Hidden by default) -->
                    <div id="emiFieldsGroup" class="d-none">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="modalEmiDuration" class="form-label fw-bold">EMI Duration (Months) <span class="text-danger">*</span></label>
                                <input type="number" id="modalEmiDuration" class="form-control" min="1" placeholder="e.g. 12" value="<?= $p_duration; ?>">
                                <div class="invalid-feedback">Please enter EMI duration (min 1 month).</div>
                            </div>
                            <div class="col-md-4">
                                <label for="modalEmiStartDate" class="form-label fw-bold">EMI Start Date <span class="text-danger">*</span></label>
                                <input type="date" id="modalEmiStartDate" class="form-control" value="<?= $p_start; ?>">
                                <div class="invalid-feedback">Please select start date.</div>
                            </div>
                            <div class="col-md-4">
                                <label for="modalInstallmentAmount" class="form-label fw-bold">Installment Amount <span class="text-danger">*</span></label>
                                <input type="number" id="modalInstallmentAmount" class="form-control" min="1" value="<?= $p_inst; ?>">
                                <div class="invalid-feedback">Please enter installment amount.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-3">
                        <label for="modalPaymentNotes" class="form-label fw-bold">Notes</label>
                        <textarea id="modalPaymentNotes" class="form-control" rows="2" placeholder="Any additional notes..."><?= $p_notes; ?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light py-3">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary px-4" id="btnSaveBuyerDetails">Save Details</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        let previousStatus = $('#plotStatus').val();
        window.buyerDetailsSaved = <?= (!empty($b_name)) ? 'true' : 'false'; ?>;

        if ($('#plotStatus').val() === 'sold') {
            $('#buyerDetailsBtnWrap').removeClass('d-none');
        }

        // Toggle EMI fields visibility
        function toggleEmiFields() {
            const mode = $('#modalPaymentMode').val();
            if (mode === 'EMI') {
                $('#emiFieldsGroup').removeClass('d-none');
                $('#modalEmiDuration, #modalEmiStartDate, #modalInstallmentAmount').prop('required', true);
            } else {
                $('#emiFieldsGroup').addClass('d-none');
                $('#modalEmiDuration, #modalEmiStartDate, #modalInstallmentAmount').prop('required', false);
            }
        }

        $('#modalPaymentMode').on('change', toggleEmiFields);
        toggleEmiFields(); // run initially

        // Status select handler
        $('#plotStatus').on('focus', function() {
            previousStatus = $(this).val();
        }).on('change', function() {
            if ($(this).val() === 'sold') {
                $('#buyerDetailsBtnWrap').removeClass('d-none');
                // If total price in modal is empty, pre-fill from main form price field
                if (!$('#modalTotalPrice').val()) {
                    $('#modalTotalPrice').val($('#plotPrice').val());
                }
                calculatePayments();
                $('#buyerDetailsModal').modal('show');
            } else {
                $('#buyerDetailsBtnWrap').addClass('d-none');
            }
        });

        $('#btnEditBuyerDetails').on('click', function() {
            // Update total price from main form if it was changed
            if (!$('#modalTotalPrice').val()) {
                $('#modalTotalPrice').val($('#plotPrice').val());
            }
            calculatePayments();
            $('#buyerDetailsModal').modal('show');
        });

        // Auto-calculate payments
        function calculatePayments() {
            const total = parseFloat($('#modalTotalPrice').val()) || 0;
            const down = parseFloat($('#modalDownPayment').val()) || 0;
            const remaining = Math.max(0, total - down);
            $('#modalRemainingAmount').val(remaining);

            const duration = parseInt($('#modalEmiDuration').val()) || 0;
            if (duration > 0 && $('#modalPaymentMode').val() === 'EMI') {
                const installment = Math.ceil(remaining / duration);
                $('#modalInstallmentAmount').val(installment);
            }
        }

        $('#modalTotalPrice, #modalDownPayment, #modalEmiDuration').on('input', calculatePayments);

        // Save details click handler
        $('#btnSaveBuyerDetails').on('click', function() {
            const form = document.getElementById('buyerDetailsForm');
            if (!form.checkValidity()) {
                $(form).addClass('was-validated');
                return;
            }
            window.buyerDetailsSaved = true;
            $('#buyerDetailsModal').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Saved',
                text: 'Buyer details saved locally. Click Update Plot to submit.',
                timer: 2000,
                showConfirmButton: false
            });
        });

        // Reset status if modal closed without saving
        $('#buyerDetailsModal').on('hidden.bs.modal', function() {
            if ($('#plotStatus').val() === 'sold' && !window.buyerDetailsSaved) {
                $('#plotStatus').val(previousStatus);
                if (previousStatus !== 'sold') {
                    $('#buyerDetailsBtnWrap').addClass('d-none');
                }
            }
        });

        // Hijack submit and send data via AJAX
        $("#editPlotForm").off("submit").on("submit", function(e) {
            e.preventDefault();

            // Validate main form
            if (!this.checkValidity()) {
                $(this).addClass('was-validated');
                return false;
            }

            if ($('#plotStatus').val() === 'sold' && !window.buyerDetailsSaved) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Buyer Details Required',
                    text: 'Please enter the buyer and payment details for this sold plot.'
                }).then(() => {
                    $('#buyerDetailsModal').modal('show');
                });
                return false;
            }

            let formData = new FormData(this);

            // Append buyer details if plot is sold
            if ($('#plotStatus').val() === 'sold') {
                formData.append('buyer_name', $('#modalBuyerName').val());
                formData.append('buyer_mobile', $('#modalBuyerMobile').val());
                formData.append('buyer_email', $('#modalBuyerEmail').val());
                formData.append('buyer_address', $('#modalBuyerAddress').val());
                formData.append('buyer_aadhar', $('#modalBuyerAadhar').val());
                formData.append('buyer_user_id', $('#modalBuyerAgent').val());
                formData.append('payment_mode', $('#modalPaymentMode').val());
                formData.append('total_price', $('#modalTotalPrice').val());
                formData.append('down_payment', $('#modalDownPayment').val());
                formData.append('remaining_amount', $('#modalRemainingAmount').val());
                formData.append('emi_duration', $('#modalEmiDuration').val());
                formData.append('emi_start_date', $('#modalEmiStartDate').val());
                formData.append('installment_amount', $('#modalInstallmentAmount').val());
                formData.append('payment_notes', $('#modalPaymentNotes').val());
            }

            $.ajax({
                url: site_url + "plots/update_plot",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",

                beforeSend: function() {
                    Swal.fire({
                        title: "Updating...",
                        text: "Please wait",
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading(),
                    });
                },

                success: function(response) {
                    Swal.close();

                    if (response.status === "success") {
                        const siteId = formData.get("site_id");
                        if (siteId) {
                            window.location.href = site_url + "plots/" + siteId;
                        } else {
                            window.location.href = site_url + "plots";
                        }
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response.message,
                        });
                    }
                },

                error: function() {
                    Swal.close();
                    Swal.fire({
                        icon: "error",
                        title: "Server Error",
                        text: "Something went wrong!",
                    });
                },
            });
        });
    });
</script>