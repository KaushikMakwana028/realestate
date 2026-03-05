<div class="page-wrapper buyer-page">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Buyer Details</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Top Profile Card -->
        <div class="card border-0 shadow-sm mb-4 buyer-hero-card" style="border-radius: 16px; overflow: hidden;">
            <div class="card-body p-0">
                <div class="buyer-hero-head" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px 30px 60px 30px;">
                    <div class="d-flex align-items-center gap-3 buyer-hero-top">
                        <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px);">
                            <i class="bx bx-user text-white" style="font-size: 28px;"></i>
                        </div>
                        <div class="buyer-hero-text">
                            <h4 class="text-white mb-1 fw-bold">
                                <?= isset($buyer->name) ? $buyer->name : "Unknown" ?>
                            </h4>
                            <div class="d-flex align-items-center gap-3 buyer-hero-meta">
                                <span class="text-white-50">
                                    <i class="bx bx-phone me-1"></i><?= isset($buyer->mobile) ? $buyer->mobile : "-" ?>
                                </span>
                                <span class="text-white-50">
                                    <i class="bx bx-envelope me-1"></i><?= isset($buyer->email) ? $buyer->email : "-" ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Action Buttons (overlapping) -->
                <div class="buyer-hero-actions-wrap" style="margin-top: -30px; padding: 0 30px 20px;">
                    <div class="d-flex gap-2 flex-wrap buyer-hero-actions">
                        <a href="https://wa.me/91<?= $buyer->mobile ?>" target="_blank"
                            class="btn btn-success shadow-sm px-4 buyer-action-btn"
                            style="border-radius: 50px; font-weight: 600;">
                            <i class="lni lni-whatsapp me-1"></i> WhatsApp
                        </a>
                        <a href="tel:<?= $buyer->mobile ?>"
                            class="btn btn-light shadow-sm px-4 buyer-action-btn"
                            style="border-radius: 50px; font-weight: 600;">
                            <i class="bx bx-phone-call me-1"></i> Call Now
                        </a>
                        <a href="<?= base_url('payment_data/' . $buyer->id) ?>"
                            class="btn btn-primary shadow-sm px-4 buyer-action-btn"
                            style="border-radius: 50px; font-weight: 600;">
                            <i class="lni lni-wallet me-1"></i> Payment Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($payment->payment_mode) && strtoupper((string)$payment->payment_mode) === "EMI"): ?>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="emi-mini-card">
                        <div class="emi-mini-label">Total EMI</div>
                        <div class="emi-mini-value"><?= (int)($total_emi_installments ?? 0) ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="emi-mini-card paid">
                        <div class="emi-mini-label">Paid EMI</div>
                        <div class="emi-mini-value"><?= (int)($paid_emi_installments ?? 0) ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="emi-mini-card remaining">
                        <div class="emi-mini-label">Remaining EMI</div>
                        <div class="emi-mini-value"><?= (int)($remaining_emi_installments ?? 0) ?></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row g-4">

            <!-- LEFT COLUMN -->
            <div class="col-xl-6">

                <!-- Customer Information -->
                <div class="card border-0 shadow-sm mb-4 buyer-section-card" style="border-radius: 16px;">
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 40px; height: 40px; background: #e8f4fd; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bx bx-user-circle text-primary" style="font-size: 22px;"></i>
                            </div>
                            <h6 class="mb-0 fw-bold">Customer Information</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-3 pb-4">

                        <div class="d-flex justify-content-between align-items-center py-3"
                            style="border-bottom: 1px solid #f0f0f0;">
                            <span class="text-muted" style="font-size: 14px;">
                                <i class="bx bx-user me-2 text-secondary"></i>Full Name
                            </span>
                            <span class="fw-semibold text-dark">
                                <?= isset($buyer->name) ? $buyer->name : "-" ?>
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center py-3"
                            style="border-bottom: 1px solid #f0f0f0;">
                            <span class="text-muted" style="font-size: 14px;">
                                <i class="bx bx-phone me-2 text-secondary"></i>Mobile Number
                            </span>
                            <span class="fw-semibold text-dark">
                                <?= isset($buyer->mobile) ? $buyer->mobile : "-" ?>
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center py-3"
                            style="border-bottom: 1px solid #f0f0f0;">
                            <span class="text-muted" style="font-size: 14px;">
                                <i class="bx bx-envelope me-2 text-secondary"></i>Email
                            </span>
                            <span class="fw-semibold text-dark">
                                <?= isset($buyer->email) ? $buyer->email : "-" ?>
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-start py-3">
                            <span class="text-muted" style="font-size: 14px;">
                                <i class="bx bx-map me-2 text-secondary"></i>Address
                            </span>
                            <span class="fw-semibold text-dark text-end" style="max-width: 60%;">
                                <?= isset($buyer->address) ? $buyer->address : "-" ?>
                            </span>
                        </div>

                    </div>
                </div>

                <!-- Plot Information -->
                <div class="card border-0 shadow-sm mb-4 buyer-section-card" style="border-radius: 16px;">
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 40px; height: 40px; background: #fef3e2; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bx bx-map-pin text-warning" style="font-size: 22px;"></i>
                            </div>
                            <h6 class="mb-0 fw-bold">Plot Information</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-3 pb-4">

                        <div class="d-flex justify-content-between align-items-center py-3"
                            style="border-bottom: 1px solid #f0f0f0;">
                            <span class="text-muted" style="font-size: 14px;">
                                <i class="bx bx-hash me-2 text-secondary"></i>Plot Number
                            </span>
                            <span class="badge bg-dark px-3 py-2" style="font-size: 14px; border-radius: 8px;">
                                <?= isset($plot->plot_number) ? $plot->plot_number : "-" ?>
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted" style="font-size: 14px;">
                                <i class="bx bx-building-house me-2 text-secondary"></i>Site
                            </span>
                            <span class="fw-semibold text-dark">
                                <?= isset($plot->site_name) ? $plot->site_name : "-" ?>
                            </span>
                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-xl-6">

                <!-- Payment Information -->
                <div class="card border-0 shadow-sm mb-4 buyer-section-card" style="border-radius: 16px;">
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 40px; height: 40px; background: #e8f8f0; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="bx bx-wallet text-success" style="font-size: 22px;"></i>
                            </div>
                            <h6 class="mb-0 fw-bold">Payment Information</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-3 pb-4">

                        <!-- Total Price Highlight -->
                        <div class="text-center py-3 mb-3"
                            style="background: linear-gradient(135deg, #e8f8f0 0%, #f0fdf4 100%); border-radius: 12px;">
                            <small class="text-muted d-block mb-1">Total Price</small>
                            <h3 class="fw-bold text-success mb-0">
                                &#8377;<?= isset($payment->total_price) ? number_format($payment->total_price) : "-" ?>
                            </h3>
                        </div>

                        <div class="d-flex justify-content-between align-items-center py-3"
                            style="border-bottom: 1px solid #f0f0f0;">
                            <span class="text-muted" style="font-size: 14px;">
                                <i class="bx bx-credit-card me-2 text-secondary"></i>Payment Mode
                            </span>
                            <span class="badge px-3 py-2
                                <?php
                                $mode = isset($payment->payment_mode) ? strtolower($payment->payment_mode) : '';
                                echo $mode == 'emi' ? 'bg-info' : ($mode == 'cash' ? 'bg-success' : 'bg-secondary');
                                ?>"
                                style="font-size: 13px; border-radius: 8px;">
                                <?= isset($payment->payment_mode) ? ucfirst($payment->payment_mode) : "-" ?>
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center py-3"
                            style="border-bottom: 1px solid #f0f0f0;">
                            <span class="text-muted" style="font-size: 14px;">
                                <i class="bx bx-wallet-alt me-2 text-secondary"></i>Down Payment
                            </span>
                            <span class="fw-semibold text-dark">
                                &#8377;<?= isset($payment->down_payment) ? number_format($payment->down_payment) : "-" ?>
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center py-3"
                            style="border-bottom: 1px solid #f0f0f0;">
                            <span class="text-muted" style="font-size: 14px;">
                                <i class="bx bx-check-shield me-2 text-secondary"></i>Paid Amount
                            </span>
                            <span class="fw-bold text-success" style="font-size: 15px;">
                                &#8377;<?= isset($payment->total_price, $remaining_amount) ? number_format(max(0, (float)$payment->total_price - (float)$remaining_amount)) : "-" ?>
                            </span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted" style="font-size: 14px;">
                                <i class="bx bx-time-five me-2 text-secondary"></i>Remaining Payment
                            </span>
                            <span class="fw-bold <?= (isset($remaining_amount) && $remaining_amount > 0) ? 'text-danger' : 'text-success' ?>"
                                style="font-size: 16px;">
                                &#8377;<?= isset($remaining_amount) ? number_format($remaining_amount) : "-" ?>
                            </span>
                        </div>

                    </div>
                </div>

                <!-- EMI Information (Conditional) -->
                <?php if (isset($payment->payment_mode) && $payment->payment_mode == "EMI"): ?>
                    <?php
                    $next_emi_date = null;
                    if (!empty($emi)) {
                        foreach ($emi as $er) {
                            if (strtolower((string)($er->status ?? 'pending')) !== 'approve') {
                                $next_emi_date = $er->emi_date ?? null;
                                break;
                            }
                        }
                    }
                    ?>
                    <div class="card border-0 shadow-sm mb-4 buyer-section-card" style="border-radius: 16px;">
                        <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width: 40px; height: 40px; background: #f0e6ff; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bx bx-calendar text-purple" style="font-size: 22px; color: #7c3aed;"></i>
                                </div>
                                <h6 class="mb-0 fw-bold">EMI Information</h6>
                            </div>
                        </div>
                        <div class="card-body px-4 pt-3 pb-4">

                            <!-- EMI Amount Highlight -->
                            <div class="text-center py-3 mb-3"
                                style="background: linear-gradient(135deg, #f0e6ff 0%, #faf5ff 100%); border-radius: 12px;">
                                <small class="text-muted d-block mb-1">Monthly EMI</small>
                                <h3 class="fw-bold mb-0" style="color: #7c3aed;">
                                    &#8377;<?= isset($payment->installment_amount) && (float)$payment->installment_amount > 0
                                                ? number_format($payment->installment_amount)
                                                : (isset($emi[0]->emi_amount) ? number_format($emi[0]->emi_amount) : "-") ?>
                                </h3>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-3"
                                style="border-bottom: 1px solid #f0f0f0;">
                                <span class="text-muted" style="font-size: 14px;">
                                    <i class="bx bx-timer me-2 text-secondary"></i>Duration
                                </span>
                                <span class="fw-semibold text-dark">
                                    <?= isset($total_emi_installments) ? (int)$total_emi_installments : "-" ?> Months
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted" style="font-size: 14px;">
                                    <i class="bx bx-calendar-event me-2 text-secondary"></i>EMI Start Date
                                </span>
                                <span class="fw-semibold text-dark">
                                    <?= isset($emi[0]->emi_date) ? date('d M Y', strtotime($emi[0]->emi_date)) : "-" ?>
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-3"
                                style="border-top: 1px solid #f0f0f0;">
                                <span class="text-muted" style="font-size: 14px;">
                                    <i class="bx bx-calendar-check me-2 text-secondary"></i>Next EMI Date
                                </span>
                                <span class="fw-semibold text-primary">
                                    <?= !empty($next_emi_date) ? date('d M Y', strtotime($next_emi_date)) : "-" ?>
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-3"
                                style="border-top: 1px solid #f0f0f0;">
                                <span class="text-muted" style="font-size: 14px;">
                                    <i class="bx bx-check-circle me-2 text-secondary"></i>Paid EMI
                                </span>
                                <span class="fw-bold text-success">
                                    <?= (int)($paid_emi_installments ?? 0) ?>
                                </span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted" style="font-size: 14px;">
                                    <i class="bx bx-time-five me-2 text-secondary"></i>Remaining EMI
                                </span>
                                <span class="fw-bold text-danger">
                                    <?= (int)($remaining_emi_installments ?? 0) ?>
                                </span>
                            </div>

                        </div>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    </div>
</div>

<style>
    .buyer-hero-text {
        min-width: 0;
        flex: 1;
    }

    .buyer-hero-text h4 {
        word-break: break-word;
    }

    .buyer-hero-meta {
        flex-wrap: wrap;
        row-gap: 6px;
    }

    .buyer-hero-meta span {
        min-width: 0;
        word-break: break-word;
    }

    .buyer-hero-actions {
        width: 100%;
    }

    .buyer-action-btn {
        white-space: nowrap;
    }

    .emi-mini-card {
        border: 1px solid #dfe6f5;
        border-radius: 12px;
        background: #f8fbff;
        padding: 14px 16px;
    }

    .emi-mini-card.paid {
        background: #effaf3;
        border-color: #cbeed6;
    }

    .emi-mini-card.remaining {
        background: #fff5f5;
        border-color: #ffd7d7;
    }

    .emi-mini-label {
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 4px;
    }

    .emi-mini-value {
        font-size: 24px;
        font-weight: 700;
        color: #0f3460;
        line-height: 1.1;
    }

    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08) !important;
    }

    .badge {
        letter-spacing: 0.3px;
    }

    @media (max-width: 576px) {
        .buyer-hero-head {
            padding: 18px 14px 44px 14px !important;
        }

        .buyer-hero-top {
            align-items: flex-start !important;
            gap: 10px !important;
        }

        .buyer-hero-text h4 {
            font-size: 22px;
            line-height: 1.25;
        }

        .buyer-hero-meta {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 4px !important;
        }

        .buyer-hero-actions-wrap {
            margin-top: -24px !important;
            padding: 0 14px 14px !important;
        }

        .buyer-hero-actions .buyer-action-btn {
            flex: 1 1 100%;
            width: 100%;
            justify-content: center;
            padding-left: 14px !important;
            padding-right: 14px !important;
            font-size: 14px;
        }

        .buyer-section-card .card-body {
            padding-left: 14px !important;
            padding-right: 14px !important;
        }

        .buyer-section-card .card-body .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 6px;
        }

        .buyer-section-card .card-body .d-flex.justify-content-between>span:last-child {
            width: 100%;
            text-align: left !important;
            max-width: 100% !important;
            word-break: break-word;
        }

        .emi-mini-value {
            font-size: 20px;
        }
    }
</style>
