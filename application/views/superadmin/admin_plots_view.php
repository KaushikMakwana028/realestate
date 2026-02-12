<div class="page-wrapper bg-light">
    <div class="page-content container-fluid">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('superadmin/admins'); ?>">Admins</a></li>
                    <li class="breadcrumb-item active">Admin Plots</li>
                </ol>
            </nav>
        </div>

        <div class="card border-0 shadow-sm radius-10">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                    <div>
                        <h5 class="mb-1 fw-bold">Plots - <?= htmlspecialchars($admin_info->name ?? 'Admin'); ?></h5>
                        <small class="text-muted"><?= htmlspecialchars($admin_info->business_name ?? '-'); ?></small>
                    </div>
                    <a href="<?= base_url('superadmin/admins'); ?>" class="btn btn-sm btn-outline-secondary">Back</a>
                </div>

                <form method="GET" action="<?= base_url('superadmin/admin_plots/' . (int) ($admin_info->id ?? 0)); ?>"
                    class="d-lg-flex align-items-center mb-3 gap-3">
                    <div class="position-relative flex-grow-1">
                        <input type="text" name="search" class="form-control ps-5 radius-30" placeholder="Search by plot no / site / status"
                            value="<?= htmlspecialchars($admin_plots_search ?? ''); ?>">
                        <span class="position-absolute top-50 translate-middle-y ms-3"><i class="bx bx-search"></i></span>
                    </div>
                    <button type="submit" class="btn btn-primary radius-30 px-4">Search</button>
                </form>

                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Site</th>
                                <th>Plot No</th>
                                <th>Size</th>
                                <th>Dimension</th>
                                <th>Facing</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($admin_plots)): ?>
                                <?php $i = $admin_plots_start_index; ?>
                                <?php foreach ($admin_plots as $plot): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= htmlspecialchars($plot->site_name ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($plot->plot_number ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($plot->size ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($plot->dimension ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($plot->facing ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($plot->price ?? '-'); ?></td>
                                        <td>
                                            <?php $status = strtolower((string) ($plot->status ?? '')); ?>
                                            <?php if ($status === 'sold'): ?>
                                                <span class="badge bg-danger">Sold</span>
                                            <?php elseif ($status === 'pending'): ?>
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Available</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">No plots found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php $searchParam = !empty($admin_plots_search) ? '&search=' . urlencode($admin_plots_search) : ''; ?>
                <nav class="mt-3">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($admin_plots_current_page <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link"
                                href="<?= base_url('superadmin/admin_plots/' . (int) ($admin_info->id ?? 0) . '?page=' . ($admin_plots_current_page - 1) . $searchParam); ?>">
                                Previous
                            </a>
                        </li>
                        <?php for ($p = 1; $p <= $admin_plots_total_pages; $p++): ?>
                            <li class="page-item <?= ($p == $admin_plots_current_page) ? 'active' : ''; ?>">
                                <a class="page-link"
                                    href="<?= base_url('superadmin/admin_plots/' . (int) ($admin_info->id ?? 0) . '?page=' . $p . $searchParam); ?>">
                                    <?= $p; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($admin_plots_current_page >= $admin_plots_total_pages) ? 'disabled' : ''; ?>">
                            <a class="page-link"
                                href="<?= base_url('superadmin/admin_plots/' . (int) ($admin_info->id ?? 0) . '?page=' . ($admin_plots_current_page + 1) . $searchParam); ?>">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
