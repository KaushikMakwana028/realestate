// user form js

$(document).ready(function () {
	const toggleLink = document.querySelector("#show_hide_password a");
	if (toggleLink) {
		toggleLink.addEventListener("click", function (e) {
			e.preventDefault();
			const passwordInput = document.querySelector("#userPassword");
			const icon = this.querySelector("i");
			if (passwordInput.type === "password") {
				passwordInput.type = "text";
				icon.classList.remove("bx-hide");
				icon.classList.add("bx-show");
			} else {
				passwordInput.type = "password";
				icon.classList.remove("bx-show");
				icon.classList.add("bx-hide");
			}
		});
	}
});

// Image preview
const profileImage = document.getElementById("profileImage");

if (profileImage) {
	profileImage.addEventListener("change", function () {
		const file = event.target.files[0];
		const preview = document.getElementById("previewImage");

		if (file) {
			const validTypes = ["image/jpeg", "image/png", "image/jpg"];
			if (!validTypes.includes(file.type)) {
				alert("Only JPG, JPEG, and PNG files are allowed.");
				this.value = "";
				if (preview) preview.style.display = "none";
				return;
			}

			if (file.size > 2 * 1024 * 1024) {
				alert("File size must be less than 2MB.");
				this.value = "";
				if (preview) preview.style.display = "none";
				return;
			}

			const reader = new FileReader();
			reader.onload = function (e) {
				if (preview) {
					preview.src = e.target.result;
					preview.style.display = "inline-block";
				}
			};
			reader.readAsDataURL(file);
		} else if (preview) {
			preview.style.display = "none";
		}
	});
} else {
	console.error('Error: Element with ID "profileImage" not found.');
}

$(document).ready(function () {
	// âœ… Check if form exists before binding event
	if ($("#addUserForm").length) {
		$("#addUserForm").on("submit", function (e) {
			e.preventDefault();

			if (!this.checkValidity()) {
				e.stopPropagation();
				$(this).addClass("was-validated");
				return;
			}

			var formData = new FormData(this);

			$.ajax({
				url: site_url + "user/save_user",
				type: "POST",
				data: formData,
				dataType: "json",
				processData: false,
				contentType: false,
				beforeSend: function () {
					Swal.fire({
						title: "Please wait...",
						allowOutsideClick: false,
						didOpen: () => Swal.showLoading(),
					});
				},
				success: function (response) {
					Swal.close();
					if (response.status === "success") {
						Swal.fire("Success!", response.message, "success");
						$("#addUserForm")[0].reset();
						$("#imagePreview").hide();
					} else {
						Swal.fire("Error!", response.message, "error");
					}
				},
				error: function () {
					Swal.close();
					Swal.fire(
						"Error!",
						"Something went wrong, please try again.",
						"error",
					);
				},
			});
		});

		// âœ… Image Preview
		$("#profileImage").on("change", function () {
			const file = this.files[0];
			if (file) {
				const reader = new FileReader();
				reader.onload = function (event) {
					$("#imagePreview").attr("src", event.target.result).show();
				};
				reader.readAsDataURL(file);
			}
		});
	}

	if ($("#addSiteForm").length) {
		$("#addSiteForm").on("submit", function (e) {
			e.preventDefault();

			// Form validation
			if (!this.checkValidity()) {
				e.stopPropagation();
				$(this).addClass("was-validated");
				return;
			}

			var formData = new FormData(this);

			$.ajax({
				url: site_url + "site/save_site",
				type: "POST",
				data: formData,
				dataType: "json",
				processData: false,
				contentType: false,
				beforeSend: function () {
					Swal.fire({
						title: "Please wait...",
						allowOutsideClick: false,
						didOpen: () => Swal.showLoading(),
					});
				},
				success: function (response) {
					Swal.close();
					if (response.status === "success") {
						Swal.fire("Success!", response.message, "success");
						$("#addSiteForm")[0].reset();
						$("#addSiteForm").removeClass("was-validated");
					} else {
						Swal.fire("Error!", response.message, "error");
					}
				},
				error: function () {
					Swal.close();
					Swal.fire(
						"Error!",
						"Something went wrong, please try again.",
						"error",
					);
				},
			});
		});
	}

	if ($("#siteImages").length) {
		$("#siteImages").on("change", function () {
			const preview = $("#siteImagesPreview");
			preview.empty();

			const files = this.files;
			if (!files || files.length === 0) return;

			Array.from(files).forEach((file) => {
				if (!file.type.startsWith("image/")) return;
				const reader = new FileReader();
				reader.onload = function (event) {
					const img = $("<img />", {
						src: event.target.result,
						css: {
							width: "80px",
							height: "80px",
							objectFit: "cover",
							borderRadius: "6px",
						},
					});
					preview.append(img);
				};
				reader.readAsDataURL(file);
			});
		});
	}

	if ($("#addPlotForm").length) {
		$("#addPlotForm").on("submit", function (e) {
			e.preventDefault();

			if (!this.checkValidity()) {
				e.stopPropagation();
				$(this).addClass("was-validated");
				return;
			}

			var formData = new FormData(this);

			$.ajax({
				url: site_url + "plots/save_plot",
				type: "POST",
				data: formData,
				dataType: "json",
				processData: false,
				contentType: false,
				beforeSend: function () {
					Swal.fire({
						title: "Please wait...",
						allowOutsideClick: false,
						didOpen: () => Swal.showLoading(),
					});
				},
				success: function (response) {
					Swal.close();
					if (response.status === "success") {
						Swal.fire("Success!", response.message, "success");
						$("#addPlotForm")[0].reset();
						$("#addPlotForm").removeClass("was-validated");
					} else {
						Swal.fire("Error!", response.message, "error");
					}
				},
				error: function () {
					Swal.close();
					Swal.fire(
						"Error!",
						"Something went wrong, please try again.",
						"error",
					);
				},
			});
		});
	}
	if ($("#addexpForm").length) {
		$("#addexpForm").on("submit", function (e) {
			e.preventDefault();

			if (!this.checkValidity()) {
				e.stopPropagation();
				$(this).addClass("was-validated");
				return;
			}

			var formData = new FormData(this);

			$.ajax({
				url: site_url + "site/save_exp",
				type: "POST",
				data: formData,
				dataType: "json",
				processData: false,
				contentType: false,
				beforeSend: function () {
					Swal.fire({
						title: "Please wait...",
						allowOutsideClick: false,
						didOpen: () => Swal.showLoading(),
					});
				},
				success: function (response) {
					Swal.close();
					if (response.status === "success") {
						Swal.fire("Success!", response.message, "success");
						$("#addexpForm")[0].reset();
						$("#addexpForm").removeClass("was-validated");
						$("#expenseImageFieldWrap").addClass("d-none");
						$("#expenseImagePreview").empty();
					} else {
						Swal.fire("Error!", response.message, "error");
					}
				},
				error: function () {
					Swal.close();
					Swal.fire(
						"Error!",
						"Something went wrong, please try again.",
						"error",
					);
				},
			});
		});

		$("#siteName").on("change", function () {
			const siteId = $(this).val();
			const fieldWrap = $("#expenseImageFieldWrap");
			const preview = $("#expenseImagePreview");
			const input = $("#expenseImage");

			preview.empty();
			input.val("");

			if (siteId) {
				fieldWrap.removeClass("d-none");
			} else {
				fieldWrap.addClass("d-none");
			}
		});

		$("#expenseImage").on("change", function () {
			const preview = $("#expenseImagePreview");
			preview.empty();

			const file = this.files && this.files[0];
			if (!file || !file.type.startsWith("image/")) return;

			const reader = new FileReader();
			reader.onload = function (event) {
				preview.html(
					`<img src="${event.target.result}" style="width:80px;height:80px;object-fit:cover;border-radius:6px;" alt="Expense image preview" />`,
				);
			};
			reader.readAsDataURL(file);
		});
	}

	$("#editPlotForm").on("submit", function (e) {
		e.preventDefault();

		let formData = new FormData(this);

		$.ajax({
			url: site_url + "plots/update_plot",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,

			beforeSend: function () {
				Swal.fire({
					title: "Updating...",
					text: "Please wait",
					allowOutsideClick: false,
					didOpen: () => Swal.showLoading(),
				});
			},

			success: function (response) {
				Swal.close();

				if (response.status === "success") {
					Swal.fire({
						icon: "success",
						title: "Updated!",
						text: response.message,
					}).then(() => {
						location.reload();
					});
				} else {
					Swal.fire({
						icon: "error",
						title: "Error",
						text: response.message,
					});
				}
			},

			error: function () {
				Swal.close();
				Swal.fire({
					icon: "error",
					title: "Server Error",
					text: "Something went wrong!",
				});
			},
		});
	});

	if ($("#customerTableBody").length) {
		let currentPage = 1;
		let searchQuery = "";

		function loadSites(page = 1, search = "") {
			$.ajax({
				url: site_url + "site/get_sites",
				method: "GET",
				data: { page: page, search: search },
				dataType: "json",
				success: function (res) {
					if (res.status && res.data.length > 0) {
						let tbody = "";
						let startIndex = (page - 1) * 10 + 1;

						res.data.forEach((site, i) => {
							const hasMap = !!site.site_map;
							const mapOk = hasMap;
							const formatInr = (v) => {
								const n = Number(v || 0);
								return Number.isFinite(n) ? `₹${n.toLocaleString("en-IN")}` : "₹0";
							};
							const siteName = site.name || "-";
							const siteLocation = site.location || "-";

							const mapBadge = mapOk
								? `<span class="badge badge-animated-live d-inline-flex align-items-center gap-2" style="background: rgba(16, 185, 129, 0.1); color: #059669; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 0.78rem;"><span class="badge-dot-live"></span>Live</span>`
								: `<span class="badge badge-animated-pending d-inline-flex align-items-center gap-2" style="background: rgba(245, 158, 11, 0.1); color: #d97706; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 0.78rem;"><span class="badge-dot-pending"></span>Pending</span>`;
							tbody += `
                            <tr>
                                <td>${startIndex + i}</td>
                                <td><span class="site-name-chip"><i class='bx bx-building-house'></i>${siteName}</span></td>
                                <td>${siteLocation}</td>
                                <td><span class="value-cell">${formatInr(site.site_value)}</span></td>
                                <td><span class="value-cell">${formatInr(site.collected_value)}</span></td>                       
                                <td><span class="value-cell">${formatInr(site.total_expenses)}</span></td>
                                <td><span class="count-pill">${site.total_plots || 0}</span></td>
                               <td>${mapBadge}</td>
                                 
                               <td>
    <a href="${site_url}plots/${site.id}" 
       class="quick-link-btn" 
       title="View Plots">
        <i class='bx bx-grid-alt'></i>
    </a>
</td>

<td>
    <a href="${site_url}expenses/${site.id}" 
       class="quick-link-btn" 
       title="View Expenses">
        <i class='bx bx-receipt'></i>
    </a>
</td>

<td>
                                    <div class="site-action-group">
                                       <a href="edit_site/${
																					site.id
																				}" class="site-action-btn site-action-edit editSite">
                                            <i class="bx bxs-edit"></i>
                                        </a>

                                        <a href="javascript:;" class="site-action-btn site-action-delete deleteSite" data-id="${
																					site.id
																				}">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                        <a href="javascript:;" class="site-action-btn site-action-assign assignSite" data-admin="${
																					site.admin_id
																				}" data-id="${site.id}">
                                            <i class="bx bxs-user-plus"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>`;
						});

						$("#customerTableBody").html(tbody);
						renderPagination(res.pagination);
					} else {
						$("#customerTableBody").html(
							'<tr><td colspan="12" class="text-center">No data found</td></tr>',
						);
						$("#sitePaginationList").html("");
					}
				},
				error: function () {
					$("#customerTableBody").html(
						'<tr><td colspan="12" class="text-center text-danger">Error loading data</td></tr>',
					);
				},
			});
		}

		function renderPagination(pagination) {
			let html = "";
			let total = pagination.total_pages;
			let current = pagination.current_page;

			html += `<li class="page-item ${current === 1 ? "disabled" : ""}">
                    <a class="page-link" href="#" data-page="${
											current - 1
										}">Previous</a>
                 </li>`;

			let start = Math.max(1, current - 1);
			let end = Math.min(start + 2, total);

			if (start > 1)
				html += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
			if (start > 2)
				html += `<li class="page-item disabled"><a class="page-link">...</a></li>`;

			for (let i = start; i <= end; i++) {
				html += `<li class="page-item ${i === current ? "active" : ""}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                     </li>`;
			}

			if (end < total - 1)
				html += `<li class="page-item disabled"><a class="page-link">...</a></li>`;
			if (end < total)
				html += `<li class="page-item"><a class="page-link" href="#" data-page="${total}">${total}</a></li>`;

			html += `<li class="page-item ${current === total ? "disabled" : ""}">
                    <a class="page-link" href="#" data-page="${
											current + 1
										}">Next</a>
                 </li>`;

			$("#sitePaginationList").html(html);
		}

		// ðŸ”¹ Pagination click
		$(document).on("click", "#sitePaginationList a.page-link", function (e) {
			e.preventDefault();
			let page = $(this).data("page");
			if (page) {
				currentPage = page;
				loadSites(currentPage, searchQuery);
			}
		});

		// ðŸ”¹ Search
		$("#serchSite").on("keyup", function () {
			searchQuery = $(this).val();
			currentPage = 1;
			loadSites(currentPage, searchQuery);
		});

		// View site details (admin)
		$(document).on("click", ".viewSiteDetail", function () {
			const siteId = $(this).data("id");
			const content = $("#siteDetailContent");
			content.html("Loading...");

			if (typeof bootstrap !== "undefined" && bootstrap.Modal) {
				const modalEl = document.getElementById("siteDetailModal");
				const modal = new bootstrap.Modal(modalEl);
				modal.show();
			}

			fetch(site_url + "site/get_site_detail/" + siteId)
				.then((r) => r.json())
				.then((data) => {
					if (!data.status) {
						content.html(
							`<div class="text-danger">${data.message || "Failed to load"}</div>`,
						);
						return;
					}

					const site = data.site || {};
					const images = data.images || [];
					const expenses = data.expenses || [];
					const plots = data.plots || [];

					const imageHtml = images.length
						? images
								.map((img) => `<img src="${site_url}${img}" alt="Site Image">`)
								.join("")
						: '<div class="text-muted">No images</div>';

					const expenseRows = expenses.length
						? expenses
								.map(
									(e) => `
						<tr>
							<td>${e.description || "-"}</td>
							<td>${e.date || "-"}</td>
							<td>${e.amount || "-"}</td>
							<td>${e.status || "-"}</td>
						</tr>
					`,
								)
								.join("")
						: '<tr><td colspan="4" class="text-muted">No expenses</td></tr>';

					const plotRows = plots.length
						? plots
								.map(
									(p) => `
						<tr>
							<td>${p.plot_number || "-"}</td>
							<td>${p.size || "-"}</td>
							<td>${p.dimension || "-"}</td>
							<td>${p.facing || "-"}</td>
							<td>${p.price || "-"}</td>
							<td>${p.status || "-"}</td>
						</tr>
					`,
								)
								.join("")
						: '<tr><td colspan="6" class="text-muted">No plots</td></tr>';

					const hasMap =
						!!site.site_map &&
						site.site_map !== "NULL" &&
						site.site_map !== "null" &&
						site.site_map !== "";
					const mapBadge = hasMap
						? `<span class="badge bg-success">Map Uploaded</span>`
						: `<span class="badge bg-secondary">No Map</span>`;

					content.html(`
					<div class="site-detail-header">
						<div class="site-detail-title">
							<i class="bx bx-building-house"></i>
							${site.name || "Site"}
						</div>
						<div class="site-detail-meta">
							<span class="site-detail-chip"><i class="bx bx-map-pin"></i> ${
								site.location || "-"
							}</span>
							${mapBadge}
						</div>
					</div>

					<div class="site-detail-card">
						<h6>Basic Info</h6>
						<div class="site-detail-grid">
							<div>
								<div class="site-detail-label">Site Name</div>
								<div class="site-detail-value">${site.name || "-"}</div>
							</div>
							<div>
								<div class="site-detail-label">Location</div>
								<div class="site-detail-value">${site.location || "-"}</div>
							</div>
							<div>
								<div class="site-detail-label">Area</div>
								<div class="site-detail-value">${site.area || "-"}</div>
							</div>
							<div>
								<div class="site-detail-label">Total Plots</div>
								<div class="site-detail-value">${site.total_plots || "-"}</div>
							</div>
							<div>
								<div class="site-detail-label">Map</div>
								<div class="site-detail-value">${hasMap ? "Uploaded" : "Not Uploaded"}</div>
							</div>
						</div>
					</div>

					<div class="site-detail-card">
						<h6>Images</h6>
						<div class="site-detail-images">${imageHtml}</div>
					</div>

					<div class="site-detail-card">
						<h6>Plots</h6>
						<div class="table-responsive">
							<table class="table table-sm site-detail-table">
								<thead>
									<tr>
										<th>Plot No</th>
										<th>Size</th>
										<th>Dimension</th>
										<th>Facing</th>
										<th>Price</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>${plotRows}</tbody>
							</table>
						</div>
					</div>

					<div class="site-detail-card">
						<h6>Expenses</h6>
						<div class="table-responsive">
							<table class="table table-sm site-detail-table">
								<thead>
									<tr>
										<th>Description</th>
										<th>Date</th>
										<th>Amount</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>${expenseRows}</tbody>
							</table>
						</div>
					</div>
					`);
				})
				.catch(() => {
					content.html('<div class="text-danger">Error loading details</div>');
				});
		});

		$(document).on("click", ".deleteSite", function () {
			const id = $(this).data("id");
			Swal.fire({
				title: "Delete this site?",
				text: "This action cannot be undone.",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!",
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: site_url + "site/delete_site/" + id,
						method: "POST",
						success: function () {
							Swal.fire("Deleted!", "Site has been deleted.", "success");
							loadSites(currentPage, searchQuery);
						},
					});
				}
			});
		});

		$(document).on("click", ".assignSite", function () {
			const siteId = $(this).data("id");
			const adminId = $(this).data("admin"); // âœ… get admin id

			$.ajax({
				url: site_url + "site/get_users",
				method: "GET",
				success: function (response) {
					if (response.status && response.data.length > 0) {
						let options = response.data
							.map((user) => `<option value="${user.id}">${user.name}</option>`)
							.join("");

						Swal.fire({
							title: "Assign Site",
							html: `
                        <label class="swal2-label" style="display:block;margin-bottom:5px;font-weight:600;">Select User</label>
                        <select id="userDropdown" class="swal2-select" style="width:100%;">
                            <option value="">Select User</option>
                            ${options}
                        </select>
                    `,
							showCancelButton: true,
							confirmButtonText: "Assign",
							cancelButtonText: "Cancel",
							didOpen: () => {
								$("#userDropdown").select2({
									dropdownParent: $(".swal2-container"),
									width: "100%",
									placeholder: "Search user...",
									allowClear: true,
								});
							},
						}).then((result) => {
							if (result.isConfirmed) {
								const userId = $("#userDropdown").val();

								if (!userId) {
									Swal.fire("Error", "Please select a user", "error");
									return;
								}

								$.ajax({
									url: site_url + "site/assign_site",
									method: "POST",
									data: {
										site_id: siteId,
										user_id: userId,
										admin_id: adminId, // âœ… send admin id
									},
									success: function (res) {
										if (res.status) {
											Swal.fire("Success", res.message, "success");
										} else {
											Swal.fire("Error", res.message, "error");
										}
									},
								});
							}
						});
					} else {
						Swal.fire("Error", "No users found", "error");
					}
				},
			});
		});

		// ðŸ”¹ Initial load
		loadSites();
	}
});
$("#editUserForm").on("submit", function (e) {
	e.preventDefault();

	let formData = new FormData(this);
	let user_id = $("#user_id").val();
	formData.append("id", user_id);

	$.ajax({
		url: site_url + "user/update_user",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,

		beforeSend: function () {
			Swal.fire({
				title: "Updating User...",
				text: "Please wait",
				allowOutsideClick: false,
				didOpen: () => Swal.showLoading(),
			});
		},

		success: function (response) {
			Swal.close();

			if (response.status === "success") {
				Swal.fire({
					icon: "success",
					title: "Updated!",
					text: response.message,
				}).then(() => {
					location.reload();
				});
			} else {
				Swal.fire({
					icon: "error",
					title: "Error",
					text: response.message,
				});
			}
		},

		error: function () {
			Swal.close();
			Swal.fire({
				icon: "error",
				title: "Server Error",
				text: "Something went wrong!",
			});
		},
	});
});

$(document).on("submit", "#editSiteForm", function (e) {
	e.preventDefault();

	const form = $(this);
	const actionUrl = form.attr("action"); // site/update_site/{id}
	const formData = new FormData(this);

	Swal.fire({
		title: "Are you sure?",
		text: "Do you want to update this site?",
		icon: "question",
		showCancelButton: true,
		confirmButtonText: "Yes, update it!",
		cancelButtonText: "Cancel",
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: actionUrl,
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					try {
						const res = JSON.parse(response);
						if (res.status === true) {
							Swal.fire({
								icon: "success",
								title: "Updated!",
								text: "Site updated successfully.",
								showConfirmButton: false,
								timer: 1500,
							}).then(() => {
								window.location.href = site_url + "site"; // redirect back to site list
							});
						} else {
							Swal.fire(
								"Error",
								res.message || "Something went wrong.",
								"error",
							);
						}
					} catch (err) {
						Swal.fire("Error", "Invalid response from server.", "error");
					}
				},
				error: function () {
					Swal.fire("Error", "Failed to update the site. Try again.", "error");
				},
			});
		}
	});
});
$("#addUpadForm").on("submit", function (e) {
	e.preventDefault();

	let user_id = $("#userSelect").val();
	let amount = $("#upadAmount").val();

	if (user_id === "" || amount === "") {
		Swal.fire("Error", "Please select user and enter amount", "error");
		return;
	}

	Swal.fire({
		title: "Confirm?",
		text: "Are you sure you want to add this UPAD?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: "Yes, Save",
		cancelButtonText: "Cancel",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: site_url + "user/save_upad",
				type: "POST",
				data: $("#addUpadForm").serialize(),
				dataType: "json",

				success: function (res) {
					if (res.status) {
						Swal.fire({
							icon: "success",
							title: "Success",
							text: res.message,
						}).then(() => {
							location.reload();
						});
					} else {
						Swal.fire("Error", res.message, "error");
					}
				},

				error: function () {
					Swal.fire("Error", "Server error!", "error");
				},
			});
		}
	});
});
$(document).ready(function () {
	// âœ… Run only if table exists
	if ($("#plotTable").length) {
		let currentPage = 1;
		let searchQuery = "";

		function normalizePlotStatus(rawStatus) {
			const status = String(rawStatus || "").toLowerCase();
			if (status === "sold") return "sold";
			if (status === "booked" || status === "reserved" || status === "pending") {
				return "booked";
			}
			return "available";
		}

		function escapeHtml(text) {
			return String(text ?? "")
				.replace(/&/g, "&amp;")
				.replace(/</g, "&lt;")
				.replace(/>/g, "&gt;")
				.replace(/"/g, "&quot;")
				.replace(/'/g, "&#039;");
		}

		function formatPrice(price) {
			const num = Number(price || 0);
			if (!Number.isFinite(num)) return "&#8377;0";
			return `&#8377;${num.toLocaleString("en-IN")}`;
		}

		function getBuyerInitials(name) {
			const cleaned = String(name || "").trim();
			if (!cleaned) return "?";
			const words = cleaned.split(/\s+/);
			if (words.length >= 2) {
				return (words[0][0] + words[1][0]).toUpperCase();
			}
			return cleaned.substring(0, 2).toUpperCase();
		}

		function buildStatusBadge(statusKey) {
			if (statusKey === "sold") {
				return '<span class="status-badge status-sold"><i class="bx bx-radio-circle-marked"></i>Sold</span>';
			}
			if (statusKey === "booked") {
				return '<span class="status-badge status-booked"><i class="bx bx-radio-circle-marked"></i>Booked</span>';
			}
			return '<span class="status-badge status-available"><i class="bx bx-radio-circle-marked"></i>Available</span>';
		}

		function updatePlotSummary(res) {
			const data = Array.isArray(res.data) ? res.data : [];
			const pagination = res.pagination || {};
			const serverCounts = res.status_counts || null;
			const totalRecords = Number(pagination.total_records || data.length || 0);
			const start = data.length ? (currentPage - 1) * 10 + 1 : 0;
			const end = data.length ? (currentPage - 1) * 10 + data.length : 0;

			const counts = { available: 0, booked: 0, sold: 0 };
			if (serverCounts) {
				counts.available = Number(serverCounts.available || 0);
				counts.booked = Number(serverCounts.booked || 0);
				counts.sold = Number(serverCounts.sold || 0);
			} else {
				data.forEach((plot) => {
					const key = normalizePlotStatus(plot.status);
					counts[key] += 1;
				});
			}

			if ($("#statTotalPlots").length) $("#statTotalPlots").text(totalRecords);
			if ($("#statAvailable").length) $("#statAvailable").text(counts.available);
			if ($("#statBooked").length) $("#statBooked").text(counts.booked);
			if ($("#statSold").length) $("#statSold").text(counts.sold);

			if ($("#countAll").length) $("#countAll").text(totalRecords);
			if ($("#countAvailable").length) $("#countAvailable").text(counts.available);
			if ($("#countBooked").length) $("#countBooked").text(counts.booked);
			if ($("#countSold").length) $("#countSold").text(counts.sold);

			const safeTotal = totalRecords > 0 ? totalRecords : 1;
			const availablePct = Math.round((counts.available / safeTotal) * 100);
			const bookedPct = Math.round((counts.booked / safeTotal) * 100);
			const soldPct = Math.round((counts.sold / safeTotal) * 100);

			if ($("#ringAvailable").length) {
				$("#ringAvailable").attr("stroke-dasharray", `${availablePct}, 100`);
			}
			if ($("#ringBooked").length) {
				$("#ringBooked").attr("stroke-dasharray", `${bookedPct}, 100`);
			}
			if ($("#ringSold").length) {
				$("#ringSold").attr("stroke-dasharray", `${soldPct}, 100`);
			}

			if ($("#pagStart").length) $("#pagStart").text(start);
			if ($("#pagEnd").length) $("#pagEnd").text(end);
			if ($("#pagTotal").length) $("#pagTotal").text(totalRecords);
		}

		function loadPlots(page = 1, search = "") {
			let site_id = $("#site_id").val();

			$.ajax({
				url: site_url + "plots/get_plots_ajax",
				method: "GET",
				data: {
					page: page,
					search: search,
					site_id: site_id,
				},
				success: function (response) {
					const res =
						typeof response === "string" ? JSON.parse(response) : response;

					if (res.status && res.data.length > 0) {
						let rows = "";
						let gridCards = "";

						$.each(res.data, function (i, plot) {
							const statusKey = normalizePlotStatus(plot.status);
							const statusBadge = buildStatusBadge(statusKey);
							const rowNo = (page - 1) * 10 + i + 1;
							const buyerName = String(plot.name || "").trim();
							const hasBuyer = statusKey === "sold" && buyerName.length > 0;
							const safeBuyerName = escapeHtml(buyerName || "-");
							const buyerHtml = hasBuyer
								? `<div class="buyer-cell">
										<div class="buyer-avatar" style="background:#4f46e5;">${escapeHtml(getBuyerInitials(buyerName))}</div>
										<div class="buyer-name">${safeBuyerName}</div>
								   </div>`
								: '<span class="no-buyer">-</span>';
							const safePlotNumber = escapeHtml(plot.plot_number || "-");
							const safeSize = escapeHtml(plot.size || "-");
							const safeDimension = escapeHtml(plot.dimension || "-");
							const safeFacing = escapeHtml(plot.facing || "-");
							const safePrice = formatPrice(plot.price);

							rows += `
								<tr data-status="${statusKey}">
									<td>${rowNo}</td>
									<td><strong>${safePlotNumber}</strong></td>
									<td><span class="dimension-display">${safeSize}</span></td>
									<td><span class="dimension-display">${safeDimension}</span></td>
									<td><span class="facing-badge" data-facing="${String(plot.facing || "").toLowerCase()}"><i class="bx bx-compass"></i>${safeFacing}</span></td>
									<td class="text-end"><span class="money-cell">${safePrice}</span></td>
									<td class="text-center">${statusBadge}</td>
									<td>${buyerHtml}</td>
									<td class="text-center">
										<div class="action-group">
											<a href="${site_url}plot/edit_plot/${plot.id}" class="btn-action btn-action-edit" data-tooltip="Edit Plot">
												<i class="bx bx-edit-alt"></i>
											</a>
											<a href="javascript:;" class="btn-action btn-action-delete deletePlot" data-id="${plot.id}" data-tooltip="Delete Plot">
												<i class="bx bx-trash"></i>
											</a>
											${
												statusKey === "sold" && plot.buyer_id
													? `<a href="${site_url}plots/buyer_details/${plot.id}" class="btn-action btn-action-view checkBuyer" data-id="${plot.id}" data-tooltip="Buyer Details">
													<i class="bx bx-user-check"></i>
											   </a>`
													: ""
											}
										</div>
									</td>
								</tr>
							`;

							gridCards += `
								<div class="col-md-6 col-lg-4" data-status="${statusKey}">
									<div class="plot-grid-card">
										<div class="plot-grid-card-status">${statusBadge}</div>
										<div class="plot-grid-card-header">
											<div class="plot-grid-number ${statusKey}">${safePlotNumber}</div>
											<div class="text-muted small mt-1">Facing: ${safeFacing}</div>
										</div>
										<div class="plot-grid-card-body">
											<div class="plot-grid-detail">
												<span class="plot-grid-detail-label">Size</span>
												<span class="plot-grid-detail-value">${safeSize}</span>
											</div>
											<div class="plot-grid-detail">
												<span class="plot-grid-detail-label">Dimension</span>
												<span class="plot-grid-detail-value">${safeDimension}</span>
											</div>
											<div class="plot-grid-detail">
												<span class="plot-grid-detail-label">Buyer</span>
												<span class="plot-grid-detail-value">${hasBuyer ? safeBuyerName : "-"}</span>
											</div>
										</div>
										<div class="plot-grid-card-footer">
											<span class="plot-grid-price">${safePrice}</span>
											<div class="action-group">
												<a href="${site_url}plot/edit_plot/${plot.id}" class="btn-action btn-action-edit" data-tooltip="Edit Plot">
													<i class="bx bx-edit-alt"></i>
												</a>
												<a href="javascript:;" class="btn-action btn-action-delete deletePlot" data-id="${plot.id}" data-tooltip="Delete Plot">
													<i class="bx bx-trash"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							`;
						});

						$("#plotTable").html(rows);
						$("#gridView").html(gridCards);
						const plotTableWrap = document.getElementById("tableView");
						if (plotTableWrap && window.innerWidth >= 1200) {
							plotTableWrap.scrollLeft = 0;
						}
						renderPagination(
							res.pagination.total_pages,
							res.pagination.current_page,
						);
						$("#emptyState").addClass("d-none");
						updatePlotSummary(res);
						if (typeof enhanceStatusBadges === "function") {
							enhanceStatusBadges();
						}
					} else {
						$("#plotTable").html(
							`<tr><td colspan="9" class="text-center text-muted">No plots found</td></tr>`,
						);
						$("#gridView").html("");
						$("#paginationList").html("");
						$("#emptyState").removeClass("d-none");
						updatePlotSummary({ data: [], pagination: { total_records: 0 } });
					}
				},
			});
		}

		function normalizeImportedValue(value) {
			if (value === undefined || value === null) return null;
			const cleaned = String(value).trim();
			if (!cleaned) return null;
			const lowered = cleaned.toLowerCase();
			if (lowered === "null" || lowered === "na" || lowered === "n/a" || lowered === "-") {
				return null;
			}
			return cleaned;
		}

		function normalizeImportedPrice(value) {
			const cleaned = normalizeImportedValue(value);
			if (cleaned === null) return null;
			const numberLike = cleaned.replace(/[^0-9.\-]/g, "");
			if (!numberLike || numberLike === "-" || numberLike === "." || numberLike === "-.") {
				return null;
			}
			const n = Number(numberLike);
			return Number.isFinite(n) ? n : null;
		}

		function normalizeImportedStatus(value) {
			const cleaned = normalizeImportedValue(value);
			if (!cleaned) return "available";
			const status = cleaned.toLowerCase();
			if (status === "sold") return "sold";
			if (status === "booked" || status === "reserved" || status === "pending") {
				return "booked";
			}
			return "available";
		}

		function getMappedImportRow(rawRow) {
			const mapped = {
				plot_number: null,
				size: null,
				dimension: null,
				facing: null,
				price: null,
				status: "available",
			};

			const headerMap = {
				plotnumber: "plot_number",
				plotno: "plot_number",
				plot: "plot_number",
				number: "plot_number",
				size: "size",
				plotsize: "size",
				area: "size",
				dimension: "dimension",
				dimensions: "dimension",
				plotdimension: "dimension",
				facing: "facing",
				face: "facing",
				direction: "facing",
				price: "price",
				amount: "price",
				rate: "price",
				cost: "price",
				status: "status",
				state: "status",
			};

			Object.keys(rawRow || {}).forEach((key) => {
				const normalizedHeader = String(key || "")
					.toLowerCase()
					.replace(/[^a-z0-9]/g, "");
				const target = headerMap[normalizedHeader];
				if (!target) return;
				if (target === "price") {
					mapped.price = normalizeImportedPrice(rawRow[key]);
					return;
				}
				if (target === "status") {
					mapped.status = normalizeImportedStatus(rawRow[key]);
					return;
				}
				mapped[target] = normalizeImportedValue(rawRow[key]);
			});

			const hasAnyValue =
				mapped.plot_number !== null ||
				mapped.size !== null ||
				mapped.dimension !== null ||
				mapped.facing !== null ||
				mapped.price !== null;

			return hasAnyValue ? mapped : null;
		}

		// âœ… Pagination Rendering
		function renderPagination(totalPages, currentPage) {
			let paginationHTML = "";

			const maxVisible = 3;
			let startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
			let endPage = Math.min(totalPages, startPage + maxVisible - 1);

			if (endPage - startPage < maxVisible - 1) {
				startPage = Math.max(1, endPage - maxVisible + 1);
			}

			paginationHTML += `
        <li class="page-item ${currentPage === 1 ? "disabled" : ""}">
          <a class="page-link" href="javascript:;" data-page="${currentPage - 1}">Previous</a>
        </li>
      `;

			for (let i = startPage; i <= endPage; i++) {
				paginationHTML += `
          <li class="page-item ${i === currentPage ? "active" : ""}">
            <a class="page-link" href="javascript:;" data-page="${i}">${i}</a>
          </li>`;
			}

			if (endPage < totalPages) {
				paginationHTML += `
          <li class="page-item">
            <a class="page-link" href="javascript:;" data-page="${totalPages}">Last</a>
          </li>
        `;
			}

			paginationHTML += `
        <li class="page-item ${currentPage === totalPages ? "disabled" : ""}">
          <a class="page-link" href="javascript:;" data-page="${currentPage + 1}">Next</a>
        </li>
      `;

			$("#paginationList").html(paginationHTML);
		}

		// âœ… Pagination click (delegate)
		$(document).on("click", "#paginationList .page-link", function (e) {
			e.preventDefault();
			const page = parseInt($(this).data("page"), 10);
			if (!page || $(this).closest("li").hasClass("disabled")) return;
			currentPage = page;
			loadPlots(currentPage, searchQuery);
		});

		// âœ… Search input
		$("#serchPlot").on("keyup", function () {
			searchQuery = $(this).val();
			loadPlots(1, searchQuery);
		});

		$("#importPlotsBtn").on("click", function () {
			$("#importPlotsFile").trigger("click");
		});

		$("#importPlotsFile").on("change", function () {
			const file = this.files && this.files[0];
			if (!file) return;

			if (typeof XLSX === "undefined") {
				Swal.fire("Error", "Excel library is not loaded. Please refresh and try again.", "error");
				$(this).val("");
				return;
			}

			const siteId = $("#site_id").val();
			if (!siteId) {
				Swal.fire("Error", "Site id is missing.", "error");
				$(this).val("");
				return;
			}

			const reader = new FileReader();
			reader.onload = function (e) {
				try {
					const workbook = XLSX.read(e.target.result, { type: "array" });
					const firstSheetName = workbook.SheetNames[0];
					if (!firstSheetName) {
						Swal.fire("Error", "No sheet found in file.", "error");
						return;
					}

					const worksheet = workbook.Sheets[firstSheetName];
					const rawRows = XLSX.utils.sheet_to_json(worksheet, { defval: null });

					if (!Array.isArray(rawRows) || rawRows.length === 0) {
						Swal.fire("Error", "Excel file is empty.", "error");
						return;
					}

					const rows = [];
					rawRows.forEach((rawRow) => {
						const mapped = getMappedImportRow(rawRow);
						if (mapped) rows.push(mapped);
					});

					if (rows.length === 0) {
						Swal.fire(
							"Error",
							"No valid rows found. Use headers like plot_number, size, dimension, facing, price, status.",
							"error",
						);
						return;
					}

					$.ajax({
						url: site_url + "plots/import_plots",
						type: "POST",
						dataType: "json",
						data: {
							site_id: siteId,
							rows: JSON.stringify(rows),
						},
						beforeSend: function () {
							Swal.fire({
								title: "Importing...",
								text: "Please wait while plots are imported.",
								allowOutsideClick: false,
								didOpen: () => Swal.showLoading(),
							});
						},
						success: function (res) {
							Swal.close();
							if (res.status === "success") {
								const msg = `Inserted: ${res.inserted || 0}\nSkipped Duplicates: ${
									res.skipped_duplicates || 0
								}\nSkipped Empty: ${res.skipped_empty || 0}`;
								Swal.fire("Success", msg, "success");
								currentPage = 1;
								loadPlots(currentPage, searchQuery);
							} else {
								Swal.fire("Error", res.message || "Import failed.", "error");
							}
						},
						error: function () {
							Swal.close();
							Swal.fire("Error", "Something went wrong while importing.", "error");
						},
						complete: function () {
							$("#importPlotsFile").val("");
						},
					});
				} catch (err) {
					Swal.fire("Error", "Invalid or unsupported file format.", "error");
					$("#importPlotsFile").val("");
				}
			};

			reader.readAsArrayBuffer(file);
		});

		// âœ… Delete plot with confirmation
		$(document).on("click", ".deletePlot", function () {
			const id = $(this).data("id");

			Swal.fire({
				title: "Delete this plot?",
				text: "This action cannot be undone.",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!",
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: site_url + "plots/delete_plot/" + id,
						method: "POST",
						success: function (res) {
							Swal.fire("Deleted!", "Plot has been deleted.", "success");
							loadPlots(currentPage, searchQuery);
						},
					});
				}
			});
		});

		// âœ… Initial Load
		loadPlots();
	}
});
$(document).ready(function () {
	if ($("#userTable").length) {
		let currentPage = 1;
		let searchQuery = "";

		// âœ… Fetch users with pagination + search
		function loadUsers(page = 1, search = "") {
			$.ajax({
				url: site_url + "user/get_users_ajax", // <-- your backend endpoint
				method: "GET",
				data: { page: page, search: search },
				success: function (response) {
					const res =
						typeof response === "string" ? JSON.parse(response) : response;

					if (res.status && res.data.length > 0) {
						let rows = "";

						$.each(res.data, function (i, user) {
							const statusBadge =
								user.isActive == 1
									? '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Active</div>'
									: '<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Inactive</div>';

							const profileImage = user.profile_image
								? `<img src="${site_url + user.profile_image}" width="40" height="40" class="rounded-circle">`
								: `<img src="${site_url}assets/images/default-user.png" width="40" height="40" class="rounded-circle">`;

							rows += `
                <tr>
                  <td>${(page - 1) * 10 + i + 1}</td>
                  <td>${user.name || "-"}</td>
                  <td>${user.mobile || "-"}</td>
                  <td>${user.email || "-"}</td>
                  <td>${profileImage}</td>
                  <td>${statusBadge}</td>
<td>${user.actual_salary_text}</td>
<td>${user.total_upad || "-"}</td>
<td>${user.payable_salary}</td>



                  <td>
                    <div class="d-flex order-actions">
                      <a href="${site_url}edit_user/${user.id}" class="text"><i class="bx bxs-edit"></i></a>
                      <a href="javascript:;" class="ms-3 text deleteUser" data-id="${user.id}"><i class="bx bxs-trash"></i></a>
                       <a href="${site_url}user/view_upad/${user.id}" class="text-primary">
            <i class="bx bx-show"></i>
        </a>
                    </div>
                  </td>
                </tr>
              `;
						});

						$("#userTable").html(rows);
						renderPagination(
							res.pagination.total_pages,
							res.pagination.current_page,
						);
					} else {
						$("#userTable").html(
							`<tr><td colspan="7" class="text-center text-muted">No users found</td></tr>`,
						);
						$(".pagination").html("");
					}
				},
			});
		}

		// âœ… Render pagination (3 visible + Last + Next)
		function renderPagination(totalPages, currentPage) {
			let paginationHTML = "";
			const maxVisible = 3;
			let startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
			let endPage = Math.min(totalPages, startPage + maxVisible - 1);

			if (endPage - startPage < maxVisible - 1) {
				startPage = Math.max(1, endPage - maxVisible + 1);
			}

			paginationHTML += `
        <li class="page-item ${currentPage === 1 ? "disabled" : ""}">
          <a class="page-link" href="javascript:;" onclick="loadUsers(${currentPage - 1}, '${searchQuery}')">Previous</a>
        </li>
      `;

			for (let i = startPage; i <= endPage; i++) {
				paginationHTML += `
          <li class="page-item ${i === currentPage ? "active" : ""}">
            <a class="page-link" href="javascript:;" onclick="loadUsers(${i}, '${searchQuery}')">${i}</a>
          </li>`;
			}

			if (endPage < totalPages) {
				paginationHTML += `
          <li class="page-item"><a class="page-link" href="javascript:;" onclick="loadUsers(${totalPages}, '${searchQuery}')">Last</a></li>
        `;
			}

			paginationHTML += `
        <li class="page-item ${currentPage === totalPages ? "disabled" : ""}">
          <a class="page-link" href="javascript:;" onclick="loadUsers(${currentPage + 1}, '${searchQuery}')">Next</a>
        </li>
      `;

			$(".pagination").html(paginationHTML);
		}

		// âœ… Search functionality
		$("#serchUser").on("keyup", function () {
			searchQuery = $(this).val();
			loadUsers(1, searchQuery);
		});

		// âœ… Delete user confirmation
		$(document).on("click", ".deleteUser", function () {
			const id = $(this).data("id");

			Swal.fire({
				title: "Delete this user?",
				text: "This action cannot be undone.",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!",
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: site_url + "user/delete_user/" + id,
						method: "POST",
						success: function () {
							Swal.fire("Deleted!", "User has been deleted.", "success");
							loadUsers(currentPage, searchQuery);
						},
					});
				}
			});
		});

		// âœ… Initial Load
		loadUsers();
	}
});

$(document).ready(function () {
	// Run only when upad table exists
	if ($("#upad_table").length === 0) return;

	let user_id = $("#user_id").val();
	// let admin_id = "<?= $this->admin['user_id'] ?>";

	let allData = [];
	let currentPage = 1;
	let perPage = 10;

	function loadUpad() {
		$.ajax({
			url: site_url + "user/get_user_upads",
			type: "POST",
			data: { user_id },
			success: function (res) {
				let response = typeof res === "string" ? JSON.parse(res) : res;

				if (response.status === false || response.data.length === 0) {
					$("#upad_table").html(`
                        <tr><td colspan="6" class="text-center">No UPAD Records Found</td></tr>
                    `);
					return;
				}

				allData = response.data;
				renderTable();
			},
		});
	}

	// Render table
	function renderTable() {
		let start = (currentPage - 1) * perPage;
		let end = start + perPage;

		let sliced = allData.slice(start, end);
		let html = "";

		sliced.forEach((r, i) => {
			html += `
                <tr>
                    <td>${start + i + 1}</td>
                    <td>${r.user_name}</td>
                    <td>â‚¹${r.amount}</td>
                    <td>${r.created_at}</td>
                    <td>${r.notes ?? ""}</td>
                   <td>
    <div class="d-flex order-actions">
        <a href="javascript:;" class="editUpad" data-id="${r.id}">
            <i class="bx bxs-edit"></i>
        </a>

        <a href="javascript:;" class="ms-3 deleteUpad" data-id="${r.id}">
            <i class="bx bxs-trash"></i>
        </a>
    </div>
</td>

                </tr>
            `;
		});

		$("#upad_table").html(html);
		renderPagination();
	}

	// Pagination logic (3 buttons + next / prev)
	function renderPagination() {
		let totalPages = Math.ceil(allData.length / perPage);
		let html = "";

		// Prev
		html += `<li class="page-item ${currentPage === 1 ? "disabled" : ""}">
                    <a class="page-link prevPage" href="javascript:;">Previous</a>
                 </li>`;

		let startPage = Math.floor((currentPage - 1) / 3) * 3 + 1;
		let endPage = Math.min(startPage + 2, totalPages);

		for (let p = startPage; p <= endPage; p++) {
			html += `
                <li class="page-item ${p === currentPage ? "active" : ""}">
                    <a class="page-link pageBtn" data-page="${p}" href="javascript:;">${p}</a>
                </li>
            `;
		}

		// Next
		html += `<li class="page-item ${currentPage === totalPages ? "disabled" : ""}">
                    <a class="page-link nextPage" href="javascript:;">Next</a>
                 </li>`;

		$(".pagination").html(html);
	}

	// Pagination click
	$(document).on("click", ".pageBtn", function () {
		currentPage = parseInt($(this).data("page"));
		renderTable();
	});

	$(document).on("click", ".prevPage", function () {
		if (currentPage > 1) {
			currentPage--;
			renderTable();
		}
	});

	$(document).on("click", ".nextPage", function () {
		let totalPages = Math.ceil(allData.length / perPage);
		if (currentPage < totalPages) {
			currentPage++;
			renderTable();
		}
	});

	// Search
	$("#serchupad").on("keyup", function () {
		let q = $(this).val().toLowerCase();

		let filtered = allData.filter(
			(x) =>
				x.user_name.toLowerCase().includes(q) ||
				x.amount.toString().includes(q) ||
				(x.notes ?? "").toLowerCase().includes(q),
		);

		allData = filtered;
		currentPage = 1;
		renderTable();
	});

	// Initial Load
	loadUpad();
});
$(document).on("click", ".deleteUpad", function () {
	let id = $(this).data("id");

	Swal.fire({
		title: "Delete UPAD?",
		text: "This action cannot be undone!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#3085d6",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: site_url + "user/delete_upad",
				type: "POST",
				data: { id },
				success: function (res) {
					let response = typeof res === "string" ? JSON.parse(res) : res;

					if (response.status) {
						Swal.fire("Deleted!", response.message, "success");
						location.reload();
					} else {
						Swal.fire("Error", response.message, "error");
					}
				},
			});
		}
	});
});

// expenses

$(document).ready(function () {
	let currentPage = 1;

	function normalizeDateForInput(rawDate) {
		if (!rawDate) return "";
		const str = String(rawDate).trim();
		if (/^\d{4}-\d{2}-\d{2}$/.test(str)) return str;
		const isoMatch = str.match(/^(\d{4}-\d{2}-\d{2})/);
		if (isoMatch) return isoMatch[1];
		const dmy = str.match(/^(\d{1,2})[\/-](\d{1,2})[\/-](\d{4})$/);
		if (dmy) {
			const dd = dmy[1].padStart(2, "0");
			const mm = dmy[2].padStart(2, "0");
			return `${dmy[3]}-${mm}-${dd}`;
		}
		const parsed = new Date(str);
		if (!isNaN(parsed.getTime())) {
			const yyyy = parsed.getFullYear();
			const mm = String(parsed.getMonth() + 1).padStart(2, "0");
			const dd = String(parsed.getDate()).padStart(2, "0");
			return `${yyyy}-${mm}-${dd}`;
		}
		return "";
	}

	function formatInr(value) {
		const num = Number(value || 0);
		return `₹${num.toLocaleString("en-IN", {
			minimumFractionDigits: 0,
			maximumFractionDigits: 2,
		})}`;
	}

	function updateExpenseSummary(summary) {
		const s = summary || {};
		$("#approvedTotal").text(formatInr(s.approved_amount || 0));
		$("#approvedCount").text(Number(s.approved_count || 0));
		$("#pendingTotal").text(formatInr(s.pending_amount || 0));
		$("#pendingCount").text(Number(s.pending_count || 0));
		$("#rejectTotal").text(formatInr(s.rejected_amount || 0));
		$("#rejectCount").text(Number(s.rejected_count || 0));
	}

	function loadExpenses(page = 1) {
		currentPage = page;
		if ($("#expensesTable").length === 0) return;

		let search = $("#serchexp").val();
		let site_id = $("#siteID").val();
		let monthFilter = $("#expMonthPicker").val();

		$.ajax({
			url: site_url + "site/get_expenses",
			type: "POST",
			data: {
				page: page,
				search: search,
				site_id: site_id,
				month_filter: monthFilter,
			},
			success: function (res) {
				res = typeof res === "string" ? JSON.parse(res) : res;
				if (!res || res.status !== true) {
					$("#expensesTable").html(
						'<tr><td colspan="9" class="text-center text-danger fw-bold py-3">Failed to load records</td></tr>',
					);
					buildPagination(0, 10, 1);
					updateExpenseSummary({});
					return;
				}
				updateExpenseSummary(res.summary || {});

				$("#expensesTable").html("");
				if (res.records.length === 0) {
					$("#expensesTable").html(`
        <tr>
            <td colspan="9" class="text-center text-danger fw-bold py-3">
                No Record Found
            </td>
        </tr>
    `);
					buildPagination(0, res.limit, res.page);
					return;
				}

				let indexStart = (page - 1) * 10 + 1;

				res.records.forEach((row, i) => {
					let imagesHtml = "";
					let imagesArr = [];
					if (row.expense_image) {
						let imgPath = row.expense_image;
						try {
							const parsed = JSON.parse(row.expense_image);
							if (Array.isArray(parsed) && parsed.length > 0) {
								imagesArr = parsed;
							} else if (typeof parsed === "string" && parsed) {
								imagesArr = [parsed];
							}
						} catch (e) {
							imagesArr = [imgPath];
						}

						imagesHtml = imagesArr
							.slice(0, 3)
							.map((p) => {
								const fullSrc = `${site_url}${p}`;
								return `<img src="${fullSrc}" data-full="${fullSrc}" class="siteImgPreview" style="width:40px;height:40px;object-fit:cover;border-radius:4px;margin-right:4px;cursor:pointer;" />`;
							})
							.join("");
					}

					if (!imagesArr.length) {
						imagesHtml = `<span class="d-inline-flex align-items-center justify-content-center border rounded bg-light text-secondary" style="width:40px;height:40px;" title="No image"><i class="bx bx-image-alt fs-5"></i></span>`;
					}

					const fullDesc = row.description || "";
					const shortDesc =
						fullDesc.length > 30 ? fullDesc.slice(0, 30) + "..." : fullDesc;
					const editDateValue = normalizeDateForInput(row.date || "");
					const currentImagePath = imagesArr.length ? imagesArr[0] : "";
					const encodedImages = encodeURIComponent(JSON.stringify(imagesArr));

					$("#expensesTable").append(`
                    <tr class="expense-row">
                        <td class="table-td">${indexStart + i}</td>
                        <td class="table-td"><span class="expense-site-chip"><i class="bx bx-building-house"></i>${row.site_name || "-"}</span></td>
                        <td class="table-td">${imagesHtml || ""}</td>
                        <td class="table-td"><span class="expense-user-chip"><span class="expense-user-dot"></span>${row.user_name || "-"}</span></td>

                        <td class="table-td">
                            <a href="javascript:;" class="expDesc text-decoration-none"
                               data-desc="${fullDesc.replace(/"/g, "&quot;")}"
                               data-images="${encodedImages}">
                                ${shortDesc || "-"}
                            </a>
                        </td>
                        <td class="table-td">${row.date || "-"}</td>
                        <td class="table-td"><span class="expense-amount-text">${formatInr(
													row.amount || 0,
												)}</span></td>

                        <td class="table-td">
                            <select class="form-select statusUpdate expense-status-select" data-id="${row.id}">
                                <option value="pending" ${row.status == "pending" ? "selected" : ""}>Pending</option>
                                <option value="approve" ${row.status == "approve" ? "selected" : ""}>Approve</option>
                                <option value="reject" ${row.status == "reject" ? "selected" : ""}>Reject</option>
                            </select>
                        </td>

                        <td class="table-td">
                            <div class="d-flex gap-1 justify-content-center">
                                        <a href="javascript:;" class="action-btn action-btn-edit editExp" 
                                           data-id="${row.id}"
                                           data-amount="${row.amount || ""}"
                                           data-date="${editDateValue}"
                                           data-image="${currentImagePath.replace(/"/g, "&quot;")}"
                                           data-desc="${fullDesc.replace(/"/g, "&quot;")}" title="Edit">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                      

                                        <a href="javascript:;" class="action-btn action-btn-delete deleteExp" data-id="${
																					row.id
																				}" title="Delete">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                        
                                    </div>
                        </td>
                    </tr>
                `);
				});

				buildPagination(res.total, res.limit, res.page);
			},
			error: function () {
				$("#expensesTable").html(
					'<tr><td colspan="9" class="text-center text-danger fw-bold py-3">Failed to load records</td></tr>',
				);
				buildPagination(0, 10, 1);
				updateExpenseSummary({});
			},
		});
	}

	function setDefaultCurrentMonth() {
		const $month = $("#expMonthPicker");
		if ($month.length === 0) return;
		if ($month.val()) return;

		const now = new Date();
		const yyyy = now.getFullYear();
		const mm = String(now.getMonth() + 1).padStart(2, "0");
		$month.val(`${yyyy}-${mm}`);
	}

	// Pagination with only 3 pages
	function buildPagination(total, limit, page) {
		let totalPages = Math.ceil(total / limit);
		let pagination = $("#expensePaginationList");

		// Hide pagination if only 1 page
		if (totalPages <= 1) {
			pagination.html("");
			return;
		}

		pagination.html("");

		pagination.append(`
        <li class="page-item ${page == 1 ? "disabled" : ""}">
            <a class="page-link" data-page="${page - 1}" href="#">Previous</a>
        </li>
    `);

		let start = Math.max(1, page - 1);
		let end = Math.min(totalPages, start + 2);

		for (let i = start; i <= end; i++) {
			pagination.append(`
            <li class="page-item ${i == page ? "active" : ""}">
                <a class="page-link" data-page="${i}" href="#">${i}</a>
            </li>
        `);
		}

		if (end < totalPages) {
			pagination.append(`
            <li class="page-item">
                <a class="page-link" data-page="${page + 1}" href="#">Next</a>
            </li>
        `);
		}
	}

	// âž¤ Click pagination
	$(document)
		.off("click.expensePagination", "#expensePaginationList .page-link")
		.on("click.expensePagination", "#expensePaginationList .page-link", function (e) {
			e.preventDefault();
			let p = $(this).data("page");
			if (p) {
				currentPage = p;
				loadExpenses(p);
			}
		});

	// âž¤ Search
	$("#serchexp").keyup(function () {
		currentPage = 1;
		loadExpenses(1);
	});

	$("#expMonthPicker").on("change", function () {
		currentPage = 1;
		loadExpenses(1);
	});

	$("#expShowAllBtn").on("click", function () {
		$("#expMonthPicker").val("");
		currentPage = 1;
		loadExpenses(1);
	});

	// âž¤ Delete
	$(document).on("click", ".deleteExp", function () {
		let id = $(this).data("id");

		Swal.fire({
			title: "Are you sure?",
			text: "This expense will be Remove.",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, Delete",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: site_url + "site/delete/" + id,
					type: "POST",
					success: function () {
						Swal.fire("Updated!", "Expense is Deleted.", "success");
						loadExpenses(currentPage);
					},
				});
			}
		});
	});

	// âž¤ Status change
	$(document).on("change", ".statusUpdate", function () {
		let id = $(this).data("id");
		let newStatus = $(this).val();
		let element = $(this);

		element.data("old", element.val());

		Swal.fire({
			title: "Change Status?",
			text: "Do you want to update this status?",
			icon: "question",
			showCancelButton: true,
			confirmButtonText: "Yes, update",
			cancelButtonText: "Cancel",
		}).then((result) => {
			if (result.isConfirmed) {
				$.post(
					site_url + "site/update_status",
					{ id, status: newStatus },
					function () {
						Swal.fire("Updated!", "Status changed successfully.", "success");
					},
				);
			} else {
				element.val(element.data("old")); // reset to old status if cancelled
			}
		});
	});

	$(document).on("click", ".editExp", function () {
		if ($("#expensesTable").length === 0) return;

		const id = $(this).data("id");
		const amount = $(this).data("amount");
		const date = normalizeDateForInput($(this).data("date"));
		const desc = $(this).data("desc");
		const currentImage = ($(this).data("image") || "").toString().trim();
		const currentImageUrl = currentImage ? `${site_url}${currentImage}` : "";

		Swal.fire({
			title: "Edit Expense",
			width: 760,
			html: `
				<div class="text-start" style="padding:6px 8px 0;">
					<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
						<div>
							<label class="form-label mb-1">Amount</label>
							<input type="number" id="editExpAmount" class="form-control" value="${amount}" min="0">
						</div>
						<div>
							<label class="form-label mb-1">Date</label>
							<input type="date" id="editExpDate" class="form-control" value="${date}">
						</div>
					</div>
					<div style="margin-top:12px;">
						<label class="form-label mb-1">Description</label>
						<textarea id="editExpDesc" class="form-control" rows="3">${desc || ""}</textarea>
					</div>
					<div style="margin-top:12px;">
						<label class="form-label mb-1">Expense Image (optional)</label>
						<input type="file" id="editExpImage" class="form-control" accept="image/*">
					</div>
					<div style="margin-top:12px;display:flex;gap:16px;flex-wrap:wrap;">
						<div>
							<div class="text-muted" style="font-size:12px;margin-bottom:6px;">Current image</div>
							<div id="editExpCurrentWrap" style="width:120px;height:90px;border:1px solid #e6e8eb;border-radius:8px;display:flex;align-items:center;justify-content:center;background:#f8f9fa;overflow:hidden;">
								${
									currentImageUrl
										? `<img src="${currentImageUrl}" id="editExpCurrentImg" style="width:100%;height:100%;object-fit:cover;" alt="Current expense image">`
										: `<i class="bx bx-image-alt" style="font-size:26px;color:#9aa3af;"></i>`
								}
							</div>
						</div>
						<div>
							<div class="text-muted" style="font-size:12px;margin-bottom:6px;">Selected new image</div>
							<div id="editExpPreviewWrap" style="width:120px;height:90px;border:1px dashed #cfd5db;border-radius:8px;display:flex;align-items:center;justify-content:center;background:#fafbfc;overflow:hidden;">
								<i class="bx bx-upload" style="font-size:24px;color:#b0b7c3;"></i>
							</div>
						</div>
					</div>
				</div>
			`,
			showCancelButton: true,
			confirmButtonText: "Update",
			didOpen: () => {
				const fileInput = document.getElementById("editExpImage");
				const previewWrap = document.getElementById("editExpPreviewWrap");
				if (!fileInput || !previewWrap) return;

				fileInput.addEventListener("change", function () {
					const file = this.files && this.files[0];
					if (!file) {
						previewWrap.innerHTML =
							'<i class="bx bx-upload" style="font-size:24px;color:#b0b7c3;"></i>';
						return;
					}
					if (!file.type.startsWith("image/")) {
						Swal.showValidationMessage("Please select a valid image file");
						this.value = "";
						previewWrap.innerHTML =
							'<i class="bx bx-upload" style="font-size:24px;color:#b0b7c3;"></i>';
						return;
					}

					const reader = new FileReader();
					reader.onload = function (event) {
						previewWrap.innerHTML = `<img src="${event.target.result}" style="width:100%;height:100%;object-fit:cover;" alt="New expense image">`;
					};
					reader.readAsDataURL(file);
				});
			},
			preConfirm: () => {
				const editAmount = $("#editExpAmount").val();
				const editDate = $("#editExpDate").val();
				const editDesc = $("#editExpDesc").val();

				if (!editAmount || !editDate || !editDesc) {
					Swal.showValidationMessage(
						"Amount, date and description are required",
					);
					return false;
				}

				const formData = new FormData();
				formData.append("id", id);
				formData.append("price", editAmount);
				formData.append("date", editDate);
				formData.append("description", editDesc);

				const fileInput = document.getElementById("editExpImage");
				if (fileInput && fileInput.files && fileInput.files[0]) {
					formData.append("expense_image", fileInput.files[0]);
				}

				return $.ajax({
					url: site_url + "site/update_expense",
					type: "POST",
					data: formData,
					processData: false,
					contentType: false,
				})
					.then((res) => {
						const data = typeof res === "string" ? JSON.parse(res) : res;
						if (!data.status) {
							throw new Error(data.message || "Update failed");
						}
						return data;
					})
					.catch((err) => {
						Swal.showValidationMessage(err.message || "Update failed");
						return false;
					});
			},
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire("Updated!", "Expense updated successfully.", "success");
				loadExpenses(currentPage);
			}
		});
	});

	// INITIAL LOAD
	setDefaultCurrentMonth();
	loadExpenses(1);
});

// âž¤ Show full description modal
$(document).on("click", ".expDesc", function () {
	const desc = $(this).data("desc") || "";
	const imagesEncoded = $(this).data("images") || "";
	let images = [];
	try {
		images = JSON.parse(decodeURIComponent(imagesEncoded)) || [];
	} catch (e) {
		images = [];
	}

	$("#expDescText").text(desc || "-");
	const $imgWrap = $("#expDescImages");
	const $imgEmpty = $("#expDescImagesEmpty");
	$imgWrap.html("");
	$imgEmpty.addClass("d-none");
	if (images.length > 0) {
		images.forEach((p) => {
			$imgWrap.append(
				`<img src="${site_url}${p}" data-full="${site_url}${p}" class="expImagePreview" />`,
			);
		});
	} else {
		$imgEmpty.removeClass("d-none");
	}

	const modal = new bootstrap.Modal(document.getElementById("expDescModal"));
	modal.show();
});

// âž¤ Show full image from expense modal
$(document).on("click", ".expImagePreview", function () {
	const src = $(this).data("full") || $(this).attr("src");
	$("#siteImageModalImg").attr("src", src || "");
	// Close description modal before showing full image
	const expModalEl = document.getElementById("expDescModal");
	if (expModalEl) {
		const expModal = bootstrap.Modal.getInstance(expModalEl);
		if (expModal) expModal.hide();
	}
	const modal = new bootstrap.Modal(document.getElementById("siteImageModal"));
	modal.show();
});

// âž¤ Show full site image
$(document).on("click", ".siteImgPreview", function () {
	const src = $(this).data("full") || $(this).attr("src");
	$("#siteImageModalImg").attr("src", src || "");
	const modal = new bootstrap.Modal(document.getElementById("siteImageModal"));
	modal.show();
});

// Ensure dark transparent backdrop for site image modal
$(document).on("shown.bs.modal", "#siteImageModal", function () {
	$(".modal-backdrop").last().addClass("site-image-backdrop");
});

$(document).ready(function () {
	if (!document.getElementById("inquiryTableBody")) return;

	let currentPage = 1;

	function loadInquiries(page = 1, search = "") {
		$.ajax({
			url: site_url + "dashboard/fetch_inquiries",
			type: "POST",
			data: { page: page, search: search },
			dataType: "json",
			success: function (res) {
				let tbody = "";

				// If NO DATA, show message
				if (!res.data || res.data.length === 0) {
					tbody = `
                    <tr>
                        <td colspan="9" class="text-center text-danger fw-bold">
                            No Record Found
                        </td>
                    </tr>`;
					$("#inquiryTableBody").html(tbody);
					renderPagination(0, res.limit, res.page);
					return;
				}

				res.data.forEach((row, index) => {
					// Safe note handling
					let note = row.note ? row.note : "";

					// Short note
					let shortNote =
						note.length > 20 ? note.substring(0, 20) + "..." : note;

					// Format date only (YYYY-MM-DD)
					let formattedDate = row.created_at
						? row.created_at.split(" ")[0]
						: "";

					tbody += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${row.user_name}</td>
                        <td>${row.name}</td>
                        <td>${row.plot_number}</td>
                        <td>${row.customer_name}</td>
                        <td>${row.mobile}</td>

                        <td title="${note}">${shortNote}</td>

                        <td>${formattedDate}</td>

                        <td>
                            <div class="d-flex order-actions">
                                <a href="javascript:;" 
                                   class="ms-3 deleteInquiry" 
                                   data-id="${row.id}">
                                    <i class="bx bxs-trash text-danger fs-5"></i>
                                </a>
                            </div>
                        </td>
                    </tr>`;
				});

				$("#inquiryTableBody").html(tbody);
				renderPagination(res.total, res.limit, res.page);
			},
		});
	}

	function renderPagination(total, limit, page) {
		let totalPages = Math.ceil(total / limit);
		let html = "";

		// Previous
		html += `<li class="page-item ${page === 1 ? "disabled" : ""}">
                    <a class="page-link" href="#" data-page="${page - 1}">Previous</a>
                </li>`;

		// Show only 3 numbers
		let start = Math.max(1, page - 1);
		let end = Math.min(totalPages, start + 2);

		for (let i = start; i <= end; i++) {
			html += `<li class="page-item ${page === i ? "active" : ""}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>`;
		}

		// Next
		html += `<li class="page-item ${page === totalPages ? "disabled" : ""}">
                    <a class="page-link" href="#" data-page="${page + 1}">Next</a>
                </li>`;

		$(".pagination").html(html);
	}

	// Pagination Click
	$(document).on("click", ".page-link", function () {
		let page = $(this).data("page");
		if (!page || page < 1) return;

		currentPage = page;
		loadInquiries(page, $("#serchinquiry").val());
	});

	// Search
	$("#serchinquiry").on("keyup", function () {
		let keyword = $(this).val();
		loadInquiries(1, keyword);
	});

	// Initial Load
	loadInquiries();
	// DELETE INQUIRY (SOFT DELETE)
	$(document).on("click", ".deleteInquiry", function () {
		let id = $(this).data("id");

		Swal.fire({
			title: "Are you sure?",
			text: "This inquiry will be marked as inactive.",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, Delete",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: site_url + "dashboard/delete_inquiry",
					type: "POST",
					data: { id: id },
					dataType: "json",

					success: function (res) {
						if (res.status) {
							Swal.fire("Deleted!", res.message, "success");
							loadInquiries(1, $("#serchinquiry").val()); // reload list
						} else {
							Swal.fire("Error", res.message, "error");
						}
					},
				});
			}
		});
	});
});
// Run only if the table exists
if ($("#attedanceTableBody").length) {
	function loadAttendance(page = 1, search = "") {
		$.ajax({
			url: site_url + "dashboard/fetch_attendance",
			type: "POST",
			data: { page: page, search: search },
			dataType: "json",
			success: function (res) {
				let tbody = "";

				if (res.data.length === 0) {
					tbody = `<tr><td colspan="7" class="text-center text-danger">No Record Found</td></tr>`;
					$("#attedanceTableBody").html(tbody);
					$(".pagination").html("");
					return;
				}

				res.data.forEach((row, index) => {
					let dt = row.attendance_time ? row.attendance_time : "";

					function getStatusUI(status) {
						let color = "";
						let label = status.charAt(0).toUpperCase() + status.slice(1); // Capitalize

						if (status === "pending") color = "text-warning";
						if (status === "present") color = "text-success";
						if (status === "absent") color = "text-danger";
						if (status === "rejected") color = "text-danger";

						return `
        <div class="d-flex align-items-center ${color}">
            <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
            <span>${label}</span>
        </div>`;
					}

					tbody += `
<tr>
    <td>${index + 1}</td>
    <td>${row.user_name}</td>
    <td>
        <img src="${row.image_path}" width="60" height="60" class="rounded">
    </td>

    <td>${dt}</td>

    <td>
        ${getStatusUI(row.status)}
    </td>

    <td>${row.mobile}</td>

    <td>
        <div class="d-flex order-actions gap-2">

            <!-- DELETE BUTTON -->
            <a href="javascript:;" 
               class="ms-3 text deleteAttendance"  
               data-id="${row.id}">
               <i class="bx bxs-trash"></i>
            </a>
                  <!-- STATUS DROPDOWN -->
            <div class="dropdown">
    <a href="javascript:;" class="text-dark" data-bs-toggle="dropdown">
        <i class="bx bx-dots-vertical-rounded font-20"></i>
    </a>

    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item changeStatus" data-id="${row.id}" data-status="present">
                <i class="bx bx-check-circle me-2 text-success"></i> Present
            </a>
        </li>

        <li>
            <a class="dropdown-item changeStatus" data-id="${row.id}" data-status="absent">
                <i class="bx bx-x-circle me-2 text-danger"></i> Absent
            </a>
        </li>

        <li>
            <a class="dropdown-item changeStatus" data-id="${row.id}" data-status="rejected">
                <i class="bx bx-block me-2 text-danger"></i> Rejected
            </a>
        </li>
    </ul>
</div>
            </div>
            
      
            
    </td>
</tr>`;
				});

				$("#attedanceTableBody").html(tbody);

				renderAttedancePagination(res.total, res.limit, res.page);
			},
		});
	}

	function renderAttedancePagination(total, limit, currentPage) {
		let totalPages = Math.ceil(total / limit);
		let html = "";

		html += `<li class="page-item ${currentPage == 1 ? "disabled" : ""}">
                    <a class="page-link" href="javascript:;" onclick="loadAttendance(${currentPage - 1})">Previous</a>
                 </li>`;

		let start = Math.max(1, currentPage - 1);
		let end = Math.min(totalPages, start + 2);

		for (let i = start; i <= end; i++) {
			html += `
                <li class="page-item ${i == currentPage ? "active" : ""}">
                    <a class="page-link" href="javascript:;" onclick="loadAttendance(${i})">${i}</a>
                </li>`;
		}

		if (end < totalPages) {
			html += `
                <li class="page-item">
                    <a class="page-link" href="javascript:;" onclick="loadAttendance(${currentPage + 1})">Next</a>
                </li>`;
		}

		$(".pagination").html(html);
	}

	// Search Event
	$("#serchattedance").on("keyup", function () {
		let val = $(this).val();
		loadAttendance(1, val);
	});

	// Load first page on initial page load
	loadAttendance();
}

// Change status click event
$(document).on("click", ".changeStatus", function () {
	let id = $(this).data("id");
	let newStatus = $(this).data("status");

	$.ajax({
		url: site_url + "dashboard/update_status",
		type: "POST",
		data: {
			id: id,
			status: newStatus,
		},
		dataType: "json",
		success: function (res) {
			if (res.status === true) {
				Swal.fire({
					icon: "success",
					title: "Status Updated!",
					text: res.message,
					timer: 1500,
					showConfirmButton: false,
				});

				loadAttendance(); // Reload table
			} else {
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: res.message,
				});
			}
		},
		error: function () {
			Swal.fire({
				icon: "error",
				title: "Server Error",
				text: "Unable to update status.",
			});
		},
	});
});

$(document).on("click", ".deleteAttendance", function () {
	let id = $(this).data("id");

	Swal.fire({
		title: "Are you sure?",
		text: "This attendance will be removed!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: "Yes, Delete",
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(
				site_url + "dashboard/delete_attendance",
				{ id: id },
				function (res) {
					Swal.fire("Deleted!", "Attendance removed.", "success");
					loadAttendance();
				},
				"json",
			);
		}
	});
});
$(document).ready(function () {
	// Run code ONLY if #payment_data table exists
	if ($("#payment_data").length > 0) {
		let buyer_id = $("#buyer_id").val();
		let currentPage = 1;

		function loadPaymentData(page = 1, search = "") {
			currentPage = page;

			if (!buyer_id) {
				$("#payment_data").html(
					`<tr><td colspan='8' class="text-center text-danger">Buyer ID missing</td></tr>`,
				);
				$(".pagination").html("");
				return;
			}

			$.ajax({
				url: site_url + "plots/payment_data_api",
				method: "POST",
				data: {
					buyer_id: buyer_id,
					page: page,
					search: search,
				},
				dataType: "json",
				success: function (res) {
					if (!res.status) {
						$("#payment_data").html(
							`<tr><td colspan='8' class="text-center">${res.message}</td></tr>`,
						);
						$(".pagination").html(""); // clear pagination if no data
						return;
					}

					if (!res.logs || res.logs.length === 0) {
						$("#payment_data").html(
							`<tr><td colspan='8' class="text-center text-muted">No payment records found</td></tr>`,
						);
						$(".pagination").html("");
						return;
					}

					let html = "";
					let index = (page - 1) * 10 + 1;

					res.logs.forEach((log) => {
						html += `
                            <tr>
                                <td>${index++}</td>
                                <td>${res.user?.name ?? "-"}</td>
                                <td>${res.buyer?.name ?? "-"}</td>
                                <td>${res.plot?.site_name ?? "-"}</td>
                                <td>${res.plot?.plot_number ?? "-"}</td>
                                <td>${log.created_on}</td>
                                <td>â‚¹${log.paid_amount}</td>
                                 <td>
                            <select class="form-select statuspayment" data-id="${log.id}">
                    <option value="pending" ${log.status == "pending" ? "selected" : ""}>Pending</option>
                    <option value="approve" ${log.status == "approve" ? "selected" : ""}>Approve</option>
                    <option value="reject" ${log.status == "reject" ? "selected" : ""}>Reject</option>
                </select>
                        </td>
                            </tr>`;
					});

					$("#payment_data").html(html);

					loadPagination(
						res.pagination.total_pages,
						res.pagination.current_page,
					);
				},
			});
		}

		// Pagination rendering
		function loadPagination(totalPages, current) {
			let phtml = "";

			phtml += `<li class="page-item ${current == 1 ? "disabled" : ""}">
                        <a class="page-link" href="#" data-page="${current - 1}">Previous</a>
                      </li>`;

			for (let i = 1; i <= totalPages; i++) {
				phtml += `<li class="page-item ${i == current ? "active" : ""}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                          </li>`;
			}

			phtml += `<li class="page-item ${current == totalPages ? "disabled" : ""}">
                        <a class="page-link" href="#" data-page="${current + 1}">Next</a>
                      </li>`;

			$(".pagination").html(phtml);
		}

		// Pagination Click
		$(document).on("click", ".pagination a", function (e) {
			e.preventDefault();
			let page = $(this).data("page");
			if (page) loadPaymentData(page, $("#serchPlot").val());
		});

		// Search
		$("#serchPlot").on("keyup", function () {
			loadPaymentData(1, $(this).val());
		});

		// Initial Load
		loadPaymentData();
	}
});
$(document).on("change", ".statuspayment", function () {
	let log_id = $(this).data("id");
	let status = $(this).val();

	Swal.fire({
		title: "Are you sure?",
		text: "Do you want to update this status?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: "Yes, Update",
		cancelButtonText: "Cancel",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: site_url + "plots/update_payment_status",
				method: "POST",
				data: { id: log_id, status: status },
				success: function (res) {
					console.log("Status updated:", res);
					Swal.fire(
						"Updated!",
						"Payment status updated successfully.",
						"success",
					);
				},
				error: function () {
					Swal.fire("Error", "Server error!", "error");
				},
			});
		}
	});
});
$("#avatar-img").on("click", function () {
	$("#avatar-upload").click();
});

// âœ… Preview selected image instantly
$("#avatar-upload").on("change", function () {
	const file = this.files[0];
	if (file) {
		const reader = new FileReader();
		reader.onload = function (e) {
			$("#avatar-img").attr("src", e.target.result);
		};
		reader.readAsDataURL(file);
	}
});

$(document).on("click", ".update_form", function () {
	// Clear previous errors
	$(".error-msg").html("");

	let name = $("#fullName").val().trim();
	let email = $("#email").val().trim();
	let mobile = $("#mobile").val().trim();
	let password = $("#password").val().trim();

	let isValid = true;

	// âœ… Name validation
	if (name === "") {
		$("#fullName")
			.closest(".col-sm-9")
			.find(".error-msg")
			.text("Full name is required");
		isValid = false;
	}

	// âœ… Email validation
	if (email === "") {
		$("#email")
			.closest(".col-sm-9")
			.find(".error-msg")
			.text("Email is required");
		isValid = false;
	} else if (!validateEmail(email)) {
		$("#email")
			.closest(".col-sm-9")
			.find(".error-msg")
			.text("Enter a valid email address");
		isValid = false;
	}

	// âŒ Stop if validation fails
	if (!isValid) return;

	// âœ… MUST use FormData for file upload
	let formData = new FormData();
	formData.append("name", name);
	formData.append("email", email);
	formData.append("mobile", mobile);
	formData.append("password", password);

	// âœ… Profile image (optional)
	const file = $("#avatar-upload")[0].files[0];
	if (file) {
		formData.append("profile_image", file);
	}

	// âœ… AJAX Request
	$.ajax({
		url: site_url + "profile/update_profile",
		type: "POST",
		data: formData,
		processData: false, // ðŸ”´ REQUIRED
		contentType: false, // ðŸ”´ REQUIRED
		dataType: "json",

		beforeSend: function () {
			$(".update_form").prop("disabled", true).val("Updating...");
		},

		success: function (response) {
			if (response.status === 200) {
				Swal.fire({
					icon: "success",
					title: "Profile Updated",
					text: response.message,
					confirmButtonColor: "#3085d6",
				});
			} else {
				Swal.fire({
					icon: "error",
					title: "Error",
					text: response.message,
				});
			}
		},

		error: function () {
			Swal.fire({
				icon: "error",
				title: "Server Error",
				text: "Something went wrong. Please try again.",
			});
		},

		complete: function () {
			$(".update_form").prop("disabled", false).val("Update Profile");
		},
	});
});

// âœ… Email validator
function validateEmail(email) {
	let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	return regex.test(email);
}

const printBtn = document.getElementById("printBtn");

if (printBtn) {
	printBtn.addEventListener("click", function () {
		let buyerInput = document.getElementById("buyer_id");

		if (!buyerInput) return;

		let buyer_id = buyerInput.value;

		if (!buyer_id) {
			Swal.fire({
				icon: "warning",
				title: "Buyer not selected",
				text: "Please select a buyer first",
			});
			return;
		}

		fetch(site_url + "plots/download_pdf/" + buyer_id, {
			method: "GET",
		})
			.then((response) => response.blob())
			.then((blob) => {
				const url = window.URL.createObjectURL(blob);
				const a = document.createElement("a");

				a.style.display = "none";
				a.href = url;
				a.download = "Buyer_Statement_" + buyer_id + ".pdf";

				document.body.appendChild(a);
				a.click();

				window.URL.revokeObjectURL(url);
				a.remove();
			})
			.catch(() => {
				Swal.fire({
					icon: "error",
					title: "Download failed",
					text: "Unable to generate PDF",
				});
			});
	});
}

$(document).ready(function () {
	let adminPage = 1;
	let adminSearch = "";
	let sitePage = 1;
	let siteSearch = "";
	let siteSearchTimer = null;
	let adminSearchTimer = null;

	function applyTableFilter(tbodySelector, query, colspan) {
		const q = (query || "").trim().toLowerCase();
		const $tbody = $(tbodySelector);
		if ($tbody.length === 0) return;

		$tbody.find("tr.js-no-results").remove();

		if (!q) {
			$tbody.find("tr").show();
			return;
		}

		let visible = 0;
		$tbody.find("tr").each(function () {
			const text = $(this).text().toLowerCase();
			const match = text.indexOf(q) !== -1;
			$(this).toggle(match);
			if (match) visible++;
		});

		if (visible === 0) {
			$tbody.append(
				`<tr class="js-no-results"><td colspan="${colspan}" class="text-center text-muted">No results found</td></tr>`,
			);
		}
	}

	function renderPagination(containerId, pagination) {
		if (!pagination || !pagination.total_pages) {
			$(containerId).html("");
			return;
		}
		let html = "";
		const total = pagination.total_pages;
		const current = pagination.current_page;

		html += `<li class="page-item ${current === 1 ? "disabled" : ""}">
                <a class="page-link" href="javascript:;" data-page="${current - 1}">Previous</a>
             </li>`;

		let start = Math.max(1, current - 1);
		let end = Math.min(start + 2, total);

		if (start > 1)
			html += `<li class="page-item"><a class="page-link" href="javascript:;" data-page="1">1</a></li>`;
		if (start > 2)
			html += `<li class="page-item disabled"><a class="page-link">...</a></li>`;

		for (let i = start; i <= end; i++) {
			html += `<li class="page-item ${i === current ? "active" : ""}">
                  <a class="page-link" href="javascript:;" data-page="${i}">${i}</a>
               </li>`;
		}

		if (end < total - 1)
			html += `<li class="page-item disabled"><a class="page-link">...</a></li>`;
		if (end < total)
			html += `<li class="page-item"><a class="page-link" href="javascript:;" data-page="${total}">${total}</a></li>`;

		html += `<li class="page-item ${current === total ? "disabled" : ""}">
                <a class="page-link" href="javascript:;" data-page="${current + 1}">Next</a>
             </li>`;

		$(containerId).html(html);
	}

	function getPageFromLink($link, containerId) {
		let page = parseInt($link.data("page"), 10);
		if (page) return page;
		const text = ($link.text() || "").trim().toLowerCase();
		const current =
			parseInt(
				$(containerId).find("li.active .page-link").first().text(),
				10,
			) || 1;
		if (text === "previous") return current - 1;
		if (text === "next") return current + 1;
		return null;
	}

	function loadAdmins(page = 1, search = "") {
		if (!$("#superAdminTable").length) return;
		$.ajax({
			url: site_url + "superadmin/get_admins",
			method: "GET",
			data: { page: page, search: search },
			dataType: "json",
			success: function (res) {
				if (res.status && res.data && res.data.length > 0) {
					let rows = "";
					res.data.forEach((admin, i) => {
						const isActive = parseInt(admin.isActive || 0) === 1;
						const statusBadge = isActive
							? '<span class="badge bg-success-light text-success">✓ Active</span>'
							: '<span class="badge bg-danger-light text-danger">✗ Inactive</span>';

						const sitesBtn = `
							<a class="btn btn-sm btn-outline-info" href="${site_url}superadmin/admin_sites/${admin.id}" title="View sites">
								<i class="bx bx-map"></i> <span class="badge bg-info">${admin.sites_count || 0}</span>
							</a>
						`;

						const plotsBtn = `
							<a class="btn btn-sm btn-outline-warning" href="${site_url}superadmin/admin_plots/${admin.id}" title="View plots">
								<i class="bx bx-grid-alt"></i> <span class="badge bg-warning">${admin.plots_count || 0}</span>
							</a>
						`;

						const actionBtns = `
							<div class="btn-group btn-group-sm" role="group">
								<button type="button" class="btn ${isActive ? "btn-outline-danger" : "btn-outline-success"} toggleAdminStatus" 
									data-id="${admin.id}" data-next-status="${isActive ? 0 : 1}" 
									title="${isActive ? "Deactivate" : "Activate"}">
									<i class="bx ${isActive ? "bx-x" : "bx-check"}"></i>
								</button>
								<a class="btn btn-outline-primary ${isActive ? "" : "disabled"}" href="${site_url}superadmin/login_as_admin/${admin.id}" 
									target="_blank" title="Login as admin">
									<i class="bx bx-log-in"></i>
								</a>
							</div>
						`;

						rows += `
							<tr>
								<td class="fw-semibold">${i + 1}</td>
								<td class="fw-semibold">${admin.name || "-"}</td>
								<td><small>${admin.business_name || "-"}</small></td>
								<td><small>${admin.mobile || "-"}</small></td>
								<td class="text-center">${statusBadge}</td>
								<td class="text-center">${sitesBtn}</td>
								<td class="text-center">${plotsBtn}</td>
								<td class="text-center">${actionBtns}</td>
							</tr>
						`;
					});
					$("#superAdminTable").html(rows);
					renderPagination("#adminPagination", res.pagination);
					applyTableFilter("#superAdminTable", search, 8);
				} else {
					$("#superAdminTable").html(
						'<tr><td colspan="8" class="text-center text-muted">No admins found</td></tr>',
					);
					renderPagination("#adminPagination", {
						total_pages: 0,
						current_page: 1,
					});
				}
			},
			error: function () {
				$("#superAdminTable").html(
					'<tr><td colspan="8" class="text-center text-danger">Failed to load admins</td></tr>',
				);
				renderPagination("#adminPagination", {
					total_pages: 0,
					current_page: 1,
				});
			},
		});
	}

	function loadSuperSites(page = 1, search = "") {
		if (!$("#superAdminSitesTable").length) return;
		$.ajax({
			url: site_url + "superadmin/get_all_sites",
			method: "GET",
			data: { page: page, search: search },
			dataType: "json",
			success: function (res) {
				if (res.status && res.data && res.data.length > 0) {
					let rows = "";
					res.data.forEach((site, i) => {
						const imgStatus = site.site_images_status || "";
						const hasImages =
							site.site_images &&
							site.site_images !== "NULL" &&
							site.site_images !== "null";
						const hasApprovedImages = imgStatus === "approve" && hasImages;
						const hasMap =
							site.site_map &&
							site.site_map !== "NULL" &&
							site.site_map !== "null";

						let imageBadge = "";
						if (imgStatus === "pending") {
							imageBadge =
								'<span class="badge bg-warning-light text-warning">Pending</span>';
						} else if (imgStatus === "reject") {
							imageBadge =
								'<span class="badge bg-danger-light text-danger">Rejected</span>';
						} else if (hasApprovedImages) {
							let images = [];
							try {
								images = JSON.parse(site.site_images) || [];
							} catch (e) {}
							if (images.length > 0) {
								imageBadge =
									'<div style="text-align:center;"><img src="' +
									site_url +
									images[0] +
									'" style="width:100px;height:100px;object-fit:cover;border-radius:6px;"></div>';
							} else {
								imageBadge =
									'<span class="badge bg-secondary-light text-secondary">No Images</span>';
							}
						} else {
							imageBadge =
								'<span class="badge bg-secondary-light text-secondary">No Images</span>';
						}

						const mapBadge = hasMap
							? '<span class="badge bg-success-light text-success">✓ Yes</span>'
							: '<span class="badge bg-secondary-light text-secondary">✗ No</span>';

						const viewBtn = `<button class="btn btn-sm btn-primary viewSiteDetail" data-id="${site.id}" title="View Details"><i class="bx bx-show"></i></button>`;
						const uploadBtn = `<button type="button" class="btn btn-sm btn-success uploadSiteMap" data-id="${site.id}" data-has-images="${hasApprovedImages ? "1" : "0"}" data-has-map="${hasMap ? "1" : "0"}" data-bs-toggle="modal" data-bs-target="#siteMapUploadModal" title="Upload Map"><i class="bx bx-upload"></i></button>`;

						rows += `
							<tr>
								<td class="fw-semibold">${i + 1}</td>
								<td class="fw-semibold">${site.name || "-"}</td>
								<td><small>${site.admin_name || "-"}</small></td>
								<td><small>${site.location || "-"}</small></td>
								<td class="text-center"><span class="badge bg-info">${site.total_plots || 0}</span></td>
								<td class="text-center">${imageBadge}</td>
								<td class="text-center">${mapBadge}</td>
								<td class="text-center">
									<div class="btn-group btn-group-sm" role="group">
										${viewBtn}
										${uploadBtn}
									</div>
								</td>
							</tr>
						`;
					});
					$("#superAdminSitesTable").html(rows);
					renderPagination("#sitePagination", res.pagination);
					applyTableFilter("#superAdminSitesTable", search, 8);
				} else {
					$("#superAdminSitesTable").html(
						'<tr><td colspan="8" class="text-center text-muted">No sites found</td></tr>',
					);
					renderPagination("#sitePagination", {
						total_pages: 0,
						current_page: 1,
					});
				}
			},
			error: function () {
				$("#superAdminSitesTable").html(
					'<tr><td colspan="8" class="text-center text-danger">Failed to load sites</td></tr>',
				);
				renderPagination("#sitePagination", {
					total_pages: 0,
					current_page: 1,
				});
			},
		});
	}

	function loadAdminSites(adminId, page = 1, search = "") {
		if (!adminId || !$("#adminSitesTable").length) return;
		$.ajax({
			url: site_url + "superadmin/get_admin_sites/" + adminId,
			method: "GET",
			data: { page: page, search: search },
			dataType: "json",
			success: function (res) {
				if (res.status && res.data && res.data.length > 0) {
					let rows = "";
					let startIndex = (page - 1) * 5 + 1;
					res.data.forEach((site, i) => {
						const imgStatus = site.site_images_status || "";
						const hasImages =
							site.site_images &&
							site.site_images !== "NULL" &&
							site.site_images !== "null";
						const hasApprovedImages = imgStatus === "approve" && hasImages;
						const hasMap =
							site.site_map &&
							site.site_map !== "NULL" &&
							site.site_map !== "null";

						let imageBadge = "";
						if (imgStatus === "pending") {
							imageBadge =
								'<span class="badge bg-warning-light text-warning">Pending</span>';
						} else if (imgStatus === "reject") {
							imageBadge =
								'<span class="badge bg-danger-light text-danger">Rejected</span>';
						} else if (hasApprovedImages) {
							let images = [];
							try {
								images = JSON.parse(site.site_images) || [];
							} catch (e) {}
							if (images.length > 0) {
								imageBadge =
									'<div style="text-align:center;"><img src="' +
									site_url +
									images[0] +
									'" style="width:100px;height:100px;object-fit:cover;border-radius:6px;margin-bottom:8px;"><br><a href="' +
									site_url +
									"superadmin/download_site_image/" +
									site.id +
									'" class="btn btn-sm btn-outline-success"><i class="bx bx-download"></i> Download</a></div>';
							} else {
								imageBadge =
									'<span class="badge bg-secondary-light text-secondary">No Images</span>';
							}
						} else {
							imageBadge =
								'<span class="badge bg-secondary-light text-secondary">No Images</span>';
						}

						const mapBtn = hasMap
							? `<a href="${site_url}${site.site_map}" target="_blank" class="btn btn-sm btn-outline-success">
									<i class="bx bx-map"></i> View Map
								</a>`
							: hasApprovedImages
								? `<button type="button" class="btn btn-sm btn-outline-primary uploadMapBtn" data-site-id="${site.id}">
									<i class="bx bx-upload"></i> Upload Map
								</button>`
								: `<button type="button" class="btn btn-sm btn-outline-secondary" disabled title="Upload images first">
									<i class="bx bx-lock"></i> Upload Map
								</button>`;

						rows += `
							<tr>
								<td class="fw-semibold">${startIndex + i}</td>
								<td class="fw-semibold">${site.name || "-"}</td>
								<td><small>${site.location || "-"}</small></td>
								<td class="text-center"><span class="badge bg-info">${site.total_plots || 0}</span></td>
								<td class="text-center">${imageBadge}</td>
								<td class="text-center">${mapBtn}</td>
							</tr>
						`;
					});
					$("#adminSitesTable").html(rows);
					renderPagination("#adminSitesPagination", res.pagination);
				} else {
					$("#adminSitesTable").html(
						'<tr><td colspan="6" class="text-center text-muted py-4">No sites found</td></tr>',
					);
					renderPagination("#adminSitesPagination", {
						total_pages: 0,
						current_page: 1,
					});
				}
			},
			error: function () {
				$("#adminSitesTable").html(
					'<tr><td colspan="6" class="text-center text-danger">Failed to load sites</td></tr>',
				);
				renderPagination("#adminSitesPagination", {
					total_pages: 0,
					current_page: 1,
				});
			},
		});
	}

	function loadAdminPlots(adminId, page = 1, search = "") {
		if (!adminId || !$("#adminPlotsTable").length) return;
		$.ajax({
			url: site_url + "superadmin/get_admin_plots/" + adminId,
			method: "GET",
			data: { page: page, search: search },
			dataType: "json",
			success: function (res) {
				if (res.status && res.data && res.data.length > 0) {
					let rows = "";
					let startIndex = (page - 1) * 10 + 1;
					res.data.forEach((plot, i) => {
						let statusLabel = "Available";
						let statusClass = "plot-status-available";
						let statusIconClass = "text-success";
						if (plot.status && plot.status.toLowerCase() === "sold") {
							statusLabel = "Sold";
							statusClass = "plot-status-sold";
							statusIconClass = "text-danger";
						} else if (plot.status && plot.status.toLowerCase() === "pending") {
							statusLabel = "Pending";
							statusClass = "plot-status-pending";
							statusIconClass = "text-warning";
						}
						rows += `
              <tr>
                <td>${startIndex + i}</td>
                <td>${plot.site_name || "-"}</td>
                <td>${plot.plot_number || "-"}</td>
                <td>${plot.size || "-"}</td>
                <td>${plot.dimension || "-"}</td>
                <td>${plot.facing || "-"}</td>
                <td>${plot.price || "-"}</td>
                <td>
					<span class="plot-status-badge ${statusClass}">
						<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 ${statusIconClass}"></i>
						${statusLabel}
					</span>
				</td>
              </tr>
            `;
					});
					$("#adminPlotsTable").html(rows);
					renderPagination("#adminPlotsPagination", res.pagination);
				} else {
					$("#adminPlotsTable").html(
						'<tr><td colspan="8" class="text-center text-muted py-4">No plots found</td></tr>',
					);
					renderPagination("#adminPlotsPagination", {
						total_pages: 0,
						current_page: 1,
					});
				}
			},
			error: function () {
				$("#adminPlotsTable").html(
					'<tr><td colspan="8" class="text-center text-danger">Failed to load plots</td></tr>',
				);
				renderPagination("#adminPlotsPagination", {
					total_pages: 0,
					current_page: 1,
				});
			},
		});
	}

	$(document).on("click", ".viewAdmin", function () {
		const adminId = $(this).data("id");
		if (!adminId) return;

		$.ajax({
			url: site_url + "superadmin/get_admin_detail/" + adminId,
			method: "GET",
			dataType: "json",
			success: function (res) {
				if (!res.status) {
					Swal.fire(
						"Error",
						res.message || "Unable to load admin details",
						"error",
					);
					return;
				}

				const admin = res.admin || {};
				const sites = res.sites || [];

				const headerHtml = `
          <div class="d-flex align-items-center gap-3">
            <div>
              <strong>${admin.name || "-"}</strong>
              <div class="text-muted">${admin.business_name || "-"}</div>
              <div class="small">${admin.email || "-"}</div>
              <div class="small">${admin.mobile || "-"}</div>
            </div>
          </div>
        `;

				let sitesHtml = "";
				if (sites.length === 0) {
					sitesHtml =
						'<div class="text-muted">No sites found for this admin.</div>';
				} else {
					sites.forEach((site) => {
						let imagesHtml = "";
						if (site.images && site.images.length > 0) {
							imagesHtml = site.images
								.map((img) => {
									const fullUrl = site_url + img;
									return `
                    <div class="me-2 mb-2">
                      <img src="${fullUrl}" alt="site" style="width:120px;height:90px;object-fit:cover;border-radius:6px;">
                      <div class="mt-1">
                        <a class="btn btn-sm btn-outline-primary" href="${fullUrl}" download>Download</a>
                      </div>
                    </div>
                  `;
								})
								.join("");
						} else {
							imagesHtml = '<div class="text-muted">No images</div>';
						}

						let plotsHtml = "";
						if (site.plots && site.plots.length > 0) {
							plotsHtml =
								'<div class="table-responsive"><table class="table mb-0"><thead class="table-light"><tr><th>#</th><th>Plot No</th><th>Size</th><th>Dimension</th><th>Facing</th><th>Price</th><th>Status</th></tr></thead><tbody>' +
								site.plots
									.map((p, idx) => {
										return `
                      <tr>
                        <td>${idx + 1}</td>
                        <td>${p.plot_number || "-"}</td>
                        <td>${p.size || "-"}</td>
                        <td>${p.dimension || "-"}</td>
                        <td>${p.facing || "-"}</td>
                        <td>${p.price || 0}</td>
                        <td>${p.status || "-"}</td>
                      </tr>
                    `;
									})
									.join("") +
								"</tbody></table></div>";
						} else {
							plotsHtml = '<div class="text-muted">No plots</div>';
						}

						sitesHtml += `
              <div class="card mb-3">
                <div class="card-body">
                  <div class="mb-2">
                    <strong>${site.name || "-"}</strong>
                    <div class="text-muted">${site.location || "-"}</div>
                  </div>
                  <div class="d-flex flex-wrap mb-3">${imagesHtml}</div>
                  <div>${plotsHtml}</div>
                </div>
              </div>
            `;
					});
				}

				$("#adminDetailHeader").html(headerHtml);
				$("#adminDetailSites").html(sitesHtml);
				$("#adminDetailModal").modal("show");
			},
			error: function () {
				Swal.fire("Error", "Unable to load admin details", "error");
			},
		});
	});

	$(document).on("click", ".viewSiteDetail", function () {
		const siteId = $(this).data("id");
		if (!siteId) return;

		$.ajax({
			url: site_url + "superadmin/get_site_detail/" + siteId,
			method: "GET",
			dataType: "json",
			success: function (res) {
				if (!res.status) {
					Swal.fire(
						"Error",
						res.message || "Unable to load site details",
						"error",
					);
					return;
				}

				const site = res.site || {};
				const images = res.images || [];
				const expenses = res.expenses || [];
				const plots = res.plots || [];

				const headerHtml = `
          <div>
            <strong>${site.name || "-"}</strong>
            <div class="text-muted">${site.location || "-"}</div>
            <div class="small">Admin: ${site.admin_name || "-"}</div>
          </div>
        `;

				let imagesHtml = "";
				if (images.length > 0) {
					imagesHtml = images
						.map((img) => {
							const fullUrl = site_url + img;
							return `
                <div>
                  <img src="${fullUrl}" alt="site" style="width:120px;height:90px;object-fit:cover;border-radius:6px;">
                  <div class="mt-1">
                    <a class="btn btn-sm btn-outline-primary" href="${fullUrl}" download>Download</a>
                  </div>
                </div>
              `;
						})
						.join("");
				} else {
					imagesHtml = '<div class="text-muted">No images</div>';
				}

				let expensesHtml = "";
				if (expenses.length > 0) {
					expenses.forEach((exp, i) => {
						expensesHtml += `
              <tr>
                <td>${i + 1}</td>
                <td>${exp.description || "-"}</td>
                <td>${exp.date || "-"}</td>
                <td>${exp.amount || 0}</td>
                <td>${exp.status || "-"}</td>
              </tr>
            `;
					});
				} else {
					expensesHtml =
						'<tr><td colspan="5" class="text-center text-muted">No expenses found</td></tr>';
				}

				let plotsHtml = "";
				if (plots.length > 0) {
					plots.forEach((p, i) => {
						plotsHtml += `
              <tr>
                <td>${i + 1}</td>
                <td>${p.plot_number || "-"}</td>
                <td>${p.size || "-"}</td>
                <td>${p.dimension || "-"}</td>
                <td>${p.facing || "-"}</td>
                <td>${p.price || 0}</td>
                <td>${p.status || "-"}</td>
              </tr>
            `;
					});
				} else {
					plotsHtml =
						'<tr><td colspan="7" class="text-center text-muted">No plots found</td></tr>';
				}

				$("#siteDetailHeader").html(headerHtml);
				$("#siteDetailImages").html(imagesHtml);
				$("#siteDetailExpenses").html(expensesHtml);
				$("#siteDetailPlots").html(plotsHtml);
				$("#siteDetailModal").modal("show");
			},
			error: function () {
				Swal.fire("Error", "Unable to load site details", "error");
			},
		});
	});

	// âž¤ Edit expense
	$(document).on("show.bs.modal", "#siteMapUploadModal", function (e) {
		const trigger = e.relatedTarget;
		const siteId = trigger ? $(trigger).data("id") : window.lastSiteMapId;
		if (siteId) {
			$("#siteMapSiteId").val(siteId);
			window.lastSiteMapId = siteId;
		}
		$("#siteMapFile").val("");
	});

	function doSiteMapUpload(e) {
		e.preventDefault();
		e.stopPropagation();
		const formEl = document.getElementById("siteMapUploadForm");
		if (!formEl) {
			Swal.fire("Error", "Upload form not found.", "error");
			return;
		}
		const hiddenId = $("#siteMapSiteId").val();
		if (!hiddenId && window.lastSiteMapId) {
			$("#siteMapSiteId").val(window.lastSiteMapId);
		}
		if (!$("#siteMapSiteId").val()) {
			Swal.fire("Error", "Site ID is missing. Please try again.", "error");
			return;
		}
		const fileInput = document.getElementById("siteMapFile");
		if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
			Swal.fire("Error", "Please choose a JSON file.", "error");
			return;
		}
		const formData = new FormData(formEl);

		$.ajax({
			url: site_url + "superadmin/upload_site_map",
			type: "POST",
			data: formData,
			processData: false,
			contentType: false,
			dataType: "json",
			beforeSend: function () {
				Swal.fire({
					title: "Uploading...",
					allowOutsideClick: false,
					didOpen: () => Swal.showLoading(),
				});
			},
			success: function (res) {
				Swal.close();
				if (res.status) {
					Swal.fire("Success", res.message || "Map uploaded", "success");
					$("#siteMapUploadModal").modal("hide");
					const siteId = $("#siteMapSiteId").val();
					if (siteId) {
						const row = $('.uploadSiteMap[data-id="' + siteId + '"]').closest(
							"tr",
						);
						const badgeCell = row.find("td").eq(5);
						badgeCell.html('<span class="badge bg-success">Yes</span>');
					}
					loadSuperSites(sitePage, siteSearch);
				} else {
					Swal.fire("Error", res.message || "Upload failed", "error");
				}
			},
			error: function (xhr) {
				Swal.close();
				const msg =
					xhr && xhr.responseText ? xhr.responseText : "Upload failed";
				Swal.fire("Error", msg, "error");
			},
		});
	}

	window.handleSiteMapUpload = function (ev) {
		doSiteMapUpload(ev || window.event);
	};

	$(document).on("click", "#siteMapUploadBtn", function (e) {
		doSiteMapUpload(e);
	});

	// Admin pagination + search
	$(document).on("click", "#adminPagination .page-link", function (e) {
		e.preventDefault();
		const page = getPageFromLink($(this), "#adminPagination");
		if (!page || $(this).closest("li").hasClass("disabled")) return;
		adminPage = page;
		adminSearch = $("#adminSearch").val() || "";
		loadAdmins(adminPage, adminSearch);
	});

	$(document).on("keyup", "#adminSearch", function (e) {
		if (e.key === "Enter") {
			adminSearch = $(this).val();
			adminPage = 1;
			applyTableFilter("#superAdminTable", adminSearch, 8);
			loadAdmins(adminPage, adminSearch);
		}
	});
	$(document).on("input", "#adminSearch", function () {
		adminSearch = $(this).val();
		adminPage = 1;
		applyTableFilter("#superAdminTable", adminSearch, 8);
		if (adminSearchTimer) clearTimeout(adminSearchTimer);
		adminSearchTimer = setTimeout(() => {
			loadAdmins(adminPage, adminSearch);
		}, 300);
	});
	$(document).on("click", "#adminSearchBtn", function () {
		adminSearch = $("#adminSearch").val();
		adminPage = 1;
		applyTableFilter("#superAdminTable", adminSearch, 8);
		loadAdmins(adminPage, adminSearch);
	});

	// Toggle Admin Status
	$(document).on("click", ".toggleAdminStatus", function () {
		const adminId = $(this).data("id");
		const nextStatus = $(this).data("next-status");
		const actionText = nextStatus === 1 ? "activate" : "deactivate";

		if (!confirm("Are you sure you want to " + actionText + " this admin?")) {
			return;
		}

		$.ajax({
			url: site_url + "superadmin/change_admin_status/" + adminId,
			method: "POST",
			data: { isActive: nextStatus },
			dataType: "json",
			success: function (res) {
				if (res.status) {
					loadAdmins(adminPage, adminSearch);
				} else {
					alert(res.message || "Failed to update admin status");
				}
			},
			error: function () {
				alert("Error while updating admin status");
			},
		});
	});

	// Site pagination + search
	$(document).on("click", "#sitePagination .page-link", function (e) {
		e.preventDefault();
		const page = getPageFromLink($(this), "#sitePagination");
		if (!page || $(this).closest("li").hasClass("disabled")) return;
		sitePage = page;
		siteSearch = $("#siteSearch").val() || "";
		loadSuperSites(sitePage, siteSearch);
	});

	$(document).on("keyup", "#siteSearch", function (e) {
		if (e.key === "Enter") {
			siteSearch = $(this).val();
			sitePage = 1;
			applyTableFilter("#superAdminSitesTable", siteSearch, 8);
			loadSuperSites(sitePage, siteSearch);
		}
	});
	$(document).on("input", "#siteSearch", function () {
		siteSearch = $(this).val();
		sitePage = 1;
		applyTableFilter("#superAdminSitesTable", siteSearch, 8);
		if (siteSearchTimer) clearTimeout(siteSearchTimer);
		siteSearchTimer = setTimeout(() => {
			loadSuperSites(sitePage, siteSearch);
		}, 300);
	});
	$(document).on("click", "#siteSearchBtn", function () {
		siteSearch = $("#siteSearch").val().trim();
		sitePage = 1;
		applyTableFilter("#superAdminSitesTable", siteSearch, 8);
		loadSuperSites(1, siteSearch);
	});

	// Admin Sites pagination + search
	// Admin Sites pagination + search

	// Get admin id from URL
	// Get admin id safely from URL
	const urlParts = window.location.pathname.split("/");
	let adminIdFromUrl = urlParts[urlParts.length - 1];

	// If last part is empty (trailing slash), take previous
	if (!adminIdFromUrl || isNaN(adminIdFromUrl)) {
		adminIdFromUrl = urlParts[urlParts.length - 2];
	}

	console.log("Admin ID from URL:", adminIdFromUrl);

	let adminSitePage = 1;
	let adminSiteSearch = "";
	let adminSiteSearchTimer = null;
	let currentAdminIdForSites = null;

	function initAdminSitesPagination() {
		if (typeof currentAdminId !== "undefined" && currentAdminId > 0) {
			currentAdminIdForSites = currentAdminId;

			console.log("Loading sites for:", currentAdminId);

			loadAdminSites(currentAdminId, 1, "");
		}
	}

	$(document).on("click", "#adminSitesPagination .page-link", function (e) {
		e.preventDefault();
		const page = getPageFromLink($(this), "#adminSitesPagination");
		if (!page || $(this).closest("li").hasClass("disabled")) return;
		adminSitePage = page;
		adminSiteSearch = $("#adminSiteSearch").val() || "";
		if (currentAdminIdForSites) {
			loadAdminSites(currentAdminIdForSites, adminSitePage, adminSiteSearch);
		}
	});

	$(document).on("keyup", "#adminSiteSearch", function (e) {
		if (e.key === "Enter") {
			adminSiteSearch = $(this).val();
			adminSitePage = 1;
			if (currentAdminIdForSites) {
				loadAdminSites(currentAdminIdForSites, adminSitePage, adminSiteSearch);
			}
		}
	});

	$(document).on("input", "#adminSiteSearch", function () {
		adminSiteSearch = $(this).val();
		adminSitePage = 1;
		if (adminSiteSearchTimer) clearTimeout(adminSiteSearchTimer);
		adminSiteSearchTimer = setTimeout(() => {
			if (currentAdminIdForSites) {
				loadAdminSites(currentAdminIdForSites, adminSitePage, adminSiteSearch);
			}
		}, 300);
	});

	$(document).on("click", "#adminSiteSearchBtn", function () {
		adminSiteSearch = $("#adminSiteSearch").val();
		adminSitePage = 1;
		if (currentAdminIdForSites) {
			loadAdminSites(currentAdminIdForSites, 1, adminSiteSearch);
		}
	});

	// Admin Plots pagination + search
	let adminPlotPage = 1;
	let adminPlotSearch = "";
	let adminPlotSearchTimer = null;
	let currentAdminIdForPlots = null;

	function initAdminPlotsPagination() {
		if (typeof currentAdminId !== "undefined" && currentAdminId > 0) {
			currentAdminIdForPlots = currentAdminId;

			console.log("Loading plots for:", currentAdminId);

			loadAdminPlots(currentAdminId, 1, "");
		}
	}

	$(document).on("click", "#adminPlotsPagination .page-link", function (e) {
		e.preventDefault();
		const page = getPageFromLink($(this), "#adminPlotsPagination");
		if (!page || $(this).closest("li").hasClass("disabled")) return;
		adminPlotPage = page;
		adminPlotSearch = $("#adminPlotSearch").val() || "";
		if (currentAdminIdForPlots) {
			loadAdminPlots(currentAdminIdForPlots, adminPlotPage, adminPlotSearch);
		}
	});

	$(document).on("keyup", "#adminPlotSearch", function (e) {
		if (e.key === "Enter") {
			adminPlotSearch = $(this).val();
			adminPlotPage = 1;
			if (currentAdminIdForPlots) {
				loadAdminPlots(currentAdminIdForPlots, adminPlotPage, adminPlotSearch);
			}
		}
	});

	$(document).on("input", "#adminPlotSearch", function () {
		adminPlotSearch = $(this).val();
		adminPlotPage = 1;
		if (adminPlotSearchTimer) clearTimeout(adminPlotSearchTimer);
		adminPlotSearchTimer = setTimeout(() => {
			if (currentAdminIdForPlots) {
				loadAdminPlots(currentAdminIdForPlots, adminPlotPage, adminPlotSearch);
			}
		}, 300);
	});

	$(document).on("click", "#adminPlotSearchBtn", function () {
		adminPlotSearch = $("#adminPlotSearch").val();
		adminPlotPage = 1;
		if (currentAdminIdForPlots) {
			loadAdminPlots(currentAdminIdForPlots, 1, adminPlotSearch);
		}
	});

	loadAdmins(adminPage, adminSearch);
	loadSuperSites(sitePage, siteSearch);
	// Auto initialize if table exists
	if ($("#adminSitesTable").length) {
		initAdminSitesPagination();
	}
 
	if ($("#adminPlotsTable").length) {
		initAdminPlotsPagination();
	}
});
