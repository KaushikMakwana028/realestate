<div class="page-wrapper">

	<div class="page-content">

		<!--breadcrumb-->

		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

			<!-- <div class="breadcrumb-title pe-3">Category</div> -->

			<div class="ps-3">

				<nav aria-label="breadcrumb">

					<ol class="breadcrumb mb-0 p-0">

						<li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"><i
									class="bx bx-home-alt"></i></a>

						</li>

						<li class="breadcrumb-item active" aria-current="page">Expenses</li>

					</ol>

				</nav>

			</div>



		</div>

		<!--end breadcrumb-->



				<div class="card">

			<div class="card-body">

				<div class="d-lg-flex align-items-center mb-4 gap-3">

					<div class="position-relative">

						<input type="text" id="serchexp" class="form-control ps-5 radius-30"
							placeholder="Search expenses"> <span
							class="position-absolute top-50 product-show translate-middle-y"><i
								class="bx bx-search"></i></span>
						<input type="hidden" id="siteID" value="<?= $site_id ?>">

					</div>

				</div>

<!-- Description Modal -->
<style>
	#expDescModal .modal-content { border-radius: 14px; }
	#expDescModal .modal-header { border-bottom: 1px solid #eef1f4; }
	#expDescModal .modal-body { padding: 20px 24px 24px; }
	.exp-desc-title { font-size: 18px; font-weight: 600; color: #1b1f24; }
	.exp-desc-label { font-size: 12px; letter-spacing: .08em; color: #6c757d; text-transform: uppercase; margin-bottom: 6px; }
	.exp-desc-text { font-size: 15px; color: #2c3137; line-height: 1.6; }
	.exp-image-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 10px; }
	.exp-image-grid img { width: 100%; height: 110px; object-fit: cover; border-radius: 10px; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
	.exp-image-empty { color: #8a93a0; font-size: 14px; }
</style>
<div class="modal fade" id="expDescModal" tabindex="-1" aria-labelledby="expDescModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title exp-desc-title" id="expDescModalLabel">Expense Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-4">
					<div class="exp-desc-label">Description</div>
					<div id="expDescText" class="exp-desc-text"></div>
				</div>
				<div>
					<div class="exp-desc-label">Images</div>
					<div id="expDescImages" class="exp-image-grid"></div>
					<div id="expDescImagesEmpty" class="exp-image-empty mt-2 d-none">No images</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Site Image Modal -->
<style>
	#siteImageModal .modal-content { background: transparent; border: 0; }
	#siteImageModal .modal-body { background: transparent; }
	.modal-backdrop.site-image-backdrop { opacity: 0.7; background: #000; }
</style>
<div class="modal fade" id="siteImageModal" tabindex="-1" aria-labelledby="siteImageModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<div class="modal-body p-0 d-flex justify-content-center align-items-center position-relative">
				<button type="button" class="btn-close position-absolute top-0 end-0 m-3 bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
				<img id="siteImageModalImg" src="" alt="Site Image" style="width:90vw;height:90vh;object-fit:contain;" />
			</div>
		</div>
	</div>
</div>

				<div class="table-responsive">

					<table class="table mb-0">

						<thead class="table-light">

							<tr>

								<th>Index</th>
								<th>Site Name</th>
								<th>Site Images</th>
								<th>User Name</th>
								<th>Expenses</th>
								<th>Date</th>
								<th>Amount</th>
								<th>Status</th>
								<th>Action</th>


							</tr>

						</thead>

						<tbody id="expensesTable">



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

<!-- </div> -->
