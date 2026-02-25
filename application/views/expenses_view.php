<div class="page-wrapper">
	<div class="page-content">

		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3 fw-bold" style="font-size: 1.25rem; color: #2c3e50;">
				<i class="bx bx-wallet me-2" style="color: #6366f1;"></i>Expense Management
			</div>
			<div class="ps-3 ms-auto">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0" style="background: transparent;">
						<li class="breadcrumb-item">
							<a href="<?= base_url('dashboard'); ?>" class="text-decoration-none"
								style="color: #6366f1;">
								<i class="bx bx-home-alt"></i> Home
							</a>
						</li>
						<li class="breadcrumb-item active text-muted" aria-current="page">Expenses</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->

		<!-- Summary Cards -->
		<div class="row mb-4 g-3">
			<div class="col-xl-3 col-md-6">
				<div class="card border-0 shadow-sm summary-card"
					style="border-radius: 14px; border-left: 4px solid #6366f1 !important; overflow: hidden;">
					<div class="card-body d-flex align-items-center p-3">
						<div class="rounded-circle d-flex align-items-center justify-content-center me-3"
							style="width: 52px; height: 52px; background: linear-gradient(135deg, #6366f1, #818cf8); flex-shrink: 0;">
							<i class="bx bx-receipt text-white" style="font-size: 1.5rem;"></i>
						</div>
						<div>
							<p class="mb-0 text-muted"
								style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
								Total Expenses</p>
							<h4 class="mb-0 fw-bold" id="totalExpenses" style="color: #2c3e50;">₹0</h4>
							<small class="text-muted" id="totalExpCount">0 entries</small>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="card border-0 shadow-sm summary-card"
					style="border-radius: 14px; border-left: 4px solid #10b981 !important; overflow: hidden;">
					<div class="card-body d-flex align-items-center p-3">
						<div class="rounded-circle d-flex align-items-center justify-content-center me-3"
							style="width: 52px; height: 52px; background: linear-gradient(135deg, #10b981, #34d399); flex-shrink: 0;">
							<i class="bx bx-check-circle text-white" style="font-size: 1.5rem;"></i>
						</div>
						<div>
							<p class="mb-0 text-muted"
								style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Approved
							</p>
							<h4 class="mb-0 fw-bold" style="color: #059669;"><span id="approvedTotal">₹0</span></h4>
							<small class="text-muted"><span id="approvedCount">0</span> entries</small>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="card border-0 shadow-sm summary-card"
					style="border-radius: 14px; border-left: 4px solid #f59e0b !important; overflow: hidden;">
					<div class="card-body d-flex align-items-center p-3">
						<div class="rounded-circle d-flex align-items-center justify-content-center me-3"
							style="width: 52px; height: 52px; background: linear-gradient(135deg, #f59e0b, #fbbf24); flex-shrink: 0;">
							<i class="bx bx-time-five text-white" style="font-size: 1.5rem;"></i>
						</div>
						<div>
							<p class="mb-0 text-muted"
								style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Pending
							</p>
							<h4 class="mb-0 fw-bold" style="color: #d97706;"><span id="pendingTotal">₹0</span></h4>
							<small class="text-muted"><span id="pendingCount">0</span> entries</small>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="card border-0 shadow-sm summary-card"
					style="border-radius: 14px; border-left: 4px solid #ef4444 !important; overflow: hidden;">
					<div class="card-body d-flex align-items-center p-3">
						<div class="rounded-circle d-flex align-items-center justify-content-center me-3"
							style="width: 52px; height: 52px; background: linear-gradient(135deg, #ef4444, #f87171); flex-shrink: 0;">
							<i class="bx bx-x-circle text-white" style="font-size: 1.5rem;"></i>
						</div>
						<div>
							<p class="mb-0 text-muted"
								style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Rejected
							</p>
							<h4 class="mb-0 fw-bold" style="color: #dc2626;"><span id="rejectTotal">₹0</span></h4>
							<small class="text-muted"><span id="rejectCount">0</span> entries</small>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Table Card -->
		<div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">

			<!-- Card Header / Toolbar -->
			<div class="card-header bg-white py-3" style="border-bottom: 1px solid #f1f5f9;">
				<div class="row align-items-center g-3">
					<!-- Search -->
					<div class="col-lg-4 col-md-6">
						<div class="position-relative">
							
							<input type="text" id="serchexp" class="form-control ps-5 enhanced-input"
								placeholder="Search expenses by name, site, amount...">
							<input type="hidden" id="siteID" value="">
						</div>
					</div>

					<!-- Month Filter -->
					<div class="col-lg-2 col-md-4">
						<div class="position-relative">
												<input type="month" id="expMonthPicker" class="form-control ps-5 enhanced-input">
						</div>
					</div>

					<!-- Status Filter -->
					<div class="col-lg-2 col-md-4">
						<select class="form-select enhanced-input" id="statusFilter">
							<option value="">All Status</option>
							<option value="approved">Approved</option>
							<option value="pending">Pending</option>
							<option value="rejected">Rejected</option>
						</select>
					</div>

					<!-- Buttons -->
					<div class="col-lg-4 col-md-8">
						<div class="d-flex gap-2 justify-content-lg-end flex-wrap">
							<button type="button" id="expShowAllBtn" class="btn btn-sm d-flex align-items-center gap-1"
								style="border-radius: 10px; padding: 9px 18px; border: 2px solid #e2e8f0; color: #475569; background: #f8fafc; transition: all 0.2s;"
								onmouseover="this.style.borderColor='#6366f1'; this.style.color='#6366f1';"
								onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#475569';">
								<i class="bx bx-list-ul" style="font-size: 1.1rem;"></i>
								Show All
							</button>
							<button class="btn btn-sm d-flex align-items-center gap-1"
								style="border-radius: 10px; padding: 9px 18px; border: 2px solid #e2e8f0; color: #475569; background: #f8fafc; transition: all 0.2s;"
								onclick="refreshExpenses()"
								onmouseover="this.style.borderColor='#6366f1'; this.style.color='#6366f1';"
								onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#475569';">
								<i class="bx bx-refresh" style="font-size: 1.1rem;"></i>
								<span class="d-none d-xl-inline">Refresh</span>
							</button>
							
						</div>
					</div>
				</div>
			</div>

			<!-- Table Body -->
			<div class="card-body p-0">
				<div class="table-responsive expense-table-wrapper">
					<table class="table table-hover align-middle mb-0" id="expenseMainTable">
						<thead style="background: linear-gradient(135deg, #f8fafc, #f1f5f9);">
							<tr>
								<th class="table-th">#</th>
								<th class="table-th"><i class="bx bx-building me-1"></i>Site Name</th>
								<th class="table-th"><i class="bx bx-image me-1"></i>Receipt</th>
								<th class="table-th"><i class="bx bx-user me-1"></i>User</th>
								<th class="table-th"><i class="bx bx-message me-1"></i>Description</th>

								<th class="table-th"><i class="bx bx-calendar me-1"></i>Date</th>
								<th class="table-th"><i class="bx bx-rupee me-1"></i>Amount</th>
								<th class="table-th">Status</th>
								<th class="table-th" style="text-align: center;">Actions</th>
							</tr>
						</thead>
						<tbody id="expensesTable">

							<!-- Sample Row 1 - Approved -->
							


						</tbody>
					</table>
				</div>

				<!-- Empty State -->
				<div class="text-center py-5 d-none" id="emptyState">
					<div class="mb-3">
						<div class="rounded-circle d-inline-flex align-items-center justify-content-center"
							style="width: 80px; height: 80px; background: linear-gradient(135deg, #f1f5f9, #e2e8f0);">
							<i class="bx bx-receipt" style="font-size: 2.5rem; color: #94a3b8;"></i>
						</div>
					</div>
					<h5 class="fw-semibold" style="color: #475569;">No Expenses Found</h5>
					<p class="text-muted" style="max-width: 400px; margin: 0 auto;">
						No expense records match your search. Try adjusting filters or date range.
					</p>
				</div>
			</div>

			<!-- Pagination Footer -->
			<div class="card-footer bg-white py-3" style="border-top: 1px solid #f1f5f9;">
				<div class="row align-items-center">
					<!-- <div class="col-md-5">
						<div class="d-flex align-items-center gap-2">
							<span class="text-muted" style="font-size: 0.85rem;">Showing</span>
							<select class="form-select form-select-sm enhanced-input" id="perPage"
								style="width: auto; font-size: 0.85rem;">
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<span class="text-muted" style="font-size: 0.85rem;">of <strong
									id="totalRecords">50</strong> records</span>
						</div>
					</div> -->
					<div class="col-md-7">
						<nav aria-label="Expense pagination">
							<ul class="pagination mb-0 justify-content-end gap-1" id="expensePaginationList">
								<li class="page-item">
									<a class="page-link page-btn" href="javascript:;">
										<i class="bx bx-chevron-left" style="font-size: 1.2rem;"></i>
									</a>
								</li>
								<li class="page-item">
									<a class="page-link page-btn page-btn-active" href="javascript:;">1</a>
								</li>
								<li class="page-item">
									<a class="page-link page-btn" href="javascript:;">2</a>
								</li>
								<li class="page-item">
									<a class="page-link page-btn" href="javascript:;">3</a>
								</li>
								<li class="page-item">
									<span class="page-link"
										style="border: none; color: #94a3b8; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">...</span>
								</li>
								<li class="page-item">
									<a class="page-link page-btn" href="javascript:;">5</a>
								</li>
								<li class="page-item">
									<a class="page-link page-btn" href="javascript:;">
										<i class="bx bx-chevron-right" style="font-size: 1.2rem;"></i>
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>

		

		<!-- Full Image Modal (Enhanced) -->
		<div class="modal fade" id="siteImageModal" tabindex="-1" aria-labelledby="siteImageModalLabel"
			aria-hidden="true">
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
						<img id="siteImageModalImg" src="" alt="Full Image"
							style="max-width: 90vw; max-height: 90vh; object-fit: contain; border-radius: 8px;" />
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<!-- Enhanced Styles -->
<style>
	/* ===== Base Resets ===== */
	.summary-card {
		transition: all 0.3s ease;
		cursor: default;
	}

	.summary-card:hover {
		transform: translateY(-4px);
		box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
	}

	/* ===== Input Styles ===== */
	.enhanced-input {
		border-radius: 10px !important;
		border: 2px solid #e2e8f0 !important;
		padding: 10px 15px !important;
		transition: all 0.3s !important;
		background: #f8fafc !important;
		font-size: 0.88rem !important;
	}

	.enhanced-input:focus {
		border-color: #6366f1 !important;
		box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important;
		background: white !important;
	}

	/* ===== Table Styles ===== */
	.table-th {
		padding: 16px 20px !important;
		font-size: 0.72rem !important;
		text-transform: uppercase !important;
		letter-spacing: 1px !important;
		color: #64748b !important;
		font-weight: 700 !important;
		border: none !important;
		white-space: nowrap;
	}

	.table-td {
		padding: 14px 20px !important;
		border-bottom: 1px solid #f1f5f9 !important;
		vertical-align: middle !important;
	}

	.expense-row {
		transition: all 0.2s ease;
		animation: fadeInUp 0.4s ease forwards;
	}

	.expense-row:hover {
		background: linear-gradient(135deg, #fafbff, #f5f3ff) !important;
	}

	.expense-row:nth-child(1) {
		animation-delay: 0.05s;
	}

	.expense-row:nth-child(2) {
		animation-delay: 0.1s;
	}

	.expense-row:nth-child(3) {
		animation-delay: 0.15s;
	}

	.expense-row:nth-child(4) {
		animation-delay: 0.2s;
	}

	.expense-row:nth-child(5) {
		animation-delay: 0.25s;
	}

	@keyframes fadeInUp {
		from {
			opacity: 0;
			transform: translateY(12px);
		}

		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	.table> :not(caption)>*>* {
		box-shadow: none !important;
	}

	.expense-table-wrapper {
		overflow-x: auto;
		overflow-y: hidden;
		max-width: 100%;
	}

	#expenseMainTable {
		width: 100%;
		min-width: 100%;
	}

	/* ===== Status Badges ===== */
	.status-badge {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		padding: 6px 14px;
		border-radius: 20px;
		font-weight: 600;
		font-size: 0.78rem;
		white-space: nowrap;
	}

	.status-dot {
		width: 7px;
		height: 7px;
		border-radius: 50%;
		display: inline-block;
	}

	.status-approved {
		background: rgba(16, 185, 129, 0.1);
		color: #059669;
	}

	.status-pending {
		background: rgba(245, 158, 11, 0.1);
		color: #d97706;
	}

	.status-rejected {
		background: rgba(239, 68, 68, 0.1);
		color: #dc2626;
	}

	.expense-site-chip {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		padding: 6px 10px;
		border-radius: 10px;
		background: #eef2ff;
		color: #4338ca;
		font-weight: 700;
		font-size: 0.8rem;
	}

	.expense-user-chip {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		font-weight: 600;
		color: #334155;
		font-size: 0.82rem;
	}

	.expense-user-dot {
		width: 8px;
		height: 8px;
		border-radius: 50%;
		background: #6366f1;
		display: inline-block;
	}

	.expense-amount-text {
		font-weight: 800;
		color: #1e293b;
		font-family: 'JetBrains Mono', 'SF Mono', monospace;
	}

	/* ===== Category Badge ===== */
	.category-badge {
		display: inline-flex;
		align-items: center;
		padding: 5px 12px;
		border-radius: 8px;
		font-weight: 600;
		font-size: 0.78rem;
		white-space: nowrap;
	}

	/* ===== Action Buttons ===== */
	.action-btn {
		width: 34px;
		height: 34px;
		border-radius: 8px;
		border: none;
		display: flex;
		align-items: center;
		justify-content: center;
		transition: all 0.25s ease;
		cursor: pointer;
	}

	.action-btn i {
		font-size: 1.1rem;
		transition: color 0.25s ease;
	}

	.action-btn-view {
		background: rgba(99, 102, 241, 0.1);
	}

	.action-btn-view i {
		color: #6366f1;
	}

	.action-btn-view:hover {
		background: #6366f1;
	}

	.action-btn-view:hover i {
		color: white;
	}

	.action-btn-edit {
		background: rgba(245, 158, 11, 0.1);
	}

	.action-btn-edit i {
		color: #f59e0b;
	}

	.action-btn-edit:hover {
		background: #f59e0b;
	}

	.action-btn-edit:hover i {
		color: white;
	}

	.action-btn-approve {
		background: rgba(16, 185, 129, 0.1);
	}

	.action-btn-approve i {
		color: #10b981;
	}

	.action-btn-approve:hover {
		background: #10b981;
	}

	.action-btn-approve:hover i {
		color: white;
	}

	.action-btn-delete {
		background: rgba(239, 68, 68, 0.1);
	}

	.action-btn-delete i {
		color: #ef4444;
	}

	.action-btn-delete:hover {
		background: #ef4444;
	}

	.action-btn-delete:hover i {
		color: white;
	}

	/* ===== Receipt Thumbnail ===== */
	.exp-receipt-thumb {
		position: relative;
		display: inline-block;
		width: 50px;
		height: 50px;
		border-radius: 10px;
		overflow: hidden;
		cursor: pointer;
	}

	.exp-receipt-overlay {
		position: absolute;
		inset: 0;
		background: rgba(99, 102, 241, 0.6);
		display: flex;
		align-items: center;
		justify-content: center;
		opacity: 0;
		transition: opacity 0.3s;
		border-radius: 10px;
	}

	.exp-receipt-overlay i {
		font-size: 1.3rem;
	}

	.exp-receipt-thumb:hover .exp-receipt-overlay {
		opacity: 1;
	}

	.exp-receipt-thumb:hover img {
		transform: scale(1.1);
	}

	/* ===== Pagination ===== */
	.page-btn {
		border-radius: 8px !important;
		border: 2px solid #e2e8f0 !important;
		color: #64748b !important;
		width: 38px;
		height: 38px;
		padding: 0 !important;
		display: flex !important;
		align-items: center;
		justify-content: center;
		transition: all 0.2s;
		font-weight: 600;
		background: white !important;
	}

	.page-btn:hover {
		background: #6366f1 !important;
		color: white !important;
		border-color: #6366f1 !important;
	}

	.page-btn-active {
		background: linear-gradient(135deg, #6366f1, #818cf8) !important;
		color: white !important;
		border: none !important;
		box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
	}

	.expense-status-select {
		border-radius: 10px;
		border: 1px solid #dbe2ea;
		font-size: 0.82rem;
		font-weight: 600;
		padding: 6px 10px;
		min-width: 110px;
	}

	@media (max-width: 992px) {
		#expenseMainTable {
			min-width: 1200px;
			width: max-content;
		}
	}

	/* ===== Enhanced Image Grid (Modal) ===== */
	.exp-image-grid-enhanced {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
		gap: 12px;
	}

	.exp-image-grid-enhanced img {
		width: 100%;
		height: 120px;
		object-fit: cover;
		border-radius: 12px;
		cursor: pointer;
		transition: all 0.3s;
		border: 2px solid #f1f5f9;
	}

	.exp-image-grid-enhanced img:hover {
		transform: scale(1.05);
		box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
		border-color: #6366f1;
	}

	/* ===== Scrollbar ===== */
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

	/* ===== Responsive ===== */
	@media (max-width: 768px) {
		.page-breadcrumb {
			flex-direction: column;
			align-items: flex-start !important;
		}

		.breadcrumb-title {
			margin-bottom: 8px;
		}

		.table-th,
		.table-td {
			padding: 10px 14px !important;
		}
	}
</style>

<!-- Scripts -->
<script>
	function openImageModal(el) {
		const img = el.querySelector('img');
		if (img) {
			document.getElementById('siteImageModalImg').src = img.src;
			new bootstrap.Modal(document.getElementById('siteImageModal')).show();
		}
	}

	function refreshExpenses() {
		const btn = event.target.closest('button');
		const icon = btn.querySelector('i');
		icon.classList.add('bx-spin');
		setTimeout(() => {
			icon.classList.remove('bx-spin');
		}, 1000);
	}

	function exportExpenses(type) {
		console.log('Exporting expenses as:', type);
	}
</script>
