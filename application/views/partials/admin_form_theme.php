<style>
	.admin-form-page .admin-form-card {
		border: none;
		border-radius: 16px;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 8px 20px rgba(0, 0, 0, 0.05);
	}

	.admin-form-page .admin-form-card .card-body {
		padding: 24px;
	}

	.admin-form-page .card-title {
		font-weight: 700;
		color: #1f2937;
	}

	.admin-form-page .form-label {
		font-weight: 600;
		color: #475569;
		margin-bottom: 6px;
	}

	.admin-form-page .form-control,
	.admin-form-page .form-select,
	.admin-form-page textarea {
		border: 1.5px solid #e2e8f0;
		border-radius: 10px;
		padding: 10px 12px;
		background: #f8fafc;
		transition: all 0.2s ease;
	}

	.admin-form-page .form-control:focus,
	.admin-form-page .form-select:focus,
	.admin-form-page textarea:focus {
		border-color: #6366f1;
		background: #fff;
		box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
	}

	.admin-form-page .input-group-text {
		border-radius: 10px;
	}

	.admin-form-page .btn-primary {
		border: none;
		border-radius: 10px;
		padding: 10px 14px;
		font-weight: 600;
		background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
		box-shadow: 0 6px 18px rgba(79, 70, 229, 0.28);
	}

	.admin-form-page .btn-primary:hover {
		filter: brightness(0.98);
		transform: translateY(-1px);
	}

	.admin-form-page #imagePreview,
	.admin-form-page #siteImagesPreview img,
	.admin-form-page #expenseImagePreview img {
		border: 1px solid #e2e8f0;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
	}

	@media (max-width: 576px) {
		.admin-form-page .admin-form-card .card-body {
			padding: 16px;
		}
	}
</style>
