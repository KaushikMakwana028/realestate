<div class="page-wrapper">
    <div class="page-content">

        <!-- ===== BREADCRUMB ===== -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Payment Data
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end breadcrumb -->

        <!-- ===== MAIN CARD ===== -->
        <div class="card border-0 shadow-sm">

            <!-- Card Header -->
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

                    <!-- Left: Title -->
                    <div class="d-flex align-items-center gap-2">
                        <div class="header-icon-box">
                            <i class="bx bx-money"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold text-dark">Payment Data</h5>
                            <small class="text-muted">All approved payment transactions</small>
                        </div>
                    </div>

                    <!-- Right: Search + Print -->
                    <div class="d-flex align-items-center gap-2 flex-wrap">

                        <!-- Search -->
                        <div class="search-box position-relative">
                            <i class="bx bx-search search-icon"></i>
                            <input
                                type="text"
                                id="serchPlot"
                                class="form-control search-input"
                                placeholder="Search buyer..."
                            >
                            <input
                                type="hidden"
                                id="buyer_id"
                                name="buyer_id"
                                value="<?= isset($buyer_id) ? $buyer_id : '' ?>"
                            >
                        </div>

                        <!-- Print Button -->
                        <button type="button" class="btn btn-print" id="printBtn">
                            <i class="bx bx-printer me-1"></i> Print Statement
                        </button>

                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body p-0">

                <!-- Stats Strip -->
                <div class="stats-strip">
                    <div class="stat-item">
                        <div class="stat-icon blue">
                            <i class="bx bx-list-ul"></i>
                        </div>
                        <div>
                            <div class="stat-val" id="statTotal">—</div>
                            <div class="stat-lbl">Total Records</div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon green">
                            <i class="bx bx-check-circle"></i>
                        </div>
                        <div>
                            <div class="stat-val" id="statAmount">—</div>
                            <div class="stat-lbl">Total Paid</div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon orange">
                            <i class="bx bx-user"></i>
                        </div>
                        <div>
                            <div class="stat-val" id="statBuyers">—</div>
                            <div class="stat-lbl">Unique Buyers</div>
                        </div>
                    </div>
                </div>

                <!-- Table Responsive -->
                <div class="table-responsive">
                    <table class="table payment-table mb-0" id="paymentTable">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Buyer Name</th>
                                <th>Site Name</th>
                                <th>Plot Number</th>
                                <th>Paid At</th>
                                <th>Paid Amount</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody id="payment_data">
                            <!-- JS will inject rows here -->

                            <!-- Empty State (shown when no data) -->
                            <tr id="emptyRow" style="display:none;">
                                <td colspan="8">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="bx bx-receipt"></i>
                                        </div>
                                        <div class="empty-title">No Payments Found</div>
                                        <div class="empty-sub">Try searching with a different buyer name.</div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Skeleton Loader (shown while loading) -->
                            <tr class="skeleton-row" id="skeletonRow">
                                <td colspan="8">
                                    <div class="skeleton-wrap">
                                        <div class="skeleton-line"></div>
                                        <div class="skeleton-line short"></div>
                                        <div class="skeleton-line"></div>
                                        <div class="skeleton-line short"></div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- end table -->

            </div>
            <!-- end card body -->

            <!-- ===== PAGINATION ===== -->
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

                    <!-- Info -->
                    <div class="text-muted small" id="paginationInfo">
                        Showing <strong>0</strong> of <strong>0</strong> records
                    </div>

                    <!-- Pages -->
                    <nav aria-label="Payment pagination">
                        <ul class="pagination pagination-sm mb-0 custom-pagination" id="paginationList">
                            <li class="page-item disabled" id="prevPage">
                                <a class="page-link" href="javascript:;">
                                    <i class="bx bx-chevron-left"></i>
                                </a>
                            </li>
                            <!-- JS will inject page numbers here -->
                            <li class="page-item disabled" id="nextPage">
                                <a class="page-link" href="javascript:;">
                                    <i class="bx bx-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
            <!-- end pagination -->

        </div>
        <!-- end card -->

    </div>
</div>


<!-- ===================== STYLES ===================== -->
<style>

    /* ===== Header Icon ===== */
    .header-icon-box {
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

    /* ===== Search Box ===== */
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
        width: 230px;
        transition: all 0.2s;
        background: #f8f9ff;
    }

    .search-input:focus {
        border-color: #0f3460;
        box-shadow: 0 0 0 3px rgba(15, 52, 96, 0.1);
        background: #fff;
        outline: none;
    }

    /* ===== Print Button ===== */
    .btn-print {
        background: linear-gradient(135deg, #1a1a2e, #0f3460);
        color: #fff;
        border: none;
        border-radius: 25px;
        padding: 7px 18px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .btn-print:hover {
        background: linear-gradient(135deg, #0f3460, #e94560);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(15, 52, 96, 0.3);
    }

    /* ===== Stats Strip ===== */
    .stats-strip {
        display: flex;
        align-items: center;
        gap: 0;
        border-bottom: 1px solid #eef0f8;
        background: #f8f9ff;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 24px;
        border-right: 1px solid #eef0f8;
        flex: 1;
    }

    .stat-item:last-child {
        border-right: none;
    }

    .stat-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .stat-icon.blue   { background: #e8f0fe; color: #1a73e8; }
    .stat-icon.green  { background: #e6f4ea; color: #34a853; }
    .stat-icon.orange { background: #fef3e2; color: #f9ab00; }

    .stat-val {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a2e;
        line-height: 1;
        margin-bottom: 2px;
    }

    .stat-lbl {
        font-size: 11px;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    /* ===== Table ===== */
    .payment-table thead tr {
        background: linear-gradient(135deg, #1a1a2e, #0f3460);
    }

    .payment-table thead th {
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 14px;
        border: none;
        white-space: nowrap;
    }

    .payment-table tbody tr {
        transition: background 0.15s;
        border-bottom: 1px solid #f0f2fa;
    }

    .payment-table tbody tr:hover {
        background-color: #f0f4ff !important;
    }

    .payment-table tbody td {
        padding: 12px 14px;
        font-size: 13px;
        color: #333;
        vertical-align: middle;
        border: none;
        border-bottom: 1px solid #f0f2fa;
    }

    /* Index badge */
    .index-badge {
        width: 28px;
        height: 28px;
        background: #eef1fb;
        color: #0f3460;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        margin: auto;
    }

    /* User / Buyer name */
    .name-cell {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .avatar-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }

    .av-blue   { background: linear-gradient(135deg,#1a1a2e,#0f3460); }
    .av-purple { background: linear-gradient(135deg,#6a0dad,#9b59b6); }

    .name-text {
        font-size: 13px;
        font-weight: 600;
        color: #1a1a2e;
    }

    /* Plot badge */
    .plot-badge {
        display: inline-block;
        background: #eef1fb;
        color: #0f3460;
        border: 1px solid #d0d8f0;
        border-radius: 5px;
        padding: 3px 10px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Site badge */
    .site-badge {
        display: inline-block;
        background: #fff8e1;
        color: #b07d00;
        border: 1px solid #ffe082;
        border-radius: 5px;
        padding: 3px 10px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Amount */
    .amount-cell {
        font-size: 13px;
        font-weight: 700;
        color: #27ae60;
    }

    /* Date */
    .date-cell {
        font-size: 12px;
        color: #555;
        white-space: nowrap;
    }

    /* Action buttons */
    .action-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-view {
        background: #e8f0fe;
        color: #1a73e8;
    }

    .btn-view:hover {
        background: #1a73e8;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(26,115,232,0.3);
    }

    .btn-pdf {
        background: #fdecea;
        color: #e94560;
    }

    .btn-pdf:hover {
        background: #e94560;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(233,69,96,0.3);
    }

    /* ===== Empty State ===== */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
    }

    .empty-icon {
        font-size: 52px;
        color: #d0d8f0;
        margin-bottom: 12px;
    }

    .empty-title {
        font-size: 16px;
        font-weight: 700;
        color: #555;
        margin-bottom: 5px;
    }

    .empty-sub {
        font-size: 12px;
        color: #aaa;
    }

    /* ===== Skeleton Loader ===== */
    .skeleton-wrap {
        padding: 10px 0;
    }

    .skeleton-line {
        height: 14px;
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.4s infinite;
        border-radius: 6px;
        margin-bottom: 10px;
    }

    .skeleton-line.short {
        width: 60%;
    }

    @keyframes shimmer {
        0%   { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* ===== Pagination ===== */
    .custom-pagination .page-link {
        border-radius: 6px !important;
        margin: 0 2px;
        border: 1.5px solid #dde3f0;
        color: #0f3460;
        font-size: 12px;
        padding: 5px 11px;
        transition: all 0.2s;
    }

    .custom-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #1a1a2e, #0f3460);
        border-color: #0f3460;
        color: #fff;
        font-weight: 700;
    }

    .custom-pagination .page-link:hover {
        background: #eef1fb;
        border-color: #0f3460;
        color: #0f3460;
    }

    .custom-pagination .page-item.disabled .page-link {
        color: #ccc;
        border-color: #eee;
    }

</style>