</main>
<!-- ==================== END MAIN CONTENT ==================== -->


<!-- ===== CORE LIBRARIES (MUST BE FIRST) ===== -->
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

<!-- SweetAlert + Select2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
	const site_url = "<?= base_url() ?>";
</script>

<!-- ✅ YOUR APP SCRIPTS (ONLY ONCE) -->
<script src="<?= base_url('assets/js/custom.js?v=' . filemtime(FCPATH . 'assets/js/custom.js')) ?>"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>

<!-- PLUGINS -->
<script src="<?= base_url('assets/plugins/simplebar/js/simplebar.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/metismenu/js/metisMenu.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') ?>"></script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		document.querySelectorAll('.top-menu .dropdown, .top-menu .dropdown-menu').forEach(function(el) {
			el.classList.remove('show');
		});
		document.body.classList.remove('sidebar-preload');
	});
</script>

<?php
$routerClass = $this->router->class ?? '';
$routerMethod = $this->router->method ?? '';
$isDashboardPage = ($routerClass === 'dashboard' && $routerMethod === 'index');
?>
<?php if ($isDashboardPage): ?>
	<!-- DASHBOARD (load only on dashboard to reduce page-switch time) -->
	<script src="<?= base_url('assets/js/index.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/peity/jquery.peity.min.js') ?>"></script>
	<script>
		$(".data-attributes span").peity("donut");
	</script>
<?php endif; ?>

<!-- ==================== SCRIPTS ==================== -->
<script>
	// Init Lucide icons
	if (typeof lucide !== 'undefined' && lucide.createIcons) {
		lucide.createIcons();
	}

	// ── Theme Toggle ──────────────────────────────────────────
	const themeToggle = document.getElementById('themeToggle');
	const themeIcon = document.getElementById('themeIcon');
	const htmlEl = document.documentElement;

	function applyTheme(theme) {
		if (theme === 'dark') {
			htmlEl.classList.add('dark-theme');
			if (themeIcon) themeIcon.setAttribute('data-lucide', 'sun');
		} else {
			htmlEl.classList.remove('dark-theme');
			if (themeIcon) themeIcon.setAttribute('data-lucide', 'moon');
		}
		if (typeof lucide !== 'undefined' && lucide.createIcons) {
			lucide.createIcons();
		}
	}

	// Load saved theme
	try {
		const saved = localStorage.getItem('app_theme') || 'light';
		applyTheme(saved);
	} catch (e) {}

	if (themeToggle) {
		themeToggle.addEventListener('click', function() {
			const isDark = htmlEl.classList.contains('dark-theme');
			const next = isDark ? 'light' : 'dark';
			applyTheme(next);
			try {
				localStorage.setItem('app_theme', next);
			} catch (e) {}
		});
	}

	// ── Sidebar Toggle (Desktop) ──────────────────────────────
	const sidebar = document.getElementById('sidebar');
	const sidebarToggle = document.getElementById('sidebarToggle');
	const toggleIcon = sidebarToggle ? sidebarToggle.querySelector('i') : null;

	function setSidebarState(collapsed) {
		if (sidebar) {
			if (collapsed) {
				sidebar.classList.add('collapsed');
				if (toggleIcon) toggleIcon.setAttribute('data-lucide', 'panel-left-open');
			} else {
				sidebar.classList.remove('collapsed');
				if (toggleIcon) toggleIcon.setAttribute('data-lucide', 'panel-left-close');
			}
		}
		if (typeof lucide !== 'undefined' && lucide.createIcons) {
			lucide.createIcons();
		}
		try {
			localStorage.setItem('sidebar_collapsed', collapsed ? '1' : '0');
		} catch (e) {}
	}

	// Restore sidebar state
	try {
		if (localStorage.getItem('sidebar_collapsed') === '1') {
			setSidebarState(true);
		}
	} catch (e) {}

	if (sidebarToggle) {
		sidebarToggle.addEventListener('click', function() {
			if (sidebar) {
				setSidebarState(!sidebar.classList.contains('collapsed'));
			}
		});
	}

	// ── Mobile Sidebar ────────────────────────────────────────
	const mobileToggle = document.getElementById('mobileMenuToggle');
	const sidebarOverlay = document.getElementById('sidebarOverlay');

	if (mobileToggle) {
		mobileToggle.addEventListener('click', function() {
			if (sidebar) {
				sidebar.classList.toggle('mobile-open');
				if (sidebarOverlay) {
					sidebarOverlay.style.display = sidebar.classList.contains('mobile-open') ? 'block' : 'none';
				}
			}
		});
	}

	if (sidebarOverlay) {
		sidebarOverlay.addEventListener('click', function() {
			if (sidebar) {
				sidebar.classList.remove('mobile-open');
			}
			sidebarOverlay.style.display = 'none';
		});
	}

	// ── Submenu Toggles ───────────────────────────────────────
	document.querySelectorAll('.nav-item.has-submenu > .nav-link').forEach(function(link) {
		link.addEventListener('click', function() {
			const item = this.closest('.nav-item');
			if (item) {
				item.classList.toggle('open');
			}
		});
	});

	// ── User Dropdown ─────────────────────────────────────────
	const userMenuBtn = document.getElementById('userMenuBtn');
	const userDropdown = document.getElementById('userDropdown');
	const notifDropdown = document.getElementById('notificationDropdown');

	if (userMenuBtn && userDropdown) {
		userMenuBtn.addEventListener('click', function(e) {
			e.stopPropagation();
			userDropdown.classList.toggle('active');
			// close notification dropdown
			if (notifDropdown) notifDropdown.classList.remove('active');
		});
	}

	// ── Notification Dropdown ─────────────────────────────────
	const notifBtn = document.getElementById('notificationBtn');

	if (notifBtn && notifDropdown) {
		notifBtn.addEventListener('click', function(e) {
			e.stopPropagation();
			notifDropdown.classList.toggle('active');
			// close user dropdown
			if (userDropdown) userDropdown.classList.remove('active');
		});
	}

	// Close dropdowns on outside click
	document.addEventListener('click', function() {
		if (userDropdown) userDropdown.classList.remove('active');
		if (notifDropdown) notifDropdown.classList.remove('active');
	});

	// Prevent closing when clicking inside dropdowns
	[userDropdown, notifDropdown].forEach(function(el) {
		if (el) {
			el.addEventListener('click', function(e) {
				e.stopPropagation();
			});
		}
	});
</script>

</body>

</html>