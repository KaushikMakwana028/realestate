<div class="page-wrapper">
	<div class="page-content">

		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"><i
									class="bx bx-home-alt"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Enquiries</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->

		<!-- Stats Cards -->
		<div class="row g-3 mb-4">
			<div class="col-6 col-lg-3">
				<div class="enq-stat-card enq-stat--total">
					<div class="enq-stat__icon">
						<i class="bx bx-conversation"></i>
					</div>
					<div class="enq-stat__info">
						<span class="enq-stat__value" id="statTotalEnquiries">--</span>
						<span class="enq-stat__label">Total Enquiries</span>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="enq-stat-card enq-stat--today">
					<div class="enq-stat__icon">
						<i class="bx bx-calendar-check"></i>
					</div>
					<div class="enq-stat__info">
						<span class="enq-stat__value" id="statTodayEnquiries">--</span>
						<span class="enq-stat__label">Today</span>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="enq-stat-card enq-stat--week">
					<div class="enq-stat__icon">
						<i class="bx bx-bar-chart-alt-2"></i>
					</div>
					<div class="enq-stat__info">
						<span class="enq-stat__value" id="statWeekEnquiries">--</span>
						<span class="enq-stat__label">This Week</span>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="enq-stat-card enq-stat--pending">
					<div class="enq-stat__icon">
						<i class="bx bx-time-five"></i>
					</div>
					<div class="enq-stat__info">
						<span class="enq-stat__value" id="statPendingEnquiries">--</span>
						<span class="enq-stat__label">Pending</span>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Card -->
		<div class="card enq-main-card">
			<div class="card-body">
				<!-- Toolbar -->
				<div class="enq-toolbar">
					<div class="enq-toolbar__left">
						<div class="enq-search-wrap">
							<i class="bx bx-search enq-search-icon"></i>
							<input type="text" id="serchinquiry" class="form-control enq-search-input"
								placeholder="Search by name, site, mobile...">
						</div>
					</div>
					<div class="enq-toolbar__right">
						<div class="enq-filter-group">
							<select class="form-select enq-filter-select" id="filterSite">
								<option value="">All Sites</option>
							</select>
							<select class="form-select enq-filter-select" id="filterDate">
								<option value="">All Time</option>
								<option value="today">Today</option>
								<option value="week">This Week</option>
								<option value="month">This Month</option>
							</select>
						</div>
						<button class="btn enq-export-btn" title="Export">
							<i class="bx bx-download"></i>
							<span class="d-none d-md-inline">Export</span>
						</button>
					</div>
				</div>

				<!-- Table -->
				<div class="table-responsive enq-table-wrap">
					<table class="table enq-table mb-0">
						<thead>
							<tr>
								<th class="enq-th-index">#</th>
								<th>
									<div class="enq-th-content">
										<i class="bx bx-user"></i> User
									</div>
								</th>
								<th>
									<div class="enq-th-content">
										<i class="bx bx-building-house"></i> Site
									</div>
								</th>
								<th>
									<div class="enq-th-content">
										<i class="bx bx-grid-alt"></i> Plot
									</div>
								</th>
								<th>
									<div class="enq-th-content">
										<i class="bx bx-user-check"></i> Customer
									</div>
								</th>
								<th>
									<div class="enq-th-content">
										<i class="bx bx-phone"></i> Mobile
									</div>
								</th>
								<th>
									<div class="enq-th-content">
										<i class="bx bx-note"></i> Notes
									</div>
								</th>
								<th>
									<div class="enq-th-content">
										<i class="bx bx-calendar"></i> Date
									</div>
								</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody id="inquiryTableBody">
							<!-- Dynamic rows -->
						</tbody>
					</table>
				</div>

				<!-- Empty State -->
				<div class="enq-empty-state d-none" id="enqEmptyState">
					<div class="enq-empty-icon">
						<i class="bx bx-conversation"></i>
					</div>
					<h6>No Enquiries Found</h6>
					<p>Try adjusting your search or filters</p>
				</div>
			</div>

			<!-- Pagination -->
			<div class="enq-pagination-footer">
				<div class="enq-pagination-info">
					<span class="text-muted" id="enqPaginationInfo">Showing 1-10 of 50 enquiries</span>
				</div>
				<nav aria-label="Page navigation">
					<ul class="pagination enq-pagination mb-0">
						<li class="page-item">
							<a class="page-link" href="javascript:;" aria-label="Previous">
								<i class="bx bx-chevron-left"></i>
							</a>
						</li>
						<li class="page-item"><a class="page-link" href="javascript:;">1</a></li>
						<li class="page-item active"><a class="page-link" href="javascript:;">2</a></li>
						<li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
						<li class="page-item">
							<a class="page-link" href="javascript:;" aria-label="Next">
								<i class="bx bx-chevron-right"></i>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>

	</div>
</div>

<!-- Enquiry Detail Modal -->
<div class="modal fade" id="enquiryDetailModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content enq-modal-content">
			<div class="modal-header enq-modal-header">
				<div class="d-flex align-items-center gap-2">
					<div class="enq-modal-icon">
						<i class="bx bx-conversation"></i>
					</div>
					<h5 class="modal-title fw-bold mb-0">Enquiry Details</h5>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-0">
				<div id="enquiryDetailContent" class="p-4">
					<div class="enq-detail-loader">
						<div class="spinner-border text-primary" role="status"></div>
						<span class="mt-2 text-muted">Loading...</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	/* ═══════════════════════════════════════
   Stats Cards
   ═══════════════════════════════════════ */
	.enq-stat-card {
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

	.enq-stat-card::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		width: 4px;
		height: 100%;
		border-radius: 0 4px 4px 0;
	}

	.enq-stat-card:hover {
		transform: translateY(-2px);
		box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
	}

	.enq-stat--total::before {
		background: #6366f1;
	}

	.enq-stat--today::before {
		background: #10b981;
	}

	.enq-stat--week::before {
		background: #06b6d4;
	}

	.enq-stat--pending::before {
		background: #f59e0b;
	}

	.enq-stat__icon {
		width: 48px;
		height: 48px;
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 22px;
		flex-shrink: 0;
	}

	.enq-stat--total .enq-stat__icon {
		background: #eef2ff;
		color: #6366f1;
	}

	.enq-stat--today .enq-stat__icon {
		background: #ecfdf5;
		color: #10b981;
	}

	.enq-stat--week .enq-stat__icon {
		background: #ecfeff;
		color: #06b6d4;
	}

	.enq-stat--pending .enq-stat__icon {
		background: #fffbeb;
		color: #f59e0b;
	}

	.enq-stat__info {
		display: flex;
		flex-direction: column;
	}

	.enq-stat__value {
		font-size: 22px;
		font-weight: 800;
		color: #111827;
		line-height: 1.2;
	}

	.enq-stat__label {
		font-size: 12px;
		color: #9ca3af;
		font-weight: 500;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	/* ═══════════════════════════════════════
   Main Card
   ═══════════════════════════════════════ */
	.enq-main-card {
		border: none;
		border-radius: 16px;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 6px 16px rgba(0, 0, 0, 0.04);
		overflow: hidden;
	}

	.enq-main-card .card-body {
		padding: 24px;
	}

	/* ═══════════════════════════════════════
   Toolbar
   ═══════════════════════════════════════ */
	.enq-toolbar {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 12px;
		margin-bottom: 20px;
		flex-wrap: wrap;
	}

	.enq-toolbar__left {
		flex: 1;
		min-width: 200px;
		max-width: 340px;
	}

	.enq-toolbar__right {
		display: flex;
		align-items: center;
		gap: 10px;
		flex-wrap: wrap;
	}

	.enq-search-wrap {
		position: relative;
		width: 100%;
	}

	.enq-search-icon {
		position: absolute;
		top: 50%;
		left: 14px;
		transform: translateY(-50%);
		color: #9ca3af;
		font-size: 18px;
		pointer-events: none;
	}

	.enq-search-input {
		padding: 10px 16px 10px 42px;
		border-radius: 12px;
		border: 1.5px solid #e5e7eb;
		font-size: 14px;
		background: #f9fafb;
		transition: all 0.25s ease;
		width: 100%;
	}

	.enq-search-input:focus {
		background: #fff;
		border-color: #6366f1;
		box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
	}

	.enq-filter-group {
		display: flex;
		gap: 8px;
	}

	.enq-filter-select {
		border-radius: 10px;
		border: 1.5px solid #e5e7eb;
		font-size: 13px;
		padding: 8px 32px 8px 12px;
		background-color: #f9fafb;
		color: #374151;
		min-width: 120px;
		cursor: pointer;
		transition: all 0.25s ease;
	}

	.enq-filter-select:focus {
		border-color: #6366f1;
		box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
	}

	.enq-export-btn {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		padding: 9px 16px;
		border-radius: 10px;
		border: 1.5px solid #e5e7eb;
		background: #fff;
		color: #374151;
		font-size: 13px;
		font-weight: 600;
		cursor: pointer;
		transition: all 0.25s ease;
	}

	.enq-export-btn:hover {
		background: #6366f1;
		color: #fff;
		border-color: #6366f1;
		box-shadow: 0 3px 10px rgba(99, 102, 241, 0.25);
	}

	/* ═══════════════════════════════════════
   Table
   ═══════════════════════════════════════ */
	.enq-table-wrap {
		border-radius: 12px;
		border: 1px solid #f0f1f3;
		overflow: hidden;
	}

	.enq-table {
		margin-bottom: 0;
	}

	.enq-table thead {
		background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
	}

	.enq-table thead th {
		font-size: 11px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.6px;
		color: #64748b;
		padding: 14px 14px;
		border-bottom: 2px solid #e2e8f0;
		white-space: nowrap;
	}

	.enq-th-index {
		width: 45px;
	}

	.enq-th-content {
		display: flex;
		align-items: center;
		gap: 6px;
	}

	.enq-th-content i {
		font-size: 14px;
		color: #94a3b8;
	}

	.enq-table tbody tr {
		transition: all 0.2s ease;
		animation: enqFadeIn 0.3s ease forwards;
	}

	.enq-table tbody tr:hover {
		background: #f8faff;
	}

	.enq-table tbody td {
		padding: 14px 14px;
		vertical-align: middle;
		font-size: 13.5px;
		color: #1e293b;
		border-bottom: 1px solid #f1f5f9;
	}

	@keyframes enqFadeIn {
		from {
			opacity: 0;
			transform: translateY(8px);
		}

		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	/* ═══════════════════════════════════════
   Table Cell Styles
   ═══════════════════════════════════════ */

	/* Index */
	.enq-index {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 30px;
		height: 30px;
		border-radius: 8px;
		background: #f1f5f9;
		color: #64748b;
		font-size: 12px;
		font-weight: 700;
	}

	/* User Name Cell */
	.enq-user-cell {
		display: flex;
		align-items: center;
		gap: 10px;
	}

	.enq-user-avatar {
		width: 34px;
		height: 34px;
		border-radius: 10px;
		background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
		color: #fff;
		display: flex;
		align-items: center;
		justify-content: center;
		font-weight: 700;
		font-size: 13px;
		flex-shrink: 0;
	}

	.enq-user-name {
		font-weight: 600;
		color: #1e293b;
		font-size: 13px;
	}

	/* Site Name Cell */
	.enq-site-cell {
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.enq-site-dot {
		width: 8px;
		height: 8px;
		border-radius: 50%;
		background: #10b981;
		flex-shrink: 0;
	}

	.enq-site-name {
		font-weight: 600;
		color: #374151;
	}

	/* Plot Number Badge */
	.enq-plot-badge {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		padding: 4px 12px;
		border-radius: 8px;
		background: #eef2ff;
		color: #4f46e5;
		font-weight: 700;
		font-size: 12px;
		min-width: 40px;
	}

	/* Customer Name */
	.enq-customer-name {
		font-weight: 600;
		color: #111827;
	}

	/* Mobile */
	.enq-mobile {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		color: #374151;
		font-weight: 500;
	}

	.enq-mobile i {
		color: #10b981;
		font-size: 14px;
	}

	.enq-mobile a {
		color: #374151;
		text-decoration: none;
		transition: color 0.2s;
	}

	.enq-mobile a:hover {
		color: #6366f1;
	}

	/* Notes */
	.enq-notes {
		max-width: 180px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		color: #64748b;
		font-size: 13px;
		cursor: pointer;
		position: relative;
	}

	.enq-notes:hover {
		color: #1e293b;
	}

	.enq-notes-tooltip {
		display: none;
		position: absolute;
		bottom: 100%;
		left: 0;
		background: #1e293b;
		color: #fff;
		padding: 8px 12px;
		border-radius: 8px;
		font-size: 12px;
		white-space: normal;
		max-width: 280px;
		z-index: 10;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
	}

	.enq-notes:hover .enq-notes-tooltip {
		display: block;
	}

	/* Date */
	.enq-date {
		display: flex;
		flex-direction: column;
		gap: 2px;
	}

	.enq-date__day {
		font-weight: 600;
		color: #1e293b;
		font-size: 13px;
	}

	.enq-date__time {
		font-size: 11px;
		color: #94a3b8;
	}

	/* ═══════════════════════════════════════
   Action Buttons
   ═══════════════════════════════════════ */
	.enq-actions {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 6px;
	}

	.enq-action-btn {
		width: 32px;
		height: 32px;
		border-radius: 8px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		border: 1px solid #e5e7eb;
		background: #fff;
		color: #64748b;
		font-size: 15px;
		cursor: pointer;
		transition: all 0.2s ease;
		text-decoration: none;
	}

	.enq-action-btn:hover {
		transform: translateY(-1px);
	}

	.enq-action-btn--view:hover {
		background: #6366f1;
		color: #fff;
		border-color: #6366f1;
		box-shadow: 0 3px 8px rgba(99, 102, 241, 0.3);
	}

	.enq-action-btn--call:hover {
		background: #10b981;
		color: #fff;
		border-color: #10b981;
		box-shadow: 0 3px 8px rgba(16, 185, 129, 0.3);
	}

	.enq-action-btn--whatsapp:hover {
		background: #25d366;
		color: #fff;
		border-color: #25d366;
		box-shadow: 0 3px 8px rgba(37, 211, 102, 0.3);
	}

	.enq-action-btn--edit:hover {
		background: #f59e0b;
		color: #fff;
		border-color: #f59e0b;
		box-shadow: 0 3px 8px rgba(245, 158, 11, 0.3);
	}

	.enq-action-btn--delete:hover {
		background: #ef4444;
		color: #fff;
		border-color: #ef4444;
		box-shadow: 0 3px 8px rgba(239, 68, 68, 0.3);
	}

	/* ═══════════════════════════════════════
   Empty State
   ═══════════════════════════════════════ */
	.enq-empty-state {
		text-align: center;
		padding: 60px 20px;
	}

	.enq-empty-icon {
		width: 80px;
		height: 80px;
		border-radius: 50%;
		background: #f3f4f6;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 16px;
	}

	.enq-empty-icon i {
		font-size: 36px;
		color: #d1d5db;
	}

	.enq-empty-state h6 {
		color: #6b7280;
		font-weight: 700;
		margin-bottom: 6px;
	}

	.enq-empty-state p {
		color: #9ca3af;
		font-size: 13px;
		margin-bottom: 0;
	}

	/* ═══════════════════════════════════════
   Pagination
   ═══════════════════════════════════════ */
	.enq-pagination-footer {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 16px 24px;
		background: #fafbfc;
		border-top: 1px solid #f0f1f3;
		flex-wrap: wrap;
		gap: 12px;
	}

	.enq-pagination {
		gap: 4px;
	}

	.enq-pagination .page-link {
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

	.enq-pagination .page-link:hover {
		background: #eef2ff;
		color: #6366f1;
	}

	.enq-pagination .page-item.active .page-link {
		background: #6366f1;
		color: #fff;
		box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
	}

	/* ═══════════════════════════════════════
   Modal
   ═══════════════════════════════════════ */
	.enq-modal-content {
		border: none;
		border-radius: 20px;
		overflow: hidden;
	}

	.enq-modal-header {
		background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
		color: #fff;
		border: none;
		padding: 18px 24px;
	}

	.enq-modal-header .btn-close {
		filter: brightness(0) invert(1);
		opacity: 0.8;
	}

	.enq-modal-icon {
		width: 38px;
		height: 38px;
		background: rgba(255, 255, 255, 0.2);
		border-radius: 10px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 20px;
	}

	.enq-detail-loader {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		padding: 60px 20px;
	}

	/* Detail Card inside modal */
	.enq-detail-card {
		border: 1px solid #e8ecf3;
		border-radius: 14px;
		padding: 18px;
		background: #fff;
		margin-bottom: 16px;
		animation: enqFadeIn 0.3s ease forwards;
	}

	.enq-detail-card h6 {
		font-weight: 700;
		margin-bottom: 14px;
		color: #1f2937;
		font-size: 15px;
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.enq-detail-card h6::before {
		content: '';
		width: 4px;
		height: 18px;
		background: #6366f1;
		border-radius: 4px;
		display: inline-block;
	}

	.enq-detail-grid {
		display: grid;
		grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: 14px 20px;
	}

	.enq-detail-label {
		font-size: 11px;
		color: #9ca3af;
		margin-bottom: 4px;
		text-transform: uppercase;
		letter-spacing: 0.3px;
		font-weight: 600;
	}

	.enq-detail-value {
		font-size: 14px;
		color: #111827;
		font-weight: 600;
		word-break: break-word;
	}

	/* ═══════════════════════════════════════
   Row Status Indicator
   ═══════════════════════════════════════ */
	.enq-table tbody tr {
		position: relative;
	}

	.enq-row-new td:first-child {
		position: relative;
	}

	.enq-row-new td:first-child::before {
		content: '';
		position: absolute;
		left: 0;
		top: 50%;
		transform: translateY(-50%);
		width: 3px;
		height: 60%;
		background: #6366f1;
		border-radius: 0 3px 3px 0;
	}

	/* ═══════════════════════════════════════
   Responsive
   ═══════════════════════════════════════ */
	@media (max-width: 991px) {
		.enq-toolbar {
			flex-direction: column;
			align-items: stretch;
		}

		.enq-toolbar__left {
			max-width: 100%;
		}

		.enq-toolbar__right {
			justify-content: space-between;
		}
	}

	@media (max-width: 767px) {
		.enq-detail-grid {
			grid-template-columns: 1fr;
		}

		.enq-filter-group {
			flex-direction: column;
			width: 100%;
		}

		.enq-filter-select {
			width: 100%;
		}

		.enq-pagination-footer {
			justify-content: center;
		}

		.enq-stat__value {
			font-size: 18px;
		}

		.enq-notes {
			max-width: 120px;
		}
	}

	@media (max-width: 575px) {
		.enq-main-card .card-body {
			padding: 16px;
		}

		.enq-table thead th {
			padding: 12px 10px;
			font-size: 10px;
		}

		.enq-table tbody td {
			padding: 12px 10px;
			font-size: 12px;
		}
	}

	/* ═══════════════════════════════════════
   Hover Row Highlight Bar
   ═══════════════════════════════════════ */
	.enq-table tbody tr::after {
		content: '';
		position: absolute;
		left: 0;
		top: 0;
		width: 0;
		height: 100%;
		background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, transparent 100%);
		transition: width 0.3s ease;
		pointer-events: none;
	}

	.enq-table tbody tr:hover::after {
		width: 100%;
	}

	/* ═══════════════════════════════════════
   Scrollbar Styling
   ═══════════════════════════════════════ */
	.enq-table-wrap::-webkit-scrollbar {
		height: 6px;
	}

	.enq-table-wrap::-webkit-scrollbar-track {
		background: #f1f5f9;
		border-radius: 3px;
	}

	.enq-table-wrap::-webkit-scrollbar-thumb {
		background: #cbd5e1;
		border-radius: 3px;
	}

	.enq-table-wrap::-webkit-scrollbar-thumb:hover {
		background: #94a3b8;
	}
</style>

<script>
	// ═══════════════════════════════════════
	// Search with debounce
	// ═══════════════════════════════════════
	(function () {
		var searchTimer;
		var searchInput = document.getElementById('serchinquiry');
		if (searchInput) {
			searchInput.addEventListener('input', function () {
				clearTimeout(searchTimer);
				var val = this.value.toLowerCase();
				searchTimer = setTimeout(function () {
					var rows = document.querySelectorAll('#inquiryTableBody tr');
					var hasVisible = false;
					rows.forEach(function (row) {
						var text = row.textContent.toLowerCase();
						if (text.indexOf(val) > -1) {
							row.style.display = '';
							hasVisible = true;
						} else {
							row.style.display = 'none';
						}
					});

					var emptyState = document.getElementById('enqEmptyState');
					if (emptyState) {
						if (!hasVisible && val.length > 0) {
							emptyState.classList.remove('d-none');
						} else {
							emptyState.classList.add('d-none');
						}
					}
				}, 300);
			});
		}
	})();

	// ═══════════════════════════════════════
	// Enquiry Detail Modal
	// ═══════════════════════════════════════
	document.addEventListener('click', function (e) {
		var btn = e.target.closest('.viewEnquiryDetail');
		if (!btn) return;

		var content = document.getElementById('enquiryDetailContent');
		if (!content) return;

		content.innerHTML = '<div class="enq-detail-loader"><div class="spinner-border text-primary" role="status"></div><span class="mt-2 text-muted">Loading...</span></div>';

		if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
			var modalEl = document.getElementById('enquiryDetailModal');
			var modal = new bootstrap.Modal(modalEl);
			modal.show();
		}

		// Get data from row data attributes
		var row = btn.closest('tr');
		if (row) {
			var userName = row.getAttribute('data-user') || '-';
			var siteName = row.getAttribute('data-site') || '-';
			var plotNumber = row.getAttribute('data-plot') || '-';
			var customerName = row.getAttribute('data-customer') || '-';
			var mobile = row.getAttribute('data-mobile') || '-';
			var notes = row.getAttribute('data-notes') || '-';
			var date = row.getAttribute('data-date') || '-';

			content.innerHTML =
				'<div class="enq-detail-card">' +
				'<h6>Enquiry Information</h6>' +
				'<div class="enq-detail-grid">' +
				'<div><div class="enq-detail-label">User Name</div><div class="enq-detail-value">' + userName + '</div></div>' +
				'<div><div class="enq-detail-label">Site Name</div><div class="enq-detail-value">' + siteName + '</div></div>' +
				'<div><div class="enq-detail-label">Plot Number</div><div class="enq-detail-value">' + plotNumber + '</div></div>' +
				'<div><div class="enq-detail-label">Enquiry Date</div><div class="enq-detail-value">' + date + '</div></div>' +
				'</div>' +
				'</div>' +
				'<div class="enq-detail-card">' +
				'<h6>Customer Details</h6>' +
				'<div class="enq-detail-grid">' +
				'<div><div class="enq-detail-label">Customer Name</div><div class="enq-detail-value">' + customerName + '</div></div>' +
				'<div><div class="enq-detail-label">Mobile</div><div class="enq-detail-value"><a href="tel:' + mobile + '" style="color:#6366f1;text-decoration:none;font-weight:700"><i class="bx bx-phone"></i> ' + mobile + '</a></div></div>' +
				'</div>' +
				'</div>' +
				'<div class="enq-detail-card">' +
				'<h6>Notes</h6>' +
				'<p style="color:#374151;font-size:14px;line-height:1.6;margin:0">' + notes + '</p>' +
				'</div>' +
				'<div class="d-flex gap-2 mt-3">' +
				'<a href="tel:' + mobile + '" class="btn btn-sm" style="background:#10b981;color:#fff;border-radius:10px;padding:8px 20px;font-weight:600"><i class="bx bx-phone"></i> Call</a>' +
				'<a href="https://wa.me/' + mobile + '" target="_blank" class="btn btn-sm" style="background:#25d366;color:#fff;border-radius:10px;padding:8px 20px;font-weight:600"><i class="bx bxl-whatsapp"></i> WhatsApp</a>' +
				'</div>';
		}
	});
</script>