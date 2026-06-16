<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script>
		(function() {
			try {
				var savedTheme = localStorage.getItem('app_theme');
				if (savedTheme === 'dark') {
					document.documentElement.classList.add('dark-theme');
				}
			} catch (e) {}
		})();
	</script>

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Lucide Icons -->
	<script src="https://unpkg.com/lucide@latest"></script>

	<!-- Favicon -->
	<link rel="icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/ico">

	<!-- Bootstrap CSS -->
	<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/bootstrap-extended.css') ?>" rel="stylesheet">

	<!-- Boxicons CSS -->
	<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

	<!-- Select2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<title>
		<?php
		if (isset($this->session->userdata('admin')['business_name'])) {
			echo htmlspecialchars($this->session->userdata('admin')['business_name']) . ' | Dashboard';
		} else {
			echo 'Welcome | Dashboard';
		}
		?>
	</title>

	<style>
		/* ==========================================
           CSS VARIABLES & THEME
        ========================================== */
		:root {
			--primary: #6366F1;
			--primary-dark: #4f46e5;
			--primary-light: #818cf8;
			--secondary: #8B5CF6;
			--success: #10B981;
			--warning: #F59E0B;
			--danger: #EF4444;

			--bg-primary: #ffffff;
			--bg-secondary: #f8fafc;
			--bg-tertiary: #f1f5f9;
			--text-primary: #0f172a;
			--text-secondary: #64748b;
			--text-tertiary: #94a3b8;
			--border-color: #e2e8f0;
			--shadow: rgba(0, 0, 0, 0.1);
			--shadow-lg: rgba(0, 0, 0, 0.15);

			--sidebar-bg: #ffffff;
			--sidebar-width: 280px;
			--sidebar-collapsed-width: 80px;

			--spacing-xs: 0.5rem;
			--spacing-sm: 0.75rem;
			--spacing-md: 1rem;
			--spacing-lg: 1.5rem;
			--spacing-xl: 2rem;
			--spacing-2xl: 3rem;

			--radius-sm: 8px;
			--radius-md: 12px;
			--radius-lg: 16px;
			--radius-xl: 20px;

			--transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			--transition-fast: all 0.15s ease;
		}

		html.dark-theme {
			--bg-primary: #0f172a;
			--bg-secondary: #1e293b;
			--bg-tertiary: #334155;
			--text-primary: #f1f5f9;
			--text-secondary: #cbd5e1;
			--text-tertiary: #94a3b8;
			--border-color: rgba(255, 255, 255, 0.08);
			--shadow: rgba(0, 0, 0, 0.3);
			--shadow-lg: rgba(0, 0, 0, 0.5);
			--sidebar-bg: #1e293b;
		}

		/* ==========================================
           RESET & BASE
        ========================================== */
		*,
		*::before,
		*::after {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Poppins', sans-serif;
			background: var(--bg-secondary);
			color: var(--text-primary);
			font-size: 14px;
			line-height: 1.6;
			overflow-x: hidden;
			transition: var(--transition);
		}

		::-webkit-scrollbar {
			width: 6px;
			height: 6px;
		}

		::-webkit-scrollbar-track {
			background: var(--bg-secondary);
		}

		::-webkit-scrollbar-thumb {
			background: var(--border-color);
			border-radius: 4px;
		}

		::-webkit-scrollbar-thumb:hover {
			background: var(--text-tertiary);
		}

		/* ==========================================
           SIDEBAR
        ========================================== */
		.sidebar {
			position: fixed;
			left: 0;
			top: 0;
			height: 100vh;
			width: var(--sidebar-width);
			background: var(--sidebar-bg);
			border-right: 1px solid var(--border-color);
			display: flex;
			flex-direction: column;
			transition: var(--transition);
			z-index: 1000;
			overflow: hidden;
		}

		.sidebar.collapsed {
			width: var(--sidebar-collapsed-width);
		}

		.sidebar-header {
			padding: var(--spacing-lg);
			display: flex;
			align-items: center;
			justify-content: space-between;
			border-bottom: 1px solid var(--border-color);
			flex-shrink: 0;
		}

		.logo {
			display: flex;
			align-items: center;
			gap: var(--spacing-sm);
			font-size: 1.1rem;
			font-weight: 700;
			color: var(--text-primary);
			text-decoration: none;
			white-space: nowrap;
			overflow: hidden;
		}

		.sidebar-logo-img {
			height: 44px;
			width: auto;
			max-width: 180px;
			object-fit: contain;
			transition: var(--transition-fast);
		}

		.sidebar.collapsed .sidebar-logo-img {
			height: 36px;
			max-width: 44px;
			object-fit: contain;
		}

		.sidebar-toggle {
			background: transparent;
			border: none;
			color: var(--text-secondary);
			cursor: pointer;
			padding: var(--spacing-xs);
			border-radius: var(--radius-sm);
			display: flex;
			align-items: center;
			justify-content: center;
			transition: var(--transition-fast);
			flex-shrink: 0;
		}

		.sidebar-toggle:hover {
			background: var(--bg-secondary);
			color: var(--text-primary);
		}

		.sidebar-toggle svg {
			width: 20px;
			height: 20px;
		}

		/* Nav */
		.sidebar-nav {
			flex: 1;
			padding: var(--spacing-md);
			overflow-y: auto;
			overflow-x: hidden;
		}

		.nav-item {
			margin-bottom: 2px;
		}

		.nav-link {
			display: flex;
			align-items: center;
			gap: var(--spacing-sm);
			padding: 10px var(--spacing-md);
			border-radius: var(--radius-md);
			color: var(--text-secondary);
			cursor: pointer;
			transition: var(--transition-fast);
			font-weight: 500;
			text-decoration: none;
			white-space: nowrap;
			overflow: hidden;
		}

		.nav-link:hover {
			background: var(--bg-secondary);
			color: var(--text-primary);
		}

		.nav-item.active>.nav-link {
			background: linear-gradient(135deg, rgba(99, 102, 241, 0.12), rgba(139, 92, 246, 0.12));
			color: var(--primary);
		}

		.nav-link svg {
			width: 20px;
			height: 20px;
			flex-shrink: 0;
		}

		.nav-link .nav-label {
			flex: 1;
		}

		.submenu-chevron {
			margin-left: auto;
			flex-shrink: 0;
			transition: transform 0.3s ease;
		}

		.submenu-chevron svg {
			width: 16px;
			height: 16px;
		}

		.nav-item.has-submenu.open .submenu-chevron {
			transform: rotate(180deg);
		}

		.submenu {
			max-height: 0;
			overflow: hidden;
			transition: max-height 0.3s ease;
			padding-left: var(--spacing-lg);
		}

		.nav-item.has-submenu.open .submenu {
			max-height: 500px;
		}

		.submenu-item {
			display: flex;
			align-items: center;
			gap: var(--spacing-sm);
			padding: 8px var(--spacing-md);
			border-radius: var(--radius-md);
			color: var(--text-secondary);
			cursor: pointer;
			transition: var(--transition-fast);
			margin-top: 2px;
			text-decoration: none;
			white-space: nowrap;
			font-size: 0.875rem;
		}

		.submenu-item:hover {
			background: var(--bg-secondary);
			color: var(--text-primary);
		}

		.submenu-item.active {
			background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
			color: var(--primary);
		}

		.submenu-item svg {
			width: 17px;
			height: 17px;
			flex-shrink: 0;
		}

		.sidebar.collapsed .nav-label,
		.sidebar.collapsed .submenu-chevron,
		.sidebar.collapsed .submenu {
			display: none;
		}

		/* Sidebar Footer */
		.sidebar-footer {
			padding: var(--spacing-md);
			border-top: 1px solid var(--border-color);
			flex-shrink: 0;
		}

		.sidebar-user {
			display: flex;
			align-items: center;
			gap: var(--spacing-sm);
			overflow: hidden;
		}

		.user-avatar {
			width: 38px;
			height: 38px;
			border-radius: 50%;
			overflow: hidden;
			flex-shrink: 0;
			border: 2px solid var(--border-color);
		}

		.user-avatar img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.sidebar-user-info {
			flex: 1;
			overflow: hidden;
		}

		.sidebar-user-name {
			font-weight: 600;
			font-size: 0.875rem;
			color: var(--text-primary);
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}

		.sidebar-user-role {
			font-size: 0.72rem;
			color: var(--text-secondary);
		}

		.sidebar.collapsed .sidebar-user-info {
			display: none;
		}

		/* ==========================================
           MAIN CONTENT
        ========================================== */
		.main-content {
			margin-left: var(--sidebar-width);
			min-height: 100vh;
			transition: var(--transition);
		}

		.sidebar.collapsed~.main-content {
			margin-left: var(--sidebar-collapsed-width);
		}

		/* ==========================================
           TOPBAR
        ========================================== */
		.topbar {
			position: sticky;
			top: 0;
			background: var(--bg-primary);
			border-bottom: 1px solid var(--border-color);
			padding: var(--spacing-md) var(--spacing-xl);
			display: flex;
			align-items: center;
			justify-content: space-between;
			z-index: 100;
			box-shadow: 0 1px 3px var(--shadow);
		}

		.topbar-left {
			display: flex;
			align-items: center;
			gap: var(--spacing-md);
			flex: 1;
		}

		.mobile-menu-toggle {
			display: none;
			background: transparent;
			border: none;
			color: var(--text-primary);
			cursor: pointer;
			padding: var(--spacing-xs);
			border-radius: var(--radius-sm);
		}

		.mobile-menu-toggle svg {
			width: 24px;
			height: 24px;
		}

		.search-box {
			position: relative;
			max-width: 380px;
			flex: 1;
		}

		.search-box svg {
			position: absolute;
			left: var(--spacing-md);
			top: 50%;
			transform: translateY(-50%);
			width: 17px;
			height: 17px;
			color: var(--text-tertiary);
			pointer-events: none;
		}

		.search-box input {
			width: 100%;
			padding: 9px var(--spacing-md) 9px 2.5rem;
			background: var(--bg-secondary);
			border: 1px solid var(--border-color);
			border-radius: var(--radius-lg);
			color: var(--text-primary);
			font-family: 'Poppins', sans-serif;
			font-size: 0.875rem;
			transition: var(--transition-fast);
		}

		.search-box input:focus {
			outline: none;
			border-color: var(--primary);
			box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
		}

		.search-box input::placeholder {
			color: var(--text-tertiary);
		}

		.topbar-right {
			display: flex;
			align-items: center;
			gap: var(--spacing-sm);
		}

		.icon-btn {
			position: relative;
			width: 40px;
			height: 40px;
			background: var(--bg-secondary);
			border: 1px solid var(--border-color);
			border-radius: var(--radius-md);
			color: var(--text-secondary);
			cursor: pointer;
			display: flex;
			align-items: center;
			justify-content: center;
			transition: var(--transition-fast);
		}

		.icon-btn:hover {
			background: var(--bg-tertiary);
			color: var(--text-primary);
			border-color: var(--text-tertiary);
		}

		.icon-btn svg {
			width: 20px;
			height: 20px;
		}

		.icon-btn .badge {
			position: absolute;
			top: -4px;
			right: -4px;
			background: var(--danger);
			color: white;
			font-size: 0.62rem;
			font-weight: 600;
			padding: 2px 5px;
			border-radius: 10px;
			line-height: 1;
		}

		/* User Menu */
		.user-menu {
			position: relative;
		}

		.user-menu-btn {
			display: flex;
			align-items: center;
			gap: var(--spacing-sm);
			padding: 6px var(--spacing-sm);
			background: var(--bg-secondary);
			border: 1px solid var(--border-color);
			border-radius: var(--radius-md);
			color: var(--text-primary);
			font-family: 'Poppins', sans-serif;
			font-size: 0.875rem;
			cursor: pointer;
			transition: var(--transition-fast);
		}

		.user-menu-btn:hover {
			background: var(--bg-tertiary);
			border-color: var(--text-tertiary);
		}

		.user-menu-btn img {
			width: 32px;
			height: 32px;
			border-radius: 50%;
			object-fit: cover;
		}

		.user-menu-btn svg {
			width: 16px;
			height: 16px;
		}

		.user-dropdown {
			position: absolute;
			top: calc(100% + 8px);
			right: 0;
			background: var(--bg-primary);
			border: 1px solid var(--border-color);
			border-radius: var(--radius-lg);
			box-shadow: 0 10px 40px var(--shadow-lg);
			min-width: 200px;
			opacity: 0;
			visibility: hidden;
			transform: translateY(-8px);
			transition: var(--transition-fast);
			z-index: 1001;
			overflow: hidden;
		}

		.user-dropdown.active {
			opacity: 1;
			visibility: visible;
			transform: translateY(0);
		}

		.user-dropdown a {
			display: flex;
			align-items: center;
			gap: var(--spacing-sm);
			padding: 10px var(--spacing-md);
			color: var(--text-secondary);
			text-decoration: none;
			transition: var(--transition-fast);
			font-size: 0.875rem;
		}

		.user-dropdown a:hover {
			background: var(--bg-secondary);
			color: var(--text-primary);
		}

		.user-dropdown a svg {
			width: 17px;
			height: 17px;
		}

		.user-dropdown hr {
			border: none;
			border-top: 1px solid var(--border-color);
			margin: 4px 0;
		}

		/* Notification Dropdown */
		.notification-dropdown {
			position: absolute;
			top: calc(100% + 8px);
			right: 0;
			width: 380px;
			background: var(--bg-primary);
			border: 1px solid var(--border-color);
			border-radius: var(--radius-lg);
			box-shadow: 0 10px 40px var(--shadow-lg);
			opacity: 0;
			visibility: hidden;
			transform: translateY(-8px);
			transition: var(--transition-fast);
			z-index: 1001;
			overflow: hidden;
		}

		.notification-dropdown.active {
			opacity: 1;
			visibility: visible;
			transform: translateY(0);
		}

		.notif-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: var(--spacing-md) var(--spacing-lg);
			border-bottom: 1px solid var(--border-color);
		}

		.notif-header h6 {
			font-size: 0.95rem;
			font-weight: 600;
			color: var(--text-primary);
		}

		.notif-badge {
			font-size: 0.72rem;
			font-weight: 600;
			background: rgba(99, 102, 241, 0.12);
			color: var(--primary);
			padding: 2px 10px;
			border-radius: 20px;
		}

		.notif-body {
			max-height: 320px;
			overflow-y: auto;
		}

		.notif-item {
			display: flex;
			align-items: flex-start;
			gap: var(--spacing-sm);
			padding: var(--spacing-sm) var(--spacing-md);
			border-bottom: 1px solid var(--border-color);
			transition: var(--transition-fast);
			cursor: pointer;
		}

		.notif-item:hover {
			background: var(--bg-secondary);
		}

		.notif-item:last-child {
			border-bottom: none;
		}

		.notif-icon {
			width: 38px;
			height: 38px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-shrink: 0;
			font-size: 0.8rem;
			font-weight: 600;
			overflow: hidden;
		}

		.notif-icon img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.notif-icon.info {
			background: rgba(99, 102, 241, 0.12);
			color: var(--primary);
		}

		.notif-icon.success {
			background: rgba(16, 185, 129, 0.12);
			color: var(--success);
		}

		.notif-icon.danger {
			background: rgba(239, 68, 68, 0.12);
			color: var(--danger);
		}

		.notif-content {
			flex: 1;
		}

		.notif-title {
			font-size: 0.82rem;
			font-weight: 600;
			color: var(--text-primary);
			margin-bottom: 2px;
		}

		.notif-text {
			font-size: 0.78rem;
			color: var(--text-secondary);
		}

		.notif-time {
			font-size: 0.7rem;
			color: var(--text-tertiary);
			white-space: nowrap;
		}

		.notif-footer {
			padding: var(--spacing-md);
			border-top: 1px solid var(--border-color);
			text-align: center;
		}

		.notif-footer a {
			color: var(--primary);
			text-decoration: none;
			font-size: 0.875rem;
			font-weight: 500;
		}

		.notif-footer a:hover {
			text-decoration: underline;
		}

		.notif-wrapper {
			position: relative;
		}

		/* Mobile overlay */
		.sidebar-overlay {
			display: none;
			position: fixed;
			inset: 0;
			background: rgba(0, 0, 0, 0.5);
			z-index: 999;
		}

		/* ==========================================
           PAGE CONTENT
        ========================================== */
		.page-content {
			padding: var(--spacing-xl);
		}

		.page-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-bottom: var(--spacing-xl);
			flex-wrap: wrap;
			gap: var(--spacing-md);
		}

		.page-title {
			font-size: 1.75rem;
			font-weight: 700;
			color: var(--text-primary);
			margin-bottom: 4px;
		}

		.page-subtitle {
			color: var(--text-secondary);
			font-size: 0.875rem;
		}

		/* ==========================================
           BUTTONS
        ========================================== */
		.btn {
			display: inline-flex;
			align-items: center;
			gap: var(--spacing-xs);
			padding: 9px var(--spacing-lg);
			border: none;
			border-radius: var(--radius-md);
			font-family: 'Poppins', sans-serif;
			font-size: 0.875rem;
			font-weight: 500;
			cursor: pointer;
			transition: var(--transition-fast);
			text-decoration: none;
			white-space: nowrap;
		}

		.btn svg {
			width: 17px;
			height: 17px;
		}

		.btn-primary {
			background: linear-gradient(135deg, var(--primary), var(--secondary));
			color: white;
		}

		.btn-primary:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
		}

		.btn-secondary {
			background: var(--bg-secondary);
			color: var(--text-primary);
			border: 1px solid var(--border-color);
		}

		.btn-secondary:hover {
			background: var(--bg-tertiary);
		}

		.btn-danger {
			background: var(--danger);
			color: white;
		}

		.btn-danger:hover {
			background: #dc2626;
			box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
		}

		.btn-success {
			background: var(--success);
			color: white;
		}

		.btn-success:hover {
			background: #059669;
			box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
		}

		.btn-sm {
			padding: 6px var(--spacing-md);
			font-size: 0.8rem;
		}

		/* ==========================================
           CARDS
        ========================================== */
		.card {
			background: var(--bg-primary);
			border: 1px solid var(--border-color);
			border-radius: var(--radius-lg);
			transition: var(--transition-fast);
		}

		.card:hover {
			box-shadow: 0 4px 20px var(--shadow);
		}

		.card-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: var(--spacing-lg);
			border-bottom: 1px solid var(--border-color);
		}

		.card-title {
			font-size: 1rem;
			font-weight: 600;
			color: var(--text-primary);
		}

		.card-subtitle {
			font-size: 0.78rem;
			color: var(--text-secondary);
			margin-top: 2px;
		}

		.card-body {
			padding: var(--spacing-lg);
		}

		/* ==========================================
           STAT CARDS
        ========================================== */
		.stats-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
			gap: var(--spacing-lg);
			margin-bottom: var(--spacing-xl);
		}

		.stat-card {
			background: var(--bg-primary);
			border: 1px solid var(--border-color);
			border-radius: var(--radius-lg);
			padding: var(--spacing-lg);
			display: flex;
			align-items: center;
			gap: var(--spacing-md);
			transition: var(--transition-fast);
		}

		.stat-card:hover {
			box-shadow: 0 4px 20px var(--shadow);
			transform: translateY(-2px);
		}

		.stat-icon {
			width: 56px;
			height: 56px;
			border-radius: var(--radius-md);
			display: flex;
			align-items: center;
			justify-content: center;
			color: white;
			flex-shrink: 0;
		}

		.stat-icon svg {
			width: 26px;
			height: 26px;
		}

		.stat-content {
			flex: 1;
		}

		.stat-label {
			font-size: 0.8rem;
			color: var(--text-secondary);
			font-weight: 500;
			margin-bottom: 4px;
		}

		.stat-value {
			font-size: 1.75rem;
			font-weight: 700;
			color: var(--text-primary);
			line-height: 1;
			margin-bottom: 4px;
		}

		.stat-change {
			display: inline-flex;
			align-items: center;
			gap: 4px;
			font-size: 0.78rem;
			font-weight: 500;
		}

		.stat-change.positive {
			color: var(--success);
		}

		.stat-change.negative {
			color: var(--danger);
		}

		.stat-change svg {
			width: 14px;
			height: 14px;
		}

		/* ==========================================
           TABLE
        ========================================== */
		.table-wrapper {
			overflow-x: auto;
		}

		.data-table {
			width: 100%;
			border-collapse: collapse;
			font-size: 0.875rem;
		}

		.data-table th {
			text-align: left;
			padding: var(--spacing-sm) var(--spacing-md);
			font-size: 0.75rem;
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: 0.05em;
			color: var(--text-secondary);
			background: var(--bg-secondary);
			border-bottom: 1px solid var(--border-color);
			white-space: nowrap;
		}

		.data-table td {
			padding: var(--spacing-sm) var(--spacing-md);
			border-bottom: 1px solid var(--border-color);
			color: var(--text-primary);
			vertical-align: middle;
		}

		.data-table tr:hover td {
			background: var(--bg-secondary);
		}

		.data-table tr:last-child td {
			border-bottom: none;
		}

		/* ==========================================
           STATUS BADGES
        ========================================== */
		.status-badge {
			display: inline-flex;
			align-items: center;
			gap: 5px;
			padding: 4px 12px;
			border-radius: 20px;
			font-size: 0.75rem;
			font-weight: 500;
			white-space: nowrap;
		}

		.status-badge.active,
		.status-badge.success {
			background: rgba(16, 185, 129, 0.1);
			color: var(--success);
		}

		.status-badge.pending,
		.status-badge.warning {
			background: rgba(245, 158, 11, 0.1);
			color: var(--warning);
		}

		.status-badge.inactive,
		.status-badge.danger {
			background: rgba(239, 68, 68, 0.1);
			color: var(--danger);
		}

		.status-badge.info {
			background: rgba(99, 102, 241, 0.1);
			color: var(--primary);
		}

		/* ==========================================
           FORMS
        ========================================== */
		.form-group {
			margin-bottom: var(--spacing-md);
		}

		.form-label {
			display: block;
			font-size: 0.82rem;
			font-weight: 500;
			color: var(--text-secondary);
			margin-bottom: 6px;
		}

		.form-control {
			width: 100%;
			padding: 10px var(--spacing-md);
			background: var(--bg-secondary);
			border: 1px solid var(--border-color);
			border-radius: var(--radius-md);
			color: var(--text-primary);
			font-family: 'Poppins', sans-serif;
			font-size: 0.875rem;
			transition: var(--transition-fast);
		}

		.form-control:focus {
			outline: none;
			border-color: var(--primary);
			box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
		}

		.form-control::placeholder {
			color: var(--text-tertiary);
		}

		select.form-control {
			cursor: pointer;
		}

		/* Unified style for form-select dropdowns */
		.form-select {
			width: 100% !important;
			padding: 10px var(--spacing-md) !important;
			background-color: var(--bg-secondary) !important;
			background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%234b5563' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") !important;
			background-repeat: no-repeat !important;
			background-position: right var(--spacing-md) center !important;
			background-size: 12px 12px !important;
			border: 1px solid var(--border-color) !important;
			border-radius: var(--radius-md) !important;
			color: var(--text-primary) !important;
			font-family: 'Poppins', sans-serif !important;
			font-size: 0.875rem !important;
			transition: var(--transition-fast) !important;
			appearance: none !important;
			cursor: pointer !important;
		}

		.form-select:focus {
			outline: none !important;
			border-color: var(--primary) !important;
			box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
		}

		/* Premium Select2 Custom Styling */
		.select2-container--default .select2-selection--single {
			background-color: var(--bg-secondary) !important;
			border: 1px solid var(--border-color) !important;
			border-radius: var(--radius-md) !important;
			height: 43px !important;
			padding: 6px 12px !important;
			font-family: 'Poppins', sans-serif !important;
			font-size: 0.875rem !important;
			color: var(--text-primary) !important;
			display: flex;
			align-items: center;
			transition: var(--transition-fast);
		}

		.select2-container--default .select2-selection--single:focus,
		.select2-container--default.select2-container--focus .select2-selection--single {
			border-color: var(--primary) !important;
			box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
			outline: none !important;
		}

		.select2-container--default .select2-selection--single .select2-selection__rendered {
			color: var(--text-primary) !important;
			padding-left: 0 !important;
			padding-right: 20px !important;
		}

		.select2-container--default .select2-selection--single .select2-selection__placeholder {
			color: var(--text-tertiary) !important;
		}

		.select2-container--default .select2-selection--single .select2-selection__arrow {
			height: 41px !important;
			right: 12px !important;
		}

		.select2-container--default .select2-selection--single .select2-selection__arrow b {
			border-color: var(--text-secondary) transparent transparent transparent !important;
		}

		.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
			border-color: transparent transparent var(--text-secondary) transparent !important;
		}

		/* Select2 Dropdown Styling */
		.select2-dropdown {
			background-color: var(--bg-primary) !important;
			border: 1px solid var(--border-color) !important;
			border-radius: var(--radius-md) !important;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
			z-index: 9999 !important;
		}

		.select2-container--default .select2-search--dropdown .select2-search__field {
			border: 1px solid var(--border-color) !important;
			border-radius: var(--radius-sm) !important;
			background-color: var(--bg-secondary) !important;
			color: var(--text-primary) !important;
			padding: 6px 10px !important;
			outline: none !important;
		}

		.select2-container--default .select2-results__option {
			padding: 8px 12px !important;
			font-size: 0.875rem !important;
			color: var(--text-primary) !important;
		}

		.select2-container--default .select2-results__option--highlighted[aria-selected],
		.select2-container--default .select2-results__option[aria-selected="true"] {
			background-color: var(--primary) !important;
			color: #ffffff !important;
		}

		.select2-container--default .select2-selection--single .select2-selection__clear {
			color: var(--text-secondary) !important;
			margin-right: 10px !important;
			font-size: 1.2rem !important;
		}

		.form-row {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: var(--spacing-md);
		}

		/* ==========================================
           FILTER BAR
        ========================================== */
		.filter-bar {
			display: flex;
			align-items: center;
			gap: var(--spacing-md);
			margin-bottom: var(--spacing-lg);
			flex-wrap: wrap;
		}

		.search-input {
			position: relative;
			flex: 1;
			min-width: 220px;
		}

		.search-input svg {
			position: absolute;
			left: var(--spacing-md);
			top: 50%;
			transform: translateY(-50%);
			width: 17px;
			height: 17px;
			color: var(--text-tertiary);
			pointer-events: none;
		}

		.search-input input {
			width: 100%;
			padding: 9px var(--spacing-md) 9px 2.5rem;
			background: var(--bg-primary);
			border: 1px solid var(--border-color);
			border-radius: var(--radius-md);
			color: var(--text-primary);
			font-family: 'Poppins', sans-serif;
			font-size: 0.875rem;
			transition: var(--transition-fast);
		}

		.search-input input:focus {
			outline: none;
			border-color: var(--primary);
			box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
		}

		/* ==========================================
           PAGINATION
        ========================================== */
		.pagination {
			display: flex;
			align-items: center;
			gap: var(--spacing-xs);
			justify-content: flex-end;
			padding: var(--spacing-md) var(--spacing-lg);
			border-top: 1px solid var(--border-color);
			flex-wrap: wrap;
		}

		.page-btn {
			width: 34px;
			height: 34px;
			display: flex;
			align-items: center;
			justify-content: center;
			border: 1px solid var(--border-color);
			border-radius: var(--radius-sm);
			background: var(--bg-primary);
			color: var(--text-secondary);
			font-size: 0.82rem;
			cursor: pointer;
			transition: var(--transition-fast);
			text-decoration: none;
		}

		.page-btn:hover {
			background: var(--bg-secondary);
			color: var(--text-primary);
		}

		.page-btn.active {
			background: var(--primary);
			color: white;
			border-color: var(--primary);
		}

		.page-btn svg {
			width: 15px;
			height: 15px;
		}

		/* ==========================================
           MODAL
        ========================================== */
		.modal-overlay {
			display: none;
			position: fixed;
			inset: 0;
			background: rgba(0, 0, 0, 0.5);
			z-index: 2000;
			align-items: center;
			justify-content: center;
			padding: var(--spacing-lg);
		}

		.modal-overlay.active {
			display: flex;
		}

		.modal-container {
			background: var(--bg-primary);
			border-radius: var(--radius-xl);
			width: 100%;
			max-width: 560px;
			max-height: 90vh;
			overflow-y: auto;
			box-shadow: 0 20px 60px var(--shadow-lg);
			animation: modalIn 0.25s ease;
		}

		@keyframes modalIn {
			from {
				opacity: 0;
				transform: scale(0.95) translateY(-10px);
			}

			to {
				opacity: 1;
				transform: scale(1) translateY(0);
			}
		}

		.modal-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: var(--spacing-lg);
			border-bottom: 1px solid var(--border-color);
		}

		.modal-title {
			font-size: 1rem;
			font-weight: 600;
			color: var(--text-primary);
		}

		.modal-close {
			background: var(--bg-secondary);
			border: none;
			width: 32px;
			height: 32px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			color: var(--text-secondary);
			transition: var(--transition-fast);
		}

		.modal-close:hover {
			background: var(--bg-tertiary);
			color: var(--text-primary);
		}

		.modal-close svg {
			width: 17px;
			height: 17px;
		}

		.modal-body {
			padding: var(--spacing-lg);
		}

		.modal-footer {
			display: flex;
			align-items: center;
			justify-content: flex-end;
			gap: var(--spacing-sm);
			padding: var(--spacing-md) var(--spacing-lg);
			border-top: 1px solid var(--border-color);
		}

		/* ==========================================
           ALERT / TOAST
        ========================================== */
		.alert {
			padding: var(--spacing-md) var(--spacing-lg);
			border-radius: var(--radius-md);
			margin-bottom: var(--spacing-md);
			font-size: 0.875rem;
			display: flex;
			align-items: center;
			gap: var(--spacing-sm);
		}

		.alert svg {
			width: 18px;
			height: 18px;
			flex-shrink: 0;
		}

		.alert-success {
			background: rgba(16, 185, 129, 0.1);
			color: var(--success);
			border: 1px solid rgba(16, 185, 129, 0.2);
		}

		.alert-danger {
			background: rgba(239, 68, 68, 0.1);
			color: var(--danger);
			border: 1px solid rgba(239, 68, 68, 0.2);
		}

		.alert-warning {
			background: rgba(245, 158, 11, 0.1);
			color: var(--warning);
			border: 1px solid rgba(245, 158, 11, 0.2);
		}

		.alert-info {
			background: rgba(99, 102, 241, 0.1);
			color: var(--primary);
			border: 1px solid rgba(99, 102, 241, 0.2);
		}

		/* ==========================================
           RESPONSIVE
        ========================================== */
		@media (max-width: 992px) {
			.sidebar {
				transform: translateX(-100%);
			}

			.sidebar.mobile-open {
				transform: translateX(0);
			}

			.sidebar.collapsed {
				transform: translateX(-100%);
			}

			.main-content {
				margin-left: 0 !important;
			}

			.mobile-menu-toggle {
				display: flex;
			}

			.sidebar-overlay {
				display: none;
			}

			.sidebar.mobile-open~.sidebar-overlay {
				display: block;
			}
		}

		@media (max-width: 768px) {
			.page-content {
				padding: var(--spacing-md);
			}

			.topbar {
				padding: var(--spacing-md);
			}

			.stats-grid {
				grid-template-columns: 1fr;
			}

			.form-row {
				grid-template-columns: 1fr;
			}

			.filter-bar {
				flex-direction: column;
				align-items: stretch;
			}

			.search-input {
				min-width: unset;
			}

			.notification-dropdown {
				width: calc(100vw - 2rem);
				right: 0;
			}

			.user-menu-btn span {
				display: none;
			}

			.search-box {
				max-width: 100%;
			}
		}

		@media (max-width: 480px) {
			.topbar-right {
				gap: 4px;
			}

			.icon-btn {
				width: 36px;
				height: 36px;
			}
		}

		/* Fade-in animation for page views */
		@keyframes fadeIn {
			from {
				opacity: 0;
				transform: translateY(8px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
	</style>

</head>

<body>

	<!-- Mobile Sidebar Overlay -->
	<div class="sidebar-overlay" id="sidebarOverlay"></div>

	<!-- ==================== SIDEBAR ==================== -->
	<aside class="sidebar" id="sidebar">

		<div class="sidebar-header">
			<a href="<?= base_url('dashboard') ?>" class="logo">
				<img src="<?= base_url('assets/images/main_logo.png') ?>" alt="Logo" class="sidebar-logo-img">
			</a>
			<button class="sidebar-toggle" id="sidebarToggle" title="Toggle sidebar">
				<i data-lucide="panel-left-close"></i>
			</button>
		</div>

		<nav class="sidebar-nav">
			<?php
			$role           = $this->session->userdata('admin')['role'] ?? 'admin';
			$currentClass   = $this->router->class ?? '';
			$currentMethod  = $this->router->method ?? '';
			?>

			<?php if ($role === 'superadmin'): ?>

				<div class="nav-item <?= ($currentClass === 'dashboard' && $currentMethod === 'index') ? 'active' : '' ?>">
					<a href="<?= base_url('superadmin/dashboard') ?>" class="nav-link">
						<i data-lucide="layout-dashboard"></i>
						<span class="nav-label">Dashboard</span>
					</a>
				</div>

				<div class="nav-item <?= ($currentClass === 'superadmin' && $currentMethod === 'admins') ? 'active' : '' ?>">
					<a href="<?= base_url('superadmin/admins') ?>" class="nav-link">
						<i data-lucide="users"></i>
						<span class="nav-label">Admins</span>
					</a>
				</div>

				<div class="nav-item <?= ($currentClass === 'superadmin' && $currentMethod === 'sites') ? 'active' : '' ?>">
					<a href="<?= base_url('superadmin/sites') ?>" class="nav-link">
						<i data-lucide="globe"></i>
						<span class="nav-label">Sites</span>
					</a>
				</div>

			<?php else: ?>

				<!-- Dashboard -->
				<div class="nav-item <?= ($currentClass === 'dashboard' && $currentMethod === 'index') ? 'active' : '' ?>">
					<a href="<?= base_url('dashboard') ?>" class="nav-link">
						<i data-lucide="layout-dashboard"></i>
						<span class="nav-label">Dashboard</span>
					</a>
				</div>

				<!-- Sites -->
				<div class="nav-item has-submenu <?= ($currentClass === 'site' || $currentClass === 'plots') ? 'open active' : '' ?>">
					<div class="nav-link">
						<i data-lucide="building-2"></i>
						<span class="nav-label">Sites</span>
						<span class="submenu-chevron"><i data-lucide="chevron-down"></i></span>
					</div>
					<div class="submenu">
						<a href="<?= base_url('site') ?>" class="submenu-item <?= ($currentClass === 'site' && in_array($currentMethod, ['index', 'edit_site'])) ? 'active' : '' ?>">
							<i data-lucide="list"></i> All Sites
						</a>
						<a href="<?= base_url('add_site') ?>" class="submenu-item <?= ($currentClass === 'site' && $currentMethod === 'add_site') ? 'active' : '' ?>">
							<i data-lucide="building"></i> Add Site
						</a>
						<a href="<?= base_url('add_plot') ?>" class="submenu-item <?= ($currentClass === 'plots' && in_array($currentMethod, ['add_plot', 'edit_plot'])) ? 'active' : '' ?>">
							<i data-lucide="map"></i> Add Plots
						</a>
					</div>
				</div>

				<!-- Expenses -->
				<div class="nav-item has-submenu <?= ($currentClass === 'site' && in_array($currentMethod, ['expenses', 'add_expenses', 'update_expense'])) ? 'open active' : '' ?>">
					<div class="nav-link">
						<i data-lucide="wallet"></i>
						<span class="nav-label">Expenses</span>
						<span class="submenu-chevron"><i data-lucide="chevron-down"></i></span>
					</div>
					<div class="submenu">
						<a href="<?= base_url('expenses') ?>" class="submenu-item <?= ($currentClass === 'site' && $currentMethod === 'expenses') ? 'active' : '' ?>">
							<i data-lucide="receipt"></i> All Expenses
						</a>
						<a href="<?= base_url('add_expenses') ?>" class="submenu-item <?= ($currentClass === 'site' && $currentMethod === 'add_expenses') ? 'active' : '' ?>">
							<i data-lucide="plus-circle"></i> Add Expenses
						</a>
					</div>
				</div>

				<!-- Users -->
				<div class="nav-item has-submenu <?= ($currentClass === 'user') ? 'open active' : '' ?>">
					<div class="nav-link">
						<i data-lucide="users-round"></i>
						<span class="nav-label">User</span>
						<span class="submenu-chevron"><i data-lucide="chevron-down"></i></span>
					</div>
					<div class="submenu">
						<a href="<?= base_url('users') ?>" class="submenu-item <?= ($currentClass === 'user' && $currentMethod === 'index') ? 'active' : '' ?>">
							<i data-lucide="users"></i> All Users
						</a>
						<a href="<?= base_url('add_user') ?>" class="submenu-item <?= ($currentClass === 'user' && $currentMethod === 'add_user') ? 'active' : '' ?>">
							<i data-lucide="user-plus"></i> Add New
						</a>
						<a href="<?= base_url('add_upad') ?>" class="submenu-item <?= ($currentClass === 'user' && $currentMethod === 'add_upad') ? 'active' : '' ?>">
							<i data-lucide="id-card"></i> Add Upad
						</a>
					</div>
				</div>

				<!-- Inquiry -->
				<div class="nav-item <?= ($currentClass === 'inquiry' || ($currentClass === 'dashboard' && $currentMethod === 'inquiry')) ? 'active' : '' ?>">
					<a href="<?= base_url('inquiry') ?>" class="nav-link">
						<i data-lucide="message-circle"></i>
						<span class="nav-label">Inquiry</span>
					</a>
				</div>

				<!-- Attendance -->
				<div class="nav-item <?= ($currentClass === 'attedance' || ($currentClass === 'dashboard' && $currentMethod === 'attedance')) ? 'active' : '' ?>">
					<a href="<?= base_url('attedance') ?>" class="nav-link">
						<i data-lucide="calendar-check"></i>
						<span class="nav-label">Attendance</span>
					</a>
				</div>

			<?php endif; ?>
		</nav>

		<?php
		$admin        = $this->session->userdata('admin');
		$userName     = isset($admin['user_name'])     ? $admin['user_name']     : 'Guest User';
		$businessName = isset($admin['business_name']) ? $admin['business_name'] : 'No Business';
		$userRole     = isset($admin['role'])          ? ucfirst($admin['role']) : 'Admin';
		$profileImage = isset($admin['profile_image']) && !empty($admin['profile_image'])
			? base_url($admin['profile_image'])
			: base_url('assets/images/54322.jpg');
		?>

	</aside>
	<!-- ==================== END SIDEBAR ==================== -->


	<!-- ==================== MAIN CONTENT ==================== -->
	<main class="main-content" id="mainContent">

		<!-- TOPBAR -->
		<header class="topbar">
			<div class="topbar-left">
				<button class="mobile-menu-toggle" id="mobileMenuToggle">
					<i data-lucide="menu"></i>
				</button>
			</div>

			<div class="topbar-right">

				<!-- User Menu -->
				<div class="user-menu">
					<?php
					$profileUrl = ($role === 'superadmin') ? base_url('superadmin/profile') : base_url('profile');
					?>
					<button class="user-menu-btn" id="userMenuBtn">
						<img src="<?= $profileImage ?>"
							alt="<?= htmlspecialchars($userName) ?>"
							onerror="this.src='<?= base_url('assets/images/avatars/avatar-2.png') ?>'">
						<span><?= htmlspecialchars($userName) ?></span>
						<i data-lucide="chevron-down"></i>
					</button>
					<div class="user-dropdown" id="userDropdown">
						<a href="<?= $profileUrl ?>"><i data-lucide="user"></i> Profile</a>
						<hr>
						<a href="<?= base_url('logout') ?>"><i data-lucide="log-out"></i> Logout</a>
					</div>
				</div>

			</div>
		</header>
		<!-- END TOPBAR -->

		<!-- PAGE CONTENT STARTS HERE -->