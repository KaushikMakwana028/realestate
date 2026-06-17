<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="page-wrapper">
    <div class="page-content bp-page">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-flex flex-wrap align-items-center mb-4">
            <div class="breadcrumb-title pe-3">Billing &amp; Plans</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Subscription Plans</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Alerts -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2 bp-alert" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bp-alert-icon text-white"><i class="bx bxs-check-circle"></i></div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Success</h6>
                        <div class="text-white small"><?= $this->session->flashdata('success'); ?></div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2 bp-alert" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bp-alert-icon text-white"><i class="bx bxs-x-circle"></i></div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Error</h6>
                        <div class="text-white small"><?= $this->session->flashdata('error'); ?></div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Active Plan Banner -->
        <?php
        $days_left = $this->session->userdata('subscription_days_left');
        $plan_name = $this->session->userdata('subscription_plan_name');
        $end_date  = $this->session->userdata('subscription_end_date');
        $has_plan  = ($days_left !== NULL && $days_left >= 0);
        ?>
        <div class="bp-banner mb-4 <?= $has_plan ? 'bp-banner--active' : 'bp-banner--empty'; ?>">
            <div class="bp-banner-left">
                <div class="bp-banner-icon">
                    <i class="bx <?= $has_plan ? 'bxs-shield-quarter' : 'bxs-error-circle'; ?>"></i>
                </div>
                <div>
                    <span class="bp-eyebrow">Current Subscription Status</span>
                    <?php if ($has_plan): ?>
                        <h3 class="bp-banner-title"><?= htmlspecialchars($plan_name); ?> Plan is Active</h3>
                        <p class="bp-banner-sub">Ends in <strong><?= (int) $days_left; ?> day<?= ((int) $days_left === 1) ? '' : 's'; ?></strong> on <?= date('d M Y', strtotime($end_date)); ?></p>
                    <?php else: ?>
                        <h3 class="bp-banner-title bp-banner-title--danger">No Active Plan</h3>
                        <p class="bp-banner-sub">Choose a plan below to unlock your dashboard.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($has_plan): ?>
                <div class="bp-days-pill">
                    <span>Days Remaining</span>
                    <strong><?= (int) $days_left; ?></strong>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mb-5 bp-fade-in">
            <h2 class="fw-bold text-dark mb-2">Pricing Plans for Every Scale</h2>
            <p class="text-muted mb-0">All plans unlock full access to every premium feature. Choose the duration that suits your business.</p>
        </div>

        <!-- Pricing Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4 align-items-stretch">
            <?php if (!empty($plans)): ?>
                <?php foreach ($plans as $index => $plan): ?>
                    <?php $isActiveSub = ($plan_name === $plan->name && $has_plan); ?>
                    <div class="col bp-fade-in" style="animation-delay: <?= $index * 0.08; ?>s;">
                        <div class="bp-card <?= $isActiveSub ? 'bp-card--active' : ''; ?>">
                            <?php if ($isActiveSub): ?>
                                <span class="bp-ribbon"><i class="bx bx-check"></i> Active Plan</span>
                            <?php endif; ?>

                            <div class="bp-card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="bp-icon-tile">
                                        <i class="bx bx-award"></i>
                                    </div>
                                    <?php if (!$isActiveSub && $plan->price == 0): ?>
                                        <span class="badge bp-badge-free">100% Free</span>
                                    <?php endif; ?>
                                </div>

                                <h4 class="bp-plan-name"><?= htmlspecialchars($plan->name); ?></h4>
                                <p class="bp-plan-duration"><?= (int) $plan->duration_days; ?> days validity</p>

                                <div class="bp-price-row">
                                    <?php if ($plan->price == 0): ?>
                                        <span class="bp-price-amount">Free</span>
                                    <?php else: ?>
                                        <span class="bp-price-currency">₹</span>
                                        <span class="bp-price-amount"><?= number_format($plan->price, 0); ?></span>
                                    <?php endif; ?>
                                </div>

                                <hr class="bp-divider">

                                <ul class="bp-feature-list">
                                    <?php
                                    $features = explode("\n", $plan->description);
                                    foreach ($features as $feature):
                                        $feature = trim($feature);
                                        if ($feature === '') continue;
                                    ?>
                                        <li>
                                            <i class="bx bx-check-circle"></i>
                                            <span><?= htmlspecialchars($feature); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <?php if ($isActiveSub): ?>
                                    <button class="bp-btn bp-btn-outline" disabled>
                                        <i class="bx bx-check me-1"></i> Current Plan
                                    </button>
                                <?php elseif ($plan->price == 0): ?>
                                    <button class="bp-btn bp-btn-light" disabled>
                                        Not Available
                                    </button>
                                <?php else: ?>
                                    <button class="bp-btn bp-btn-primary btn-buy-plan"
                                        data-id="<?= (int) $plan->id; ?>"
                                        data-name="<?= htmlspecialchars($plan->name); ?>"
                                        data-price="<?= (float) $plan->price; ?>">
                                        <span class="bp-btn-label">Get Started</span>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="bp-empty-state">
                        <i class="bx bx-package"></i>
                        <p class="mb-0">No active pricing plans configured by administrator.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Razorpay Script & Trigger -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        const razorpayKey = '<?= $this->config->item('razorpay_key_id') ?>';
        const businessName = '<?= $this->config->item('razorpay_company_name') ?>';
        const logoUrl = '<?= $this->config->item('razorpay_logo_url') ?>';
        const themeColor = '<?= $this->config->item('razorpay_theme_color') ?>';

        const adminName = '<?= htmlspecialchars($this->session->userdata('admin')['user_name'] ?? 'Guest') ?>';
        const adminMobile = '<?= htmlspecialchars($this->session->userdata('admin')['mobile'] ?? '') ?>';

        function setButtonLoading($btn, isLoading) {
            if (isLoading) {
                $btn.data('original-text', $btn.find('.bp-btn-label').text());
                $btn.prop('disabled', true).addClass('bp-btn--loading');
                $btn.find('.bp-btn-label').html('<i class="bx bx-loader-alt bx-spin"></i> Please wait');
            } else {
                $btn.prop('disabled', false).removeClass('bp-btn--loading');
                $btn.find('.bp-btn-label').text($btn.data('original-text') || 'Get Started');
            }
        }

        $('.btn-buy-plan').on('click', function() {
            const $btn = $(this);
            if ($btn.prop('disabled')) return;

            const planId = $btn.data('id');
            const planName = $btn.data('name');
            const planPrice = parseFloat($btn.data('price'));

            setButtonLoading($btn, true);

            const options = {
                "key": razorpayKey,
                "amount": Math.round(planPrice * 100), // Amount in paise
                "currency": "INR",
                "name": businessName,
                "description": planName + " Subscription Plan",
                "image": logoUrl,
                "handler": function(response) {
                    Swal.fire({
                        title: "Verifying Payment...",
                        text: "Please wait while we verify your transaction.",
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading(),
                    });

                    $.ajax({
                        url: "<?= base_url('dashboard/verify_payment') ?>",
                        type: "POST",
                        dataType: "json",
                        data: {
                            razorpay_payment_id: response.razorpay_payment_id,
                            plan_id: planId
                        },
                        success: function(res) {
                            Swal.close();
                            if (res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Payment Successful!',
                                    text: res.message,
                                    confirmButtonText: 'Go to Dashboard'
                                }).then(() => {
                                    window.location.href = "<?= base_url('dashboard') ?>";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Verification Failed',
                                    text: res.message
                                });
                                setButtonLoading($btn, false);
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Failed to verify payment. Please contact support.'
                            });
                            setButtonLoading($btn, false);
                        }
                    });
                },
                "modal": {
                    "ondismiss": function() {
                        setButtonLoading($btn, false);
                    }
                },
                "prefill": {
                    "name": adminName,
                    "contact": adminMobile
                },
                "theme": {
                    "color": themeColor
                }
            };

            const rzp = new Razorpay(options);
            rzp.on('payment.failed', function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Payment Failed',
                    text: response.error.description
                });
                setButtonLoading($btn, false);
            });
            rzp.open();
        });
    });
</script>

<style>
    .bp-page {
        --bp-primary: #6366f1;
        --bp-primary-dark: #4f46e5;
        --bp-primary-soft: rgba(99, 102, 241, 0.10);
        --bp-text-dark: #1e293b;
        --bp-text-muted: #64748b;
        --bp-border: #e9ecf3;
        --bp-radius-lg: 18px;
        --bp-radius-md: 12px;
        --bp-shadow-sm: 0 1px 3px rgba(15, 23, 42, 0.06);
        --bp-shadow-md: 0 10px 25px -8px rgba(15, 23, 42, 0.12);
        --bp-shadow-active: 0 10px 25px -6px rgba(99, 102, 241, 0.25);
    }

    /* ---------- Alerts ---------- */
    .bp-alert {
        border-radius: var(--bp-radius-md);
    }

    .bp-alert-icon {
        font-size: 1.75rem;
        line-height: 1;
        display: flex;
        align-items: center;
    }

    /* ---------- Banner ---------- */
    .bp-banner {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.5rem;
        border-radius: var(--bp-radius-lg);
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        box-shadow: var(--bp-shadow-sm);
    }

    .bp-banner--active {
        border: 1px solid var(--bp-border);
    }

    .bp-banner--empty {
        border: 1px solid #fde2e2;
        background: linear-gradient(135deg, #fff7f7, #fef2f2);
    }

    .bp-banner-left {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .bp-banner-icon {
        flex-shrink: 0;
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        background: var(--bp-primary-soft);
        color: var(--bp-primary);
    }

    .bp-banner--empty .bp-banner-icon {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .bp-eyebrow {
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-weight: 700;
        font-size: 0.72rem;
        color: var(--bp-primary);
    }

    .bp-banner--empty .bp-eyebrow {
        color: #ef4444;
    }

    .bp-banner-title {
        margin: 0.2rem 0 0.15rem;
        font-weight: 700;
        font-size: 1.3rem;
        color: var(--bp-text-dark);
    }

    .bp-banner-title--danger {
        color: #dc2626;
    }

    .bp-banner-sub {
        margin: 0;
        font-size: 0.875rem;
        color: var(--bp-text-muted);
    }

    .bp-days-pill {
        background: #fff;
        border: 1px solid var(--bp-border);
        border-radius: 999px;
        padding: 0.5rem 1.25rem;
        text-align: center;
        box-shadow: var(--bp-shadow-sm);
    }

    .bp-days-pill span {
        display: block;
        font-size: 0.72rem;
        color: var(--bp-text-muted);
    }

    .bp-days-pill strong {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bp-primary);
    }

    /* ---------- Pricing cards ---------- */
    .bp-card {
        position: relative;
        height: 100%;
        background: #fff;
        border: 1px solid var(--bp-border);
        border-radius: var(--bp-radius-lg);
        box-shadow: var(--bp-shadow-sm);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        overflow: hidden;
    }

    .bp-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--bp-shadow-md);
        border-color: #dfe3f5;
    }

    .bp-card--active {
        border: 2px solid var(--bp-primary);
        box-shadow: var(--bp-shadow-active);
    }

    .bp-card--active:hover {
        transform: translateY(-6px);
    }

    .bp-ribbon {
        position: absolute;
        top: 14px;
        right: -34px;
        background: linear-gradient(135deg, var(--bp-primary), var(--bp-primary-dark));
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.3rem 2.5rem;
        transform: rotate(40deg);
        box-shadow: 0 4px 10px rgba(99, 102, 241, 0.35);
    }

    .bp-card-body {
        padding: 1.75rem;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .bp-icon-tile {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: var(--bp-primary-soft);
        color: var(--bp-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    .bp-badge-free {
        background: #16a34a;
        color: #fff;
        border-radius: 999px;
        padding: 0.35rem 0.75rem;
        font-weight: 600;
        font-size: 0.72rem;
    }

    .bp-plan-name {
        font-weight: 700;
        color: var(--bp-text-dark);
        margin-bottom: 0.15rem;
        font-size: 1.2rem;
    }

    .bp-plan-duration {
        color: var(--bp-text-muted);
        font-size: 0.82rem;
        margin-bottom: 1.1rem;
    }

    .bp-price-row {
        display: flex;
        align-items: flex-end;
        gap: 0.25rem;
        margin-bottom: 1.1rem;
    }

    .bp-price-currency {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--bp-text-dark);
        padding-bottom: 0.3rem;
    }

    .bp-price-amount {
        font-size: clamp(1.8rem, 4vw, 2.4rem);
        font-weight: 800;
        color: var(--bp-text-dark);
        line-height: 1;
    }

    .bp-divider {
        border: none;
        border-top: 1px solid var(--bp-border);
        margin: 0 0 1.1rem;
    }

    .bp-feature-list {
        list-style: none;
        padding: 0;
        margin: 0 0 1.25rem;
        flex-grow: 1;
    }

    .bp-feature-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.6rem;
        margin-bottom: 0.7rem;
        font-size: 0.875rem;
        color: var(--bp-text-dark);
        line-height: 1.45;
    }

    .bp-feature-list li i {
        color: var(--bp-primary);
        font-size: 1.05rem;
        line-height: 1.4;
        flex-shrink: 0;
    }

    .bp-btn {
        width: 100%;
        border: none;
        border-radius: var(--bp-radius-md);
        padding: 0.75rem 1rem;
        font-weight: 700;
        font-size: 0.92rem;
        min-height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        transition: filter 0.2s ease, opacity 0.2s ease, transform 0.1s ease;
        cursor: pointer;
    }

    .bp-btn:active {
        transform: scale(0.98);
    }

    .bp-btn:focus-visible {
        outline: 2px solid var(--bp-primary);
        outline-offset: 2px;
    }

    .bp-btn-primary {
        background: linear-gradient(135deg, var(--bp-primary), var(--bp-primary-dark));
        color: #fff;
    }

    .bp-btn-primary:hover:not(:disabled) {
        filter: brightness(1.06);
    }

    .bp-btn-outline {
        background: #fff;
        color: var(--bp-primary);
        border: 1.5px solid var(--bp-primary);
        opacity: 0.85;
        cursor: default;
    }

    .bp-btn-light {
        background: #f1f3f9;
        color: var(--bp-text-muted);
        cursor: not-allowed;
    }

    .bp-btn:disabled {
        cursor: not-allowed;
    }

    .bp-btn--loading {
        opacity: 0.85;
    }

    /* ---------- Empty state ---------- */
    .bp-empty-state {
        text-align: center;
        padding: 3.5rem 1.5rem;
        border: 1.5px dashed var(--bp-border);
        border-radius: var(--bp-radius-lg);
        color: var(--bp-text-muted);
    }

    .bp-empty-state i {
        font-size: 2.5rem;
        display: block;
        margin-bottom: 0.75rem;
        color: #c7cce0;
    }

    /* ---------- Motion ---------- */
    .bp-fade-in {
        animation: bpFadeUp 0.45s ease both;
    }

    @keyframes bpFadeUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .bp-fade-in,
        .bp-card {
            animation: none !important;
            transition: none !important;
        }
    }

    /* ---------- Mobile ---------- */
    @media (max-width: 575.98px) {
        .bp-banner {
            padding: 1.1rem;
            flex-direction: column;
            align-items: stretch;
        }

        .bp-banner-left {
            gap: 0.75rem;
        }

        .bp-banner-title {
            font-size: 1.1rem;
        }

        .bp-days-pill {
            width: 100%;
        }

        .bp-card-body {
            padding: 1.4rem;
        }

        .bp-ribbon {
            right: -38px;
            top: 12px;
            font-size: 0.65rem;
            padding: 0.28rem 2.4rem;
        }

        .breadcrumb-title {
            font-size: 1rem;
        }
    }
</style>