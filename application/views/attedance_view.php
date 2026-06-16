<div class="page-wrapper attendance-page">
	<div class="page-content">

		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3 fw-bold" style="font-size: 1.25rem; color: #2c3e50;">
				<i class="bx bx-calendar-check me-2" style="color: #6366f1;"></i>Attendance Management
			</div>
			<div class="ps-3 ms-auto">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0" style="background: transparent;">
						<li class="breadcrumb-item">
							<a href="<?= base_url('dashboard'); ?>" class="text-decoration-none" style="color: #6366f1;">
								<i class="bx bx-home-alt"></i> Home
							</a>
						</li>
						<li class="breadcrumb-item active text-muted" aria-current="page">Attendance</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->

		<!-- Main Table Card -->
		<div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
			<!-- Card Header -->
			<div class="card-header bg-white py-3 att-toolbar-wrap">
				<div class="att-toolbar">
					<div class="att-toolbar__left">
						<div class="att-search-wrap">
							<i class="bx bx-search att-search-icon"></i>
							<input type="text" id="serchattedance" class="form-control att-search-input"
								placeholder="Search by name, date, status...">
						</div>
					</div>
					<div class="att-toolbar__right">
						<div class="att-filter-group">
							<input type="month" id="dateFilter" class="form-control att-filter-select">
							<select class="form-select att-filter-select" id="statusFilter">
								<option value="">All Status</option>
								<option value="present">Present</option>
								<option value="absent">Absent</option>
								<option value="pending">Pending</option>
								<option value="rejected">Rejected</option>
							</select>
						</div>
						<button type="button" id="showAllAttendanceBtn" class="att-show-all-btn d-none" title="Show all attendance records">
							<i class="bx bx-list-ul"></i><span class="d-none d-xl-inline">Show All Data</span>
						</button>
						<button class="att-icon-btn" onclick="refreshTable()" title="Refresh">
							<i class="bx bx-refresh"></i>
						</button>
					</div>
				</div>
			</div>

			<!-- Table -->
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-hover align-middle mb-0" id="attendanceTable">
						<thead class="att-table-head">
							<tr>
								<th class="att-th-index">#</th>
								<th>
									<div class="att-th-content"><i class="bx bx-user"></i> Employee</div>
								</th>
								<th>
									<div class="att-th-content"><i class="bx bx-image"></i> Photo</div>
								</th>
								<th>
									<div class="att-th-content"><i class="bx bx-calendar"></i> Date & Time</div>
								</th>
								<th>
									<div class="att-th-content"><i class="bx bx-info-circle"></i> Status</div>
								</th>
								<th>
									<div class="att-th-content"><i class="bx bx-phone"></i> Mobile</div>
								</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody id="attedanceTableBody">
							<!-- Dynamic rows will be loaded here -->
						</tbody>
					</table>
				</div>

				<div class="att-empty-state d-none" id="emptyState">
					<div class="att-empty-icon"><i class="bx bx-calendar-x"></i></div>
					<h6>No Attendance Records Found</h6>
					<p>There are no attendance records matching your search criteria. Try adjusting your filters.</p>
				</div>

				<div class="att-loading-state d-none" id="loadingState">
					<div class="spinner-border" role="status" style="color:#6366f1;width:3rem;height:3rem;"><span class="visually-hidden">Loading...</span></div>
					<p class="text-muted mt-3">Loading attendance data...</p>
				</div>
			</div>

			<!-- Card Footer with Pagination -->
			<div class="card-footer bg-white py-3" style="border-top: 1px solid #f1f5f9;">
				<div class="row align-items-center">
					<div class="col-md-5">
						<div class="d-flex align-items-center gap-2">
							<span class="text-muted" style="font-size: 0.85rem;">Showing</span>
							<select class="form-select form-select-sm" id="perPage"
								style="width: auto; border-radius: 8px; border: 2px solid #e2e8f0; font-size: 0.85rem;">
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<span class="text-muted" style="font-size: 0.85rem;">of <strong
									id="totalRecords">0</strong> records</span>
						</div>
					</div>
					<div class="col-md-7">
						<nav aria-label="Attendance pagination">
							<ul class="pagination mb-0 justify-content-end gap-1" id="attendancePagination">
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<!-- Full Image Modal (Expense-like) -->
<div class="modal fade" id="siteImageModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content" style="background: rgba(0,0,0,0.92);">
			<div class="modal-body p-0 d-flex justify-content-center align-items-center position-relative">
				<button type="button"
					class="btn position-absolute d-flex align-items-center justify-content-center"
					data-bs-dismiss="modal" aria-label="Close"
					style="top: 20px; right: 20px; width: 44px; height: 44px; background: rgba(255,255,255,0.15); border: none; border-radius: 12px; z-index: 10; transition: all 0.3s;"
					onmouseover="this.style.background='rgba(255,255,255,0.3)';"
					onmouseout="this.style.background='rgba(255,255,255,0.15)';">
					<i class="bx bx-x text-white" style="font-size: 1.5rem;"></i>
				</button>
				<img id="siteImageModalImg" src="" alt="Attendance Photo"
					style="max-width: 90vw; max-height: 90vh; object-fit: contain; border-radius: 8px;" />
			</div>
		</div>
	</div>
</div>

<!-- Custom CSS -->
<style>
	/* Toolbar */
	.att-toolbar {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 12px;
		flex-wrap: wrap;
	}

	.att-toolbar__left {
		flex: 1;
		min-width: 220px;
		max-width: 360px;
	}

	.att-toolbar__right {
		display: flex;
		align-items: center;
		gap: 8px;
		flex-wrap: wrap;
	}

	.att-search-wrap {
		position: relative;
		width: 100%;
	}

	.att-search-icon {
		position: absolute;
		top: 50%;
		left: 14px;
		transform: translateY(-50%);
		color: #9ca3af;
		font-size: 18px;
		pointer-events: none;
	}

	.att-search-input {
		padding: 10px 16px 10px 42px;
		border-radius: 10px;
		border: 1.5px solid #e2e8f0;
		background: #f8fafc;
		font-size: 14px;
		transition: all .25s ease;
		width: 100%;
	}

	.att-search-input:focus {
		background: #fff;
		border-color: #6366f1;
		box-shadow: 0 0 0 3px rgba(99, 102, 241, .12);
	}

	.att-filter-group {
		display: flex;
		gap: 8px;
	}

	.att-filter-select {
		border-radius: 10px;
		border: 1.5px solid #e2e8f0;
		background: #f8fafc;
		font-size: 13px;
		padding: 9px 14px;
		min-width: 130px;
		cursor: pointer;
	}

	.att-filter-select:focus {
		border-color: #6366f1;
		box-shadow: 0 0 0 3px rgba(99, 102, 241, .12);
	}

	.att-icon-btn,
	.att-show-all-btn,
	.att-export-btn {
		height: 40px;
		border-radius: 10px;
		border: 1.5px solid #e2e8f0;
		background: #fff;
		color: #475569;
		font-size: 13px;
		font-weight: 600;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		padding: 0 14px;
		cursor: pointer;
		transition: all .2s ease;
	}

	.att-icon-btn {
		width: 40px;
		padding: 0;
		justify-content: center;
		font-size: 18px;
	}

	.att-icon-btn:hover {
		background: #f1f5f9;
	}

	.att-show-all-btn {
		border-color: #c7d2fe;
		color: #6366f1;
	}

	.att-export-btn {
		background: linear-gradient(135deg, #6366f1, #818cf8);
		color: #fff;
		border: none;
		box-shadow: 0 2px 8px rgba(99, 102, 241, .3);
	}

	.att-export-btn:hover {
		box-shadow: 0 4px 14px rgba(99, 102, 241, .4);
		color: #fff;
	}

	/* Table head */
	.att-table-head {
		background: linear-gradient(135deg, #f8fafc, #f1f5f9);
	}

	.att-table-head th {
		padding: 14px 18px;
		font-size: 11px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: .6px;
		color: #64748b;
		border: none;
		white-space: nowrap;
	}

	.att-th-index {
		width: 45px;
	}

	.att-th-content {
		display: flex;
		align-items: center;
		gap: 6px;
	}

	.att-th-content i {
		font-size: 14px;
		color: #94a3b8;
	}

	/* Empty / loading */
	.att-empty-state,
	.att-loading-state {
		text-align: center;
		padding: 60px 20px;
	}

	.att-empty-icon {
		width: 80px;
		height: 80px;
		border-radius: 50%;
		background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 16px;
	}

	.att-empty-icon i {
		font-size: 36px;
		color: #94a3b8;
	}

	.att-empty-state h6 {
		color: #475569;
		font-weight: 700;
		margin-bottom: 6px;
	}

	.att-empty-state p {
		color: #9ca3af;
		font-size: 13px;
		max-width: 380px;
		margin: 0 auto;
	}

	@media (max-width: 991px) {
		.att-toolbar {
			flex-direction: column;
			align-items: stretch;
		}

		.att-toolbar__left {
			max-width: 100%;
		}

		.att-toolbar__right {
			justify-content: space-between;
		}
	}

	@media (max-width: 575px) {
		.att-filter-group {
			flex-direction: column;
			width: 100%;
		}

		.att-filter-select {
			width: 100%;
		}
	}

	.stat-card {
		transition: all 0.3s ease;
		cursor: default;
	}

	.stat-card:hover {
		transform: translateY(-4px);
		box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
	}

	.attendance-row:hover {
		background: linear-gradient(135deg, #fafbff, #f5f3ff) !important;
	}

	#serchattedance:focus,
	#dateFilter:focus,
	#statusFilter:focus {
		border-color: #6366f1 !important;
		box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important;
		background: white !important;
	}

	.table> :not(caption)>*>* {
		box-shadow: none !important;
	}

	@keyframes fadeInUp {
		from {
			opacity: 0;
			transform: translateY(15px);
		}

		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	.attendance-row {
		animation: fadeInUp 0.4s ease forwards;
	}

	.attendance-row:nth-child(1) {
		animation-delay: 0.05s;
	}

	.attendance-row:nth-child(2) {
		animation-delay: 0.1s;
	}

	.attendance-row:nth-child(3) {
		animation-delay: 0.15s;
	}

	.attendance-row:nth-child(4) {
		animation-delay: 0.2s;
	}

	.attendance-row:nth-child(5) {
		animation-delay: 0.25s;
	}

	.badge span[style*="border-radius: 50"] {
		border-radius: 50% !important;
	}

	.attendance-photo-thumb {
		width: 60px;
		height: 60px;
		object-fit: cover;
		border-radius: 8px;
		cursor: pointer;
		border: 2px solid #e2e8f0;
	}

	.attendance-action-wrap .action-btn {
		width: 34px;
		height: 34px;
		border-radius: 8px;
		border: none;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		transition: all 0.2s ease;
	}

	.attendance-action-wrap .action-btn i {
		font-size: 1.1rem;
	}

	.attendance-action-wrap .action-btn-delete {
		background: rgba(239, 68, 68, 0.1);
		color: #ef4444;
	}

	.attendance-action-wrap .action-btn-delete:hover {
		background: #ef4444;
		color: #fff;
	}

	.attendance-action-wrap .action-btn-menu {
		background: #f1f5f9;
		color: #334155;
	}

	.attendance-action-wrap .action-btn-menu:hover {
		background: #e2e8f0;
		color: #0f172a;
	}

	.attendance-action-wrap .dropdown-menu {
		border-radius: 10px;
		border: 1px solid #e2e8f0;
		box-shadow: 0 10px 28px rgba(15, 23, 42, 0.16);
	}

	@media (max-width: 768px) {
		.page-breadcrumb {
			flex-direction: column;
			align-items: flex-start !important;
		}

		.breadcrumb-title {
			margin-bottom: 8px;
		}
	}

	/* Scrollbar styling for table */
	.table-responsive::-webkit-scrollbar {
		height: 6px;
	}

	.table-responsive::-webkit-scrollbar-track {
		background: #f1f5f9;
	}

	.table-responsive::-webkit-scrollbar-thumb {
		background: #cbd5e1;
		border-radius: 3px;
	}

	.table-responsive::-webkit-scrollbar-thumb:hover {
		background: #94a3b8;
	}

	html[data-bs-theme="dark"] .attendance-page .card,
	html[data-bs-theme="dark"] .attendance-page .card-header,
	html[data-bs-theme="dark"] .attendance-page .card-footer,
	html[data-bs-theme="dark"] .attendance-page .bg-white {
		background: #1f2937 !important;
		color: #e5e7eb !important;
		border-color: #374151 !important;
	}

	html[data-bs-theme="dark"] .attendance-page .table thead,
	html[data-bs-theme="dark"] .attendance-page .table tbody tr,
	html[data-bs-theme="dark"] .attendance-page .table tbody td {
		background: transparent !important;
		color: #e5e7eb !important;
		border-color: #374151 !important;
	}

	html[data-bs-theme="dark"] .attendance-page .form-control,
	html[data-bs-theme="dark"] .attendance-page .form-select,
	html[data-bs-theme="dark"] .attendance-page .input-group-text {
		background: #111827 !important;
		color: #e5e7eb !important;
		border-color: #374151 !important;
	}

	html[data-bs-theme="dark"] .attendance-page .text-muted {
		color: #9ca3af !important;
	}
</style>

<script>
	function viewPhoto(src) {
		document.getElementById('siteImageModalImg').src = src;
		new bootstrap.Modal(document.getElementById('siteImageModal')).show();
	}

	function refreshTable() {
		const icon = document.querySelector('button[onclick="refreshTable()"] i');
		if (icon) {
			icon.classList.add('bx-spin');
			setTimeout(() => icon.classList.remove('bx-spin'), 700);
		}
		if (typeof window.refreshAttendanceTable === 'function') {
			window.refreshAttendanceTable();
		}
	}

	function exportData(type) {
		console.log('Exporting as:', type);
		// Add export logic
	}

	function printTable() {
		window.print();
	}
</script>