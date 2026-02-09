<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Sites</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title mb-0">All Sites (Super Admin)</h5>
                    <div class="text-muted">View sites, expenses, and images</div>
                </div>
                <div class="d-lg-flex align-items-center mb-3 gap-3">
                    <div class="position-relative">
                        <input type="text" id="siteSearch" class="form-control ps-5 radius-30" placeholder="Search Site">
                        <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                    </div>
                    <button type="button" id="siteSearchBtn" class="btn btn-primary radius-30 px-4">Search</button>
                </div>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Index</th>
                                <th>Site</th>
                                <th>Admin</th>
                                <th>Location</th>
                                <th>Total Plots</th>
                                <th>Approved Expenses</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="superAdminSitesTable">
                            <?php if (!empty($super_sites)): ?>
                                <?php $i = 1; foreach ($super_sites as $site): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $site->name ?? '-'; ?></td>
                                        <td><?= $site->admin_name ?? '-'; ?></td>
                                        <td><?= $site->location ?? '-'; ?></td>
                                        <td><?= $site->total_plots ?? 0; ?></td>
                                        <td><?= $site->total_expenses ?? 0; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary viewSiteDetail" data-id="<?= $site->id; ?>">View</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" class="text-center text-muted">No sites found</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Site pagination">
                    <ul class="pagination round-pagination justify-content-center" id="sitePagination">
                        <?php if (!empty($sites_total_pages) && $sites_total_pages > 1): ?>
                            <li class="page-item disabled"><a class="page-link" href="javascript:;">Previous</a></li>
                            <?php for ($p = 1; $p <= $sites_total_pages; $p++): ?>
                                <li class="page-item <?= $p === 1 ? 'active' : ''; ?>">
                                    <a class="page-link" href="javascript:;" data-page="<?= $p; ?>"><?= $p; ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item"><a class="page-link" href="javascript:;" data-page="2">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="modal fade" id="siteDetailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Site Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="siteDetailHeader" class="mb-3"></div>
                        <div class="mb-4">
                            <div class="fw-bold mb-2">Site Images</div>
                            <div id="siteDetailImages" class="d-flex flex-wrap gap-2"></div>
                        </div>
                        <div class="mb-4">
                            <div class="fw-bold mb-2">Expenses</div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="siteDetailExpenses"></tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <div class="fw-bold mb-2">Plots</div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Plot No</th>
                                            <th>Size</th>
                                            <th>Dimension</th>
                                            <th>Facing</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="siteDetailPlots"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
