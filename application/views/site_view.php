<div class="page-wrapper">

	<div class="page-content">

		<!--breadcrumb-->

		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

			<!-- <div class="breadcrumb-title pe-3">Category</div> -->

			<div class="ps-3">

				<nav aria-label="breadcrumb">

					<ol class="breadcrumb mb-0 p-0">

						<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i></a>

						</li>

						<li class="breadcrumb-item active" aria-current="page">Sites</li>

					</ol>

				</nav>

			</div>



		</div>

		<!--end breadcrumb-->



		<div class="card site-main-card">

			<div class="card-body">

				<div class="d-lg-flex align-items-center mb-4 gap-3 site-toolbar">

					<div class="position-relative site-search-box">

						<input type="text" id="serchSite" class="form-control ps-5 site-search-input" placeholder="Search site name or location">
						<span class="position-absolute top-50 product-show translate-middle-y site-search-icon"><i class="bx bx-search"></i></span>

					</div>

				</div>

				<div class="table-responsive site-table-wrapper">

					<table class="table mb-0 site-table" id="siteTable">

						<thead>

							<tr>

								<th>Index</th>

								<th>Site Name</th>

								<!-- <th>Location</th> -->

								<th>Site Value</th>
								<th>Collected Value</th>
								<th>Total Expenses</th>


								<th>Total Plots</th>
								<th>Map Status</th>
								<th>View Plots</th>
								<!-- <th>View Expenses</th> -->
								<th>Actions</th>



							</tr>

						</thead>

						<tbody id="customerTableBody">



						</tbody>

					</table>

				</div>

			</div>

			<nav aria-label="Page navigation example">

				<ul class="pagination round-pagination justify-content-center site-pagination" id="sitePaginationList">

					<li class="page-item"><a class="page-link" href="javascript:;">Previous</a>

					</li>

					<li class="page-item"><a class="page-link" href="javascript:;javascript:;">1</a>

					</li>

					<li class="page-item active"><a class="page-link" href="javascript:;">2</a>

					</li>

					<li class="page-item"><a class="page-link" href="javascript:;">3</a>

					</li>

					<li class="page-item"><a class="page-link" href="javascript:;">Next</a>

					</li>

				</ul>

			</nav>

		</div>





	</div>

</div>

<!-- Site Detail Modal -->
<div class="modal fade" id="siteDetailModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Site Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div id="siteDetailContent">Loading...</div>
			</div>
		</div>
	</div>
</div>

<!-- </div> -->

<style>
	:root {
		--site-primary: #4f46e5;
		--site-primary-light: #eef2ff;
		--site-success: #059669;
		--site-success-light: #ecfdf5;
		--site-warning: #d97706;
		--site-warning-light: #fffbeb;
		--site-gray-100: #f3f4f6;
		--site-gray-200: #e5e7eb;
		--site-gray-500: #6b7280;
		--site-gray-700: #374151;
		--site-gray-900: #111827;
	}

	.site-main-card {
		border: none;
		border-radius: 14px;
		box-shadow: 0 10px 24px rgba(2, 6, 23, 0.06);
		overflow: hidden;
	}

	.site-toolbar {
		justify-content: space-between;
	}

	.site-search-box {
		max-width: 430px;
		width: 100%;
	}

	.site-search-input {
		border-radius: 12px;
		border: 1.5px solid var(--site-gray-200);
		background: #f8fafc;
		padding: 12px 14px 12px 40px;
		font-size: 13.5px;
	}

	.site-search-input:focus {
		border-color: var(--site-primary);
		box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
		background: #fff;
	}

	.site-search-icon {
		left: 14px;
		color: #94a3b8;
	}

	.site-table-wrapper {
		border: 1px solid var(--site-gray-200);
		border-radius: 12px;
		overflow-x: auto;
		overflow-y: hidden;
		max-width: 100%;
	}

	.site-table {
		margin: 0;
		width: 100%;
		min-width: 100%;
	}

	.site-table thead th {
		background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
		border-bottom: 2px solid var(--site-gray-200);
		color: var(--site-gray-500);
		font-size: 11.5px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.55px;
		padding: 13px 14px;
		white-space: nowrap;
	}

	.site-table tbody td {
		padding: 14px;
		font-size: 13px;
		color: var(--site-gray-700);
		vertical-align: middle;
	}

	.site-table tbody tr:hover {
		background: linear-gradient(90deg, rgba(79, 70, 229, 0.03), transparent);
	}

	.site-name-chip {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		padding: 6px 10px;
		border-radius: 10px;
		background: var(--site-primary-light);
		color: #3730a3;
		font-weight: 700;
		font-size: 12.5px;
	}

	.value-cell {
		font-weight: 700;
		color: var(--site-gray-900);
		font-family: 'JetBrains Mono', 'SF Mono', monospace;
	}

	.count-pill {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		min-width: 34px;
		height: 28px;
		padding: 0 10px;
		border-radius: 999px;
		background: #ecfeff;
		color: #0e7490;
		font-size: 12px;
		font-weight: 700;
	}

	.quick-link-btn {
		width: 34px;
		height: 34px;
		border-radius: 10px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		background: #f8fafc;
		border: 1px solid var(--site-gray-200);
		color: var(--site-gray-700);
		transition: 0.2s ease;
	}

	.quick-link-btn:hover {
		background: var(--site-primary-light);
		color: var(--site-primary);
		border-color: rgba(79, 70, 229, 0.25);
	}

	.site-action-group {
		display: flex;
		align-items: center;
		gap: 6px;
	}

	.site-action-btn {
		width: 34px;
		height: 34px;
		border-radius: 10px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		border: none;
	}

	.site-action-edit {
		background: #ecfeff;
		color: #0891b2;
	}

	.site-action-delete {
		background: #fef2f2;
		color: #dc2626;
	}

	.site-action-assign {
		background: var(--site-success-light);
		color: var(--site-success);
	}

	.site-pagination .page-link {
		border-radius: 10px !important;
		border: 1px solid var(--site-gray-200);
		font-size: 13px;
		font-weight: 700;
		color: var(--site-gray-700);
	}

	.site-pagination .page-item.active .page-link {
		background: linear-gradient(135deg, var(--site-primary), #6366f1);
		border-color: var(--site-primary);
		color: #fff;
	}

	@media (max-width: 1400px) {
		.site-table {
			min-width: 1180px;
			width: max-content;
		}
	}

	.site-detail-header {
		display: flex;
		flex-wrap: wrap;
		gap: 16px;
		align-items: center;
		justify-content: space-between;
		padding: 12px 16px;
		background: linear-gradient(135deg, #f4f7ff 0%, #f9fbff 100%);
		border-radius: 12px;
		margin-bottom: 16px;
	}

	.site-detail-title {
		display: flex;
		align-items: center;
		gap: 10px;
		font-weight: 700;
		font-size: 18px;
	}

	.site-detail-meta {
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
	}

	.site-detail-chip {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		padding: 6px 10px;
		border-radius: 999px;
		font-size: 12px;
		background: #eef2ff;
		color: #3730a3;
		font-weight: 600;
	}

	.site-detail-card {
		border: 1px solid #eef2f7;
		border-radius: 12px;
		padding: 14px;
		background: #fff;
		margin-bottom: 16px;
	}

	.site-detail-card h6 {
		font-weight: 700;
		margin-bottom: 12px;
		color: #1f2937;
	}

	.site-detail-grid {
		display: grid;
		grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: 10px 16px;
	}

	.site-detail-label {
		font-size: 12px;
		color: #6b7280;
		margin-bottom: 4px;
	}

	.site-detail-value {
		font-size: 14px;
		color: #111827;
		font-weight: 600;
		word-break: break-word;
	}

	.site-detail-images {
		display: flex;
		flex-wrap: wrap;
		gap: 8px;
	}

	.site-detail-images img {
		width: 96px;
		height: 96px;
		object-fit: cover;
		border-radius: 10px;
		border: 1px solid #e5e7eb;
	}

	.site-detail-table {
		margin-bottom: 0;
	}

	.site-detail-table th {
		font-size: 12px;
		text-transform: uppercase;
		letter-spacing: 0.3px;
		color: #6b7280;
		border-bottom: 1px solid #e5e7eb;
	}

	.site-detail-table td {
		font-size: 13px;
		color: #111827;
	}

	/* Animated Badge Styles */
	.badge-animated-live,
	.badge-animated-pending {
		display: inline-flex !important;
		align-items: center;
		gap: 8px;
		padding: 6px 14px !important;
		border-radius: 20px !important;
		font-weight: 600 !important;
		font-size: 0.78rem !important;
		animation: fadeInUp 0.5s ease forwards;
	}

	@keyframes pulse-live {
		0% {
			background-color: #10b981;
			box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
		}
		50% {
			box-shadow: 0 0 0 4px rgba(16, 185, 129, 0);
		}
		100% {
			background-color: #10b981;
			box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
		}
	}

	@keyframes pulse-pending {
		0% {
			background-color: #f59e0b;
			box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
		}
		50% {
			box-shadow: 0 0 0 4px rgba(245, 158, 11, 0);
		}
		100% {
			background-color: #f59e0b;
			box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
		}
	}

	.badge-dot-live,
	.badge-dot-pending {
		display: inline-block;
		width: 6px;
		height: 6px;
		border-radius: 50%;
	}

	.badge-dot-live {
		background-color: #10b981;
		animation: pulse-live 2s ease-in-out infinite;
	}

	.badge-dot-pending {
		background-color: #f59e0b;
		animation: pulse-pending 2s ease-in-out infinite;
	}

	/* Table row animation */
	#customerTableBody tr {
		animation: fadeInUp 0.4s ease forwards;
	}

	#customerTableBody tr:nth-child(1) {
		animation-delay: 0.05s;
	}

	#customerTableBody tr:nth-child(2) {
		animation-delay: 0.1s;
	}

	#customerTableBody tr:nth-child(3) {
		animation-delay: 0.15s;
	}

	#customerTableBody tr:nth-child(4) {
		animation-delay: 0.2s;
	}

	#customerTableBody tr:nth-child(5) {
		animation-delay: 0.25s;
	}

	#customerTableBody tr:nth-child(n+6) {
		animation-delay: 0.3s;
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

	@media (max-width: 767px) {
		.site-detail-grid {
			grid-template-columns: 1fr;
		}
	}
</style>

<script>
	document.addEventListener('click', function(e) {
		const btn = e.target.closest('.viewSiteDetail');
		if (!btn) return;
		const siteId = btn.getAttribute('data-id');
		const content = document.getElementById('siteDetailContent');
		if (!content) return;
		content.innerHTML = 'Loading...';

		if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
			const modalEl = document.getElementById('siteDetailModal');
			const modal = new bootstrap.Modal(modalEl);
			modal.show();
		}

		fetch('<?= base_url('site/get_site_detail/'); ?>' + siteId)
			.then((r) => r.json())
			.then((data) => {
				if (!data.status) {
					content.innerHTML = '<div class="text-danger">' + (data.message || 'Failed to load') + '</div>';
					return;
				}

				const site = data.site || {};
				const images = data.images || [];
				const expenses = data.expenses || [];
				const plots = data.plots || [];
				const hasMap = data.site?.has_map === true || Number(site.listed_map || 0) === 1 || (!!site.site_map && site.site_map !== 'NULL' && site.site_map !== 'null' && site.site_map !== '');

				const imageHtml = images.length ?
					images.map((img) => `<img src="<?= base_url(); ?>${img}" alt="Site Image">`).join('') :
					'<div class="text-muted">No images</div>';

				const expenseRows = expenses.length ?
					expenses.map((e) => `
					<tr>
						<td>${e.description || '-'}</td>
						<td>${e.date || '-'}</td>
						<td>${e.amount || '-'}</td>
						<td>${e.status || '-'}</td>
					</tr>
				`).join('') :
					'<tr><td colspan="4" class="text-muted">No expenses</td></tr>';

				const plotRows = plots.length ?
					plots.map((p) => `
					<tr>
						<td>${p.plot_number || '-'}</td>
						<td>${p.size || '-'}</td>
						<td>${p.dimension || '-'}</td>
						<td>${p.facing || '-'}</td>
						<td>${p.price || '-'}</td>
						<td>${p.status || '-'}</td>
					</tr>
				`).join('') :
					'<tr><td colspan="6" class="text-muted">No plots</td></tr>';

				const mapBadge = hasMap ?
					`<span class="badge bg-success">Map Uploaded</span>` :
					`<span class="badge bg-secondary">No Map</span>`;

				content.innerHTML = `
				<div class="site-detail-header">
					<div class="site-detail-title">
						<i class="bx bx-building-house"></i>
						${site.name || 'Site'}
					</div>
					<div class="site-detail-meta">
						<span class="site-detail-chip"><i class="bx bx-map-pin"></i> ${site.location || '-'}</span>
						${mapBadge}
					</div>
				</div>

				<div class="site-detail-card">
					<h6>Basic Info</h6>
					<div class="site-detail-grid">
						<div>
							<div class="site-detail-label">Site Name</div>
							<div class="site-detail-value">${site.name || '-'}</div>
						</div>
						<div>
							<div class="site-detail-label">Location</div>
							<div class="site-detail-value">${site.location || '-'}</div>
						</div>
						<div>
							<div class="site-detail-label">Area</div>
							<div class="site-detail-value">${site.area || '-'}</div>
						</div>
						<div>
							<div class="site-detail-label">Total Plots</div>
							<div class="site-detail-value">${site.total_plots || '-'}</div>
						</div>
						<div>
							<div class="site-detail-label">Map</div>
							<div class="site-detail-value">${hasMap ? 'Uploaded' : 'Not Uploaded'}</div>
						</div>
					</div>
				</div>

				<div class="site-detail-card">
					<h6>Images</h6>
					<div class="site-detail-images">${imageHtml}</div>
				</div>

				<div class="site-detail-card">
					<h6>Plots</h6>
					<div class="table-responsive">
						<table class="table table-sm site-detail-table">
							<thead>
								<tr>
									<th>Plot No</th>
									<th>Size</th>
									<th>Dimension</th>
									<th>Facing</th>
									<th>Price</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>${plotRows}</tbody>
						</table>
					</div>
				</div>

				<div class="site-detail-card">
					<h6>Expenses</h6>
					<div class="table-responsive">
						<table class="table table-sm site-detail-table">
							<thead>
								<tr>
									<th>Description</th>
									<th>Date</th>
									<th>Amount</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>${expenseRows}</tbody>
						</table>
					</div>
				</div>
			`;
			})
			.catch(() => {
				content.innerHTML = '<div class="text-danger">Error loading details</div>';
			});
	});
</script>
