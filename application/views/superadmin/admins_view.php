<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Admins</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title mb-0">All Admins</h5>
                    <div class="text-muted">Super Admin View</div>
                </div>
                <div class="d-lg-flex align-items-center mb-3 gap-3">
                    <div class="position-relative">
                        <input type="text" id="adminSearch" class="form-control ps-5 radius-30" placeholder="Search Admin">
                        <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                    </div>
                    <button type="button" id="adminSearchBtn" class="btn btn-primary radius-30 px-4">Search</button>
                </div>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Index</th>
                                <th>Admin</th>
                                <th>Business</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Sites</th>
                                <th>Plots</th>
                                <th>Users</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="superAdminTable">
                            <?php if (!empty($super_admins)): ?>
                                <?php $i = 1; foreach ($super_admins as $admin): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $admin->name ?? '-'; ?></td>
                                        <td><?= $admin->business_name ?? '-'; ?></td>
                                        <td><?= $admin->mobile ?? '-'; ?></td>
                                        <td><?= $admin->email ?? '-'; ?></td>
                                        <td><?= $admin->sites_count ?? 0; ?></td>
                                        <td><?= $admin->plots_count ?? 0; ?></td>
                                        <td><?= $admin->users_count ?? 0; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-primary viewAdmin" data-id="<?= $admin->id; ?>">View</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="9" class="text-center text-muted">No admins found</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Admin pagination">
                    <ul class="pagination round-pagination justify-content-center" id="adminPagination">
                        <?php if (!empty($admins_total_pages) && $admins_total_pages > 1): ?>
                            <li class="page-item disabled"><a class="page-link" href="javascript:;">Previous</a></li>
                            <?php for ($p = 1; $p <= $admins_total_pages; $p++): ?>
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

        <div class="modal fade" id="adminDetailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Admin Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="adminDetailHeader" class="mb-3"></div>
                        <div id="adminDetailSites"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
