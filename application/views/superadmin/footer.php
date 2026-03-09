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

</body>

</html>
