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
                        <li class="breadcrumb-item active" aria-current="page">Salary</li>
                    </ol>
                </nav>
            </div>
        </div>



        <!-- Main Card -->
        <div class="card sal-main-card">
            <div class="card-body">
                <!-- Toolbar -->
                <div class="sal-toolbar">
                    <div class="sal-toolbar__left">
                        <div class="sal-search-wrap">
                            <i class="bx bx-search sal-search-icon"></i>
                            <input type="text" id="searchSalary" class="form-control sal-search-input"
                                placeholder="Search by name, email, mobile...">
                        </div>
                    </div>
                    <div class="sal-toolbar__right">
                        <button class="btn sal-add-upad-btn" title="Add Upad" id="btnAddNewUpad">
                            <i class="bx bx-plus-circle"></i>
                            <span>Add UPAD</span>
                        </button>
                    </div>
                </div>

                <!-- Table View -->
                <div class="table-responsive sal-table-wrap">
                    <table class="table sal-table mb-0">
                        <thead>
                            <tr>
                                <th class="sal-th-index">#</th>
                                <th>
                                    <div class="sal-th-content">
                                        <i class="bx bx-user"></i> User Name
                                    </div>
                                </th>
                                <th>
                                    <div class="sal-th-content">
                                        <i class="bx bx-rupee"></i> Salary Amount
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div class="sal-th-content justify-content-center">
                                        <i class="bx bx-wallet"></i> UPAD
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div class="sal-th-content justify-content-center">
                                        <i class="bx bx-credit-card"></i> Payable
                                    </div>
                                </th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="salaryTableBody">
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-2 text-muted mb-0">Loading salary records...</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                <div class="sal-empty-state d-none" id="salEmptyState">
                    <div class="sal-empty-icon">
                        <i class="bx bx-money-withdraw"></i>
                    </div>
                    <h6>No Salary Records Found</h6>
                    <p>Try adjusting your search criteria</p>
                </div>
            </div>

            <!-- Pagination -->
            <div class="sal-pagination-footer">
                <div class="sal-pagination-info">
                    <span class="text-muted" id="salPaginationInfo">Showing 0-0 of 0 staff</span>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination sal-pagination mb-0">
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
    .sal-stat-card {
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

    .sal-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        border-radius: 0 4px 4px 0;
    }

    .sal-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .sal-stat--total::before { background: #6366f1; }
    .sal-stat--salary::before { background: #06b6d4; }
    .sal-stat--upad::before { background: #f59e0b; }
    .sal-stat--payable::before { background: #10b981; }

    .sal-stat__icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .sal-stat--total .sal-stat__icon { background: #eef2ff; color: #6366f1; }
    .sal-stat--salary .sal-stat__icon { background: #ecfeff; color: #06b6d4; }
    .sal-stat--upad .sal-stat__icon { background: #fffbeb; color: #f59e0b; }
    .sal-stat--payable .sal-stat__icon { background: #ecfdf5; color: #10b981; }

    .sal-stat__info {
        display: flex;
        flex-direction: column;
        flex: 1;
        min-width: 0;
    }

    .sal-stat__value {
        font-size: 20px;
        font-weight: 800;
        color: #111827;
        line-height: 1.2;
    }

    .sal-stat__label {
        font-size: 11px;
        color: #9ca3af;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.2;
        margin-top: 2px;
    }

    /* Main Card */
    .sal-main-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 6px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .sal-main-card .card-body {
        padding: 24px;
    }

    /* Toolbar */
    .sal-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .sal-toolbar__left {
        flex: 1;
        min-width: 200px;
        max-width: 380px;
    }

    .sal-toolbar__right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .sal-search-wrap {
        position: relative;
        width: 100%;
    }

    .sal-search-icon {
        position: absolute;
        top: 50%;
        left: 14px;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 18px;
        pointer-events: none;
    }

    .sal-search-input {
        padding: 10px 16px 10px 42px;
        border-radius: 12px;
        border: 1.5px solid #e5e7eb;
        font-size: 14px;
        background: #f9fafb;
        transition: all 0.25s ease;
        width: 100%;
    }

    .sal-search-input:focus {
        background: #fff;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    /* Add Button */
    .sal-add-upad-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        border-radius: 10px;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.25s ease;
        background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
    }

    .sal-add-upad-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
        color: #fff;
    }

    .sal-add-upad-btn i {
        font-size: 18px;
    }

    /* Table styles */
    .sal-table-wrap {
        border-radius: 12px;
        border: 1px solid #f0f1f3;
        overflow-x: auto;
    }

    .sal-table {
        margin-bottom: 0;
    }

    .sal-table thead {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .sal-table thead th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #64748b;
        padding: 14px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }

    .sal-th-index { width: 45px; }

    .sal-th-content {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .sal-th-content i {
        font-size: 14px;
        color: #94a3b8;
    }

    .sal-table tbody tr {
        transition: all 0.2s ease;
        animation: salFadeIn 0.3s ease forwards;
    }

    .sal-table tbody tr:hover {
        background: #f8faff;
    }

    .sal-table tbody td {
        padding: 12px 14px;
        vertical-align: middle;
        font-size: 13.5px;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
    }

    @keyframes salFadeIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Profile Cell */
    .usr-profile-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .usr-avatar {
        position: relative;
        flex-shrink: 0;
    }

    .usr-avatar__img {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid #e5e7eb;
    }

    .usr-avatar__placeholder {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 15px;
        color: #fff;
    }

    .usr-avatar-color-1 { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); }
    .usr-avatar-color-2 { background: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%); }
    .usr-avatar-color-3 { background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%); }
    .usr-avatar-color-4 { background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%); }
    .usr-avatar-color-5 { background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%); }
    .usr-avatar-color-6 { background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%); }

    .usr-profile-info {
        display: flex;
        flex-direction: column;
    }

    .usr-profile-name {
        font-weight: 700;
        color: #1e293b;
        font-size: 14px;
        line-height: 1.3;
    }

    .usr-profile-role {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Money text styling */
    .sal-money-value {
        font-weight: 700;
        font-variant-numeric: tabular-nums;
    }

    .sal-money--salary {
        color: #1e293b;
    }

    .sal-money--upad {
        color: #d97706; /* amber-600 */
        background: #fef3c7; /* amber-100 */
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 12px;
        display: inline-block;
    }

    .sal-money--payable {
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 13px;
        display: inline-block;
    }

    .sal-money--payable-positive {
        background: #fef2f2;
        color: #dc2626;
    }

    .sal-money--payable-zero {
        background: #ecfdf5;
        color: #059669;
    }

    /* Actions */
    .sal-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .sal-action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #64748b;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        position: relative;
    }

    .sal-action-btn:hover {
        transform: translateY(-1px);
    }

    .sal-action-btn--add:hover {
        background: #0ea5e9;
        color: #fff;
        border-color: #0ea5e9;
        box-shadow: 0 3px 8px rgba(14, 165, 233, 0.3);
    }

    .sal-action-btn--history:hover {
        background: #6366f1;
        color: #fff;
        border-color: #6366f1;
        box-shadow: 0 3px 8px rgba(99, 102, 241, 0.3);
    }

    /* Tooltip */
    .sal-action-btn[title]:hover::after {
        content: attr(title);
        position: absolute;
        bottom: calc(100% + 6px);
        left: 50%;
        transform: translateX(-50%);
        background: #1e293b;
        color: #fff;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        white-space: nowrap;
        pointer-events: none;
        z-index: 10;
    }

    .sal-action-btn[title]:hover::before {
        content: '';
        position: absolute;
        bottom: calc(100% + 2px);
        left: 50%;
        transform: translateX(-50%);
        border: 4px solid transparent;
        border-top-color: #1e293b;
        pointer-events: none;
        z-index: 10;
    }

    /* Empty state */
    .sal-empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .sal-empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .sal-empty-icon i {
        font-size: 36px;
        color: #cbd5e1;
    }

    .sal-empty-state h6 {
        color: #4b5563;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .sal-empty-state p {
        color: #9ca3af;
        font-size: 13px;
        margin-bottom: 0;
    }

    /* Pagination */
    .sal-pagination-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        background: #fafbfc;
        border-top: 1px solid #f0f1f3;
        flex-wrap: wrap;
        gap: 12px;
    }

    .sal-pagination {
        gap: 4px;
    }

    .sal-pagination .page-link {
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

    .sal-pagination .page-link:hover {
        background: #eef2ff;
        color: #6366f1;
    }

    .sal-pagination .page-item.active .page-link {
        background: #6366f1;
        color: #fff;
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
    }

    @media (max-width: 767px) {
        .sal-toolbar {
            flex-direction: column;
            align-items: stretch;
        }
        .sal-toolbar__left {
            max-width: 100%;
        }
        .sal-toolbar__right {
            width: 100%;
        }
        .sal-add-upad-btn {
            width: 100%;
            justify-content: center;
        }
        .sal-pagination-footer {
            justify-content: center;
        }
    }
</style>

<!-- Scoped Javascript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Ensure jQuery is loaded
        if (typeof jQuery === "undefined") {
            console.error("jQuery is required for the Salary View page");
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

            // Load Salary Data via AJAX
            function loadSalaryData(page = 1, search = "") {
                currentPage = page;
                
                // Show loading spinner
                $("#salaryTableBody").html(`
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted mb-0">Loading salary records...</p>
                        </td>
                    </tr>
                `);
                $("#salEmptyState").addClass("d-none");

                $.ajax({
                    url: siteUrl + "user/get_users_ajax",
                    method: "GET",
                    data: { page: page, search: search },
                    dataType: "json",
                    success: function (res) {
                        if (res.status && res.data.length > 0) {
                            let rows = "";

                            $.each(res.data, function (i, user) {
                                // User Avatar
                                let avatarHtml = "";
                                if (user.profile_image) {
                                    avatarHtml = `<img src="${siteUrl + user.profile_image}" class="usr-avatar__img" alt="${user.name}">`;
                                } else {
                                    const initials = user.name.split(' ').map(function(w) { return w[0]; }).join('').toUpperCase().substring(0, 2);
                                    const colorIdx = (user.name.charCodeAt(0) % 6) + 1;
                                    avatarHtml = `<div class="usr-avatar__placeholder usr-avatar-color-${colorIdx}">${initials}</div>`;
                                }

                                // Payable Badge color
                                const payableVal = Number(user.payable_salary || 0);
                                const payableClass = payableVal > 0 ? "sal-money--payable-positive" : "sal-money--payable-zero";

                                rows += `
                                    <tr>
                                        <td>${(page - 1) * 10 + i + 1}</td>
                                        <td>
                                            <div class="usr-profile-cell">
                                                <div class="usr-avatar">
                                                    ${avatarHtml}
                                                </div>
                                                <div class="usr-profile-info">
                                                    <span class="usr-profile-name">${user.name || "-"}</span>
                                                    <span class="usr-profile-role">${user.email || user.mobile || "-"}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="sal-money-value sal-money--salary">₹${formatMoney(user.actual_salary)}</span>
                                                <span class="text-muted" style="font-size: 11px;">
                                                    Daily: ₹${formatMoney(user.daily_salary)} (${user.present_days} days Present)
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="sal-money-value sal-money--upad">₹${formatMoney(user.total_upad)}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="sal-money-value sal-money--payable ${payableClass}">₹${formatMoney(user.payable_salary)}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="sal-actions">
                                                <a href="${siteUrl}add_upad/${user.id}" class="sal-action-btn sal-action-btn--add" title="Add UPAD">
                                                    <i class="bx bx-plus-circle"></i>
                                                </a>
                                                <a href="${siteUrl}user/view_upad/${user.id}" class="sal-action-btn sal-action-btn--history" title="UPAD History">
                                                    <i class="bx bx-history"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                `;
                            });

                            $("#salaryTableBody").html(rows);
                            
                            // Render pagination
                            renderPagination(res.pagination.total_pages, res.pagination.current_page);
                            
                            // Calculate Stats for Top Cards
                            let totalStaff = res.data.length;
                            let sumSalary = 0;
                            let sumUpad = 0;
                            let sumPayable = 0;

                            $.each(res.data, function(_, u) {
                                sumSalary += Number(u.actual_salary || 0);
                                sumUpad += Number(u.total_upad || 0);
                                sumPayable += Number(u.payable_salary || 0);
                            });

                            $("#salTotalStaff").text(totalStaff);
                            $("#salTotalSalary").text(formatMoney(sumSalary));
                            $("#salTotalUpad").text(formatMoney(sumUpad));
                            $("#salTotalPayable").text(formatMoney(sumPayable));

                            // Showing info
                            const start = (res.pagination.current_page - 1) * 10 + 1;
                            const end = start + res.data.length - 1;
                            $("#salPaginationInfo").text(`Showing ${start}-${end} of ${totalStaff} staff`);

                        } else {
                            $("#salaryTableBody").html("");
                            $("#salEmptyState").removeClass("d-none");
                            
                            $("#salTotalStaff").text("0");
                            $("#salTotalSalary").text("0.00");
                            $("#salTotalUpad").text("0.00");
                            $("#salTotalPayable").text("0.00");
                            $("#salPaginationInfo").text("Showing 0-0 of 0 staff");
                            $(".sal-pagination").html("");
                        }
                    },
                    error: function() {
                        $("#salaryTableBody").html(`
                            <tr>
                                <td colspan="6" class="text-center text-danger py-4">
                                    <i class="bx bx-error-circle" style="font-size: 24px;"></i>
                                    <p class="mt-2 mb-0">Failed to load salary details. Please try again.</p>
                                </td>
                            </tr>
                        `);
                    }
                });
            }

            // Render Pagination
            function renderPagination(totalPages, currentPage) {
                let paginationHTML = "";
                const maxVisible = 3;
                let startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
                let endPage = Math.min(totalPages, startPage + maxVisible - 1);

                if (endPage - startPage < maxVisible - 1) {
                    startPage = Math.max(1, endPage - maxVisible + 1);
                }

                // Previous
                paginationHTML += `
                    <li class="page-item ${currentPage === 1 ? "disabled" : ""}">
                        <a class="page-link salary-page-link" href="javascript:;" data-page="${currentPage - 1}">Previous</a>
                    </li>
                `;

                // Pages
                for (let i = startPage; i <= endPage; i++) {
                    paginationHTML += `
                        <li class="page-item ${i === currentPage ? "active" : ""}">
                            <a class="page-link salary-page-link" href="javascript:;" data-page="${i}">${i}</a>
                        </li>
                    `;
                }

                // Last Page shortcut if not in view
                if (endPage < totalPages) {
                    paginationHTML += `
                        <li class="page-item">
                            <a class="page-link salary-page-link" href="javascript:;" data-page="${totalPages}">Last</a>
                        </li>
                    `;
                }

                // Next
                paginationHTML += `
                    <li class="page-item ${currentPage === totalPages ? "disabled" : ""}">
                        <a class="page-link salary-page-link" href="javascript:;" data-page="${currentPage + 1}">Next</a>
                    </li>
                `;

                $(".sal-pagination").html(paginationHTML);
            }

            // Event Listeners
            // Search Input with debounce
            let searchTimer;
            $("#searchSalary").on("keyup", function () {
                clearTimeout(searchTimer);
                searchQuery = $(this).val();
                searchTimer = setTimeout(function () {
                    loadSalaryData(1, searchQuery);
                }, 300);
            });

            // Pagination Link Clicks
            $(document).on("click", ".salary-page-link", function () {
                const page = Number($(this).data("page") || 1);
                if (page < 1 || $(this).closest(".page-item").hasClass("disabled")) {
                    return;
                }
                loadSalaryData(page, searchQuery);
            });

            // Topbar Add Upad Redirect
            $("#btnAddNewUpad").on("click", function () {
                window.location.href = siteUrl + "add_upad";
            });

            // Initial Load
            loadSalaryData(1, "");

        })(jQuery);
    });
</script>
