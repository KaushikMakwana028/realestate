<div class="page-wrapper">
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
                        <li class="breadcrumb-item active" aria-current="page">Buyers</li>
                    </ol>
                </nav>
            </div>
        </div>



        <!-- Main Card -->
        <div class="card buy-main-card">
            <div class="card-body">
                <!-- Toolbar -->
                <div class="buy-toolbar">
                    <div class="buy-toolbar__left">
                        <div class="buy-search-wrap">
                            <i class="bx bx-search buy-search-icon"></i>
                            <input type="text" id="searchBuyers" class="form-control buy-search-input"
                                placeholder="Search by name, mobile, email, address, aadhar...">
                        </div>
                    </div>
                </div>

                <!-- Table View -->
                <div class="table-responsive buy-table-wrap">
                    <table class="table buy-table mb-0">
                        <thead>
                            <tr>
                                <th class="buy-th-index">#</th>
                                <th>
                                    <div class="buy-th-content">
                                        <i class="bx bx-user"></i> Buyer details
                                    </div>
                                </th>
                                <th>
                                    <div class="buy-th-content">
                                        <i class="bx bx-phone"></i> Contact
                                    </div>
                                </th>
                                <th>
                                    <div class="buy-th-content">
                                        <i class="bx bx-map-pin"></i> Plots bought
                                    </div>
                                </th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="buyersTableBody">
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-2 text-muted mb-0">Loading buyer records...</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                <div class="buy-empty-state d-none" id="buyEmptyState">
                    <div class="buy-empty-icon">
                        <i class="bx bx-user-x"></i>
                    </div>
                    <h6>No Buyers Found</h6>
                    <p>Try adjusting your search criteria</p>
                </div>
            </div>

            <!-- Pagination -->
            <div class="buy-pagination-footer">
                <div class="buy-pagination-info">
                    <span class="text-muted" id="buyPaginationInfo">Showing 0-0 of 0 buyers</span>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination buy-pagination mb-0">
                        <!-- Dynamic pagination buttons -->
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</div>

<!-- Scoped CSS -->
<style>
    /* Stats Cards */
    .buy-stat-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px 20px;
        border-radius: 14px;
        background: #fff;
        border: 1px solid #e8ecf3;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .buy-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        border-radius: 0 4px 4px 0;
    }

    .buy-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .buy-stat--total::before { background: #6366f1; }
    .buy-stat--investment::before { background: #0ea5e9; }
    .buy-stat--collected::before { background: #10b981; }
    .buy-stat--outstanding::before { background: #f59e0b; }

    .buy-stat__icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .buy-stat--total .buy-stat__icon { background: #eef2ff; color: #6366f1; }
    .buy-stat--investment .buy-stat__icon { background: #e0f2fe; color: #0ea5e9; }
    .buy-stat--collected .buy-stat__icon { background: #ecfdf5; color: #10b981; }
    .buy-stat--outstanding .buy-stat__icon { background: #fffbeb; color: #f59e0b; }

    .buy-stat__info {
        display: flex;
        flex-direction: column;
        flex: 1;
        min-width: 0;
    }

    .buy-stat__value {
        font-size: 20px;
        font-weight: 800;
        color: #111827;
        line-height: 1.2;
    }

    .buy-stat__label {
        font-size: 11px;
        color: #9ca3af;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.2;
        margin-top: 2px;
    }

    /* Main Card */
    .buy-main-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 6px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .buy-main-card .card-body {
        padding: 24px;
    }

    /* Toolbar */
    .buy-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .buy-toolbar__left {
        flex: 1;
        min-width: 200px;
        max-width: 380px;
    }

    .buy-search-wrap {
        position: relative;
        width: 100%;
    }

    .buy-search-icon {
        position: absolute;
        top: 50%;
        left: 14px;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 18px;
        pointer-events: none;
    }

    .buy-search-input {
        padding: 10px 16px 10px 42px;
        border-radius: 12px;
        border: 1.5px solid #e5e7eb;
        font-size: 14px;
        background: #f9fafb;
        transition: all 0.25s ease;
        width: 100%;
    }

    .buy-search-input:focus {
        background: #fff;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    /* Table styles */
    .buy-table-wrap {
        border-radius: 12px;
        border: 1px solid #f0f1f3;
        overflow-x: auto;
    }

    .buy-table {
        margin-bottom: 0;
    }

    .buy-table thead {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .buy-table thead th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #64748b;
        padding: 14px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }

    .buy-th-index { width: 45px; }

    .buy-th-content {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .buy-th-content i {
        font-size: 14px;
        color: #94a3b8;
    }

    .buy-table tbody tr {
        transition: all 0.2s ease;
        animation: buyFadeIn 0.3s ease forwards;
    }

    .buy-table tbody tr:hover {
        background: #f8faff;
    }

    .buy-table tbody td {
        padding: 12px 14px;
        vertical-align: middle;
        font-size: 13.5px;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
    }

    @keyframes buyFadeIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Buyer Info Details */
    .buy-name {
        font-weight: 700;
        color: #1e293b;
        font-size: 14px;
        display: block;
        margin-bottom: 4px;
    }

    .buy-sub-info {
        font-size: 11px;
        color: #64748b;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .buy-badge-aadhar {
        background: #eef2ff;
        color: #4f46e5;
        font-size: 10px;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 3px;
        width: fit-content;
        margin-top: 4px;
    }

    /* Plot badges list */
    .buy-plots-container {
        display: flex;
        flex-direction: column;
        gap: 4px;
        max-width: 280px;
    }

    .buy-plot-tag {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 4px 8px;
        font-size: 11.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .buy-plot-tag i {
        color: #64748b;
        font-size: 13px;
    }

    /* Financials Display */
    .buy-financial-row {
        display: flex;
        flex-direction: column;
        gap: 3px;
        font-size: 12px;
    }

    .buy-fin-item {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        border-bottom: 1px dashed #e2e8f0;
        padding-bottom: 2px;
    }

    .buy-fin-item:last-child {
        border-bottom: none;
    }

    .buy-fin-label {
        color: #64748b;
        font-weight: 500;
    }

    .buy-fin-val {
        font-weight: 700;
        font-variant-numeric: tabular-nums;
    }

    .buy-fin-val--inv { color: #0ea5e9; }
    .buy-fin-val--paid { color: #10b981; }
    .buy-fin-val--rem { color: #f59e0b; }

    /* Action Links List */
    .buy-action-links {
        display: flex;
        flex-direction: column;
        gap: 6px;
        align-items: center;
    }

    .buy-statement-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        background: #fff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        text-decoration: none;
        width: 100%;
        max-width: 200px;
        transition: all 0.2s ease;
    }

    .buy-statement-btn:hover {
        background: #f8fafc;
        border-color: #6366f1;
        color: #6366f1;
        box-shadow: 0 2px 6px rgba(99, 102, 241, 0.1);
        transform: translateY(-1px);
    }

    .buy-statement-btn i {
        font-size: 15px;
    }

    /* Empty state */
    .buy-empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .buy-empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .buy-empty-icon i {
        font-size: 36px;
        color: #cbd5e1;
    }

    .buy-empty-state h6 {
        color: #4b5563;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .buy-empty-state p {
        color: #9ca3af;
        font-size: 13px;
        margin-bottom: 0;
    }

    /* Pagination */
    .buy-pagination-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        background: #fafbfc;
        border-top: 1px solid #f0f1f3;
        flex-wrap: wrap;
        gap: 12px;
    }

    .buy-pagination {
        gap: 4px;
    }

    .buy-pagination .page-link {
        border: none;
        border-radius: 10px !important;
        padding: 8px 14px;
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        background: transparent;
        transition: all 0.2s ease;
        min-width: 38px;
        text-align: center;
    }

    .buy-pagination .page-link:hover {
        background: #eef2ff;
        color: #6366f1;
    }

    .buy-pagination .page-item.active .page-link {
        background: #6366f1;
        color: #fff;
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
    }

    @media (max-width: 767px) {
        .buy-toolbar {
            flex-direction: column;
            align-items: stretch;
        }
        .buy-toolbar__left {
            max-width: 100%;
        }
        .buy-pagination-footer {
            justify-content: center;
        }
    }

    /* Modern Action Buttons styling */
    .btn-action-hover {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        font-size: 16px;
        border: 1px solid #e2e8f0;
        text-decoration: none;
    }
    .btn-action-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .btn-light-primary {
        color: #4f46e5;
        background: #eef2ff;
    }
    .btn-light-primary:hover {
        background: #4f46e5;
        color: #fff;
        border-color: #4f46e5;
    }
    .btn-light-warning {
        color: #d97706;
        background: #fffbeb;
    }
    .btn-light-warning:hover {
        background: #d97706;
        color: #fff;
        border-color: #d97706;
    }
    .btn-light-danger {
        color: #dc2626;
        background: #fef2f2;
    }
    .btn-light-danger:hover {
        background: #dc2626;
        color: #fff;
        border-color: #dc2626;
    }
</style>

<!-- Scoped Javascript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (typeof jQuery === "undefined") {
            console.error("jQuery is required for the Buyers View page");
            return;
        }

        (function ($) {
            const siteUrl = "<?= base_url(); ?>";
            let currentPage = 1;
            let searchQuery = "";

            // Format Money in Indian Rupee format
            function formatMoney(value) {
                const num = Number(value || 0);
                return num.toLocaleString("en-IN", { 
                    maximumFractionDigits: 2,
                    minimumFractionDigits: 2
                });
            }

            // Load Buyers Data via AJAX
            function loadBuyersData(page = 1, search = "") {
                currentPage = page;

                // Show loading spinner
                $("#buyersTableBody").html(`
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted mb-0">Loading buyer records...</p>
                        </td>
                    </tr>
                `);
                $("#buyEmptyState").addClass("d-none");

                $.ajax({
                    url: siteUrl + "user/get_buyers_ajax",
                    method: "GET",
                    data: { page: page, search: search },
                    dataType: "json",
                    success: function (res) {
                        if (res.status && res.data.length > 0) {
                            let rows = "";

                            $.each(res.data, function (i, buyer) {
                                // Aadhar card badge
                                let aadharHtml = "";
                                if (buyer.aadhar && buyer.aadhar.trim() !== "") {
                                    aadharHtml = `<span class="buy-badge-aadhar"><i class="bx bx-id-card"></i> Aadhar: ${buyer.aadhar}</span>`;
                                }

                                // Plots list tags HTML
                                let plotsHtml = `<div class="buy-plots-container">`;
                                let actionLinksHtml = `<div class="buy-action-links" style="display:flex; flex-direction:column; gap:6px; width:100%;">`;

                                $.each(buyer.plots, function(_, p) {
                                    plotsHtml += `
                                        <span class="buy-plot-tag" title="${p.site_name}">
                                            <i class="bx bx-home-alt"></i> ${p.site_name} - Plot #${p.plot_number}
                                        </span>
                                    `;
                                    actionLinksHtml += `
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <a href="${siteUrl}plots/buyer_details/${p.buyer_id}" class="btn-action-hover btn-light-primary" title="View Statement (Plot #${p.plot_number})"><i class="bx bx-show"></i></a>
                                            <a href="${siteUrl}plot/edit_plot/${p.plot_id}" class="btn-action-hover btn-light-warning" title="Edit Plot (Plot #${p.plot_number})"><i class="bx bx-edit"></i></a>
                                            <button class="btn-action-hover btn-light-danger deleteBuyerBtn" data-id="${p.buyer_id}" title="Delete Buyer (Plot #${p.plot_number})"><i class="bx bx-trash"></i></button>
                                        </div>
                                    `;
                                });

                                plotsHtml += `</div>`;
                                actionLinksHtml += `</div>`;

                                rows += `
                                    <tr>
                                        <td>${(page - 1) * 10 + i + 1}</td>
                                        <td>
                                            <span class="buy-name">${buyer.name || "-"}</span>
                                            <div class="buy-sub-info">
                                                <span><i class="bx bx-navigation"></i> ${buyer.address || "-"}</span>
                                                ${aadharHtml}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column gap-1">
                                                <a href="tel:${buyer.mobile}" class="text-dark fw-bold text-decoration-none" style="font-size:13px;">
                                                    <i class="bx bx-phone text-success"></i> ${buyer.mobile || "-"}
                                                </a>
                                                <span class="text-muted" style="font-size:11.5px;">
                                                    <i class="bx bx-envelope"></i> ${buyer.email || "-"}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-start gap-2">
                                                <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                                                      style="width: 24px; height: 24px; font-size: 11px; flex-shrink:0;">
                                                    ${buyer.plots.length}
                                                </span>
                                                ${plotsHtml}
                                            </div>
                                        </td>
                                        <td>
                                            ${actionLinksHtml}
                                        </td>
                                    </tr>
                                `;
                            });

                            $("#buyersTableBody").html(rows);

                            // Pagination
                            renderPagination(res.pagination.total_pages, res.pagination.current_page);

                            // Calculate Top Summary Totals
                            let totalBuyers = res.pagination.total_rows || res.data.length;
                            let sumInvestment = 0;
                            let sumCollected = 0;
                            let sumOutstanding = 0;

                            // Calculate based on AJAX result
                            $.each(res.data, function(_, b) {
                                sumInvestment += Number(b.total_investment || 0);
                                sumCollected += Number(b.total_paid || 0);
                                sumOutstanding += Number(b.total_remaining || 0);
                            });

                            $("#buyTotalCount").text(totalBuyers);
                            $("#buyTotalInvestment").text(formatMoney(sumInvestment));
                            $("#buyTotalCollected").text(formatMoney(sumCollected));
                            $("#buyTotalOutstanding").text(formatMoney(sumOutstanding));

                            // Showing info text
                            const start = (res.pagination.current_page - 1) * 10 + 1;
                            const end = start + res.data.length - 1;
                            $("#buyPaginationInfo").text(`Showing ${start}-${end} of ${res.pagination.total_rows} buyers`);

                        } else {
                            $("#buyersTableBody").html("");
                            $("#buyEmptyState").removeClass("d-none");

                            $("#buyTotalCount").text("0");
                            $("#buyTotalInvestment").text("0.00");
                            $("#buyTotalCollected").text("0.00");
                            $("#buyTotalOutstanding").text("0.00");
                            $("#buyPaginationInfo").text("Showing 0-0 of 0 buyers");
                            $(".buy-pagination").html("");
                        }
                    },
                    error: function () {
                        $("#buyersTableBody").html(`
                            <tr>
                                <td colspan="5" class="text-center text-danger py-4">
                                    <i class="bx bx-error-circle" style="font-size: 24px;"></i>
                                    <p class="mt-2 mb-0">Failed to load buyer details. Please try again.</p>
                                </td>
                            </tr>
                        `);
                    }
                });
            }

            // Render Pagination Buttons
            function renderPagination(totalPages, currentPage) {
                let paginationHTML = "";
                const maxVisible = 3;
                let startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
                let endPage = Math.min(totalPages, startPage + maxVisible - 1);

                if (endPage - startPage < maxVisible - 1) {
                    startPage = Math.max(1, endPage - maxVisible + 1);
                }

                // Previous button
                paginationHTML += `
                    <li class="page-item ${currentPage === 1 ? "disabled" : ""}">
                        <a class="page-link buy-page-link" href="javascript:;" data-page="${currentPage - 1}">Previous</a>
                    </li>
                `;

                // Page numbers
                for (let i = startPage; i <= endPage; i++) {
                    paginationHTML += `
                        <li class="page-item ${i === currentPage ? "active" : ""}">
                            <a class="page-link buy-page-link" href="javascript:;" data-page="${i}">${i}</a>
                        </li>
                    `;
                }

                // Last page shortcut
                if (endPage < totalPages) {
                    paginationHTML += `
                        <li class="page-item">
                            <a class="page-link buy-page-link" href="javascript:;" data-page="${totalPages}">Last</a>
                        </li>
                    `;
                }

                // Next button
                paginationHTML += `
                    <li class="page-item ${currentPage === totalPages ? "disabled" : ""}">
                        <a class="page-link buy-page-link" href="javascript:;" data-page="${currentPage + 1}">Next</a>
                    </li>
                `;

                $(".buy-pagination").html(paginationHTML);
            }

            // Event Listeners
            // Realtime search with debounce
            let searchTimer;
            $("#searchBuyers").on("keyup", function () {
                clearTimeout(searchTimer);
                searchQuery = $(this).val();
                searchTimer = setTimeout(function () {
                    loadBuyersData(1, searchQuery);
                }, 300);
            });

            // Pagination item click
            $(document).on("click", ".buy-page-link", function () {
                const page = Number($(this).data("page") || 1);
                if (page < 1 || $(this).closest(".page-item").hasClass("disabled")) {
                    return;
                }
                loadBuyersData(page, searchQuery);
            });

            // Delete Buyer AJAX click handler
            $(document).on("click", ".deleteBuyerBtn", function () {
                const id = $(this).data("id");

                Swal.fire({
                    title: "Delete this buyer?",
                    text: "This action will delete the buyer details and revert the plot status to Available. This cannot be undone.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: siteUrl + "user/delete_buyer/" + id,
                            method: "POST",
                            dataType: "json",
                            success: function (res) {
                                if (res.status) {
                                    Swal.fire("Deleted!", res.message, "success");
                                    loadBuyersData(currentPage, searchQuery);
                                } else {
                                    Swal.fire("Error", res.message, "error");
                                }
                            },
                            error: function() {
                                Swal.fire("Error", "Failed to delete buyer. Try again.", "error");
                            }
                        });
                    }
                });
            });

            // Initial load
            loadBuyersData(1, "");

        })(jQuery);
    });
</script>
