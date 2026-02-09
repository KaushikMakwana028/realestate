<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <!-- ===========================
             DASHBOARD COUNTER CARDS
        ============================ -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">

            <!-- Total Sites -->
            <div class="col">
                <div class="card radius-10 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-1 text-secondary">Total Sites</p>
                                <h4 class="my-1"><?= $sites_count ?></h4>
                                <p class="mb-0 font-13 text-success">
                                    <i class="bx bxs-up-arrow"></i> <?= $sites_last_week ?> from last week
                                </p>
                            </div>
                            <div class="widgets-icons bg-light-success text-success">
                                <i class="bx bx-building-house"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Plots -->
            <div class="col">
                <div class="card radius-10 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-1 text-secondary">Total Plots</p>
                                <h4 class="my-1"><?= $plots_count ?></h4>
                                <p class="mb-0 font-13 text-success">
                                    <i class="bx bxs-up-arrow"></i> <?= $plots_last_week ?> from last week
                                </p>
                            </div>
                            <div class="widgets-icons bg-light-info text-info">
                                <i class="bx bx-map-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Users / Admins -->
            <div class="col">
                <div class="card radius-10 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <?php if (!empty($is_superadmin)): ?>
                                    <p class="mb-1 text-secondary">Total Admins</p>
                                    <h4 class="my-1"><?= $admins_count ?? 0 ?></h4>
                                <?php else: ?>
                                    <p class="mb-1 text-secondary">Total Users</p>
                                    <h4 class="my-1"><?= $users_count ?></h4>
                                <?php endif; ?>
                                <p class="mb-0 font-13 text-danger">
                                    <i class="bx bxs-up-arrow"></i>
                                    <?php if (!empty($is_superadmin)): ?>
                                        <?= $admins_last_week ?? 0 ?>
                                    <?php else: ?>
                                        <?= $users_last_week ?>
                                    <?php endif; ?>
                                    from last week
                                </p>
                            </div>
                            <div class="widgets-icons bg-light-danger text-danger">
                                <i class="bx bx-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Inquiry -->
            <?php if (empty($is_superadmin)): ?>
                <div class="col">
                    <div class="card radius-10 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="mb-1 text-secondary">Total Inquiry</p>
                                    <h4 class="my-1"><?= $Inquiry_count ?></h4>
                                    <p class="mb-0 font-13 text-warning">
                                        <i class="bx bxs-down-arrow"></i> <?= $inquiry_last_week ?> from last week
                                    </p>
                                </div>
                                <div class="widgets-icons bg-light-warning text-warning">
                                    <i class="bx bx-message-dots"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
        <!-- END DASHBOARD CARDS -->

        <?php if (!empty($is_superadmin)): ?>
        <?php endif; ?>


        <!-- ===========================
             CARD DATA SECTION (LEFT + DUPLICATE RIGHT)
        ============================ -->
        <div class="row mt-4">
            
            <!-- LEFT SECTION -->
            <div class="col-md-6">
                <div class="card border-0 rounded-4 shadow-none bg-transparent">
    <div class="card-body p-0">
        <div class="card rounded-4">
            <div class="card-body">

                <div class="d-flex align-items-start justify-content-between mb-3">
                    <h6 class="mb-0">Attendance Data</h6>

                   
                </div>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="widgets-icons bg-light-primary text-primary rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bx bx-credit-card-alt"></i>
                    </div>
                    <div>
                        <h3 class="mb-0"><?= $attendance_total?></h3>
                        <p class="mb-0 text-secondary">Attandance Data</p>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-lg-2 g-3">
                    <div class="col">
                        <div class="border rounded-4 p-3">
                            <div class="fs-3 text-success"><i class="bx bx-credit-card"></i></div>
                            <h5 class="my-1"><?= $attendance_pending?></h5>
                            <p class="mb-0">Pending</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-4 p-3">
                            <div class="fs-3 text-primary"><i class="bx bx-shower"></i></div>
                            <h5 class="my-1"><?= $attendance_approved?></h5>
                            <p class="mb-0">Approved</p>
                        </div>
                    </div>
                    <!-- <div class="col">
                        <div class="border rounded-4 p-3">
                            <div class="fs-3 text-warning"><i class="bx bx-pie-chart"></i></div>
                            <h5 class="my-1">$5784</h5>
                            <p class="mb-0">Rejected</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-4 p-3">
                            <div class="fs-3 text-danger"><i class="bx bx-credit-card-alt"></i></div>
                            <h5 class="my-1">$3652</h5>
                            <p class="mb-0">Absent</p>
                        </div>
                    </div> -->
                </div>

            </div>
        </div>
    </div>
</div>

            </div>

            <!-- RIGHT SECTION (DUPLICATE) -->
            <div class="col-md-6">
                <div class="card border-0 rounded-4 shadow-none bg-transparent">
    <div class="card-body p-0">
        <div class="card rounded-4">
            <div class="card-body">

                <div class="d-flex align-items-start justify-content-between mb-3">
                    <h6 class="mb-0">Expenses Data</h6>
                 </div>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="widgets-icons bg-light-primary text-primary rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bx bx-credit-card-alt"></i>
                    </div>
                    <div>
                        <h3 class="mb-0">₹<?= $total_expense ?></h3>
<p class="mb-0 text-secondary">Total Expense (This Month)</p>

                    </div>
                </div>

                <div class="row row-cols-1 row-cols-lg-2 g-3">
                    <div class="col">
                        <div class="border rounded-4 p-3">
                            <div class="fs-3 text-success"><i class="bx bx-credit-card"></i></div>
                            <h5 class="my-1">₹<?= $approved_expense ?></h5>
<p class="mb-0">Approved Expense</p>

                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-4 p-3">
                            <div class="fs-3 text-primary"><i class="bx bx-shower"></i></div>
                            <h5 class="my-1">₹<?= $pending_expense ?></h5>
<p class="mb-0">Pending Expense</p>

                        </div>
                    </div>

                    <!-- <div class="col">
                        <div class="border rounded-4 p-3">
                            <div class="fs-3 text-warning"><i class="bx bx-pie-chart"></i></div>
                            <h5 class="my-1">$5784</h5>
                            <p class="mb-0">Credit Balance</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-4 p-3">
                            <div class="fs-3 text-danger"><i class="bx bx-credit-card-alt"></i></div>
                            <h5 class="my-1">$3652</h5>
                            <p class="mb-0">Debit Money</p>
                        </div>
                    </div> -->
                </div>

            </div>
        </div>
    </div>
</div>

            </div>

        </div>

    </div><!-- end page-content -->
</div>
<!--end page wrapper -->
