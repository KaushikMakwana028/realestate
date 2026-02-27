<div class="page-wrapper">
	<div class="page-content">

		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item">
							<a href="<?= base_url('dashboard'); ?>" class="breadcrumb-link">
								<i class="bx bx-home-alt"></i>
							</a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= base_url('site'); ?>" class="breadcrumb-link">Sites</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Plots</li>
					</ol>
				</nav>
			</div>
		</div>

		<!-- Page Header -->
		<div class="page-header-section">
			<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
				<div>
					<h3 class="page-main-title mb-1">
						<i class="bx bx-grid-alt"></i> Plot Management

						<?php if (isset($site_name) && !empty($site_name)) : ?>
							<span style="font-weight:700; color:#0d6efd;">
								— <?= htmlspecialchars($site_name) ?>
							</span>
						<?php endif; ?>
					</h3>

					<p class="page-subtitle mb-0">
						View and manage all plots
						<?php if (isset($site_name) && !empty($site_name)) : ?>
							for <strong style="color:#198754;">
								<?= htmlspecialchars($site_name) ?>
							</strong>
						<?php else : ?>
							for this site
						<?php endif; ?>
					</p>
				</div>

				<div class="d-flex gap-2 flex-wrap">
					<a href="<?= base_url('site'); ?>"
						class="btn btn-sm btn-back-site rounded-pill px-3">
						<i class="bx bx-arrow-back me-1"></i> Back to Sites
					</a>
					<!-- <button class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="exportPlots('')">
						<i class="bx bx-download me-1"></i> Export
					</button> -->
					<a href="<?= base_url('plots/download_sample_format?site_id=' . (int) $id); ?>"
						class="btn btn-sm btn-download-sample rounded-pill px-3">
						<i class="bx bx-download me-1"></i> Download Sample
					</a>

					<label for="importPlotsFile"
						class="btn btn-sm btn-import-plot rounded-pill px-3 mb-0">
						<i class="bx bx-upload me-1"></i> Import
					</label>

					<button class="btn btn-primary btn-sm rounded-pill px-3 btn-add-plot" data-bs-toggle="modal"
						data-bs-target="#addPlotModal" onclick="window.location.href='<?= base_url('plots/add_plot/' . $id); ?>'">
						<i class="bx bx-plus me-1"></i> Add Plot
					</button>
				</div>
			</div>
		</div>

		<input type="hidden" id="site_id" value="<?= $id; ?>">
		<input type="file" id="importPlotsFile" accept=".xlsx,.xls,.csv" class="d-none">

		<!-- Stats Cards -->
		<div class="row g-3 mb-4" id="plotStatsRow">
			<div class="col-6 col-lg-3">
				<div class="stats-card stats-card-primary">
					<div class="stats-icon"><i class="bx bx-grid-alt"></i></div>
					<div class="stats-info">
						<span class="stats-label">Total Plots</span>
						<h4 class="stats-value" id="statTotalPlots">--</h4>
					</div>
					<div class="stats-ring">
						<svg viewBox="0 0 36 36">
							<path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
								fill="none" stroke="currentColor" stroke-opacity="0.1" stroke-width="3" />
							<path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
								fill="none" stroke="currentColor" stroke-opacity="0.3" stroke-width="3"
								stroke-dasharray="100, 100" stroke-linecap="round" />
						</svg>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="stats-card stats-card-success">
					<div class="stats-icon"><i class="bx bx-check-circle"></i></div>
					<div class="stats-info">
						<span class="stats-label">Available</span>
						<h4 class="stats-value" id="statAvailable">--</h4>
					</div>
					<div class="stats-ring">
						<svg viewBox="0 0 36 36">
							<path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
								fill="none" stroke="currentColor" stroke-opacity="0.1" stroke-width="3" />
							<path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
								fill="none" stroke="currentColor" stroke-opacity="0.3" stroke-width="3"
								stroke-dasharray="70, 100" stroke-linecap="round" id="ringAvailable" />
						</svg>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="stats-card stats-card-warning">
					<div class="stats-icon"><i class="bx bx-bookmark"></i></div>
					<div class="stats-info">
						<span class="stats-label">Booked</span>
						<h4 class="stats-value" id="statBooked">--</h4>
					</div>
					<div class="stats-ring">
						<svg viewBox="0 0 36 36">
							<path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
								fill="none" stroke="currentColor" stroke-opacity="0.1" stroke-width="3" />
							<path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
								fill="none" stroke="currentColor" stroke-opacity="0.3" stroke-width="3"
								stroke-dasharray="20, 100" stroke-linecap="round" id="ringBooked" />
						</svg>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="stats-card stats-card-danger">
					<div class="stats-icon"><i class="bx bx-badge-check"></i></div>
					<div class="stats-info">
						<span class="stats-label">Sold</span>
						<h4 class="stats-value" id="statSold">--</h4>
					</div>
					<div class="stats-ring">
						<svg viewBox="0 0 36 36">
							<path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
								fill="none" stroke="currentColor" stroke-opacity="0.1" stroke-width="3" />
							<path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
								fill="none" stroke="currentColor" stroke-opacity="0.3" stroke-width="3"
								stroke-dasharray="10, 100" stroke-linecap="round" id="ringSold" />
						</svg>
					</div>
				</div>
			</div>
		</div>

		<!-- Status Filter Tabs -->
		<div class="plot-filter-tabs mb-4">
			<button class="filter-tab active" data-filter="all">
				<i class="bx bx-grid-alt"></i> All
				<span class="filter-count" id="countAll">0</span>
			</button>
			<button class="filter-tab" data-filter="available">
				<i class="bx bx-check-circle"></i> Available
				<span class="filter-count filter-count-success" id="countAvailable">0</span>
			</button>
			<button class="filter-tab" data-filter="booked">
				<i class="bx bx-bookmark"></i> Booked
				<span class="filter-count filter-count-warning" id="countBooked">0</span>
			</button>
			<button class="filter-tab" data-filter="sold">
				<i class="bx bx-badge-check"></i> Sold
				<span class="filter-count filter-count-danger" id="countSold">0</span>
			</button>
		</div>

		<!-- Main Card -->
		<div class="card plot-main-card">
			<div class="card-body">

				<!-- Toolbar -->
				<div class="plot-toolbar">
					<div class="search-box">
						<i class="bx bx-search search-icon"></i>
						<input type="text" id="serchPlot" class="form-control search-input"
							placeholder="Search by plot number, buyer name, facing...">
						<span class="search-shortcut" id="searchShortcut">⌘K</span>
					</div>
					<div class="toolbar-actions">
						<!-- <div class="dropdown">
							<button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
								<i class="bx bx-sort-alt-2 me-1"></i> Sort
							</button>
							<ul class="dropdown-menu dropdown-menu-end sort-dropdown">
								<li><a class="dropdown-item sort-option" data-sort="number" href="#"><i
											class="bx bx-hash me-2"></i>Plot Number</a></li>
								<li><a class="dropdown-item sort-option" data-sort="price-asc" href="#"><i
											class="bx bx-sort-up me-2"></i>Price: Low to High</a></li>
								<li><a class="dropdown-item sort-option" data-sort="price-desc" href="#"><i
											class="bx bx-sort-down me-2"></i>Price: High to Low</a></li>
								<li><a class="dropdown-item sort-option" data-sort="size" href="#"><i
											class="bx bx-expand me-2"></i>Size</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item sort-option" data-sort="status" href="#"><i
											class="bx bx-flag me-2"></i>Status</a></li>
							</ul>
						</div> -->
						<div class="btn-group view-toggle" role="group">
							<button class="btn btn-sm btn-outline-secondary active" data-view="table"
								title="Table View">
								<i class="bx bx-list-ul"></i>
							</button>
							<button class="btn btn-sm btn-outline-secondary" data-view="grid" title="Card View">
								<i class="bx bx-grid-alt"></i>
							</button>
						</div>
					</div>
				</div>

				<!-- Table View -->
				<div class="table-responsive plot-table-wrapper" id="tableView">
					<thead>
						<table class="table plot-table" id="plotTableMain">
							<tr>
								<th>#</th>
								<th class="th-sortable" data-sort="number">
									Plot Number <i class="bx bx-sort-alt-2 sort-icon"></i>
								</th>
								<th>Size</th>
								<th>Dimension</th>
								<th>Facing</th>
								<th class="text-end th-sortable" data-sort="price">
									Price <i class="bx bx-sort-alt-2 sort-icon"></i>
								</th>
								<th class="text-center">Status</th>
								<th>Buyer</th>
								<th class="text-center">Actions</th>
							</tr>
					</thead>
					<tbody id="plotTable">
						<!-- Rows injected by JS -->
					</tbody>
					</table>

					<!-- Empty State -->
					<div class="empty-state d-none" id="emptyState">
						<div class="empty-state-icon">
							<i class="bx bx-grid-alt"></i>
						</div>
						<h5>No Plots Found</h5>
						<p>No plots match your current search or filter. Try adjusting your criteria.</p>
						<button class="btn btn-primary btn-sm rounded-pill px-4" onclick="clearFilters()">
							<i class="bx bx-refresh me-1"></i> Clear Filters
						</button>
					</div>
				</div>

				<!-- Grid / Card View (hidden by default) -->
				<div class="row g-3 d-none" id="gridView">
					<!-- Grid cards injected by JS -->
				</div>
			</div>

			<!-- Pagination -->
			<div class="card-footer bg-transparent border-0 py-3">
				<div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
					<div class="pagination-info">
						Showing <strong id="pagStart">1</strong>–<strong id="pagEnd">10</strong> of <strong
							id="pagTotal">0</strong> plots
					</div>
					<nav aria-label="Page navigation">
						<ul class="pagination pagination-modern mb-0" id="paginationList">
							<li class="page-item disabled">
								<a class="page-link" href="javascript:;" aria-label="Previous">
									<i class="bx bx-chevron-left"></i>
								</a>
							</li>
							<li class="page-item active"><a class="page-link" href="javascript:;">1</a></li>
							<li class="page-item"><a class="page-link" href="javascript:;">2</a></li>
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
</div>

<style>
	/* ===================== VARIABLES ===================== */
	:root {
		--plot-primary: #4f46e5;
		--plot-primary-light: #eef2ff;
		--plot-primary-dark: #3730a3;
		--plot-success: #059669;
		--plot-success-light: #ecfdf5;
		--plot-info: #0891b2;
		--plot-info-light: #ecfeff;
		--plot-warning: #d97706;
		--plot-warning-light: #fffbeb;
		--plot-danger: #dc2626;
		--plot-danger-light: #fef2f2;
		--plot-gray-50: #f9fafb;
		--plot-gray-100: #f3f4f6;
		--plot-gray-200: #e5e7eb;
		--plot-gray-300: #d1d5db;
		--plot-gray-400: #9ca3af;
		--plot-gray-500: #6b7280;
		--plot-gray-600: #4b5563;
		--plot-gray-700: #374151;
		--plot-gray-800: #1f2937;
		--plot-gray-900: #111827;
		--plot-radius: 14px;
		--plot-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 4px 12px rgba(0, 0, 0, 0.06);
		--plot-shadow-lg: 0 4px 6px rgba(0, 0, 0, 0.04), 0 10px 24px rgba(0, 0, 0, 0.08);
		--plot-transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
	}

	/* ===================== BREADCRUMB ===================== */
	.breadcrumb-link {
		color: var(--plot-primary);
		transition: var(--plot-transition);
		text-decoration: none;
		font-weight: 600;
		display: inline-flex;
		align-items: center;
		gap: 4px;
	}

	.breadcrumb-link:hover {
		color: var(--plot-primary-dark);
		transform: translateX(2px);
	}

	/* Card footer styling */
	.plot-main-card .card-footer {
		background: linear-gradient(90deg, var(--plot-gray-50) 0%, #fafbfc 100%);
		border-top: 1px solid var(--plot-gray-200);
		padding: 20px 28px;
	}

	/* ===================== PAGE HEADER ===================== */
	.page-main-title {
		font-size: 24px;
		font-weight: 800;
		color: var(--plot-gray-900);
		display: flex;
		align-items: center;
		gap: 10px;
		margin-bottom: 8px;
	}

	.page-main-title i {
		color: var(--plot-primary);
		font-size: 28px;
	}

	.page-subtitle {
		font-size: 14px;
		color: var(--plot-gray-500);
		font-weight: 400;
	}

	.btn-add-plot {
		background: linear-gradient(135deg, var(--plot-primary) 0%, #6366f1 100%);
		border: none;
		font-weight: 600;
		box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
		transition: var(--plot-transition);
		padding: 10px 20px;
		border-radius: 10px;
	}

	.btn-add-plot:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
		background: linear-gradient(135deg, #4338ca 0%, #6366f1 100%);
	}

	/* ================= DOWNLOAD SAMPLE BUTTON ================= */
	.btn-download-sample {
		background: linear-gradient(135deg, var(--plot-info) 0%, #06b6d4 100%);
		border: none;
		font-weight: 600;
		box-shadow: 0 4px 12px rgba(8, 145, 178, 0.3);
		transition: var(--plot-transition);
		padding: 10px 20px;
		border-radius: 10px;
		color: #fff;
	}

	.btn-download-sample:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(8, 145, 178, 0.4);
		background: linear-gradient(135deg, #0e7490 0%, #06b6d4 100%);
		color: #fff;
	}

	/* ================= IMPORT BUTTON ================= */
	.btn-import-plot {
		background: linear-gradient(135deg, var(--plot-success) 0%, #10b981 100%);
		border: none;
		font-weight: 600;
		box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
		transition: var(--plot-transition);
		padding: 10px 20px;
		border-radius: 10px;
		color: #fff;
	}

	.btn-import-plot:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(5, 150, 105, 0.4);
		background: linear-gradient(135deg, #047857 0%, #10b981 100%);
		color: #fff;
	}

	/* Optional: Loading State */
	.btn-import-plot.loading {
		opacity: 0.8;
		pointer-events: none;
	}


	/* ================= BACK BUTTON ================= */

	.btn-back-site {
		background: linear-gradient(135deg, var(--plot-gray-200) 0%, var(--plot-gray-300) 100%);
		border: none;
		color: var(--plot-gray-800);
		font-weight: 600;
		padding: 10px 20px;
		border-radius: 10px;
		box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
		transition: var(--plot-transition);
		display: inline-flex;
		align-items: center;
		gap: 6px;
	}

	.btn-back-site i {
		transition: var(--plot-transition);
	}

	.btn-back-site:hover {
		background: linear-gradient(135deg, var(--plot-gray-300) 0%, var(--plot-gray-400) 100%);
		color: var(--plot-gray-900);
		transform: translateY(-2px);
		box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
	}

	.btn-back-site:hover i {
		transform: translateX(-4px);
	}

	.btn-outline-secondary:hover {
		transform: translateY(-2px);
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
	}

	.btn-outline-primary:hover {
		transform: translateY(-2px);
		box-shadow: 0 2px 8px rgba(79, 70, 229, 0.2);
	}

	/* ===================== STATS CARDS ===================== */
	.stats-card {
		position: relative;
		overflow: hidden;
		border-radius: var(--plot-radius);
		padding: 24px;
		display: flex;
		align-items: center;
		gap: 14px;
		box-shadow: var(--plot-shadow);
		transition: var(--plot-transition);
		border: 1px solid transparent;
		cursor: default;
	}

	.stats-card:hover {
		transform: translateY(-4px);
		box-shadow: var(--plot-shadow-lg);
	}

	.stats-card-primary {
		background: linear-gradient(135deg, #fefffe 0%, var(--plot-primary-light) 100%);
		border-color: rgba(79, 70, 229, 0.12);
	}

	.stats-card-success {
		background: linear-gradient(135deg, #fefffe 0%, var(--plot-success-light) 100%);
		border-color: rgba(5, 150, 105, 0.12);
	}

	.stats-card-warning {
		background: linear-gradient(135deg, #fefffe 0%, var(--plot-warning-light) 100%);
		border-color: rgba(217, 119, 6, 0.12);
	}

	.stats-card-danger {
		background: linear-gradient(135deg, #fefffe 0%, var(--plot-danger-light) 100%);
		border-color: rgba(220, 38, 38, 0.12);
	}

	.stats-icon {
		width: 56px;
		height: 56px;
		border-radius: 14px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 28px;
		flex-shrink: 0;
	}

	.stats-card-primary .stats-icon {
		background: rgba(79, 70, 229, 0.12);
		color: var(--plot-primary);
	}

	.stats-card-success .stats-icon {
		background: rgba(5, 150, 105, 0.12);
		color: var(--plot-success);
	}

	.stats-card-warning .stats-icon {
		background: rgba(217, 119, 6, 0.12);
		color: var(--plot-warning);
	}

	.stats-card-danger .stats-icon {
		background: rgba(220, 38, 38, 0.12);
		color: var(--plot-danger);
	}

	.stats-info {
		flex: 1;
		min-width: 0;
	}

	.stats-label {
		font-size: 12px;
		font-weight: 600;
		color: var(--plot-gray-500);
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.stats-value {
		font-size: 26px;
		font-weight: 800;
		color: var(--plot-gray-900);
		margin: 4px 0 0;
		line-height: 1.2;
	}

	/* Stats ring decoration */
	.stats-ring {
		position: absolute;
		right: 16px;
		top: 16px;
		width: 52px;
		height: 52px;
		opacity: 0.4;
	}

	.stats-card-primary .stats-ring {
		color: var(--plot-primary);
	}

	.stats-card-success .stats-ring {
		color: var(--plot-success);
	}

	.stats-card-warning .stats-ring {
		color: var(--plot-warning);
	}

	.stats-card-danger .stats-ring {
		color: var(--plot-danger);
	}

	/* ===================== FILTER TABS ===================== */
	.plot-filter-tabs {
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
		margin-bottom: 24px;
	}

	.filter-tab {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 10px 18px;
		border-radius: 12px;
		border: 1.5px solid var(--plot-gray-200);
		background: #fff;
		color: var(--plot-gray-600);
		font-size: 13.5px;
		font-weight: 600;
		cursor: pointer;
		transition: var(--plot-transition);
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
	}

	.filter-tab i {
		font-size: 16px;
	}

	.filter-tab:hover {
		border-color: var(--plot-primary);
		color: var(--plot-primary);
		background: var(--plot-primary-light);
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(79, 70, 229, 0.1);
	}

	.filter-tab.active {
		background: linear-gradient(135deg, var(--plot-primary) 0%, #6366f1 100%);
		border-color: var(--plot-primary);
		color: #fff;
		box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
	}

	.filter-tab.active .filter-count {
		background: rgba(255, 255, 255, 0.25);
		color: #fff;
	}

	.filter-count {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		min-width: 24px;
		height: 24px;
		padding: 0 8px;
		border-radius: 8px;
		font-size: 11.5px;
		font-weight: 700;
		background: var(--plot-gray-100);
		color: var(--plot-gray-600);
		transition: var(--plot-transition);
	}

	.filter-count-success {
		background: var(--plot-success-light);
		color: var(--plot-success);
	}

	.filter-count-warning {
		background: var(--plot-warning-light);
		color: var(--plot-warning);
	}

	.filter-count-danger {
		background: var(--plot-danger-light);
		color: var(--plot-danger);
	}

	/* ===================== MAIN CARD ===================== */
	.plot-main-card {
		border: none;
		border-radius: 14px;
		box-shadow: var(--plot-shadow-lg);
		overflow: hidden;
		animation: fadeInUp 0.5s ease both;
		animation-delay: 0.35s;
	}

	.plot-main-card .card-body {
		padding: 28px;
	}

	/* ===================== TOOLBAR ===================== */
	.plot-toolbar {
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		justify-content: space-between;
		gap: 16px;
		margin-bottom: 24px;
		animation: slideInDown 0.4s ease both;
	}

	.search-box {
		position: relative;
		flex: 1;
		max-width: 480px;
		min-width: 220px;
	}

	.search-icon {
		position: absolute;
		left: 16px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 18px;
		color: var(--plot-gray-400);
		pointer-events: none;
		transition: var(--plot-transition);
	}

	.search-input {
		width: 100%;
		padding: 12px 48px 12px 44px;
		border-radius: 12px;
		border: 1.5px solid var(--plot-gray-200);
		background: var(--plot-gray-50);
		font-size: 13.5px;
		transition: var(--plot-transition);
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
	}

	.search-input::placeholder {
		color: var(--plot-gray-400);
	}

	.search-input:focus {
		border-color: var(--plot-primary);
		box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1), 0 4px 12px rgba(79, 70, 229, 0.15);
		background: #fff;
		outline: none;
	}

	.search-input:focus+.search-icon {
		color: var(--plot-primary);
	}

	.search-shortcut {
		position: absolute;
		right: 14px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 11px;
		font-weight: 600;
		color: var(--plot-gray-400);
		background: var(--plot-gray-100);
		padding: 3px 10px;
		border-radius: 6px;
		border: 1px solid var(--plot-gray-200);
		pointer-events: none;
		transition: var(--plot-transition);
	}

	.search-input:focus~.search-shortcut {
		opacity: 0;
		pointer-events: none;
	}

	.toolbar-actions {
		display: flex;
		align-items: center;
		gap: 10px;
	}

	.toolbar-actions .btn {
		animation: slideInDown 0.4s ease both;
	}

	.view-toggle .btn {
		padding: 8px 12px;
		border-color: var(--plot-gray-200);
		color: var(--plot-gray-500);
		font-weight: 600;
		transition: var(--plot-transition);
		background: #fff;
	}

	.view-toggle .btn.active,
	.view-toggle .btn:hover {
		background: linear-gradient(135deg, var(--plot-primary) 0%, #6366f1 100%);
		border-color: var(--plot-primary);
		color: #fff;
		box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
	}

	.sort-dropdown .dropdown-item {
		font-size: 13px;
		padding: 10px 16px;
		transition: var(--plot-transition);
		border-radius: 6px;
		margin: 2px 4px;
	}

	.sort-dropdown .dropdown-item:hover {
		background: var(--plot-primary-light);
		color: var(--plot-primary);
		transform: translateX(4px);
	}

	/* ===================== TABLE ===================== */
	.plot-table-wrapper {
		border-radius: 12px;
		border: 1px solid var(--plot-gray-200);
		overflow-x: auto;
		overflow-y: visible;
		max-width: 100%;
		scrollbar-gutter: stable;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
	}

	.plot-table {
		margin: 0;
		min-width: 1100px;
		width: max-content;
	}

	.plot-table thead th {
		background: linear-gradient(135deg, var(--plot-gray-50) 0%, #fafbfc 100%);
		border-bottom: 2px solid var(--plot-gray-200);
		font-size: 11.5px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.6px;
		color: var(--plot-gray-500);
		padding: 14px 16px;
		white-space: nowrap;
		user-select: none;
	}

	.th-sortable {
		cursor: pointer;
		transition: var(--plot-transition);
	}

	.th-sortable:hover {
		color: var(--plot-primary) !important;
	}

	.sort-icon {
		font-size: 14px;
		vertical-align: middle;
		opacity: 0.4;
	}

	.plot-table tbody tr {
		transition: var(--plot-transition);
		border-bottom: 1px solid var(--plot-gray-100);
		position: relative;
	}

	.plot-table tbody tr:last-child {
		border-bottom: none;
	}

	.plot-table tbody tr:hover {
		background: linear-gradient(90deg, rgba(79, 70, 229, 0.02) 0%, transparent 100%);
	}

	.plot-table tbody td {
		padding: 16px;
		font-size: 13.5px;
		color: var(--plot-gray-700);
		vertical-align: middle;
		white-space: normal;
	}

	.plot-table thead th:last-child,
	.plot-table tbody td:last-child {
		text-align: center;
		min-width: 120px;
	}

	.plot-table thead th:first-child,
	.plot-table tbody td:first-child {
		width: 56px;
		text-align: center;
	}

	@media (max-width: 992px) {
		.plot-table {
			min-width: 900px;
			width: max-content;
		}

		.plot-table tbody td {
			white-space: nowrap;
		}
	}

	.plot-table tbody td:first-child {
		font-weight: 700;
		color: var(--plot-gray-500);
	}

	.plot-table tbody td:nth-child(2) {
		font-weight: 700;
		color: var(--plot-gray-800);
	}

	/* Row left accent on hover */
	.plot-table tbody tr::before {
		content: '';
		position: absolute;
		left: 0;
		top: 0;
		bottom: 0;
		width: 4px;
		border-radius: 0 3px 3px 0;
		opacity: 0;
		transition: var(--plot-transition);
	}

	.plot-table tbody tr:hover::before {
		opacity: 1;
	}

	.plot-table tbody tr[data-status="available"]::before {
		background: var(--plot-success);
	}

	.plot-table tbody tr[data-status="booked"]::before {
		background: var(--plot-warning);
	}

	.plot-table tbody tr[data-status="sold"]::before {
		background: var(--plot-danger);
	}

	.plot-table tbody tr::before {
		background: var(--plot-primary);
	}

	/* Plot number cell */
	.plot-number-cell {
		display: inline-flex;
		align-items: center;
		gap: 8px;
	}

	.plot-number-badge {
		width: 34px;
		height: 34px;
		border-radius: 8px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-weight: 800;
		font-size: 12px;
		flex-shrink: 0;
	}

	.plot-number-badge.available {
		background: var(--plot-success-light);
		color: var(--plot-success);
		border: 1px solid rgba(5, 150, 105, 0.15);
	}

	.plot-number-badge.booked {
		background: var(--plot-warning-light);
		color: var(--plot-warning);
		border: 1px solid rgba(217, 119, 6, 0.15);
	}

	.plot-number-badge.sold {
		background: var(--plot-danger-light);
		color: var(--plot-danger);
		border: 1px solid rgba(220, 38, 38, 0.15);
	}

	.plot-number-text {
		font-weight: 700;
		color: var(--plot-gray-800);
		font-size: 14px;
	}

	/* Size chip */
	.size-chip {
		display: inline-flex;
		align-items: center;
		gap: 4px;
		padding: 4px 10px;
		background: var(--plot-gray-100);
		border-radius: 8px;
		font-size: 12.5px;
		font-weight: 600;
		color: var(--plot-gray-700);
	}

	.size-chip i {
		font-size: 14px;
		color: var(--plot-gray-400);
	}

	/* Dimension display */
	.dimension-display {
		font-family: 'JetBrains Mono', 'SF Mono', monospace;
		font-size: 12.5px;
		font-weight: 600;
		color: var(--plot-gray-600);
		background: var(--plot-gray-50);
		padding: 4px 8px;
		border-radius: 6px;
		border: 1px solid var(--plot-gray-200);
		display: inline-block;
	}

	/* Facing badge */
	.facing-badge {
		display: inline-flex;
		align-items: center;
		gap: 4px;
		font-size: 12.5px;
		font-weight: 600;
		color: var(--plot-gray-600);
	}

	.facing-badge i {
		font-size: 16px;
	}

	.facing-badge[data-facing="east"] i,
	.facing-badge[data-facing="north"] i {
		color: var(--plot-success);
	}

	.facing-badge[data-facing="west"] i,
	.facing-badge[data-facing="south"] i {
		color: var(--plot-warning);
	}

	/* Money cell */
	.money-cell {
		font-weight: 700;
		font-family: 'JetBrains Mono', 'SF Mono', monospace;
		font-size: 13px;
		color: var(--plot-gray-800);
	}

	/* Status badge */
	.status-badge {
		display: inline-flex;
		align-items: center;
		gap: 5px;
		padding: 6px 14px;
		border-radius: 999px;
		font-size: 11.5px;
		font-weight: 700;
		letter-spacing: 0.3px;
		text-transform: capitalize;
		animation: fadeInUp 0.4s ease forwards;
	}

	.status-badge i {
		font-size: 12px;
	}

	.status-available {
		background: var(--plot-success-light);
		color: var(--plot-success);
		border: 1px solid rgba(5, 150, 105, 0.15);
		animation: pulseAvailable 2s ease-in-out infinite;
	}

	.status-booked {
		background: var(--plot-warning-light);
		color: var(--plot-warning);
		border: 1px solid rgba(217, 119, 6, 0.15);
	}

	.status-sold {
		background: var(--plot-danger-light);
		color: var(--plot-danger);
		border: 1px solid rgba(220, 38, 38, 0.15);
		animation: pulseSold 2s ease-in-out infinite;
	}

	/* Animated badge dots */
	.badge-dot-available,
	.badge-dot-sold {
		display: inline-block;
		width: 6px;
		height: 6px;
		border-radius: 50%;
		margin-right: 2px;
	}

	.badge-dot-available {
		background-color: var(--plot-success);
		animation: pulseAvailable 2s ease-in-out infinite;
	}

	.badge-dot-sold {
		background-color: var(--plot-danger);
		animation: pulseSold 2s ease-in-out infinite;
	}

	@keyframes pulseAvailable {
		0% {
			background-color: var(--plot-success-light);
			box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.7);
		}

		50% {
			box-shadow: 0 0 0 4px rgba(5, 150, 105, 0);
		}

		100% {
			background-color: var(--plot-success-light);
			box-shadow: 0 0 0 0 rgba(5, 150, 105, 0);
		}
	}

	@keyframes pulseSold {
		0% {
			background-color: var(--plot-danger-light);
			box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7);
		}

		50% {
			box-shadow: 0 0 0 4px rgba(220, 38, 38, 0);
		}

		100% {
			background-color: var(--plot-danger-light);
			box-shadow: 0 0 0 0 rgba(220, 38, 38, 0);
		}
	}

	/* Buyer cell */
	.buyer-cell {
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.buyer-avatar {
		width: 30px;
		height: 30px;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		font-weight: 700;
		font-size: 11px;
		color: #fff;
		flex-shrink: 0;
	}

	.buyer-name {
		font-weight: 600;
		font-size: 13px;
		color: var(--plot-gray-700);
	}

	.no-buyer {
		font-size: 12.5px;
		color: var(--plot-gray-400);
		font-style: italic;
	}

	/* ===================== ACTION BUTTONS ===================== */
	.action-group {
		display: flex;
		align-items: center;
		gap: 6px;
		justify-content: center;
	}

	.btn-action {
		width: 36px;
		height: 36px;
		border-radius: 10px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-size: 16px;
		border: none;
		cursor: pointer;
		transition: var(--plot-transition);
		position: relative;
		font-weight: 600;
	}

	.btn-action::after {
		content: attr(data-tooltip);
		position: absolute;
		bottom: calc(100% + 8px);
		left: 50%;
		transform: translateX(-50%) scale(0.8);
		background: var(--plot-gray-800);
		color: #fff;
		font-size: 11px;
		font-weight: 600;
		padding: 6px 10px;
		border-radius: 8px;
		white-space: nowrap;
		opacity: 0;
		pointer-events: none;
		transition: var(--plot-transition);
		z-index: 10;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
	}

	.btn-action:hover::after {
		opacity: 1;
		transform: translateX(-50%) scale(1);
	}

	.btn-action-view {
		background: var(--plot-primary-light);
		color: var(--plot-primary);
	}

	.btn-action-view:hover {
		background: var(--plot-primary);
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
	}

	.btn-action-edit {
		background: var(--plot-info-light);
		color: var(--plot-info);
	}

	.btn-action-edit:hover {
		background: var(--plot-info);
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(8, 145, 178, 0.3);
	}

	.btn-action-delete {
		background: var(--plot-danger-light);
		color: var(--plot-danger);
	}

	.btn-action-delete:hover {
		background: var(--plot-danger);
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
	}

	.btn-action-sell {
		background: var(--plot-success-light);
		color: var(--plot-success);
	}

	.btn-action-sell:hover {
		background: var(--plot-success);
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
	}

	/* ===================== EMPTY STATE ===================== */
	.empty-state {
		text-align: center;
		padding: 80px 20px;
		animation: fadeInUp 0.5s ease both;
	}

	.empty-state-icon {
		width: 96px;
		height: 96px;
		border-radius: 50%;
		background: linear-gradient(135deg, var(--plot-primary-light) 0%, rgba(79, 70, 229, 0.08) 100%);
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-size: 44px;
		color: var(--plot-primary);
		margin-bottom: 20px;
		animation: emptyBounce 2s ease-in-out infinite;
		box-shadow: 0 4px 16px rgba(79, 70, 229, 0.1);
	}

	@keyframes emptyBounce {

		0%,
		100% {
			transform: translateY(0);
		}

		50% {
			transform: translateY(-10px);
		}
	}

	.empty-state h5 {
		font-weight: 800;
		color: var(--plot-gray-900);
		font-size: 20px;
		margin-bottom: 8px;
	}

	.empty-state p {
		color: var(--plot-gray-500);
		font-size: 14px;
		max-width: 400px;
		margin: 0 auto 24px;
	}

	/* ===================== PAGINATION ===================== */
	.pagination-info {
		font-size: 13px;
		color: var(--plot-gray-500);
		font-weight: 600;
	}

	.pagination-modern {
		gap: 6px;
		animation: slideInDown 0.4s ease both;
		animation-delay: 0.4s;
	}

	.pagination-modern .page-link {
		border: 1.5px solid var(--plot-gray-200);
		border-radius: 10px !important;
		font-size: 13px;
		font-weight: 700;
		color: var(--plot-gray-600);
		padding: 8px 14px;
		min-width: 40px;
		text-align: center;
		transition: var(--plot-transition);
		background: #fff;
	}

	.pagination-modern .page-item.active .page-link {
		background: linear-gradient(135deg, var(--plot-primary) 0%, #6366f1 100%);
		color: #fff;
		border-color: var(--plot-primary);
		box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
	}

	.pagination-modern .page-link:hover {
		background: var(--plot-primary-light);
		color: var(--plot-primary);
		border-color: var(--plot-primary);
		transform: translateY(-1px);
	}

	.pagination-modern .page-item.disabled .page-link {
		background: var(--plot-gray-50);
		color: var(--plot-gray-300);
		border-color: var(--plot-gray-200);
		cursor: not-allowed;
	}

	/* ===================== GRID VIEW CARDS ===================== */
	.plot-grid-card {
		border: 1.5px solid var(--plot-gray-200);
		border-radius: 14px;
		overflow: hidden;
		background: #fff;
		transition: var(--plot-transition);
		height: 100%;
		position: relative;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
	}

	.plot-grid-card:hover {
		transform: translateY(-6px);
		box-shadow: 0 8px 24px rgba(79, 70, 229, 0.15);
		border-color: rgba(79, 70, 229, 0.3);
	}

	.plot-grid-card-status {
		position: absolute;
		top: 12px;
		right: 12px;
		z-index: 2;
	}

	.plot-grid-card-header {
		padding: 24px 20px 16px;
		display: flex;
		align-items: center;
		gap: 14px;
		border-bottom: 1px solid var(--plot-gray-100);
	}

	.plot-grid-number {
		width: 56px;
		height: 56px;
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-weight: 800;
		font-size: 18px;
		flex-shrink: 0;
	}

	.plot-grid-number.available {
		background: var(--plot-success-light);
		color: var(--plot-success);
	}

	.plot-grid-number.booked {
		background: var(--plot-warning-light);
		color: var(--plot-warning);
	}

	.plot-grid-number.sold {
		background: var(--plot-danger-light);
		color: var(--plot-danger);
	}

	.plot-grid-card-body {
		padding: 16px 20px;
	}

	.plot-grid-detail {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 8px 0;
		border-bottom: 1px solid var(--plot-gray-100);
		font-size: 13px;
	}

	.plot-grid-detail:last-child {
		border-bottom: none;
	}

	.plot-grid-detail-label {
		color: var(--plot-gray-500);
		font-weight: 600;
		font-size: 12px;
	}

	.plot-grid-detail-value {
		color: var(--plot-gray-800);
		font-weight: 700;
	}

	.plot-grid-card-footer {
		padding: 16px 20px;
		border-top: 1px solid var(--plot-gray-100);
		background: linear-gradient(135deg, var(--plot-gray-50) 0%, #fafbfc 100%);
		display: flex;
		align-items: center;
		justify-content: space-between;
	}

	.plot-grid-price {
		font-size: 18px;
		font-weight: 800;
		color: var(--plot-primary);
	}

	/* ===================== ANIMATIONS ===================== */
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

	@keyframes slideInDown {
		from {
			opacity: 0;
			transform: translateY(-12px);
		}

		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	@keyframes scaleIn {
		from {
			opacity: 0;
			transform: scale(0.95);
		}

		to {
			opacity: 1;
			transform: scale(1);
		}
	}

	.plot-table tbody tr {
		animation: fadeInUp 0.35s ease both;
	}

	.plot-table tbody tr:nth-child(1) {
		animation-delay: 0.03s;
	}

	.plot-table tbody tr:nth-child(2) {
		animation-delay: 0.06s;
	}

	.plot-table tbody tr:nth-child(3) {
		animation-delay: 0.09s;
	}

	.plot-table tbody tr:nth-child(4) {
		animation-delay: 0.12s;
	}

	.plot-table tbody tr:nth-child(5) {
		animation-delay: 0.15s;
	}

	.plot-table tbody tr:nth-child(6) {
		animation-delay: 0.18s;
	}

	.plot-table tbody tr:nth-child(7) {
		animation-delay: 0.21s;
	}

	.plot-table tbody tr:nth-child(8) {
		animation-delay: 0.24s;
	}

	.plot-table tbody tr:nth-child(9) {
		animation-delay: 0.27s;
	}

	.plot-table tbody tr:nth-child(10) {
		animation-delay: 0.30s;
	}

	.stats-card {
		animation: scaleIn 0.4s ease both;
	}

	#plotStatsRow .col-6:nth-child(1) .stats-card {
		animation: fadeInUp 0.4s ease both;
		animation-delay: 0.05s;
	}

	#plotStatsRow .col-6:nth-child(2) .stats-card {
		animation: fadeInUp 0.4s ease both;
		animation-delay: 0.10s;
	}

	#plotStatsRow .col-6:nth-child(3) .stats-card {
		animation: fadeInUp 0.4s ease both;
		animation-delay: 0.15s;
	}

	#plotStatsRow .col-6:nth-child(4) .stats-card {
		animation: fadeInUp 0.4s ease both;
		animation-delay: 0.20s;
	}

	.filter-tab {
		animation: fadeInUp 0.4s ease both;
	}

	.plot-filter-tabs .filter-tab:nth-child(1) {
		animation-delay: 0.08s;
	}

	.plot-filter-tabs .filter-tab:nth-child(2) {
		animation-delay: 0.12s;
	}

	.plot-filter-tabs .filter-tab:nth-child(3) {
		animation-delay: 0.16s;
	}

	.plot-filter-tabs .filter-tab:nth-child(4) {
		animation-delay: 0.20s;
	}

	/* Grid card animations */
	#gridView .col-md-6,
	#gridView .col-lg-4 {
		animation: fadeInUp 0.4s ease both;
	}

	#gridView .col-md-6:nth-child(1),
	#gridView .col-lg-4:nth-child(1) {
		animation-delay: 0.05s;
	}

	#gridView .col-md-6:nth-child(2),
	#gridView .col-lg-4:nth-child(2) {
		animation-delay: 0.10s;
	}

	#gridView .col-md-6:nth-child(3),
	#gridView .col-lg-4:nth-child(3) {
		animation-delay: 0.15s;
	}

	#gridView .col-md-6:nth-child(4),
	#gridView .col-lg-4:nth-child(4) {
		animation-delay: 0.20s;
	}

	#gridView .col-md-6:nth-child(5),
	#gridView .col-lg-4:nth-child(5) {
		animation-delay: 0.25s;
	}

	#gridView .col-md-6:nth-child(6),
	#gridView .col-lg-4:nth-child(6) {
		animation-delay: 0.30s;
	}

	/* ===================== RESPONSIVE ===================== */
	@media (max-width: 1200px) {
		.plot-toolbar {
			flex-direction: column;
			align-items: stretch;
		}

		.search-box {
			max-width: 100%;
		}

		.toolbar-actions {
			justify-content: flex-end;
		}
	}

	@media (max-width: 991px) {
		.page-header-section {
			flex-direction: column;
		}

		#plotStatsRow {
			grid-template-columns: repeat(2, 1fr) !important;
		}
	}

	@media (max-width: 767px) {
		.page-main-title {
			font-size: 18px;
		}

		.page-subtitle {
			font-size: 12px;
		}

		.stats-value {
			font-size: 22px;
		}

		.stats-card {
			padding: 16px;
		}

		.stats-icon {
			width: 48px;
			height: 48px;
			font-size: 22px;
		}

		.stats-ring {
			width: 40px;
			height: 40px;
		}

		.plot-main-card .card-body {
			padding: 16px;
		}

		.plot-toolbar {
			gap: 12px;
		}

		.search-box {
			max-width: 100%;
		}

		.toolbar-actions {
			flex-wrap: wrap;
			width: 100%;
			gap: 8px;
		}

		.btn-action::after {
			display: none;
		}

		.plot-filter-tabs {
			gap: 6px;
		}

		.filter-tab {
			padding: 8px 14px;
			font-size: 12px;
		}

		.plot-table tbody td {
			padding: 12px;
			font-size: 12px;
		}

		.plot-table thead th {
			padding: 10px 8px;
			font-size: 10px;
		}

		.action-group {
			gap: 3px;
		}

		.btn-action {
			width: 32px;
			height: 32px;
			font-size: 14px;
		}
	}

	@media (max-width: 576px) {
		.page-main-title {
			font-size: 16px;
		}

		.stats-card {
			padding: 14px;
			gap: 10px;
		}

		.stats-icon {
			width: 40px;
			height: 40px;
			font-size: 18px;
		}

		.stats-label {
			font-size: 10px;
		}

		.stats-value {
			font-size: 18px;
		}

		.filter-tab {
			padding: 6px 12px;
			font-size: 11px;
			gap: 4px;
		}

		.filter-count {
			min-width: 20px;
			height: 20px;
			font-size: 10px;
			padding: 0 4px;
		}

		.search-input {
			padding: 10px 40px 10px 36px;
			font-size: 12px;
		}

		.plot-table {
			font-size: 12px;
		}

		.plot-table tbody td {
			padding: 10px 8px;
		}

		.plot-table thead th {
			padding: 8px 6px;
		}

		#plotStatsRow {
			grid-template-columns: 1fr !important;
		}
	}

	/* ===================== SCROLLBAR ===================== */
	.plot-table-wrapper::-webkit-scrollbar {
		height: 6px;
	}

	.plot-table-wrapper::-webkit-scrollbar-track {
		background: var(--plot-gray-100);
	}

	.plot-table-wrapper::-webkit-scrollbar-thumb {
		background: var(--plot-gray-300);
		border-radius: 3px;
	}

	.plot-table-wrapper::-webkit-scrollbar-thumb:hover {
		background: var(--plot-gray-400);
	}

	/* ===================== SITE NAME CHIP ===================== */
	.site-name-chip {
		display: inline-flex;
		align-items: center;
		gap: 5px;
		padding: 4px 10px;
		border-radius: 8px;
		font-size: 12.5px;
		font-weight: 600;
		background: var(--plot-primary-light);
		color: var(--plot-primary-dark);
		border: 1px solid rgba(79, 70, 229, 0.1);
	}

	.site-name-chip i {
		font-size: 14px;
	}
</style>

<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script>
	document.addEventListener("DOMContentLoaded", function() {

		// ✅ Prevent entire script from running twice
		if (window.plotPageInitialized) return;
		window.plotPageInitialized = true;

		// =====================================================
		// ===================== HELPERS =======================
		// =====================================================

		function getAvatarColor(str) {
			const colors = [
				'#4f46e5', '#059669', '#0891b2', '#d97706',
				'#dc2626', '#7c3aed', '#db2777', '#0d9488',
				'#2563eb', '#ca8a04', '#e11d48', '#6d28d9'
			];
			let hash = 0;
			for (let i = 0; i < (str || '').length; i++) {
				hash = str.charCodeAt(i) + ((hash << 5) - hash);
			}
			return colors[Math.abs(hash) % colors.length];
		}

		function formatCurrency(val) {
			const num = parseFloat(val);
			if (isNaN(num)) return '₹0';
			return '₹' + num.toLocaleString('en-IN');
		}

		function enhanceStatusBadges() {
			document.querySelectorAll('.status-badge.status-available').forEach(badge => {
				if (!badge.querySelector('.badge-dot-available')) {
					const dot = document.createElement('span');
					dot.className = 'badge-dot-available';
					badge.insertBefore(dot, badge.firstChild);
				}
			});

			document.querySelectorAll('.status-badge.status-sold').forEach(badge => {
				if (!badge.querySelector('.badge-dot-sold')) {
					const dot = document.createElement('span');
					dot.className = 'badge-dot-sold';
					badge.insertBefore(dot, badge.firstChild);
				}
			});
		}

		enhanceStatusBadges();
		setInterval(enhanceStatusBadges, 1000);

		// =====================================================
		// ================= KEYBOARD SHORTCUT =================
		// =====================================================

		document.addEventListener('keydown', function(e) {
			if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
				e.preventDefault();
				document.getElementById('serchPlot')?.focus();
			}
		});

		// =====================================================
		// ================= VIEW TOGGLE =======================
		// =====================================================

		document.querySelectorAll('.view-toggle .btn').forEach(btn => {
			btn.addEventListener('click', function() {
				document.querySelectorAll('.view-toggle .btn').forEach(b => b.classList.remove('active'));
				this.classList.add('active');

				const view = this.getAttribute('data-view');
				document.getElementById('tableView')?.classList.toggle('d-none', view !== 'table');
				document.getElementById('gridView')?.classList.toggle('d-none', view !== 'grid');
			});
		});

		// =====================================================
		// ================= FILTER TABS =======================
		// =====================================================

		document.querySelectorAll('.filter-tab').forEach(tab => {
			tab.addEventListener('click', function() {

				document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
				this.classList.add('active');

				const filter = this.getAttribute('data-filter');
				const rows = document.querySelectorAll('#plotTable tr[data-status]');
				let visible = 0;

				rows.forEach(row => {
					const status = row.getAttribute('data-status');
					const show = filter === 'all' || status === filter;
					row.style.display = show ? '' : 'none';
					if (show) visible++;
				});

				document.getElementById('emptyState')?.classList.toggle('d-none', visible > 0);
				enhanceStatusBadges();
			});
		});

		// =====================================================
		// ================= SEARCH ============================
		// =====================================================

		const searchInput = document.getElementById('serchPlot');
		if (searchInput) {
			searchInput.addEventListener('input', function() {
				const query = this.value.toLowerCase().trim();
				const rows = document.querySelectorAll('#plotTable tr');
				let visible = 0;

				rows.forEach(row => {
					const text = row.textContent.toLowerCase();
					const match = !query || text.includes(query);
					row.style.display = match ? '' : 'none';
					if (match) visible++;
				});

				document.getElementById('emptyState')?.classList.toggle('d-none', visible > 0);
			});
		}

		// =====================================================
		// ================= IMPORT PLOTS ======================
		// =====================================================

		const importBtn = document.getElementById("importPlotsBtn");
		const fileInput = document.getElementById("importPlotsFile");

		if (!importBtn || !fileInput) return;

		// Open file selector on button click
		importBtn.addEventListener("click", function(e) {
			e.preventDefault();
			fileInput.click();
		});

		fileInput.addEventListener("change", function(e) {

			const file = e.target.files[0];
			if (!file) return;

			if (!file.name.toLowerCase().endsWith(".xlsx")) {
				alert("Only XLSX files are allowed.");
				fileInput.value = "";
				return;
			}

			importBtn.classList.add("loading");

			const reader = new FileReader();

			reader.onload = function(evt) {

				try {

					const data = new Uint8Array(evt.target.result);
					const workbook = XLSX.read(data, {
						type: "array"
					});
					const sheet = workbook.Sheets[workbook.SheetNames[0]];
					const rows = XLSX.utils.sheet_to_json(sheet);

					fetch("<?= base_url('plots/import'); ?>", {
							method: "POST",
							headers: {
								"Content-Type": "application/x-www-form-urlencoded"
							},
							body: new URLSearchParams({
								site_id: document.getElementById("site_id").value,
								rows: JSON.stringify(rows)
							})
						})
						.then(response => response.text())
						.then(text => {

							console.log("SERVER RESPONSE:", text);

							let res;

							try {
								res = JSON.parse(text);
							} catch (e) {
								throw new Error("Invalid JSON from server.");
							}

							if (res.status === "success") {
								alert("Successfully imported " + res.inserted + " plots.");
								location.reload();
							} else {
								alert(res.message || "Import failed.");
								if (res.errors) {
									console.log("Validation Errors:", res.errors);
								}
							}

						})
						.catch(error => {
							console.error("Import Error:", error);
							alert("Import failed. Check console for details.");
						})
						.finally(() => {
							importBtn.classList.remove("loading");
							fileInput.value = "";
						});

				} catch (error) {
					console.error("File Processing Error:", error);
					alert("Invalid Excel file.");
					importBtn.classList.remove("loading");
					fileInput.value = "";
				}

			};

			reader.readAsArrayBuffer(file);

		});

	});
</script>
