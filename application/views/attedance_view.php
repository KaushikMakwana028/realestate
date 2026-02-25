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

		<!-- Stats Cards -->
		<div class="row mb-4">
			<div class="col-xl-3 col-md-6 mb-3">
				<div class="card border-0 shadow-sm stat-card"
					style="border-left: 4px solid #6366f1 !important; border-radius: 12px; overflow: hidden;">
					<div class="card-body d-flex align-items-center p-3">
						<div class="rounded-circle d-flex align-items-center justify-content-center me-3"
							style="width: 52px; height: 52px; background: linear-gradient(135deg, #6366f1, #818cf8);">
							<i class="bx bx-group text-white" style="font-size: 1.5rem;"></i>
						</div>
						<div>
							<p class="mb-0 text-muted"
								style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Total
								Employees</p>
							<h4 class="mb-0 fw-bold" id="totalEmployees" style="color: #2c3e50;">--</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-3">
				<div class="card border-0 shadow-sm stat-card"
					style="border-left: 4px solid #10b981 !important; border-radius: 12px; overflow: hidden;">
					<div class="card-body d-flex align-items-center p-3">
						<div class="rounded-circle d-flex align-items-center justify-content-center me-3"
							style="width: 52px; height: 52px; background: linear-gradient(135deg, #10b981, #34d399);">
							<i class="bx bx-check-circle text-white" style="font-size: 1.5rem;"></i>
						</div>
						<div>
							<p class="mb-0 text-muted"
								style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Present
								Today</p>
							<h4 class="mb-0 fw-bold" id="presentToday" style="color: #10b981;">--</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-3">
				<div class="card border-0 shadow-sm stat-card"
					style="border-left: 4px solid #f59e0b !important; border-radius: 12px; overflow: hidden;">
					<div class="card-body d-flex align-items-center p-3">
						<div class="rounded-circle d-flex align-items-center justify-content-center me-3"
							style="width: 52px; height: 52px; background: linear-gradient(135deg, #f59e0b, #fbbf24);">
							<i class="bx bx-time-five text-white" style="font-size: 1.5rem;"></i>
						</div>
						<div>
							<p class="mb-0 text-muted"
								style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Late
								Arrivals</p>
							<h4 class="mb-0 fw-bold" id="lateArrivals" style="color: #f59e0b;">--</h4>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6 mb-3">
				<div class="card border-0 shadow-sm stat-card"
					style="border-left: 4px solid #ef4444 !important; border-radius: 12px; overflow: hidden;">
					<div class="card-body d-flex align-items-center p-3">
						<div class="rounded-circle d-flex align-items-center justify-content-center me-3"
							style="width: 52px; height: 52px; background: linear-gradient(135deg, #ef4444, #f87171);">
							<i class="bx bx-x-circle text-white" style="font-size: 1.5rem;"></i>
						</div>
						<div>
							<p class="mb-0 text-muted"
								style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px;">Absent
								Today</p>
							<h4 class="mb-0 fw-bold" id="absentToday" style="color: #ef4444;">--</h4>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Table Card -->
		<div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
			<!-- Card Header -->
			<div class="card-header bg-white py-3" style="border-bottom: 1px solid #f1f5f9;">
				<div class="row align-items-center g-3">
					<!-- Search -->
					<div class="col-lg-4 col-md-6">
						<div class="position-relative">
							<i class="bx bx-search position-absolute"
								style="left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 1.2rem;"></i>
							<input type="text" id="serchattedance" class="form-control ps-5"
								placeholder="Search by name, date, status..."
								style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 10px 15px 10px 42px; transition: all 0.3s; background: #f8fafc;">
						</div>
					</div>

					<!-- Date Filter -->
					<div class="col-lg-3 col-md-6">
						<div class="position-relative">
							<i class="bx bx-calendar position-absolute"
								style="left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 1.2rem;"></i>
							<input type="date" id="dateFilter" class="form-control ps-5"
								style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 10px 15px 10px 42px; background: #f8fafc;">
						</div>
					</div>

					<!-- Status Filter -->
					<div class="col-lg-2 col-md-4">
						<select class="form-select" id="statusFilter"
							style="border-radius: 10px; border: 2px solid #e2e8f0; padding: 10px 15px; background: #f8fafc; cursor: pointer;">
							<option value="">All Status</option>
							<option value="present">Present</option>
							<option value="absent">Absent</option>
							<option value="pending">Pending</option>
							<option value="rejected">Rejected</option>
						</select>
					</div>

					<!-- Action Buttons -->
					<div class="col-lg-3 col-md-8 text-end">
						<div class="d-flex gap-2 justify-content-end flex-wrap">
							<button class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1"
								style="border-radius: 8px; padding: 8px 16px; border: 2px solid #e2e8f0;"
								onclick="refreshTable()" title="Refresh">
								<i class="bx bx-refresh" style="font-size: 1.1rem;"></i>
								<span class="d-none d-xl-inline">Refresh</span>
							</button>
							<button type="button" id="showAllAttendanceBtn"
								class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 d-none"
								style="border-radius: 8px; padding: 8px 16px; border: 2px solid #c7d2fe;"
								title="Show all attendance records">
								<i class="bx bx-list-ul" style="font-size: 1.1rem;"></i>
								<span class="d-none d-xl-inline">Show All Data</span>
							</button>
							<div class="btn-group">
								<!-- <button class="btn btn-sm d-flex align-items-center gap-1 text-white"
									style="border-radius: 8px 0 0 8px; padding: 8px 16px; background: linear-gradient(135deg, #6366f1, #818cf8); border: none;"
									onclick="exportData('csv')">
									<i class="bx bx-download" style="font-size: 1.1rem;"></i>
									<span class="d-none d-xl-inline">Export</span>
								</button> -->
								<!-- <button class="btn btn-sm dropdown-toggle dropdown-toggle-split text-white"
									data-bs-toggle="dropdown"
									style="border-radius: 0 8px 8px 0; padding: 8px 10px; background: linear-gradient(135deg, #818cf8, #6366f1); border: none; border-left: 1px solid rgba(255,255,255,0.2);">
								</button> -->
								<ul class="dropdown-menu dropdown-menu-end shadow-sm"
									style="border-radius: 10px; border: none;">
									<li><a class="dropdown-item" href="javascript:;" onclick="exportData('csv')"><i
												class="bx bx-file me-2"></i>CSV</a></li>
									<li><a class="dropdown-item" href="javascript:;" onclick="exportData('excel')"><i
												class="bx bx-spreadsheet me-2"></i>Excel</a></li>
									<li><a class="dropdown-item" href="javascript:;" onclick="exportData('pdf')"><i
												class="bx bx-file-blank me-2"></i>PDF</a></li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li><a class="dropdown-item" href="javascript:;" onclick="printTable()"><i
												class="bx bx-printer me-2"></i>Print</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Table -->
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-hover align-middle mb-0" id="attendanceTable">
						<thead style="background: linear-gradient(135deg, #f8fafc, #f1f5f9);">
							<tr>
								<th
									style="padding: 16px 20px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b; font-weight: 700; border: none;">
									#
								</th>
								<th
									style="padding: 16px 20px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b; font-weight: 700; border: none;">
									Employee
								</th>
								<th
									style="padding: 16px 20px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b; font-weight: 700; border: none;">
									Photo
								</th>
								<th
									style="padding: 16px 20px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b; font-weight: 700; border: none;">
									<i class="bx bx-calendar me-1"></i>Date & Time
								</th>
								<th
									style="padding: 16px 20px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b; font-weight: 700; border: none;">
									Status
								</th>
								<th
									style="padding: 16px 20px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b; font-weight: 700; border: none;">
									<i class="bx bx-phone me-1"></i>Mobile
								</th>
								<th
									style="padding: 16px 20px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b; font-weight: 700; border: none; text-align: center;">
									Actions
								</th>
							</tr>
						</thead>
						<tbody id="attedanceTableBody">
							<!-- Dynamic rows will be loaded here -->

							<!-- Sample Row for Preview -->
							<tr class="attendance-row" style="transition: all 0.2s ease;">
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<span class="fw-semibold text-muted">1</span>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<div class="d-flex align-items-center gap-3">
										<div class="rounded-circle d-flex align-items-center justify-content-center"
											style="width: 40px; height: 40px; background: linear-gradient(135deg, #6366f1, #818cf8); flex-shrink: 0;">
											<span class="text-white fw-bold" style="font-size: 0.85rem;">JD</span>
										</div>
										<div>
											<h6 class="mb-0 fw-semibold" style="color: #1e293b; font-size: 0.9rem;">John
												Doe</h6>
											<small class="text-muted" style="font-size: 0.75rem;">EMP-001 ·
												Developer</small>
										</div>
									</div>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<div class="position-relative" style="width: 48px; height: 48px;">
										<img src="https://via.placeholder.com/48" alt="Selfie"
											class="rounded-circle shadow-sm"
											style="width: 48px; height: 48px; object-fit: cover; border: 2px solid #e2e8f0; cursor: pointer;"
											onclick="viewPhoto(this.src)" title="Click to view">
										<span class="position-absolute"
											style="bottom: -2px; right: -2px; width: 14px; height: 14px; background: #10b981; border-radius: 50%; border: 2px solid white;"></span>
									</div>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<div>
										<div class="fw-semibold" style="color: #334155; font-size: 0.9rem;">
											<i class="bx bx-calendar-alt me-1" style="color: #6366f1;"></i>25 Dec 2024
										</div>
										<small class="text-muted">
											<i class="bx bx-time me-1"></i>09:00 AM
										</small>
									</div>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<span class="badge d-inline-flex align-items-center gap-1"
										style="background: rgba(16, 185, 129, 0.1); color: #059669; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 0.78rem;">
										<span
											style="width: 6px; height: 6px; background: #10b981; border-radius: 50; display: inline-block;"></span>
										Present
									</span>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<a href="tel:+919876543210"
										class="text-decoration-none d-flex align-items-center gap-2"
										style="color: #475569;">
										<div class="rounded-circle d-flex align-items-center justify-content-center"
											style="width: 30px; height: 30px; background: rgba(99, 102, 241, 0.1); flex-shrink: 0;">
											<i class="bx bx-phone" style="color: #6366f1; font-size: 0.85rem;"></i>
										</div>
										+91 98765 43210
									</a>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9; text-align: center;">
									<div class="d-flex gap-1 justify-content-center">
										<button class="btn btn-sm d-flex align-items-center justify-content-center"
											style="width: 34px; height: 34px; border-radius: 8px; background: rgba(99, 102, 241, 0.1); border: none; transition: all 0.2s;"
											title="View Details"
											onmouseover="this.style.background='#6366f1'; this.querySelector('i').style.color='white';"
											onmouseout="this.style.background='rgba(99,102,241,0.1)'; this.querySelector('i').style.color='#6366f1';">
											<i class="bx bx-show" style="color: #6366f1; font-size: 1.1rem;"></i>
										</button>
										<button class="btn btn-sm d-flex align-items-center justify-content-center"
											style="width: 34px; height: 34px; border-radius: 8px; background: rgba(245, 158, 11, 0.1); border: none; transition: all 0.2s;"
											title="Edit"
											onmouseover="this.style.background='#f59e0b'; this.querySelector('i').style.color='white';"
											onmouseout="this.style.background='rgba(245,158,11,0.1)'; this.querySelector('i').style.color='#f59e0b';">
											<i class="bx bx-edit" style="color: #f59e0b; font-size: 1.1rem;"></i>
										</button>
										<button class="btn btn-sm d-flex align-items-center justify-content-center"
											style="width: 34px; height: 34px; border-radius: 8px; background: rgba(239, 68, 68, 0.1); border: none; transition: all 0.2s;"
											title="Delete"
											onmouseover="this.style.background='#ef4444'; this.querySelector('i').style.color='white';"
											onmouseout="this.style.background='rgba(239,68,68,0.1)'; this.querySelector('i').style.color='#ef4444';">
											<i class="bx bx-trash" style="color: #ef4444; font-size: 1.1rem;"></i>
										</button>
									</div>
								</td>
							</tr>

							<!-- Sample Late Row -->
							<tr class="attendance-row" style="transition: all 0.2s ease;">
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<span class="fw-semibold text-muted">2</span>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<div class="d-flex align-items-center gap-3">
										<div class="rounded-circle d-flex align-items-center justify-content-center"
											style="width: 40px; height: 40px; background: linear-gradient(135deg, #f59e0b, #fbbf24); flex-shrink: 0;">
											<span class="text-white fw-bold" style="font-size: 0.85rem;">AS</span>
										</div>
										<div>
											<h6 class="mb-0 fw-semibold" style="color: #1e293b; font-size: 0.9rem;">
												Alice Smith</h6>
											<small class="text-muted" style="font-size: 0.75rem;">EMP-002 ·
												Designer</small>
										</div>
									</div>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<div class="position-relative" style="width: 48px; height: 48px;">
										<img src="https://via.placeholder.com/48" alt="Selfie"
											class="rounded-circle shadow-sm"
											style="width: 48px; height: 48px; object-fit: cover; border: 2px solid #e2e8f0; cursor: pointer;">
										<span class="position-absolute"
											style="bottom: -2px; right: -2px; width: 14px; height: 14px; background: #f59e0b; border-radius: 50%; border: 2px solid white;"></span>
									</div>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<div>
										<div class="fw-semibold" style="color: #334155; font-size: 0.9rem;">
											<i class="bx bx-calendar-alt me-1" style="color: #6366f1;"></i>25 Dec 2024
										</div>
										<small class="text-muted">
											<i class="bx bx-time me-1"></i>10:15 AM
										</small>
									</div>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<span class="badge d-inline-flex align-items-center gap-1"
										style="background: rgba(245, 158, 11, 0.1); color: #d97706; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 0.78rem;">
										<span
											style="width: 6px; height: 6px; background: #f59e0b; border-radius: 50%; display: inline-block;"></span>
										Late
									</span>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
									<a href="tel:+919876543211"
										class="text-decoration-none d-flex align-items-center gap-2"
										style="color: #475569;">
										<div class="rounded-circle d-flex align-items-center justify-content-center"
											style="width: 30px; height: 30px; background: rgba(99, 102, 241, 0.1); flex-shrink: 0;">
											<i class="bx bx-phone" style="color: #6366f1; font-size: 0.85rem;"></i>
										</div>
										+91 98765 43211
									</a>
								</td>
								<td style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9; text-align: center;">
									<div class="d-flex gap-1 justify-content-center">
										<button class="btn btn-sm d-flex align-items-center justify-content-center"
											style="width: 34px; height: 34px; border-radius: 8px; background: rgba(99, 102, 241, 0.1); border: none;"
											title="View Details"
											onmouseover="this.style.background='#6366f1'; this.querySelector('i').style.color='white';"
											onmouseout="this.style.background='rgba(99,102,241,0.1)'; this.querySelector('i').style.color='#6366f1';">
											<i class="bx bx-show" style="color: #6366f1; font-size: 1.1rem;"></i>
										</button>
										<button class="btn btn-sm d-flex align-items-center justify-content-center"
											style="width: 34px; height: 34px; border-radius: 8px; background: rgba(245, 158, 11, 0.1); border: none;"
											title="Edit"
											onmouseover="this.style.background='#f59e0b'; this.querySelector('i').style.color='white';"
											onmouseout="this.style.background='rgba(245,158,11,0.1)'; this.querySelector('i').style.color='#f59e0b';">
											<i class="bx bx-edit" style="color: #f59e0b; font-size: 1.1rem;"></i>
										</button>
										<button class="btn btn-sm d-flex align-items-center justify-content-center"
											style="width: 34px; height: 34px; border-radius: 8px; background: rgba(239, 68, 68, 0.1); border: none;"
											title="Delete"
											onmouseover="this.style.background='#ef4444'; this.querySelector('i').style.color='white';"
											onmouseout="this.style.background='rgba(239,68,68,0.1)'; this.querySelector('i').style.color='#ef4444';">
											<i class="bx bx-trash" style="color: #ef4444; font-size: 1.1rem;"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- Empty State (shown when no data) -->
				<div class="text-center py-5 d-none" id="emptyState">
					<div class="mb-3">
						<div class="rounded-circle d-inline-flex align-items-center justify-content-center"
							style="width: 80px; height: 80px; background: linear-gradient(135deg, #f1f5f9, #e2e8f0);">
							<i class="bx bx-calendar-x" style="font-size: 2.5rem; color: #94a3b8;"></i>
						</div>
					</div>
					<h5 class="fw-semibold" style="color: #475569;">No Attendance Records Found</h5>
					<p class="text-muted" style="max-width: 400px; margin: 0 auto;">There are no attendance records
						matching your search criteria. Try adjusting your filters.</p>
				</div>

				<!-- Loading State -->
				<div class="text-center py-5 d-none" id="loadingState">
					<div class="spinner-border mb-3" role="status" style="color: #6366f1; width: 3rem; height: 3rem;">
						<span class="visually-hidden">Loading...</span>
					</div>
					<p class="text-muted">Loading attendance data...</p>
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
									id="totalRecords">50</strong> records</span>
						</div>
					</div>
					<div class="col-md-7">
						<nav aria-label="Attendance pagination">
							<ul class="pagination mb-0 justify-content-end gap-1" id="attendancePagination">
								<li class="page-item">
									<a class="page-link d-flex align-items-center justify-content-center"
										href="javascript:;"
										style="border-radius: 8px; border: 2px solid #e2e8f0; color: #64748b; width: 38px; height: 38px; padding: 0; transition: all 0.2s;"
										onmouseover="this.style.background='#6366f1'; this.style.color='white'; this.style.borderColor='#6366f1';"
										onmouseout="this.style.background='white'; this.style.color='#64748b'; this.style.borderColor='#e2e8f0';">
										<i class="bx bx-chevron-left" style="font-size: 1.2rem;"></i>
									</a>
								</li>
								<li class="page-item">
									<a class="page-link d-flex align-items-center justify-content-center"
										href="javascript:;"
										style="border-radius: 8px; background: linear-gradient(135deg, #6366f1, #818cf8); color: white; border: none; width: 38px; height: 38px; padding: 0; font-weight: 600; box-shadow: 0 2px 8px rgba(99,102,241,0.3);">
										1
									</a>
								</li>
								<li class="page-item">
									<a class="page-link d-flex align-items-center justify-content-center"
										href="javascript:;"
										style="border-radius: 8px; border: 2px solid #e2e8f0; color: #64748b; width: 38px; height: 38px; padding: 0; transition: all 0.2s;"
										onmouseover="this.style.background='#6366f1'; this.style.color='white'; this.style.borderColor='#6366f1';"
										onmouseout="this.style.background='white'; this.style.color='#64748b'; this.style.borderColor='#e2e8f0';">
										2
									</a>
								</li>
								<li class="page-item">
									<a class="page-link d-flex align-items-center justify-content-center"
										href="javascript:;"
										style="border-radius: 8px; border: 2px solid #e2e8f0; color: #64748b; width: 38px; height: 38px; padding: 0; transition: all 0.2s;"
										onmouseover="this.style.background='#6366f1'; this.style.color='white'; this.style.borderColor='#6366f1';"
										onmouseout="this.style.background='white'; this.style.color='#64748b'; this.style.borderColor='#e2e8f0';">
										3
									</a>
								</li>
								<li class="page-item">
									<span class="page-link d-flex align-items-center justify-content-center"
										style="border: none; color: #94a3b8; width: 38px; height: 38px; padding: 0;">
										...
									</span>
								</li>
								<li class="page-item">
									<a class="page-link d-flex align-items-center justify-content-center"
										href="javascript:;"
										style="border-radius: 8px; border: 2px solid #e2e8f0; color: #64748b; width: 38px; height: 38px; padding: 0; transition: all 0.2s;"
										onmouseover="this.style.background='#6366f1'; this.style.color='white'; this.style.borderColor='#6366f1';"
										onmouseout="this.style.background='white'; this.style.color='#64748b'; this.style.borderColor='#e2e8f0';">
										5
									</a>
								</li>
								<li class="page-item">
									<a class="page-link d-flex align-items-center justify-content-center"
										href="javascript:;"
										style="border-radius: 8px; border: 2px solid #e2e8f0; color: #64748b; width: 38px; height: 38px; padding: 0; transition: all 0.2s;"
										onmouseover="this.style.background='#6366f1'; this.style.color='white'; this.style.borderColor='#6366f1';"
										onmouseout="this.style.background='white'; this.style.color='#64748b'; this.style.borderColor='#e2e8f0';">
										<i class="bx bx-chevron-right" style="font-size: 1.2rem;"></i>
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<!-- Photo Preview Modal -->
<div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content border-0" style="border-radius: 16px; overflow: hidden;">
			<div class="modal-header border-0 pb-0" style="background: linear-gradient(135deg, #6366f1, #818cf8);">
				<h6 class="modal-title text-white"><i class="bx bx-camera me-2"></i>Attendance Photo</h6>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body text-center p-4">
				<img id="previewPhoto" src="" alt="Attendance Photo" class="rounded-3 shadow"
					style="max-width: 100%; max-height: 300px; object-fit: cover;">
				<div class="mt-3">
					<small class="text-muted"><i class="bx bx-time me-1"></i>Captured at 09:00 AM</small>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Custom CSS -->
<style>
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
		document.getElementById('previewPhoto').src = src;
		new bootstrap.Modal(document.getElementById('photoModal')).show();
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
