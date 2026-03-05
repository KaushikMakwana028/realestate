<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">UPAD History</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-12 col-md-4">
                <div class="upad-stat upad-stat--count">
                    <div class="upad-stat__icon"><i class="bx bx-receipt"></i></div>
                    <div>
                        <div class="upad-stat__value" id="upadStatCount">0</div>
                        <div class="upad-stat__label">Total Records</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="upad-stat upad-stat--amount">
                    <div class="upad-stat__icon"><i class="bx bx-rupee"></i></div>
                    <div>
                        <div class="upad-stat__value" id="upadStatAmount">INR 0</div>
                        <div class="upad-stat__label">Total UPAD Amount</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="upad-stat upad-stat--latest">
                    <div class="upad-stat__icon"><i class="bx bx-time-five"></i></div>
                    <div>
                        <div class="upad-stat__value upad-stat__value--small" id="upadStatLatest">-</div>
                        <div class="upad-stat__label">Latest Entry</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm upad-card">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="upad-header-icon">
                            <i class="bx bx-wallet"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold text-dark">UPAD Records</h5>
                            <small class="text-muted">User advance payment history</small>
                        </div>
                    </div>

                    <div class="search-box position-relative">
                        <i class="bx bx-search search-icon"></i>
                        <input type="text" id="serchupad" class="form-control search-input" placeholder="Search name, amount, notes...">
                        <input type="hidden" id="user_id" value="<?= $user_id ?>">
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table upad-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>UPAD Amount</th>
                                <th>Given At</th>
                                <th>Notes</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="upad_table"></tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white border-top py-3">
                <nav aria-label="UPAD pagination">
                    <ul class="pagination upad-pagination justify-content-center mb-0"></ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>
    .upad-stat {
        border: 1px solid #e7edf7;
        border-radius: 14px;
        background: #fff;
        padding: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        min-height: 82px;
        box-shadow: 0 2px 8px rgba(16, 24, 40, 0.03);
    }

    .upad-stat__icon {
        width: 42px;
        height: 42px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        flex-shrink: 0;
    }

    .upad-stat--count .upad-stat__icon {
        background: linear-gradient(135deg, #0f3460, #204a78);
    }

    .upad-stat--amount .upad-stat__icon {
        background: linear-gradient(135deg, #027a48, #039855);
    }

    .upad-stat--latest .upad-stat__icon {
        background: linear-gradient(135deg, #b54708, #dc6803);
    }

    .upad-stat__value {
        color: #1d2939;
        font-size: 20px;
        font-weight: 800;
        line-height: 1.1;
    }

    .upad-stat__value--small {
        font-size: 15px;
        font-weight: 700;
    }

    .upad-stat__label {
        color: #667085;
        font-size: 12px;
        font-weight: 600;
    }

    .upad-header-icon {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #1a1a2e, #0f3460);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        flex-shrink: 0;
    }

    .search-box {
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        font-size: 16px;
        z-index: 1;
    }

    .search-input {
        padding-left: 36px;
        border-radius: 25px;
        border: 1.5px solid #dde3f0;
        font-size: 13px;
        height: 38px;
        width: 250px;
        transition: all 0.2s;
        background: #f8f9ff;
    }

    .search-input:focus {
        border-color: #0f3460;
        box-shadow: 0 0 0 3px rgba(15, 52, 96, 0.1);
        background: #fff;
    }

    .upad-table thead th {
        background: linear-gradient(180deg, #f8faff 0%, #f3f7fd 100%);
        color: #344054;
        font-size: 12px;
        font-weight: 700;
        border-bottom: 1px solid #e8eef8;
        padding: 12px 14px;
        white-space: nowrap;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .upad-table tbody td {
        padding: 14px;
        vertical-align: middle;
        border-color: #eef2f7;
    }

    .upad-table tbody tr:hover {
        background: #f9fbff;
    }

    .upad-index {
        display: inline-flex;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        background: #eef4ff;
        color: #0f3460;
        font-weight: 700;
        font-size: 12px;
    }

    .upad-user {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .upad-user__avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0f3460, #2563eb);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .upad-user__name {
        font-weight: 700;
        color: #1d2939;
        font-size: 13px;
    }

    .upad-amount {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #027a48;
        font-weight: 700;
        font-size: 13px;
        background: #ecfdf3;
        border: 1px solid #abefc6;
        border-radius: 20px;
        padding: 5px 10px;
    }

    .upad-date {
        font-size: 13px;
        color: #344054;
        font-weight: 600;
    }

    .upad-note {
        color: #667085;
        font-size: 13px;
        white-space: nowrap;
        max-width: 220px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .upad-note--empty {
        color: #98a2b3;
        font-style: italic;
    }

    .upad-actions {
        display: flex;
        justify-content: center;
        gap: 8px;
    }

    .upad-action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dbe4f0;
        background: #fff;
        color: #344054;
        transition: 0.2s ease;
    }

    .upad-action-btn:hover {
        transform: translateY(-1px);
    }

    .upad-action-btn--edit:hover {
        color: #0f3460;
        border-color: #bfd6f5;
        background: #edf4ff;
    }

    .upad-action-btn--delete:hover {
        color: #b42318;
        border-color: #fecaca;
        background: #fff1f2;
    }

    .upad-empty {
        text-align: center;
        padding: 36px 16px;
    }

    .upad-empty i {
        font-size: 34px;
        color: #98a2b3;
        margin-bottom: 10px;
    }

    .upad-empty h6 {
        margin-bottom: 5px;
        color: #344054;
        font-weight: 700;
    }

    .upad-empty p {
        margin: 0;
        color: #667085;
        font-size: 13px;
    }

    .upad-pagination .page-link {
        border-radius: 8px;
        border: 1px solid #dbe4f0;
        color: #0f3460;
        min-width: 36px;
        text-align: center;
        margin: 0 3px;
    }

    .upad-pagination .page-item.active .page-link {
        background: #0f3460;
        border-color: #0f3460;
        color: #fff;
    }

    .upad-pagination .page-item.disabled .page-link {
        color: #98a2b3;
        background: #f7f9fc;
        border-color: #e4e7ec;
    }

    @media (max-width: 576px) {
        .search-input {
            width: 100%;
            min-width: 220px;
        }
    }
</style>
