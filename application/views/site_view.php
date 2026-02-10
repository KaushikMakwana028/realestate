<div class="page-wrapper">

			<div class="page-content">

				<!--breadcrumb-->

				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

					<!-- <div class="breadcrumb-title pe-3">Category</div> -->

					<div class="ps-3">

						<nav aria-label="breadcrumb">

							<ol class="breadcrumb mb-0 p-0">

								<li class="breadcrumb-item"><a href="<?= base_url('dashboard');?>"><i class="bx bx-home-alt"></i></a>

								</li>

								<li class="breadcrumb-item active" aria-current="page">Sites</li>

							</ol>

						</nav>

					</div>

					

				</div>

				<!--end breadcrumb-->

			  

				<div class="card">

					<div class="card-body">

						<div class="d-lg-flex align-items-center mb-4 gap-3">

							<div class="position-relative">

								<input type="text" id="serchSite" class="form-control ps-5 radius-30" placeholder="Search site"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>

							</div>

						</div>

						<div class="table-responsive">

							<table class="table mb-0" id="siteTable">

								<thead class="table-light">

									<tr>

										<th>Index</th>

										<th>Site Name</th>

										<th>Location</th>

										<th>Site Value</th>
										<th>Collected Value</th>
										<th>Total Expenses</th>


										<th>Total Plots</th>
										<th>Images Status</th>
										<th>Map Status</th>
										<th>View Plots</th>
										<th>View Expenses</th>
										<th>Actions</th>



									</tr>

								</thead>

								<tbody id="customerTableBody">

									

								</tbody>

							</table>

						</div>

					</div>

                    <nav aria-label="Page navigation example">

							<ul class="pagination round-pagination justify-content-center">

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
			const hasMap = data.site?.has_map === true || (!!site.site_map && site.site_map !== 'NULL' && site.site_map !== 'null' && site.site_map !== '');

			const imageHtml = images.length
				? images.map((img) => `<img src="<?= base_url(); ?>${img}" alt="Site Image">`).join('')
				: '<div class="text-muted">No images</div>';

			const expenseRows = expenses.length
				? expenses.map((e) => `
					<tr>
						<td>${e.description || '-'}</td>
						<td>${e.date || '-'}</td>
						<td>${e.amount || '-'}</td>
						<td>${e.status || '-'}</td>
					</tr>
				`).join('')
				: '<tr><td colspan="4" class="text-muted">No expenses</td></tr>';

			const plotRows = plots.length
				? plots.map((p) => `
					<tr>
						<td>${p.plot_number || '-'}</td>
						<td>${p.size || '-'}</td>
						<td>${p.dimension || '-'}</td>
						<td>${p.facing || '-'}</td>
						<td>${p.price || '-'}</td>
						<td>${p.status || '-'}</td>
					</tr>
				`).join('')
				: '<tr><td colspan="6" class="text-muted">No plots</td></tr>';

			const mapBadge = hasMap
				? `<span class="badge bg-success">Map Uploaded</span>`
				: `<span class="badge bg-secondary">No Map</span>`;

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
