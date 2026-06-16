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
			<div class="ms-auto">
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInquiryModal">
					<i class="bx bx-plus"></i> Add Enquiry
				</button>
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
							<select class="form-select enq-filter-select" id="filterStatus">
								<option value="">All Status</option>
								<option value="pending">Pending</option>
								<option value="contacted">Contacted</option>
								<option value="qualified">Qualified</option>
								<option value="converted">Converted</option>
								<option value="closed">Closed</option>
							</select>
							<input type="month" class="form-control enq-filter-select" id="filterMonth">
							<button type="button" class="btn btn-outline-primary enq-show-all-btn d-none"
								id="showAllInquiryBtn" title="Show all enquiries data">
								<i class="bx bx-list-ul me-1"></i>Show All Data
							</button>
						</div>
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
										<i class="bx bx-info-circle"></i> Status
									</div>
								</th>
								<th>
									<div class="enq-th-content">
										<i class="bx bx-note"></i> Notes
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
					<span class="text-muted" id="enqPaginationInfo">Showing 0 enquiries</span>
				</div>
				<nav aria-label="Page navigation">
					<ul class="pagination enq-pagination mb-0" id="enqPaginationList">
						<!-- Dynamic pagination -->
					</ul>
				</nav>
			</div>
		</div>

	</div>
</div>

<!-- Add Inquiry Modal -->
<div class="modal fade" id="addInquiryModal" tabindex="-1" aria-labelledby="addInquiryModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addInquiryModalLabel">
					<i class="bx bx-plus-circle me-2"></i>Add New Enquiry
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="addInquiryForm">
				<div class="modal-body">
					<div class="row g-3">
						<div class="col-12">
							<label class="form-label">Site <span class="text-danger">*</span></label>
							<select class="form-select" id="addSiteId" name="site_id" required>
								<option value="">Select Site</option>
							</select>
						</div>
						<div class="col-12">
							<label class="form-label">Plot <span class="text-danger">*</span></label>
							<select class="form-select" id="addPlotId" name="plot_id" required disabled>
								<option value="">Select Plot</option>
							</select>
						</div>
						<div class="col-12">
							<label class="form-label">Customer Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="customer_name" required>
						</div>
						<div class="col-12">
							<label class="form-label">Mobile <span class="text-danger">*</span></label>
							<input type="tel" class="form-control" name="mobile" pattern="[0-9]{10}" maxlength="10" required>
							<small class="text-muted">10 digit mobile number</small>
						</div>
						<div class="col-12">
							<label class="form-label">Address</label>
							<textarea class="form-control" name="address" rows="2"></textarea>
						</div>
						<div class="col-12">
							<label class="form-label">Status <span class="text-danger">*</span></label>
							<select class="form-select" name="status" required>
								<option value="pending" selected>Pending</option>
								
								<option value="converted">Converted</option>
								<option value="closed">Lost</option>
							</select>
						</div>
						<div class="col-12">
							<label class="form-label">Notes</label>
							<textarea class="form-control" name="note" rows="3"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">
						<i class="bx bx-save me-1"></i>Add Enquiry
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Edit Inquiry Modal -->
<div class="modal fade" id="editInquiryModal" tabindex="-1" aria-labelledby="editInquiryModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editInquiryModalLabel">
					<i class="bx bx-edit me-2"></i>Edit Enquiry
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="editInquiryForm">
				<input type="hidden" id="editInquiryId" name="inquiry_id">
				<div class="modal-body">
					<div class="row g-3">
						<div class="col-12">
							<label class="form-label">Site <span class="text-danger">*</span></label>
							<select class="form-select" id="editSiteId" name="site_id" required>
								<option value="">Select Site</option>
							</select>
						</div>
						<div class="col-12">
							<label class="form-label">Plot <span class="text-danger">*</span></label>
							<select class="form-select" id="editPlotId" name="plot_id" required>
								<option value="">Select Plot</option>
							</select>
						</div>
						<div class="col-12">
							<label class="form-label">Customer Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="editCustomerName" name="customer_name" required>
						</div>
						<div class="col-12">
							<label class="form-label">Mobile <span class="text-danger">*</span></label>
							<input type="tel" class="form-control" id="editMobile" name="mobile" pattern="[0-9]{10}" maxlength="10" required>
						</div>
						<div class="col-12">
							<label class="form-label">Address</label>
							<textarea class="form-control" id="editAddress" name="address" rows="2"></textarea>
						</div>
						<div class="col-12">
							<label class="form-label">Status <span class="text-danger">*</span></label>
							<select class="form-select" id="editStatus" name="status" required>
								<option value="pending">Pending</option>
								<option value="contacted">Contacted</option>
								<option value="qualified">Qualified</option>
								<option value="converted">Converted</option>
								<option value="closed">Closed</option>
							</select>
						</div>
						<div class="col-12">
							<label class="form-label">Notes</label>
							<textarea class="form-control" id="editNote" name="note" rows="3"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">
						<i class="bx bx-save me-1"></i>Update Enquiry
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
	// ═══════════════════════════════════════════════════════════════
	// INQUIRY MANAGEMENT - Consolidated Script
	// ═══════════════════════════════════════════════════════════════

	// Global State
	const InquiryManager = {
		currentPage: 1,
		filters: {
			search: '',
			site_filter: '',
			month_filter: '',
			status_filter: ''
		},
		siteOptions: [],
		searchTimeout: null,
		allInquiries: [], // Store all loaded inquiries for detail modal

		// Initialize
		init: function() {
			this.cacheElements();
			this.bindEvents();
			this.loadInitialData();
		},

		// Cache DOM elements
		cacheElements: function() {
			this.$searchInput = $('#serchinquiry');
			this.$filterSite = $('#filterSite');
			this.$filterMonth = $('#filterMonth');
			this.$filterStatus = $('#filterStatus');
			this.$showAllBtn = $('#showAllInquiryBtn');
			this.$tableBody = $('#inquiryTableBody');
			this.$emptyState = $('#enqEmptyState');
			this.$paginationList = $('#enqPaginationList');
			this.$paginationInfo = $('#enqPaginationInfo');
			this.$addForm = $('#addInquiryForm');
			this.$editForm = $('#editInquiryForm');
			this.$addSiteId = $('#addSiteId');
			this.$addPlotId = $('#addPlotId');
			this.$editSiteId = $('#editSiteId');
			this.$editPlotId = $('#editPlotId');
			this.$editInquiryId = $('#editInquiryId');
		},

		// Bind all events
		bindEvents: function() {
			const self = this;

			// Search with debounce
			this.$searchInput.on('input', function() {
				clearTimeout(self.searchTimeout);
				self.searchTimeout = setTimeout(() => {
					self.filters.search = $(this).val();
					self.currentPage = 1;
					self.loadInquiries();
				}, 500);
			});

			// Filter changes
			this.$filterSite.add(this.$filterMonth).add(this.$filterStatus).on('change', function() {
				self.filters.site_filter = self.$filterSite.val();
				self.filters.month_filter = self.$filterMonth.val();
				self.filters.status_filter = self.$filterStatus.val();
				self.currentPage = 1;
				self.loadInquiries();
				self.toggleShowAllBtn();
			});

			// Show All button
			this.$showAllBtn.on('click', function() {
				self.$searchInput.add(self.$filterSite).add(self.$filterMonth).add(self.$filterStatus).val('');
				self.filters = { search: '', site_filter: '', month_filter: '', status_filter: '' };
				self.currentPage = 1;
				self.loadInquiries();
				$(this).addClass('d-none');
			});

			// Add modal - Site change
			this.$addSiteId.on('change', function() {
				const siteId = $(this).val();
				if (siteId) {
					self.loadPlotsForSite(siteId, self.$addPlotId);
					self.$addPlotId.prop('disabled', false);
				} else {
					self.$addPlotId.html('<option value="">Select Plot</option>').prop('disabled', true);
				}
			});

			// Edit modal - Site change
			this.$editSiteId.on('change', function() {
				const siteId = $(this).val();
				if (siteId) {
					self.loadPlotsForSite(siteId, self.$editPlotId);
				}
			});

			// Form submissions
			this.$addForm.on('submit', (e) => this.handleAddInquiry(e));
			this.$editForm.on('submit', (e) => this.handleEditInquiry(e));

			// Detail modal (Event delegation)
			$(document).on('click', '.viewEnquiryDetail', (e) => this.showDetailModal(e));
		},

		// Load initial data
		loadInitialData: function() {
			this.loadInquiries();
			this.loadSitesForSelects();
		},

		// Load inquiries from server
		loadInquiries: function() {
			$.ajax({
				url: baseUrl('fetch_inquiries'),
				type: 'POST',
				data: {
					page: this.currentPage,
					search: this.filters.search,
					site_filter: this.filters.site_filter,
					month_filter: this.filters.month_filter,
					status_filter: this.filters.status_filter
				},
				dataType: 'json',
				success: (response) => {
					if (response.status) {
						this.allInquiries = response.data; // Store for detail modal
						this.renderInquiries(response.data);
						this.renderPagination(response.total, response.limit, response.page);
						this.updateStats(response.stats);
					}
				},
				error: () => this.showToast('Error', 'Failed to load inquiries', 'error')
			});
		},

		// Render inquiries table
		renderInquiries: function(data) {
			if (data.length === 0) {
				this.$tableBody.html('');
				this.$emptyState.removeClass('d-none');
				return;
			}

			this.$emptyState.addClass('d-none');

			let html = '';
			data.forEach((item, index) => {
				const serialNo = ((this.currentPage - 1) * 10) + index + 1;
				const statusBadge = this.getStatusBadge(item.status);

				html += `
					<tr data-inquiry-id="${item.id}">
						<td class="enq-td-index">${serialNo}</td>
						<td>${item.user_name || '-'}</td>
						<td>${item.name || '-'}</td>
						<td>${item.plot_number || '-'}</td>
						<td>${item.customer_name || '-'}</td>
						<td>${item.mobile || '-'}</td>
						<td>${statusBadge}</td>
						<td><span class="enq-note-text" title="${item.note || ''}">${item.note || '-'}</span></td>
						<td>${this.formatDate(item.created_at)}</td>
						<td class="text-center">
							<button class="btn btn-sm btn-outline-primary" onclick="InquiryManager.editInquiry(${item.id})" title="Edit">
								<i class="bx bx-edit"></i>
							</button>
							<button class="btn btn-sm btn-outline-info viewEnquiryDetail" data-inquiry-id="${item.id}" title="View Details">
								<i class="bx bx-eye"></i>
							</button>
						</td>
					</tr>
				`;
			});

			this.$tableBody.html(html);
		},

		// Get status badge HTML
		getStatusBadge: function(status) {
			const badges = {
				'pending': '<span class="badge bg-warning">Pending</span>',
				'contacted': '<span class="badge bg-info">Contacted</span>',
				'qualified': '<span class="badge bg-primary">Qualified</span>',
				'converted': '<span class="badge bg-success">Converted</span>',
				'closed': '<span class="badge bg-secondary">Closed</span>'
			};
			return badges[status] || '<span class="badge bg-secondary">Unknown</span>';
		},

		// Edit inquiry
		editInquiry: function(id) {
			// Find inquiry from stored data
			const inquiry = this.allInquiries.find(item => item.id == id);
			
			if (inquiry) {
				this.populateEditForm(inquiry);
				new bootstrap.Modal(document.getElementById('editInquiryModal')).show();
			} else {
				this.showToast('Error', 'Inquiry not found', 'error');
			}
		},

		// Populate edit form
		populateEditForm: function(inquiry) {
			this.$editInquiryId.val(inquiry.id);
			this.$editSiteId.val(inquiry.site_id);
			this.loadPlotsForSite(inquiry.site_id, this.$editPlotId, inquiry.plot_id);
			$('#editCustomerName').val(inquiry.customer_name);
			$('#editMobile').val(inquiry.mobile);
			$('#editAddress').val(inquiry.address);
			$('#editStatus').val(inquiry.status);
			$('#editNote').val(inquiry.note);
		},

		// Handle add inquiry form
		handleAddInquiry: function(e) {
			e.preventDefault();
			
			// Validate mobile
			const mobile = this.$addForm.find('input[name="mobile"]').val();
			if (!/^\d{10}$/.test(mobile)) {
				this.showToast('Error', 'Please enter a valid 10-digit mobile number', 'error');
				return;
			}

			$.ajax({
				url: baseUrl('add_inquiry_web'),
				type: 'POST',
				data: this.$addForm.serialize(),
				dataType: 'json',
				success: (response) => {
					if (response.status) {
						this.showToast('Success', response.message, 'success');
						bootstrap.Modal.getInstance(document.getElementById('addInquiryModal')).hide();
						this.$addForm[0].reset();
						this.$addPlotId.html('<option value="">Select Plot</option>').prop('disabled', true);
						this.currentPage = 1; // Reset to first page
						this.loadInquiries();
					} else {
						this.showToast('Error', response.message, 'error');
					}
				},
				error: () => this.showToast('Error', 'Something went wrong!', 'error')
			});
		},

		// Handle edit inquiry form
		handleEditInquiry: function(e) {
			e.preventDefault();
			
			// Validate mobile
			const mobile = this.$editForm.find('input[name="mobile"]').val();
			if (!/^\d{10}$/.test(mobile)) {
				this.showToast('Error', 'Please enter a valid 10-digit mobile number', 'error');
				return;
			}

			$.ajax({
				url: baseUrl('update_inquiry_web'),
				type: 'POST',
				data: this.$editForm.serialize(),
				dataType: 'json',
				success: (response) => {
					if (response.status) {
						this.showToast('Success', response.message, 'success');
						bootstrap.Modal.getInstance(document.getElementById('editInquiryModal')).hide();
						this.loadInquiries();
					} else {
						this.showToast('Error', response.message, 'error');
					}
				},
				error: () => this.showToast('Error', 'Something went wrong!', 'error')
			});
		},

		// Render pagination
		renderPagination: function(total, limit, page) {
			const totalPages = Math.ceil(total / limit);
			let html = '';

			// Previous button
			html += `<li class="page-item ${page === 1 ? 'disabled' : ''}">
				<a class="page-link" href="javascript:;" onclick="InquiryManager.changePage(${page - 1})">
					<i class="bx bx-chevron-left"></i>
				</a>
			</li>`;

			// Page numbers
			for (let i = 1; i <= totalPages; i++) {
				if (i === 1 || i === totalPages || (i >= page - 1 && i <= page + 1)) {
					html += `<li class="page-item ${i === page ? 'active' : ''}">
						<a class="page-link" href="javascript:;" onclick="InquiryManager.changePage(${i})">${i}</a>
					</li>`;
				} else if (i === page - 2 || i === page + 2) {
					html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
				}
			}

			// Next button
			html += `<li class="page-item ${page === totalPages ? 'disabled' : ''}">
				<a class="page-link" href="javascript:;" onclick="InquiryManager.changePage(${page + 1})">
					<i class="bx bx-chevron-right"></i>
				</a>
			</li>`;

			this.$paginationList.html(html);

			// Update info
			const start = ((page - 1) * limit) + 1;
			const end = Math.min(page * limit, total);
			this.$paginationInfo.text(`Showing ${start}-${end} of ${total} enquiries`);
		},

		// Change page
		changePage: function(page) {
			this.currentPage = page;
			this.loadInquiries();
			window.scrollTo({ top: 0, behavior: 'smooth' });
		},

		// Update stats cards
		updateStats: function(stats) {
			$('#statTotalEnquiries').text(stats.total_enquiries || 0);
			$('#statTodayEnquiries').text(stats.today_enquiries || 0);
			$('#statWeekEnquiries').text(stats.week_enquiries || 0);
			$('#statPendingEnquiries').text(stats.pending_enquiries || 0);
		},

		// Load sites for all selects
		loadSitesForSelects: function() {
			$.ajax({
				url: baseUrl('fetch_inquiries'),
				type: 'POST',
				data: { page: 1 },
				dataType: 'json',
				success: (response) => {
					if (response.status && response.site_options) {
						this.siteOptions = response.site_options;
						let options = '<option value="">Select Site</option>';
						response.site_options.forEach(site => {
							options += `<option value="${site.id}">${site.name}</option>`;
						});
						this.$addSiteId.add(this.$editSiteId).add(this.$filterSite).html(options);
					}
				}
			});
		},

		// Load plots for site
		loadPlotsForSite: function(siteId, $targetSelect, selectedPlotId = null) {
			if (!siteId) {
				$targetSelect.html('<option value="">Select Plot</option>');
				return;
			}

			$.ajax({
				url: baseUrl('get_plots_by_site'),
				type: 'POST',
				data: { site_id: siteId },
				dataType: 'json',
				success: (response) => {
					if (response.status) {
						let options = '<option value="">Select Plot</option>';
						response.data.forEach(plot => {
							const selected = selectedPlotId == plot.id ? 'selected' : '';
							options += `<option value="${plot.id}" ${selected}>${plot.plot_number}</option>`;
						});
						$targetSelect.html(options);
					}
				}
			});
		},

		// Toggle show all button
		toggleShowAllBtn: function() {
			const hasFilters = this.filters.search || this.filters.site_filter || 
							   this.filters.month_filter || this.filters.status_filter;
			this.$showAllBtn.toggleClass('d-none', !hasFilters);
		},

		// Show detail modal
		showDetailModal: function(e) {
			const inquiryId = $(e.target).closest('.viewEnquiryDetail').data('inquiry-id');
			const inquiry = this.allInquiries.find(item => item.id == inquiryId);

			if (!inquiry) {
				this.showToast('Error', 'Inquiry data not found', 'error');
				return;
			}

			const $modal = $('#enquiryDetailModal');
			const $content = $('#enquiryDetailContent');

			if (!$content.length) return;

			const detailHTML = `
				<div class="enq-detail-card">
					<h6><i class="bx bx-info-circle me-2"></i>Enquiry Information</h6>
					<div class="enq-detail-grid">
						<div>
							<div class="enq-detail-label">User Name</div>
							<div class="enq-detail-value">${inquiry.user_name || '-'}</div>
						</div>
						<div>
							<div class="enq-detail-label">Site Name</div>
							<div class="enq-detail-value">${inquiry.name || '-'}</div>
						</div>
						<div>
							<div class="enq-detail-label">Plot Number</div>
							<div class="enq-detail-value">${inquiry.plot_number || '-'}</div>
						</div>
						<div>
							<div class="enq-detail-label">Enquiry Date</div>
							<div class="enq-detail-value">${this.formatDate(inquiry.created_at)}</div>
						</div>
					</div>
				</div>
				<div class="enq-detail-card">
					<h6><i class="bx bx-user-circle me-2"></i>Customer Details</h6>
					<div class="enq-detail-grid">
						<div>
							<div class="enq-detail-label">Customer Name</div>
							<div class="enq-detail-value">${inquiry.customer_name || '-'}</div>
						</div>
						<div>
							<div class="enq-detail-label">Mobile</div>
							<div class="enq-detail-value">
								<a href="tel:${inquiry.mobile}" style="color:#6366f1;text-decoration:none;font-weight:700">
									<i class="bx bx-phone"></i> ${inquiry.mobile || '-'}
								</a>
							</div>
						</div>
						<div>
							<div class="enq-detail-label">Address</div>
							<div class="enq-detail-value">${inquiry.address || '-'}</div>
						</div>
						<div>
							<div class="enq-detail-label">Status</div>
							<div class="enq-detail-value">${this.getStatusBadge(inquiry.status)}</div>
						</div>
					</div>
				</div>
				<div class="enq-detail-card">
					<h6><i class="bx bx-note me-2"></i>Notes</h6>
					<p style="color:#374151;font-size:14px;line-height:1.6;margin:0;word-break:break-word;">${inquiry.note || 'No notes'}</p>
				</div>
				<div class="d-flex gap-2 mt-4">
					<a href="tel:${inquiry.mobile}" class="btn btn-sm" style="background:#10b981;color:#fff;border-radius:8px;padding:10px 16px;font-weight:600;border:none;cursor:pointer;">
						<i class="bx bx-phone"></i> Call
					</a>
					<a href="https://wa.me/${inquiry.mobile}" target="_blank" class="btn btn-sm" style="background:#25d366;color:#fff;border-radius:8px;padding:10px 16px;font-weight:600;border:none;cursor:pointer;">
						<i class="bx bxl-whatsapp"></i> WhatsApp
					</a>
					<button class="btn btn-sm" onclick="InquiryManager.editInquiry(${inquiry.id}); bootstrap.Modal.getInstance(document.getElementById('enquiryDetailModal')).hide();" style="background:#6366f1;color:#fff;border-radius:8px;padding:10px 16px;font-weight:600;border:none;cursor:pointer;">
						<i class="bx bx-edit"></i> Edit
					</button>
				</div>
			`;

			$content.html(detailHTML);
			new bootstrap.Modal($modal[0]).show();
		},

		// Format date
		formatDate: function(dateString) {
			if (!dateString) return '-';
			const date = new Date(dateString);
			return date.toLocaleDateString('en-IN', { 
				day: '2-digit', 
				month: 'short', 
				year: 'numeric' 
			});
		},

		// Show toast notification
		showToast: function(title, message, type) {
			if (typeof Lobibox !== 'undefined') {
				Lobibox.notify(type, {
					pauseDelayOnHover: true,
					continueDelayOnInactiveTab: false,
					position: 'top right',
					icon: type === 'success' ? 'bx bx-check-circle' : 'bx bx-x-circle',
					msg: message,
					title: title
				});
			} else {
				console.log(`${type.toUpperCase()}: ${title} - ${message}`);
			}
		}
	};

	// Helper function for base URL
	function baseUrl(path) {
		return '<?= base_url() ?>' + path;
	}

	// Initialize on document ready
	$(document).ready(function() {
		InquiryManager.init();
	});

	// Global function for onclick handlers (pagination, edit)
	function changePage(page) {
		InquiryManager.changePage(page);
	}

	function editInquiry(id) {
		InquiryManager.editInquiry(id);
	}
</script>

<style>
	.enq-note-text {
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		max-width: 300px;
		word-break: break-word;
	}

	.enq-detail-loader {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		padding: 40px 20px;
		text-align: center;
	}

	.enq-detail-card {
		background: #f9fafb;
		border: 1px solid #e5e7eb;
		border-radius: 10px;
		padding: 20px;
		margin-bottom: 20px;
	}

	.enq-detail-card h6 {
		color: #1f2937;
		margin-bottom: 15px;
		font-weight: 600;
		font-size: 15px;
	}

	.enq-detail-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
		gap: 20px;
	}

	.enq-detail-label {
		color: #6b7280;
		font-size: 12px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		margin-bottom: 8px;
		font-weight: 600;
	}

	.enq-detail-value {
		color: #1f2937;
		font-size: 14px;
		font-weight: 500;
	}
</style>
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

	.enq-filter-group .select2-container {
		min-width: 220px !important;
	}

	.enq-filter-group .select2-container .select2-selection--single {
		height: 40px;
		border-radius: 10px;
		border: 1.5px solid #e5e7eb;
		background: #f9fafb;
	}

	.enq-filter-group .select2-container .select2-selection__rendered {
		line-height: 37px;
		font-size: 13px;
		color: #374151;
		padding-left: 12px;
	}

	.enq-filter-group .select2-container .select2-selection__arrow {
		height: 38px;
	}

	.enq-show-all-btn {
		height: 40px;
		border-radius: 10px;
		white-space: nowrap;
		font-size: 13px;
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

<style>
	.enq-note-text {
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		max-width: 200px;
	}
</style>

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
