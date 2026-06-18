<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style>
    /* ============================================================
   BILLING & PLANS - ENHANCED UI (LIGHT THEME)
   ============================================================ */
    :root {
        --bp-primary: #4f46e5;
        --bp-primary-light: #818cf8;
        --bp-primary-soft: rgba(79, 70, 229, 0.08);
        --bp-primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --bp-success: #10b981;
        --bp-success-soft: rgba(16, 185, 129, 0.10);
        --bp-danger: #ef4444;
        --bp-danger-soft: rgba(239, 68, 68, 0.08);
        --bp-warning: #f59e0b;
        --bp-text-dark: #0f172a;
        --bp-text-body: #1e293b;
        --bp-text-muted: #64748b;
        --bp-text-light: #94a3b8;
        --bp-border: #e2e8f0;
        --bp-border-light: #f1f5f9;
        --bp-bg: #f8fafc;
        --bp-white: #ffffff;
        --bp-radius-xl: 24px;
        --bp-radius-lg: 18px;
        --bp-radius-md: 14px;
        --bp-radius-sm: 10px;
        --bp-shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06);
        --bp-shadow-md: 0 10px 40px -12px rgba(0, 0, 0, 0.10);
        --bp-shadow-lg: 0 20px 60px -15px rgba(0, 0, 0, 0.12);
        --bp-shadow-active: 0 15px 45px -10px rgba(79, 70, 229, 0.20);
        --bp-transition: 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ---------- Page Container ---------- */
    .bp-page {
        padding-bottom: 2rem;
        background: var(--bp-bg);
    }

    /* ---------- Breadcrumb ---------- */
    .bp-breadcrumb .breadcrumb-title {
        font-weight: 800;
        font-size: 1.85rem;
        letter-spacing: -0.03em;
        color: var(--bp-text-dark);
    }

    .bp-breadcrumb .breadcrumb-title .bp-highlight {
        background: var(--bp-primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .bp-breadcrumb .breadcrumb-item a {
        color: var(--bp-text-muted);
        text-decoration: none;
        transition: color var(--bp-transition);
        font-weight: 500;
    }

    .bp-breadcrumb .breadcrumb-item a:hover {
        color: var(--bp-primary);
    }

    .bp-breadcrumb .breadcrumb-item.active {
        color: var(--bp-text-dark);
        font-weight: 600;
    }

    /* ---------- Alerts ---------- */
    .bp-alert {
        border-radius: var(--bp-radius-md);
        border: none !important;
        padding: 1rem 1.5rem;
        box-shadow: var(--bp-shadow-sm);
    }

    .bp-alert-success {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%) !important;
        border-left: 4px solid var(--bp-success) !important;
    }

    .bp-alert-error {
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%) !important;
        border-left: 4px solid var(--bp-danger) !important;
    }

    .bp-alert-icon {
        font-size: 1.75rem;
        line-height: 1;
        display: flex;
        align-items: center;
    }

    .bp-alert-success .bp-alert-icon {
        color: var(--bp-success);
    }

    .bp-alert-error .bp-alert-icon {
        color: var(--bp-danger);
    }

    .bp-alert-title {
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 0.1rem;
    }

    .bp-alert-success .bp-alert-title {
        color: #065f46;
    }

    .bp-alert-error .bp-alert-title {
        color: #991b1b;
    }

    .bp-alert-text {
        font-size: 0.88rem;
        opacity: 0.9;
    }

    /* ---------- Banner ---------- */
    .bp-banner {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
        padding: 1.75rem 2rem;
        border-radius: var(--bp-radius-lg);
        background: var(--bp-white);
        border: 1px solid var(--bp-border);
        box-shadow: var(--bp-shadow-sm);
        transition: all var(--bp-transition);
        position: relative;
        overflow: hidden;
    }

    .bp-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--bp-primary-gradient);
        opacity: 0;
        transition: opacity var(--bp-transition);
    }

    .bp-banner--active::before {
        opacity: 1;
    }

    .bp-banner--active {
        border-color: var(--bp-primary);
        box-shadow: var(--bp-shadow-active);
        background: linear-gradient(135deg, #faf9ff 0%, #f3f0ff 100%);
    }

    .bp-banner--empty {
        border-color: #fca5a5;
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
    }

    .bp-banner--empty::before {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        opacity: 1;
    }

    .bp-banner-left {
        display: flex;
        align-items: flex-start;
        gap: 1.25rem;
    }

    .bp-banner-icon {
        flex-shrink: 0;
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        background: var(--bp-primary-soft);
        color: var(--bp-primary);
        transition: transform var(--bp-transition);
    }

    .bp-banner--active .bp-banner-icon {
        animation: bpPulse 2s ease-in-out infinite;
    }

    .bp-banner--empty .bp-banner-icon {
        background: var(--bp-danger-soft);
        color: var(--bp-danger);
    }

    @keyframes bpPulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .bp-eyebrow {
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 700;
        font-size: 0.7rem;
        color: var(--bp-primary);
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.15rem 0.75rem;
        border-radius: 999px;
        background: var(--bp-primary-soft);
    }

    .bp-banner--empty .bp-eyebrow {
        background: var(--bp-danger-soft);
        color: var(--bp-danger);
    }

    .bp-banner-title {
        margin: 0.3rem 0 0.15rem;
        font-weight: 800;
        font-size: 1.4rem;
        color: var(--bp-text-dark);
        letter-spacing: -0.02em;
    }

    .bp-banner-title--danger {
        color: var(--bp-danger);
    }

    .bp-banner-sub {
        margin: 0;
        font-size: 0.92rem;
        color: var(--bp-text-muted);
    }

    .bp-banner-sub strong {
        color: var(--bp-text-dark);
    }

    .bp-days-pill {
        background: var(--bp-white);
        border: 2px solid var(--bp-primary);
        border-radius: 999px;
        padding: 0.5rem 1.5rem;
        text-align: center;
        min-width: 100px;
        box-shadow: var(--bp-shadow-sm);
        position: relative;
    }

    .bp-days-pill span {
        display: block;
        font-size: 0.65rem;
        font-weight: 600;
        color: var(--bp-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .bp-days-pill strong {
        font-size: 2rem;
        font-weight: 800;
        color: var(--bp-primary);
        line-height: 1.2;
    }

    /* ---------- Header Section ---------- */
    .bp-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .bp-header h2 {
        font-weight: 800;
        font-size: 2.25rem;
        letter-spacing: -0.03em;
        color: var(--bp-text-dark);
        margin-bottom: 0.5rem;
    }

    .bp-header h2 .bp-highlight {
        background: var(--bp-primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .bp-header p {
        color: var(--bp-text-muted);
        font-size: 1.05rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* ---------- Pricing Cards ---------- */
    .bp-card {
        position: relative;
        height: 100%;
        background: var(--bp-white);
        border: 2px solid var(--bp-border);
        border-radius: var(--bp-radius-xl);
        box-shadow: var(--bp-shadow-sm);
        transition: all var(--bp-transition);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .bp-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--bp-primary-gradient);
        opacity: 0;
        transition: opacity var(--bp-transition);
    }

    .bp-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--bp-shadow-lg);
        border-color: #c7d2fe;
    }

    .bp-card:hover::before {
        opacity: 1;
    }

    .bp-card--active {
        border-color: var(--bp-primary);
        box-shadow: var(--bp-shadow-active);
        transform: translateY(-4px);
    }

    .bp-card--active::before {
        opacity: 1;
    }

    .bp-card--active:hover {
        transform: translateY(-10px);
        box-shadow: var(--bp-shadow-lg);
    }

    /* Popular Badge */
    .bp-popular {
        position: absolute;
        top: 16px;
        right: 16px;
        background: var(--bp-primary-gradient);
        color: #fff;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.3rem 1rem;
        border-radius: 999px;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.30);
        animation: bpPop 2s ease-in-out infinite;
    }

    @keyframes bpPop {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    /* Active Ribbon */
    .bp-ribbon {
        position: absolute;
        top: 18px;
        right: -36px;
        background: var(--bp-primary-gradient);
        color: #fff;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 0.3rem 2.8rem;
        transform: rotate(40deg);
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.25);
        letter-spacing: 0.04em;
        text-transform: uppercase;
        z-index: 2;
    }

    .bp-ribbon i {
        margin-right: 4px;
    }

    /* Card Body */
    .bp-card-body {
        padding: 2rem 1.75rem 1.75rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .bp-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }

    .bp-icon-tile {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: var(--bp-primary-soft);
        color: var(--bp-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: all var(--bp-transition);
    }

    .bp-card:hover .bp-icon-tile {
        transform: scale(1.05) rotate(-5deg);
        background: var(--bp-primary-gradient);
        color: #fff;
    }

    .bp-badge-free {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        border-radius: 999px;
        padding: 0.35rem 0.9rem;
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }

    .bp-plan-name {
        font-weight: 800;
        color: var(--bp-text-dark);
        margin-bottom: 0.1rem;
        font-size: 1.3rem;
        letter-spacing: -0.02em;
    }

    .bp-plan-duration {
        color: var(--bp-text-muted);
        font-size: 0.85rem;
        margin-bottom: 1.25rem;
    }

    .bp-plan-duration i {
        margin-right: 4px;
    }

    /* Price */
    .bp-price-row {
        display: flex;
        align-items: flex-end;
        gap: 0.25rem;
        margin-bottom: 1.25rem;
        padding: 0.75rem 0;
        border-top: 2px solid var(--bp-border-light);
        border-bottom: 2px solid var(--bp-border-light);
    }

    .bp-price-currency {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--bp-text-dark);
        padding-bottom: 0.25rem;
    }

    .bp-price-amount {
        font-size: clamp(2rem, 4vw, 2.75rem);
        font-weight: 900;
        color: var(--bp-text-dark);
        line-height: 1;
        letter-spacing: -0.02em;
    }

    .bp-price-period {
        font-size: 0.85rem;
        color: var(--bp-text-muted);
        padding-bottom: 0.35rem;
        margin-left: 0.25rem;
    }

    .bp-price-free {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--bp-success);
    }

    /* Features */
    .bp-feature-list {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem;
        flex: 1;
    }

    .bp-feature-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.7rem;
        padding: 0.4rem 0;
        font-size: 0.88rem;
        color: var(--bp-text-body);
        line-height: 1.5;
        border-bottom: 1px solid var(--bp-border-light);
    }

    .bp-feature-list li:last-child {
        border-bottom: none;
    }

    .bp-feature-list li i {
        color: var(--bp-primary);
        font-size: 1.1rem;
        line-height: 1.5;
        flex-shrink: 0;
        margin-top: 0.05rem;
    }

    .bp-feature-list li .bp-feature-muted {
        color: var(--bp-text-muted);
    }

    /* Buttons */
    .bp-btn {
        width: 100%;
        border: none;
        border-radius: var(--bp-radius-md);
        padding: 0.85rem 1rem;
        font-weight: 700;
        font-size: 0.95rem;
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all var(--bp-transition);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .bp-btn::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transition: width 0.6s ease, height 0.6s ease;
        transform: translate(-50%, -50%);
    }

    .bp-btn:active::after {
        width: 300px;
        height: 300px;
    }

    .bp-btn-primary {
        background: var(--bp-primary-gradient);
        color: #fff;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.30);
    }

    .bp-btn-primary:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(79, 70, 229, 0.40);
    }

    .bp-btn-primary:active:not(:disabled) {
        transform: translateY(0);
    }

    .bp-btn-outline {
        background: var(--bp-primary-soft);
        color: var(--bp-primary);
        border: 2px solid var(--bp-primary);
        opacity: 0.7;
        cursor: default;
    }

    .bp-btn-light {
        background: #f1f5f9;
        color: var(--bp-text-muted);
        cursor: not-allowed;
        opacity: 0.6;
    }

    .bp-btn:disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }

    .bp-btn--loading {
        opacity: 0.8;
    }

    .bp-btn .bp-btn-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* ---------- Savings Badge ---------- */
    .bp-savings {
        display: inline-block;
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #92400e;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.2rem 0.8rem;
        border-radius: 999px;
        margin-top: 0.5rem;
    }

    /* ---------- Trust Footer ---------- */
    .bp-trust-footer {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
        padding: 1.5rem;
        background: var(--bp-white);
        border-radius: var(--bp-radius-lg);
        border: 1px solid var(--bp-border);
        box-shadow: var(--bp-shadow-sm);
    }

    .bp-trust-footer .bp-trust-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--bp-text-muted);
        font-size: 0.85rem;
        font-weight: 500;
    }

    .bp-trust-footer .bp-trust-item i {
        color: var(--bp-primary);
        font-size: 1.2rem;
    }

    /* ---------- Empty State ---------- */
    .bp-empty-state {
        text-align: center;
        padding: 4rem 2rem;
        border: 2px dashed var(--bp-border);
        border-radius: var(--bp-radius-xl);
        background: var(--bp-white);
    }

    .bp-empty-state i {
        font-size: 3.5rem;
        display: block;
        margin-bottom: 1rem;
        color: #c7d2fe;
    }

    .bp-empty-state h5 {
        color: var(--bp-text-dark);
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .bp-empty-state p {
        color: var(--bp-text-muted);
    }

    /* ---------- Animations ---------- */
    .bp-fade-in {
        animation: bpFadeUp 0.5s ease both;
    }

    @keyframes bpFadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 991.98px) {
        .bp-header h2 {
            font-size: 1.75rem;
        }

        .bp-banner {
            padding: 1.25rem 1.5rem;
        }

        .bp-banner-title {
            font-size: 1.15rem;
        }
    }

    @media (max-width: 767.98px) {
        .bp-breadcrumb .breadcrumb-title {
            font-size: 1.4rem;
        }

        .bp-banner {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }

        .bp-banner-left {
            gap: 0.75rem;
        }

        .bp-banner-icon {
            width: 44px;
            height: 44px;
            font-size: 1.25rem;
        }

        .bp-days-pill {
            width: 100%;
            min-width: unset;
        }

        .bp-days-pill strong {
            font-size: 1.5rem;
        }

        .bp-header h2 {
            font-size: 1.4rem;
        }

        .bp-header p {
            font-size: 0.92rem;
        }

        .bp-card-body {
            padding: 1.25rem;
        }

        .bp-price-amount {
            font-size: 1.75rem;
        }

        .bp-ribbon {
            right: -32px;
            top: 14px;
            font-size: 0.55rem;
            padding: 0.25rem 2.2rem;
        }

        .bp-trust-footer {
            flex-direction: column;
            gap: 0.75rem;
        }
    }

    @media (max-width: 575.98px) {
        .bp-breadcrumb .breadcrumb-title {
            font-size: 1.2rem;
        }

        .bp-banner {
            padding: 1rem;
        }

        .bp-banner-title {
            font-size: 1rem;
        }

        .bp-feature-list li {
            font-size: 0.82rem;
        }

        .bp-btn {
            font-size: 0.85rem;
            min-height: 44px;
            padding: 0.65rem 1rem;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content bp-page">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb bp-breadcrumb d-flex flex-wrap align-items-center mb-4">
            <div class="breadcrumb-title pe-3">
                Billing &amp; <span class="bp-highlight">Plans</span>
            </div>
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
            <div class="alert bp-alert bp-alert-success alert-dismissible fade show py-2 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bp-alert-icon"><i class="bx bxs-check-circle"></i></div>
                    <div class="ms-3">
                        <h6 class="bp-alert-title">Success!</h6>
                        <div class="bp-alert-text"><?= $this->session->flashdata('success'); ?></div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert bp-alert bp-alert-error alert-dismissible fade show py-2 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <div class="bp-alert-icon"><i class="bx bxs-x-circle"></i></div>
                    <div class="ms-3">
                        <h6 class="bp-alert-title">Error!</h6>
                        <div class="bp-alert-text"><?= $this->session->flashdata('error'); ?></div>
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
                    <span class="bp-eyebrow">
                        <i class="bx <?= $has_plan ? 'bx-check-circle' : 'bx-x-circle'; ?> me-1"></i>
                        <?= $has_plan ? 'Active Subscription' : 'No Active Subscription'; ?>
                    </span>
                    <?php if ($has_plan): ?>
                        <h3 class="bp-banner-title"><?= htmlspecialchars($plan_name); ?></h3>
                        <p class="bp-banner-sub">
                            <i class="bx bx-calendar me-1"></i>
                            Expires in <strong><?= (int) $days_left; ?> day<?= ((int) $days_left === 1) ? '' : 's'; ?></strong>
                            on <strong><?= date('d M Y', strtotime($end_date)); ?></strong>
                        </p>
                    <?php else: ?>
                        <h3 class="bp-banner-title bp-banner-title--danger">No Active Plan</h3>
                        <p class="bp-banner-sub">Choose a plan below to unlock full access to your dashboard.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($has_plan): ?>
                <div class="bp-days-pill">
                    <span><i class="bx bx-timer me-1"></i> Days Remaining</span>
                    <strong><?= (int) $days_left; ?></strong>
                </div>
            <?php endif; ?>
        </div>

        <!-- Header -->
        <div class="bp-header bp-fade-in">
            <h2>
                Choose Your <span class="bp-highlight">Perfect Plan</span>
            </h2>
            <p>All plans include full access to every premium feature. Select the duration that fits your business needs.</p>
        </div>

        <!-- Pricing Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4 align-items-stretch">
            <?php if (!empty($plans)): ?>
                <?php
                $planCount = count($plans);
                $popularIndex = floor($planCount / 2);
                foreach ($plans as $index => $plan):
                    $isActiveSub = ($plan_name === $plan->name && $has_plan);
                    $isPopular = ($index === $popularIndex && $plan->price > 0);
                    $isFree = ($plan->price == 0);
                    $savings = ($plan->duration_days >= 180) ? 'Save 20%' : '';
                ?>
                    <div class="col bp-fade-in" style="animation-delay: <?= $index * 0.08; ?>s;">
                        <div class="bp-card <?= $isActiveSub ? 'bp-card--active' : ''; ?>">
                            <?php if ($isPopular && !$isActiveSub): ?>
                                <span class="bp-popular"><i class="bx bx-star me-1"></i> Popular</span>
                            <?php endif; ?>

                            <?php if ($isActiveSub): ?>
                                <span class="bp-ribbon"><i class="bx bx-check"></i> Active Plan</span>
                            <?php endif; ?>

                            <div class="bp-card-body">
                                <div class="bp-card-top">
                                    <div class="bp-icon-tile">
                                        <?php if ($isFree): ?>
                                            <i class="bx bx-gift"></i>
                                        <?php elseif ($plan->duration_days <= 30): ?>
                                            <i class="bx bx-rocket"></i>
                                        <?php elseif ($plan->duration_days <= 90): ?>
                                            <i class="bx bx-trending-up"></i>
                                        <?php else: ?>
                                            <i class="bx bx-award"></i>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($isFree): ?>
                                        <span class="bp-badge-free"><i class="bx bx-check me-1"></i> Free</span>
                                    <?php endif; ?>
                                </div>

                                <h4 class="bp-plan-name"><?= htmlspecialchars($plan->name); ?></h4>
                                <p class="bp-plan-duration">
                                    <i class="bx bx-calendar"></i> <?= (int) $plan->duration_days; ?> days validity
                                </p>

                                <div class="bp-price-row">
                                    <?php if ($plan->price == 0): ?>
                                        <span class="bp-price-free">Free</span>
                                        <span class="bp-price-period">forever</span>
                                    <?php else: ?>
                                        <span class="bp-price-currency">₹</span>
                                        <span class="bp-price-amount"><?= number_format($plan->price, 0); ?></span>
                                        <span class="bp-price-period">/ <?= (int) $plan->duration_days; ?> days</span>
                                    <?php endif; ?>
                                </div>

                                <?php if ($savings && !$isFree): ?>
                                    <span class="bp-savings"><i class="bx bx-trending-down me-1"></i> <?= $savings; ?></span>
                                <?php endif; ?>

                                <ul class="bp-feature-list">
                                    <?php
                                    $features = explode("\n", $plan->description);
                                    $displayFeatures = array_slice($features, 0, 4);
                                    foreach ($displayFeatures as $feature):
                                        $feature = trim($feature);
                                        if ($feature === '') continue;
                                    ?>
                                        <li>
                                            <i class="bx bx-check-circle"></i>
                                            <span><?= htmlspecialchars($feature); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                    <?php if (count($features) > 4): ?>
                                        <li style="color: var(--bp-text-muted); font-size: 0.8rem; justify-content: center; border: none;">
                                            + <?= count($features) - 4; ?> more features
                                        </li>
                                    <?php endif; ?>
                                </ul>

                                <?php if ($isActiveSub): ?>
                                    <button class="bp-btn bp-btn-outline" disabled>
                                        <i class="bx bx-check-circle me-1"></i> Current Plan
                                    </button>
                                <?php elseif ($isFree): ?>
                                    <button class="bp-btn bp-btn-light" disabled>
                                        <i class="bx bx-lock me-1"></i> Not Available
                                    </button>
                                <?php else: ?>
                                    <button class="bp-btn bp-btn-primary btn-buy-plan"
                                        data-id="<?= (int) $plan->id; ?>"
                                        data-name="<?= htmlspecialchars($plan->name); ?>"
                                        data-price="<?= (float) $plan->price; ?>">
                                        <span class="bp-btn-label">
                                            <i class="bx bx-rocket"></i>
                                            Get Started
                                        </span>
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
                        <h5>No Plans Available</h5>
                        <p>No active pricing plans have been configured by the administrator.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Trust Footer -->
        <div class="mt-5 bp-fade-in" style="animation-delay: 0.6s;">
            <div class="bp-trust-footer">
                <div class="bp-trust-item">
                    <i class="bx bx-shield-alt"></i>
                    <span>Secure payments by Razorpay</span>
                </div>
                <div class="bp-trust-item">
                    <i class="bx bx-support"></i>
                    <span>24/7 customer support</span>
                </div>
                <div class="bp-trust-item">
                    <i class="bx bx-check-shield"></i>
                    <span>Cancel anytime</span>
                </div>
                <div class="bp-trust-item">
                    <i class="bx bx-refresh"></i>
                    <span>30-day money-back guarantee</span>
                </div>
            </div>
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
                $btn.data('original-text', $btn.find('.bp-btn-label').html());
                $btn.prop('disabled', true).addClass('bp-btn--loading');
                $btn.find('.bp-btn-label').html('<i class="bx bx-loader-alt bx-spin"></i> Processing...');
            } else {
                $btn.prop('disabled', false).removeClass('bp-btn--loading');
                $btn.find('.bp-btn-label').html($btn.data('original-text') || '<i class="bx bx-rocket"></i> Get Started');
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
                "amount": Math.round(planPrice * 100),
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
                                    title: '🎉 Payment Successful!',
                                    text: res.message,
                                    confirmButtonText: 'Go to Dashboard',
                                    confirmButtonColor: '#4f46e5',
                                }).then(() => {
                                    window.location.href = "<?= base_url('dashboard') ?>";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Verification Failed',
                                    text: res.message,
                                    confirmButtonColor: '#ef4444',
                                });
                                setButtonLoading($btn, false);
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Failed to verify payment. Please contact support.',
                                confirmButtonColor: '#ef4444',
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
                    "color": themeColor || '#4f46e5'
                }
            };

            const rzp = new Razorpay(options);
            rzp.on('payment.failed', function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Payment Failed',
                    text: response.error.description || 'Something went wrong. Please try again.',
                    confirmButtonColor: '#ef4444',
                });
                setButtonLoading($btn, false);
            });
            rzp.open();
        });
    });
</script>