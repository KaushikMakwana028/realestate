<div class="page-wrapper">
	<div class="page-content">

		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"><i
									class="bx bx-home-alt"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Users</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->

		<!-- Stats Cards -->
		<div class="row g-3 mb-4">
			<div class="col-6 col-lg-3">
				<div class="usr-stat-card usr-stat--total">
					<div class="usr-stat__icon">
						<i class="bx bx-group"></i>
					</div>
					<div class="usr-stat__info">
						<span class="usr-stat__value" id="statTotalUsers">--</span>
						<span class="usr-stat__label">Total Users</span>
					</div>
					<div class="usr-stat__trend usr-stat__trend--up">
						<i class="bx bx-trending-up"></i>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="usr-stat-card usr-stat--active">
					<div class="usr-stat__icon">
						<i class="bx bx-user-check"></i>
					</div>
					<div class="usr-stat__info">
						<span class="usr-stat__value" id="statActiveUsers">--</span>
						<span class="usr-stat__label">Active</span>
					</div>
					<div class="usr-stat__trend usr-stat__trend--up">
						<i class="bx bx-trending-up"></i>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="usr-stat-card usr-stat--salary">
					<div class="usr-stat__icon">
						<i class="bx bx-rupee"></i>
					</div>
					<div class="usr-stat__info">
						<span class="usr-stat__value" id="statTotalSalary">--</span>
						<span class="usr-stat__label">Total Salary</span>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="usr-stat-card usr-stat--pending">
					<div class="usr-stat__icon">
						<i class="bx bx-wallet"></i>
					</div>
					<div class="usr-stat__info">
						<span class="usr-stat__value" id="statTotalPayable">--</span>
						<span class="usr-stat__label">Total Payable</span>
					</div>
					<div class="usr-stat__trend usr-stat__trend--down">
						<i class="bx bx-trending-down"></i>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Card -->
		<div class="card usr-main-card">
			<div class="card-body">
				<!-- Toolbar -->
				<div class="usr-toolbar">
					<div class="usr-toolbar__left">
						<div class="usr-search-wrap">
							<i class="bx bx-search usr-search-icon"></i>
							<input type="text" id="serchUser" class="form-control usr-search-input"
								placeholder="Search by name, email, mobile...">
							<kbd class="usr-search-kbd d-none d-md-inline">Ctrl+K</kbd>
						</div>
					</div>
					<div class="usr-toolbar__right">
						<div class="usr-filter-group">
							<button class="usr-filter-chip active" data-filter="all">
								<i class="bx bx-group"></i> All
							</button>
							<button class="usr-filter-chip" data-filter="active">
								<i class="bx bx-check-circle"></i> Active
							</button>
							<button class="usr-filter-chip" data-filter="inactive">
								<i class="bx bx-x-circle"></i> Inactive
							</button>
						</div>
						<button class="btn usr-add-btn" title="Add User">
							<i class="bx bx-plus"></i>
							<span class="d-none d-md-inline">Add User</span>
						</button>
					</div>
				</div>

				<!-- Table View -->
				<div class="table-responsive usr-table-wrap">
					<table class="table usr-table mb-0">
						<thead>
							<tr>
								<th class="usr-th-index">#</th>
								<th>
									<div class="usr-th-content">
										<i class="bx bx-user"></i> User
									</div>
								</th>
								<th>
									<div class="usr-th-content">
										<i class="bx bx-phone"></i> Mobile
									</div>
								</th>
								<th>
									<div class="usr-th-content">
										<i class="bx bx-envelope"></i> Email
									</div>
								</th>
								<th>
									<div class="usr-th-content">
										<i class="bx bx-envelope"></i> Profile
									</div>
								</th>
								<th class="text-center">
									<div class="usr-th-content justify-content-center">
										<i class="bx bx-toggle-right"></i> Status
									</div>
								</th>
								<th class="text-center">
									<div class="usr-th-content justify-content-center">
										<i class="bx bx-rupee"></i> Salary
									</div>
								</th>
								<th class="text-center">
									<div class="usr-th-content justify-content-center">
										<i class="bx bx-money"></i> UPAD
									</div>
								</th>
								<th class="text-center">
									<div class="usr-th-content justify-content-center">
										<i class="bx bx-wallet"></i> Payable
									</div>
								</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody id="userTable">
							<!-- Dynamic rows -->
						</tbody>
					</table>
				</div>

				<!-- Empty State -->
				<div class="usr-empty-state d-none" id="usrEmptyState">
					<div class="usr-empty-icon">
						<i class="bx bx-user-x"></i>
					</div>
					<h6>No Users Found</h6>
					<p>Try adjusting your search or filter criteria</p>
				</div>
			</div>

			<!-- Pagination -->
			<div class="usr-pagination-footer">
				<div class="usr-pagination-info">
					<span class="text-muted" id="usrPaginationInfo">Showing 1-10 of 50 users</span>
				</div>
				<nav aria-label="Page navigation">
					<ul class="pagination usr-pagination mb-0">
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

<!-- User Detail Modal -->
<div class="modal fade" id="userDetailModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content usr-modal-content">
			<div class="modal-header usr-modal-header">
				<div class="d-flex align-items-center gap-2">
					<div class="usr-modal-icon">
						<i class="bx bx-user"></i>
					</div>
					<h5 class="modal-title fw-bold mb-0">User Profile</h5>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-0">
				<div id="userDetailContent" class="p-4">
					<div class="usr-detail-loader">
						<div class="spinner-border text-primary" role="status"></div>
						<span class="mt-2 text-muted">Loading profile...</span>
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
	.usr-stat-card {
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

	.usr-stat-card::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		width: 4px;
		height: 100%;
		border-radius: 0 4px 4px 0;
	}

	.usr-stat-card:hover {
		transform: translateY(-2px);
		box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
	}

	.usr-stat--total::before {
		background: #6366f1;
	}

	.usr-stat--active::before {
		background: #10b981;
	}

	.usr-stat--salary::before {
		background: #06b6d4;
	}

	.usr-stat--pending::before {
		background: #f59e0b;
	}

	.usr-stat__icon {
		width: 48px;
		height: 48px;
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 22px;
		flex-shrink: 0;
	}

	.usr-stat--total .usr-stat__icon {
		background: #eef2ff;
		color: #6366f1;
	}

	.usr-stat--active .usr-stat__icon {
		background: #ecfdf5;
		color: #10b981;
	}

	.usr-stat--salary .usr-stat__icon {
		background: #ecfeff;
		color: #06b6d4;
	}

	.usr-stat--pending .usr-stat__icon {
		background: #fffbeb;
		color: #f59e0b;
	}

	.usr-stat__info {
		display: flex;
		flex-direction: column;
		flex: 1;
	}

	.usr-stat__value {
		font-size: 22px;
		font-weight: 800;
		color: #111827;
		line-height: 1.2;
	}

	.usr-stat__label {
		font-size: 12px;
		color: #9ca3af;
		font-weight: 500;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.usr-stat__trend {
		width: 32px;
		height: 32px;
		border-radius: 8px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 16px;
	}

	.usr-stat__trend--up {
		background: #ecfdf5;
		color: #10b981;
	}

	.usr-stat__trend--down {
		background: #fef2f2;
		color: #ef4444;
	}

	/* ═══════════════════════════════════════
   Main Card
   ═══════════════════════════════════════ */
	.usr-main-card {
		border: none;
		border-radius: 16px;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 6px 16px rgba(0, 0, 0, 0.04);
		overflow: hidden;
	}

	.usr-main-card .card-body {
		padding: 24px;
	}

	/* ═══════════════════════════════════════
   Toolbar
   ═══════════════════════════════════════ */
	.usr-toolbar {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 12px;
		margin-bottom: 20px;
		flex-wrap: wrap;
	}

	.usr-toolbar__left {
		flex: 1;
		min-width: 200px;
		max-width: 380px;
	}

	.usr-toolbar__right {
		display: flex;
		align-items: center;
		gap: 10px;
		flex-wrap: wrap;
	}

	.usr-search-wrap {
		position: relative;
		width: 100%;
	}

	.usr-search-icon {
		position: absolute;
		top: 50%;
		left: 14px;
		transform: translateY(-50%);
		color: #9ca3af;
		font-size: 18px;
		pointer-events: none;
	}

	.usr-search-input {
		padding: 10px 60px 10px 42px;
		border-radius: 12px;
		border: 1.5px solid #e5e7eb;
		font-size: 14px;
		background: #f9fafb;
		transition: all 0.25s ease;
		width: 100%;
	}

	.usr-search-input:focus {
		background: #fff;
		border-color: #6366f1;
		box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
	}

	.usr-search-kbd {
		position: absolute;
		top: 50%;
		right: 12px;
		transform: translateY(-50%);
		background: #e5e7eb;
		color: #6b7280;
		padding: 2px 8px;
		border-radius: 6px;
		font-size: 11px;
		font-family: inherit;
		pointer-events: none;
		border: 1px solid #d1d5db;
	}

	/* Filter Chips */
	.usr-filter-group {
		display: flex;
		background: #f3f4f6;
		border-radius: 10px;
		padding: 3px;
		gap: 2px;
	}

	.usr-filter-chip {
		border: none;
		background: transparent;
		padding: 7px 14px;
		border-radius: 8px;
		color: #6b7280;
		font-size: 13px;
		font-weight: 600;
		cursor: pointer;
		transition: all 0.2s ease;
		display: flex;
		align-items: center;
		gap: 5px;
		white-space: nowrap;
	}

	.usr-filter-chip i {
		font-size: 15px;
	}

	.usr-filter-chip.active {
		background: #fff;
		color: #6366f1;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
	}

	.usr-filter-chip:hover:not(.active) {
		color: #374151;
		background: rgba(255, 255, 255, 0.5);
	}

	/* Add Button */
	.usr-add-btn {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		padding: 9px 18px;
		border-radius: 10px;
		background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
		color: #fff;
		font-size: 13px;
		font-weight: 600;
		border: none;
		cursor: pointer;
		transition: all 0.25s ease;
		box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
	}

	.usr-add-btn:hover {
		transform: translateY(-1px);
		box-shadow: 0 4px 14px rgba(99, 102, 241, 0.4);
		color: #fff;
	}

	.usr-add-btn i {
		font-size: 18px;
	}

	/* ═══════════════════════════════════════
   Table
   ═══════════════════════════════════════ */
	.usr-table-wrap {
		border-radius: 12px;
		border: 1px solid #f0f1f3;
		overflow: hidden;
	}

	.usr-table {
		margin-bottom: 0;
	}

	.usr-table thead {
		background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
	}

	.usr-table thead th {
		font-size: 11px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.6px;
		color: #64748b;
		padding: 14px 14px;
		border-bottom: 2px solid #e2e8f0;
		white-space: nowrap;
	}

	.usr-th-index {
		width: 45px;
	}

	.usr-th-content {
		display: flex;
		align-items: center;
		gap: 6px;
	}

	.usr-th-content i {
		font-size: 14px;
		color: #94a3b8;
	}

	.usr-table tbody tr {
		transition: all 0.2s ease;
		animation: usrFadeIn 0.3s ease forwards;
		position: relative;
	}

	.usr-table tbody tr:hover {
		background: #f8faff;
	}

	.usr-table tbody td {
		padding: 12px 14px;
		vertical-align: middle;
		font-size: 13.5px;
		color: #1e293b;
		border-bottom: 1px solid #f1f5f9;
	}

	@keyframes usrFadeIn {
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
	.usr-index {
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

	/* User Profile Cell */
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
		transition: all 0.25s ease;
	}

	.usr-table tbody tr:hover .usr-avatar__img {
		border-color: #c7d2fe;
		box-shadow: 0 2px 8px rgba(99, 102, 241, 0.15);
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
		flex-shrink: 0;
	}

	.usr-avatar__status {
		position: absolute;
		bottom: -2px;
		right: -2px;
		width: 12px;
		height: 12px;
		border-radius: 50%;
		border: 2px solid #fff;
	}

	.usr-avatar__status--active {
		background: #10b981;
	}

	.usr-avatar__status--inactive {
		background: #ef4444;
	}

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

	/* Mobile Cell */
	.usr-mobile {
		display: inline-flex;
		align-items: center;
		gap: 6px;
	}

	.usr-mobile__icon {
		width: 26px;
		height: 26px;
		border-radius: 7px;
		background: #ecfdf5;
		color: #10b981;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 13px;
		flex-shrink: 0;
	}

	.usr-mobile a {
		color: #374151;
		text-decoration: none;
		font-weight: 600;
		font-size: 13px;
		transition: color 0.2s;
	}

	.usr-mobile a:hover {
		color: #6366f1;
	}

	/* Email Cell */
	.usr-email {
		display: inline-flex;
		align-items: center;
		gap: 6px;
	}

	.usr-email__icon {
		width: 26px;
		height: 26px;
		border-radius: 7px;
		background: #eef2ff;
		color: #6366f1;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 13px;
		flex-shrink: 0;
	}

	.usr-email a {
		color: #64748b;
		text-decoration: none;
		font-size: 13px;
		transition: color 0.2s;
		max-width: 180px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		display: inline-block;
	}

	.usr-email a:hover {
		color: #6366f1;
	}

	/* Status Badge */
	.usr-status {
		display: inline-flex;
		align-items: center;
		gap: 5px;
		padding: 5px 12px;
		border-radius: 999px;
		font-size: 11px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.3px;
	}

	.usr-status--active {
		background: #ecfdf5;
		color: #059669;
		border: 1px solid #a7f3d0;
	}

	.usr-status--active::before {
		content: '';
		width: 6px;
		height: 6px;
		border-radius: 50%;
		background: #10b981;
		animation: usrPulse 2s infinite;
	}

	.usr-status--inactive {
		background: #fef2f2;
		color: #dc2626;
		border: 1px solid #fecaca;
	}

	.usr-status--inactive::before {
		content: '';
		width: 6px;
		height: 6px;
		border-radius: 50%;
		background: #ef4444;
	}

	@keyframes usrPulse {

		0%,
		100% {
			opacity: 1;
		}

		50% {
			opacity: 0.4;
		}
	}

	/* Money Values */
	.usr-money {
		font-weight: 700;
		font-size: 13px;
		font-variant-numeric: tabular-nums;
	}

	.usr-money--salary {
		color: #1e293b;
	}

	.usr-money--upad {
		color: #059669;
	}

	.usr-money--payable {
		padding: 4px 10px;
		border-radius: 8px;
		font-size: 13px;
	}

	.usr-money--payable-positive {
		background: #fef2f2;
		color: #dc2626;
	}

	.usr-money--payable-zero {
		background: #ecfdf5;
		color: #059669;
	}

	/* ═══════════════════════════════════════
   Action Buttons
   ═══════════════════════════════════════ */
	.usr-actions {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 5px;
	}

	.usr-action-btn {
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
		position: relative;
	}

	.usr-action-btn:hover {
		transform: translateY(-1px);
	}

	.usr-action-btn--view:hover {
		background: #6366f1;
		color: #fff;
		border-color: #6366f1;
		box-shadow: 0 3px 8px rgba(99, 102, 241, 0.3);
	}

	.usr-action-btn--edit:hover {
		background: #f59e0b;
		color: #fff;
		border-color: #f59e0b;
		box-shadow: 0 3px 8px rgba(245, 158, 11, 0.3);
	}

	.usr-action-btn--salary:hover {
		background: #06b6d4;
		color: #fff;
		border-color: #06b6d4;
		box-shadow: 0 3px 8px rgba(6, 182, 212, 0.3);
	}

	.usr-action-btn--call:hover {
		background: #10b981;
		color: #fff;
		border-color: #10b981;
		box-shadow: 0 3px 8px rgba(16, 185, 129, 0.3);
	}

	.usr-action-btn--delete:hover {
		background: #ef4444;
		color: #fff;
		border-color: #ef4444;
		box-shadow: 0 3px 8px rgba(239, 68, 68, 0.3);
	}

	/* Action tooltip */
	.usr-action-btn[title]:hover::after {
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

	.usr-action-btn[title]:hover::before {
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

	/* ═══════════════════════════════════════
   Empty State
   ═══════════════════════════════════════ */
	.usr-empty-state {
		text-align: center;
		padding: 60px 20px;
	}

	.usr-empty-icon {
		width: 80px;
		height: 80px;
		border-radius: 50%;
		background: #f3f4f6;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 16px;
	}

	.usr-empty-icon i {
		font-size: 36px;
		color: #d1d5db;
	}

	.usr-empty-state h6 {
		color: #6b7280;
		font-weight: 700;
		margin-bottom: 6px;
	}

	.usr-empty-state p {
		color: #9ca3af;
		font-size: 13px;
		margin-bottom: 0;
	}

	/* ═══════════════════════════════════════
   Pagination
   ═══════════════════════════════════════ */
	.usr-pagination-footer {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 16px 24px;
		background: #fafbfc;
		border-top: 1px solid #f0f1f3;
		flex-wrap: wrap;
		gap: 12px;
	}

	.usr-pagination {
		gap: 4px;
	}

	.usr-pagination .page-link {
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

	.usr-pagination .page-link:hover {
		background: #eef2ff;
		color: #6366f1;
	}

	.usr-pagination .page-item.active .page-link {
		background: #6366f1;
		color: #fff;
		box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
	}

	/* ═══════════════════════════════════════
   Modal
   ═══════════════════════════════════════ */
	.usr-modal-content {
		border: none;
		border-radius: 20px;
		overflow: hidden;
	}

	.usr-modal-header {
		background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
		color: #fff;
		border: none;
		padding: 18px 24px;
	}

	.usr-modal-header .btn-close {
		filter: brightness(0) invert(1);
		opacity: 0.8;
	}

	.usr-modal-icon {
		width: 38px;
		height: 38px;
		background: rgba(255, 255, 255, 0.2);
		border-radius: 10px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 20px;
	}

	.usr-detail-loader {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		padding: 60px 20px;
	}

	/* Modal Profile Section */
	.usr-modal-profile {
		display: flex;
		align-items: center;
		gap: 20px;
		padding: 20px;
		background: linear-gradient(135deg, #f8faff 0%, #eef2ff 100%);
		border-radius: 14px;
		margin-bottom: 20px;
		border: 1px solid #e0e7ff;
	}

	.usr-modal-avatar {
		width: 72px;
		height: 72px;
		border-radius: 16px;
		object-fit: cover;
		border: 3px solid #c7d2fe;
		box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
	}

	.usr-modal-avatar-placeholder {
		width: 72px;
		height: 72px;
		border-radius: 16px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-weight: 800;
		font-size: 24px;
		color: #fff;
		background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
		box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
	}

	.usr-modal-profile-info h5 {
		font-weight: 800;
		color: #1e293b;
		margin-bottom: 4px;
	}

	.usr-modal-profile-info p {
		color: #64748b;
		font-size: 13px;
		margin-bottom: 0;
	}

	/* Detail Card */
	.usr-detail-card {
		border: 1px solid #e8ecf3;
		border-radius: 14px;
		padding: 18px;
		background: #fff;
		margin-bottom: 16px;
		animation: usrFadeIn 0.3s ease forwards;
	}

	.usr-detail-card h6 {
		font-weight: 700;
		margin-bottom: 14px;
		color: #1f2937;
		font-size: 15px;
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.usr-detail-card h6::before {
		content: '';
		width: 4px;
		height: 18px;
		background: #6366f1;
		border-radius: 4px;
	}

	.usr-detail-grid {
		display: grid;
		grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: 14px 20px;
	}

	.usr-detail-label {
		font-size: 11px;
		color: #9ca3af;
		margin-bottom: 4px;
		text-transform: uppercase;
		letter-spacing: 0.3px;
		font-weight: 600;
	}

	.usr-detail-value {
		font-size: 14px;
		color: #111827;
		font-weight: 600;
		word-break: break-word;
	}

	/* Salary Summary in Modal */
	.usr-salary-summary {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 12px;
	}

	.usr-salary-box {
		text-align: center;
		padding: 16px 12px;
		border-radius: 12px;
		border: 1px solid #e8ecf3;
	}

	.usr-salary-box__value {
		font-size: 20px;
		font-weight: 800;
		display: block;
		margin-bottom: 4px;
	}

	.usr-salary-box__label {
		font-size: 11px;
		color: #9ca3af;
		text-transform: uppercase;
		letter-spacing: 0.3px;
		font-weight: 600;
	}

	.usr-salary-box--salary {
		background: #f0fdf4;
	}

	.usr-salary-box--salary .usr-salary-box__value {
		color: #059669;
	}

	.usr-salary-box--upad {
		background: #ecfeff;
	}

	.usr-salary-box--upad .usr-salary-box__value {
		color: #0891b2;
	}

	.usr-salary-box--payable {
		background: #fef2f2;
	}

	.usr-salary-box--payable .usr-salary-box__value {
		color: #dc2626;
	}

	/* ═══════════════════════════════════════
   Avatar Color Variations
   ═══════════════════════════════════════ */
	.usr-avatar-color-1 {
		background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
	}

	.usr-avatar-color-2 {
		background: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%);
	}

	.usr-avatar-color-3 {
		background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
	}

	.usr-avatar-color-4 {
		background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
	}

	.usr-avatar-color-5 {
		background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
	}

	.usr-avatar-color-6 {
		background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
	}

	/* ═══════════════════════════════════════
   Scrollbar
   ═══════════════════════════════════════ */
	.usr-table-wrap::-webkit-scrollbar {
		height: 6px;
	}

	.usr-table-wrap::-webkit-scrollbar-track {
		background: #f1f5f9;
		border-radius: 3px;
	}

	.usr-table-wrap::-webkit-scrollbar-thumb {
		background: #cbd5e1;
		border-radius: 3px;
	}

	.usr-table-wrap::-webkit-scrollbar-thumb:hover {
		background: #94a3b8;
	}

	/* ═══════════════════════════════════════
   Responsive
   ═══════════════════════════════════════ */
	@media (max-width: 991px) {
		.usr-toolbar {
			flex-direction: column;
			align-items: stretch;
		}

		.usr-toolbar__left {
			max-width: 100%;
		}

		.usr-toolbar__right {
			justify-content: space-between;
		}
	}

	@media (max-width: 767px) {
		.usr-detail-grid {
			grid-template-columns: 1fr;
		}

		.usr-salary-summary {
			grid-template-columns: 1fr;
		}

		.usr-filter-group {
			width: 100%;
		}

		.usr-filter-chip {
			flex: 1;
			justify-content: center;
		}

		.usr-pagination-footer {
			justify-content: center;
		}

		.usr-stat__value {
			font-size: 18px;
		}

		.usr-modal-profile {
			flex-direction: column;
			text-align: center;
		}
	}

	@media (max-width: 575px) {
		.usr-main-card .card-body {
			padding: 16px;
		}

		.usr-table thead th {
			padding: 12px 10px;
			font-size: 10px;
		}

		.usr-table tbody td {
			padding: 10px 10px;
			font-size: 12px;
		}

		.usr-avatar__img,
		.usr-avatar__placeholder {
			width: 34px;
			height: 34px;
			border-radius: 10px;
			font-size: 12px;
		}
	}
</style>

<script>
	// ═══════════════════════════════════════
	// Filter Chips
	// ═══════════════════════════════════════
	document.querySelectorAll('.usr-filter-chip').forEach(function (chip) {
		chip.addEventListener('click', function () {
			document.querySelectorAll('.usr-filter-chip').forEach(function (c) {
				c.classList.remove('active');
			});
			this.classList.add('active');

			var filter = this.getAttribute('data-filter');
			var rows = document.querySelectorAll('#userTable tr');
			var hasVisible = false;

			rows.forEach(function (row) {
				var status = (row.getAttribute('data-status') || '').toLowerCase();
				if (filter === 'all' || status === filter) {
					row.style.display = '';
					hasVisible = true;
				} else {
					row.style.display = 'none';
				}
			});

			var emptyState = document.getElementById('usrEmptyState');
			if (emptyState) {
				emptyState.classList.toggle('d-none', hasVisible);
			}
		});
	});

	// ═══════════════════════════════════════
	// Search with debounce
	// ═══════════════════════════════════════
	(function () {
		var searchTimer;
		var searchInput = document.getElementById('serchUser');
		if (searchInput) {
			searchInput.addEventListener('input', function () {
				clearTimeout(searchTimer);
				var val = this.value.toLowerCase();
				searchTimer = setTimeout(function () {
					var rows = document.querySelectorAll('#userTable tr');
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

					var emptyState = document.getElementById('usrEmptyState');
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
	// Keyboard shortcut (Cmd/Ctrl + K)
	// ═══════════════════════════════════════
	document.addEventListener('keydown', function (e) {
		if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
			e.preventDefault();
			var input = document.getElementById('serchUser');
			if (input) input.focus();
		}
	});

	// ═══════════════════════════════════════
	// User Detail Modal
	// ═══════════════════════════════════════
	document.addEventListener('click', function (e) {
		var btn = e.target.closest('.viewUserDetail');
		if (!btn) return;

		var content = document.getElementById('userDetailContent');
		if (!content) return;

		content.innerHTML = '<div class="usr-detail-loader"><div class="spinner-border text-primary" role="status"></div><span class="mt-2 text-muted">Loading profile...</span></div>';

		if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
			var modalEl = document.getElementById('userDetailModal');
			var modal = new bootstrap.Modal(modalEl);
			modal.show();
		}

		var row = btn.closest('tr');
		if (row) {
			var name = row.getAttribute('data-name') || '-';
			var email = row.getAttribute('data-email') || '-';
			var mobile = row.getAttribute('data-mobile') || '-';
			var status = row.getAttribute('data-status') || '-';
			var salary = row.getAttribute('data-salary') || '0';
			var upad = row.getAttribute('data-upad') || '0';
			var payable = row.getAttribute('data-payable') || '0';
			var image = row.getAttribute('data-image') || '';
			var initials = name.split(' ').map(function (w) { return w[0]; }).join('').toUpperCase().substring(0, 2);
			var colorIdx = (name.charCodeAt(0) % 6) + 1;

			var avatarHtml = image
				? '<img src="' + image + '" class="usr-modal-avatar" alt="' + name + '">'
				: '<div class="usr-modal-avatar-placeholder usr-avatar-color-' + colorIdx + '">' + initials + '</div>';

			var statusBadge = status.toLowerCase() === 'active'
				? '<span class="usr-status usr-status--active">Active</span>'
				: '<span class="usr-status usr-status--inactive">Inactive</span>';

			content.innerHTML =
				'<div class="usr-modal-profile">' +
				avatarHtml +
				'<div class="usr-modal-profile-info">' +
				'<h5>' + name + '</h5>' +
				'<p><i class="bx bx-envelope"></i> ' + email + ' &nbsp;&bull;&nbsp; <i class="bx bx-phone"></i> ' + mobile + '</p>' +
				'<div class="mt-2">' + statusBadge + '</div>' +
				'</div>' +
				'</div>' +

				'<div class="usr-detail-card">' +
				'<h6>Salary Overview</h6>' +
				'<div class="usr-salary-summary">' +
				'<div class="usr-salary-box usr-salary-box--salary">' +
				'<span class="usr-salary-box__value">₹' + salary + '</span>' +
				'<span class="usr-salary-box__label">Monthly Salary</span>' +
				'</div>' +
				'<div class="usr-salary-box usr-salary-box--upad">' +
				'<span class="usr-salary-box__value">₹' + upad + '</span>' +
				'<span class="usr-salary-box__label">Total UPAD</span>' +
				'</div>' +
				'<div class="usr-salary-box usr-salary-box--payable">' +
				'<span class="usr-salary-box__value">₹' + payable + '</span>' +
				'<span class="usr-salary-box__label">Total Payable</span>' +
				'</div>' +
				'</div>' +
				'</div>' +

				'<div class="usr-detail-card">' +
				'<h6>Contact Information</h6>' +
				'<div class="usr-detail-grid">' +
				'<div><div class="usr-detail-label">Full Name</div><div class="usr-detail-value">' + name + '</div></div>' +
				'<div><div class="usr-detail-label">Email</div><div class="usr-detail-value">' + email + '</div></div>' +
				'<div><div class="usr-detail-label">Mobile</div><div class="usr-detail-value"><a href="tel:' + mobile + '" style="color:#6366f1;text-decoration:none"><i class="bx bx-phone"></i> ' + mobile + '</a></div></div>' +
				'<div><div class="usr-detail-label">Status</div><div class="usr-detail-value">' + statusBadge + '</div></div>' +
				'</div>' +
				'</div>' +

				'<div class="d-flex gap-2 mt-3">' +
				'<a href="tel:' + mobile + '" class="btn btn-sm" style="background:#10b981;color:#fff;border-radius:10px;padding:8px 20px;font-weight:600"><i class="bx bx-phone"></i> Call</a>' +
				'<a href="mailto:' + email + '" class="btn btn-sm" style="background:#6366f1;color:#fff;border-radius:10px;padding:8px 20px;font-weight:600"><i class="bx bx-envelope"></i> Email</a>' +
				'<a href="https://wa.me/' + mobile + '" target="_blank" class="btn btn-sm" style="background:#25d366;color:#fff;border-radius:10px;padding:8px 20px;font-weight:600"><i class="bx bxl-whatsapp"></i> WhatsApp</a>' +
				'</div>';
		}
	});
</script>



