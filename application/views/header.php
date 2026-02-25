<!doctype html>

<html lang="en" data-bs-theme="light">

<head>

	<!-- Required meta tags -->

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--favicon-->

	<link rel="icon" href="<?= base_url('assets/images/favicon-32x32.png') ?>" type="image/png">



	<!--plugins-->

	<link href="<?= base_url('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') ?>" rel="stylesheet">

	<link href="<?= base_url('assets/plugins/simplebar/css/simplebar.css') ?>" rel="stylesheet">

	<link href="<?= base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet">

	<link href="<?= base_url('assets/plugins/metismenu/css/metisMenu.min.css') ?>" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

	<!-- loader-->

	<link href="<?= base_url('assets/css/pace.min.css') ?>" rel="stylesheet" />

	<script src="<?= base_url('assets/js/pace.min.js') ?>"></script>



	<!-- Bootstrap CSS -->

	<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


	<link href="<?= base_url('assets/css/bootstrap-extended.css') ?>" rel="stylesheet">



	<!-- Google Fonts (CDN) -->

	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">



	<!-- App Styles -->

	<link href="<?= base_url('assets/sass/app.css') ?>" rel="stylesheet">

	<link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">

	<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">



	<!-- Theme Style CSS -->

	<link rel="stylesheet" href="<?= base_url('assets/sass/dark-theme.css') ?>">

	<link rel="stylesheet" href="<?= base_url('assets/sass/semi-dark.css') ?>">

	<link rel="stylesheet" href="<?= base_url('assets/sass/bordered-theme.css') ?>">





	<title> <?php
	if (isset($this->session->userdata('admin')['business_name'])) {
		echo $this->session->userdata('admin')['business_name'] . ' | Dashboard';
	} else {
		echo 'Welcome | Dashboard';
	}
	?></title>

</head>



<body>

	<!--wrapper-->

	<div class="wrapper">

		<!--sidebar wrapper -->

		<div class="sidebar-wrapper" data-simplebar="true">

			<div class="sidebar-header">

				<div>

				</div>

				<div>

					<h4 class="logo-text fw-bold"> <?php
					if (isset($this->session->userdata('admin')['business_name'])) {
						echo $this->session->userdata('admin')['business_name'];
					} else {
						echo 'Welcome | Dashboard';
					}
					?></h4>

				</div>

				<div class="mobile-toggle-icon ms-auto"><i class='bx bx-x'></i>

				</div>

			</div>

			<!--navigation-->

			<?php $role = $this->session->userdata('admin')['role'] ?? 'admin'; ?>
			<ul class="metismenu" id="menu">

				<?php if ($role === 'superadmin'): ?>
					<li>
						<a href="<?= base_url('dashboard'); ?>" class="">
							<div class="parent-icon"><i class='bx bx-home-alt'></i></div>
							<div class="menu-title">Dashboard</div>
						</a>
					</li>
					<li>
						<a href="<?= base_url('superadmin/admins'); ?>" class="">
							<div class="parent-icon"><i class='bx bx-user'></i></div>
							<div class="menu-title">Admins</div>
						</a>
					</li>
					<li>
						<a href="<?= base_url('superadmin/sites'); ?>" class="">
							<div class="parent-icon"><i class='bx bx-globe'></i></div>
							<div class="menu-title">Sites</div>
						</a>
					</li>
				<?php else: ?>
					<!-- Dashboard -->
<li>
    <a href="<?= base_url('dashboard'); ?>" class="">
        <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
        <div class="menu-title">Dashboard</div>
    </a>
</li>

<!-- Sites -->
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-buildings'></i></div>
        <div class="menu-title">Sites</div>
    </a>
    <ul>
        <li>
            <a href="<?= base_url('site'); ?>">
                <i class='bx bx-list-ul'></i>All Sites
            </a>
        </li>

        <li>
            <a href="<?= base_url('add_site'); ?>">
                <i class='bx bx-building-house'></i>Add Site
            </a>
        </li>

        <li>
            <a href="<?= base_url('add_plot'); ?>">
                <i class='bx bx-map'></i>Add Plots
            </a>
        </li>
    </ul>
</li>

<!-- Expenses -->
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-wallet'></i></div>
        <div class="menu-title">Expenses</div>
    </a>
    <ul>
        <li>
            <a href="<?= base_url('expenses'); ?>">
                <i class='bx bx-receipt'></i>All Expenses
            </a>
        </li>

        <li>
            <a href="<?= base_url('add_expenses'); ?>">
                <i class='bx bx-plus-medical'></i>Add Expenses
            </a>
        </li>
    </ul>
</li>

<!-- Users -->
<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-user-circle'></i></div>
        <div class="menu-title">User</div>
    </a>
    <ul>
        <li>
            <a href="<?= base_url('users'); ?>">
                <i class='bx bx-group'></i>All Users
            </a>
        </li>

        <li>
            <a href="<?= base_url('add_user'); ?>">
                <i class='bx bx-user-plus'></i>Add New
            </a>
        </li>

        <li>
            <a href="<?= base_url('add_upad'); ?>">
                <i class='bx bx-id-card'></i>Add Upad
            </a>
        </li>
    </ul>
</li>

<!-- Inquiry -->
<li>
    <a href="<?= base_url('inquiry'); ?>" class="">
        <div class="parent-icon">
            <i class='bx bx-chat'></i>
        </div>
        <div class="menu-title">Inquiry</div>
    </a>
</li>

<!-- Attendance -->
<li>
    <a href="<?= base_url('attedance'); ?>" class="">
        <div class="parent-icon">
            <i class='bx bx-calendar-check'></i>
        </div>
        <div class="menu-title">Attedance</div>
    </a>
</li>

				<?php endif; ?>


			</ul>



			<!--end navigation-->

		</div>

		<!--end sidebar wrapper -->

		<!--start header -->

		<header>
			<header>
				<div class="topbar">
					<nav class="navbar navbar-expand gap-2 align-items-center">
						<div class="mobile-toggle-menu d-flex"><i class="bx bx-menu"></i>
						</div>



						<div class="top-menu ms-auto">
							<ul class="navbar-nav align-items-center gap-1">
								<li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal"
									data-bs-target="#SearchModal">
									<a class="nav-link" href="avascript:;"><i class="bx bx-search"></i>
									</a>
								</li>
								<li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">


								</li>
								<li class="nav-item dark-mode d-none d-sm-flex">
									<a class="nav-link dark-mode-icon" href="javascript:;"><i class="bx bx-moon"></i>
									</a>
								</li>

								<li class="nav-item dropdown dropdown-app">
									<div class="dropdown-menu dropdown-menu-end p-0">
										<div class="app-container p-2 my-2 ps">
											<div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/slack.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Slack</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/behance.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Behance</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/google-drive.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Dribble</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/outlook.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Outlook</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/github.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">GitHub</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/stack-overflow.png"
																	width="30" alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Stack</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/figma.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Stack</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/twitter.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Twitter</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/google-calendar.png"
																	width="30" alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Calendar</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/spotify.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Spotify</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/google-photos.png"
																	width="30" alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Photos</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/pinterest.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Photos</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/linkedin.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">linkedin</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/dribble.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Dribble</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/youtube.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">YouTube</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/google.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">News</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/envato.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Envato</p>
															</div>
														</div>
													</a>
												</div>
												<div class="col">
													<a href="javascript:;">
														<div class="app-box text-center">
															<div class="app-icon">
																<img src="assets/images/app/safari.png" width="30"
																	alt="">
															</div>
															<div class="app-name">
																<p class="mb-0 mt-1">Safari</p>
															</div>
														</div>
													</a>
												</div>

											</div><!--end row-->

											<div class="ps__rail-x" style="left: 0px; bottom: 0px;">
												<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
												</div>
											</div>
											<div class="ps__rail-y" style="top: 0px; right: 0px;">
												<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;">
												</div>
											</div>
										</div>
									</div>
								</li>

								<li class="nav-item dropdown dropdown-large">

									<div class="dropdown-menu dropdown-menu-end">
										<a href="javascript:;">
											<div class="msg-header">
												<p class="msg-header-title">Notifications</p>
												<p class="msg-header-badge">8 New</p>
											</div>
										</a>
										<div class="header-notifications-list ps">
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="assets/images/avatars/avatar-1.png" class="msg-avatar"
															alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Daisy Anderson<span
																class="msg-time float-end">5 sec
																ago</span></h6>
														<p class="msg-info">The standard chunk of lorem</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-danger text-danger">dc
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">New Orders <span
																class="msg-time float-end">2 min
																ago</span></h6>
														<p class="msg-info">You have recived new orders</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="assets/images/avatars/avatar-2.png" class="msg-avatar"
															alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Althea Cabardo <span
																class="msg-time float-end">14
																sec ago</span></h6>
														<p class="msg-info">Many desktop publishing packages</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-success text-success">
														<img src="assets/images/app/outlook.png" width="25"
															alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Account Created<span
																class="msg-time float-end">28 min
																ago</span></h6>
														<p class="msg-info">Successfully created new email</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-info text-info">Ss
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">New Product Approved <span
																class="msg-time float-end">2 hrs ago</span></h6>
														<p class="msg-info">Your new product has approved</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="assets/images/avatars/avatar-4.png" class="msg-avatar"
															alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Katherine Pechon <span
																class="msg-time float-end">15
																min ago</span></h6>
														<p class="msg-info">Making this the first true generator</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-success text-success"><i
															class="bx bx-check-square"></i>
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Your item is shipped <span
																class="msg-time float-end">5 hrs
																ago</span></h6>
														<p class="msg-info">Successfully shipped your item</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="notify bg-light-primary">
														<img src="assets/images/app/github.png" width="25"
															alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">New 24 authors<span
																class="msg-time float-end">1 day
																ago</span></h6>
														<p class="msg-info">24 new authors joined last week</p>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center">
													<div class="user-online">
														<img src="assets/images/avatars/avatar-8.png" class="msg-avatar"
															alt="user avatar">
													</div>
													<div class="flex-grow-1">
														<h6 class="msg-name">Peter Costanzo <span
																class="msg-time float-end">6 hrs
																ago</span></h6>
														<p class="msg-info">It was popularised in the 1960s</p>
													</div>
												</div>
											</a>
											<div class="ps__rail-x" style="left: 0px; bottom: 0px;">
												<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
												</div>
											</div>
											<div class="ps__rail-y" style="top: 0px; right: 0px;">
												<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;">
												</div>
											</div>
										</div>
										<a href="javascript:;">
											<div class="text-center msg-footer">
												<button class="btn btn-primary w-100">View All Notifications</button>
											</div>
										</a>
									</div>
								</li>
								<li class="nav-item dropdown dropdown-large">

									<div class="dropdown-menu dropdown-menu-end">
										<a href="javascript:;">
											<div class="msg-header">
												<p class="msg-header-title">My Cart</p>
												<p class="msg-header-badge">10 Items</p>
											</div>
										</a>
										<div class="header-message-list ps">
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center gap-3">
													<div class="position-relative">
														<div class="cart-product rounded-circle bg-light">
															<img src="assets/images/products/11.png" class=""
																alt="product image">
														</div>
													</div>
													<div class="flex-grow-1">
														<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
														<p class="cart-product-price mb-0">1 X $29.00</p>
													</div>
													<div class="">
														<p class="cart-price mb-0">$250</p>
													</div>
													<div class="cart-product-cancel"><i class="bx bx-x"></i>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center gap-3">
													<div class="position-relative">
														<div class="cart-product rounded-circle bg-light">
															<img src="assets/images/products/02.png" class=""
																alt="product image">
														</div>
													</div>
													<div class="flex-grow-1">
														<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
														<p class="cart-product-price mb-0">1 X $29.00</p>
													</div>
													<div class="">
														<p class="cart-price mb-0">$250</p>
													</div>
													<div class="cart-product-cancel"><i class="bx bx-x"></i>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center gap-3">
													<div class="position-relative">
														<div class="cart-product rounded-circle bg-light">
															<img src="assets/images/products/03.png" class=""
																alt="product image">
														</div>
													</div>
													<div class="flex-grow-1">
														<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
														<p class="cart-product-price mb-0">1 X $29.00</p>
													</div>
													<div class="">
														<p class="cart-price mb-0">$250</p>
													</div>
													<div class="cart-product-cancel"><i class="bx bx-x"></i>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center gap-3">
													<div class="position-relative">
														<div class="cart-product rounded-circle bg-light">
															<img src="assets/images/products/04.png" class=""
																alt="product image">
														</div>
													</div>
													<div class="flex-grow-1">
														<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
														<p class="cart-product-price mb-0">1 X $29.00</p>
													</div>
													<div class="">
														<p class="cart-price mb-0">$250</p>
													</div>
													<div class="cart-product-cancel"><i class="bx bx-x"></i>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center gap-3">
													<div class="position-relative">
														<div class="cart-product rounded-circle bg-light">
															<img src="assets/images/products/05.png" class=""
																alt="product image">
														</div>
													</div>
													<div class="flex-grow-1">
														<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
														<p class="cart-product-price mb-0">1 X $29.00</p>
													</div>
													<div class="">
														<p class="cart-price mb-0">$250</p>
													</div>
													<div class="cart-product-cancel"><i class="bx bx-x"></i>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center gap-3">
													<div class="position-relative">
														<div class="cart-product rounded-circle bg-light">
															<img src="assets/images/products/06.png" class=""
																alt="product image">
														</div>
													</div>
													<div class="flex-grow-1">
														<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
														<p class="cart-product-price mb-0">1 X $29.00</p>
													</div>
													<div class="">
														<p class="cart-price mb-0">$250</p>
													</div>
													<div class="cart-product-cancel"><i class="bx bx-x"></i>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center gap-3">
													<div class="position-relative">
														<div class="cart-product rounded-circle bg-light">
															<img src="assets/images/products/07.png" class=""
																alt="product image">
														</div>
													</div>
													<div class="flex-grow-1">
														<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
														<p class="cart-product-price mb-0">1 X $29.00</p>
													</div>
													<div class="">
														<p class="cart-price mb-0">$250</p>
													</div>
													<div class="cart-product-cancel"><i class="bx bx-x"></i>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center gap-3">
													<div class="position-relative">
														<div class="cart-product rounded-circle bg-light">
															<img src="assets/images/products/08.png" class=""
																alt="product image">
														</div>
													</div>
													<div class="flex-grow-1">
														<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
														<p class="cart-product-price mb-0">1 X $29.00</p>
													</div>
													<div class="">
														<p class="cart-price mb-0">$250</p>
													</div>
													<div class="cart-product-cancel"><i class="bx bx-x"></i>
													</div>
												</div>
											</a>
											<a class="dropdown-item" href="javascript:;">
												<div class="d-flex align-items-center gap-3">
													<div class="position-relative">
														<div class="cart-product rounded-circle bg-light">
															<img src="assets/images/products/09.png" class=""
																alt="product image">
														</div>
													</div>
													<div class="flex-grow-1">
														<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
														<p class="cart-product-price mb-0">1 X $29.00</p>
													</div>
													<div class="">
														<p class="cart-price mb-0">$250</p>
													</div>
													<div class="cart-product-cancel"><i class="bx bx-x"></i>
													</div>
												</div>
											</a>
											<div class="ps__rail-x" style="left: 0px; bottom: 0px;">
												<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
												</div>
											</div>
											<div class="ps__rail-y" style="top: 0px; right: 0px;">
												<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;">
												</div>
											</div>
										</div>
										<a href="javascript:;">
											<div class="text-center msg-footer">
												<div class="d-flex align-items-center justify-content-between mb-3">
													<h5 class="mb-0">Total</h5>
													<h5 class="mb-0 ms-auto">$489.00</h5>
												</div>
												<button class="btn btn-primary w-100">Checkout</button>
											</div>
										</a>
									</div>
								</li>
							</ul>
						</div>
						<div class="user-box dropdown px-3">
							<?php
							$admin = $this->session->userdata('admin');
							$userName = isset($admin['user_name']) ? $admin['user_name'] : 'Guest User';
							$businessName = isset($admin['business_name']) ? $admin['business_name'] : 'No Business';
							$profileImage = isset($admin['profile_image']) && !empty($admin['profile_image'])
								? base_url($admin['profile_image'])
								: base_url('assets/images/54322.jpg'); // dummy image fallback
							?>
							<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
								href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<img src="<?= $profileImage ?>" class="user-img" alt="user avatar"
									onerror="this.src='<?= base_url('assets/images/avatars/avatar-2.png') ?>'">
								<div class="user-info">
									<p class="user-name mb-0"><?= htmlspecialchars($userName) ?></p>
									<p class="designattion mb-0"><?= htmlspecialchars($businessName) ?></p>
								</div>
							</a>
							<ul class="dropdown-menu dropdown-menu-end">
								<li>
									<a class="dropdown-item d-flex align-items-center"
										href="<?= base_url('profile'); ?>">
										<i class="bx bx-user fs-5"></i><span>Profile</span>
									</a>
								</li>
								<li>
									<div class="dropdown-divider mb-0"></div>
								</li>
								<li>
									<a class="dropdown-item d-flex align-items-center"
										href="<?= base_url('logout'); ?>">
										<i class="bx bx-log-out-circle"></i><span>Logout</span>
									</a>
								</li>
							</ul>
						</div>

					</nav>
				</div>
			</header>

		</header>

		<!--end header -->

		<!--start page wrapper -->