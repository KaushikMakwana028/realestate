// user form js

document.addEventListener("DOMContentLoaded", function () {
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
const profileImageInput = document.getElementById("profileImage");

if (profileImageInput) {
  profileImageInput.addEventListener("change", function (event) {
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
  // ✅ Check if form exists before binding event
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
            "error"
          );
        },
      });
    });

    // ✅ Image Preview
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
            "error"
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
            "error"
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
          } else {
            Swal.fire("Error!", response.message, "error");
          }
        },
        error: function () {
          Swal.close();
          Swal.fire(
            "Error!",
            "Something went wrong, please try again.",
            "error"
          );
        },
      });
    });

    $("#siteName").on("change", function () {
      const siteId = $(this).val();
      const preview = $("#expenseSiteImages");
      preview.empty();

      if (!siteId) return;

      $.ajax({
        url: site_url + "site/get_site_images",
        type: "POST",
        data: { site_id: siteId },
        dataType: "json",
        success: function (res) {
          if (!res || !res.status || !res.images || res.images.length === 0) {
            return;
          }

          res.images.forEach((imgPath) => {
            const img = $("<img />", {
              src: site_url + imgPath,
              css: {
                width: "80px",
                height: "80px",
                objectFit: "cover",
                borderRadius: "6px",
              },
            });
            preview.append(img);
          });
        },
      });
    });
  }

  $("#editPlotForm").on("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: site_url +"plots/update_plot",
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
        }
    });
});

  if (!$("#customerTableBody").length) return; 
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
            tbody += `
                            <tr>
                                <td>${startIndex + i}</td>
                                <td>${site.name}</td>
                                 <td>${site.location}</td>
                                <td>${site.site_value}</td>
                                <td>${site.collected_value}</td>                       
                               <td>${site.total_expenses}</td>
                               <td>${site.total_plots}</td>
                                
                               <td>
    <a href="${site_url}plots/${site.id}" 
       class="text-dark fs-4" 
       title="View Plots">
        <i class='bx bx-grid-alt'></i>
    </a>
</td>

<td>
    <a href="${site_url}expenses/${site.id}" 
       class="text-dark fs-4" 
       title="View Expenses">
        <i class='bx bx-receipt'></i>
    </a>
</td>

<td>
                                    <div class="d-flex order-actions">
                                       <a href="edit_site/${
                                         site.id
                                       }" class="editSite">
                                            <i class="bx bxs-edit"></i>
                                        </a>

                                        <a href="javascript:;" class="ms-3 deleteSite" data-id="${
                                          site.id
                                        }">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                        <a href="javascript:;" class="ms-3 assignSite" data-admin="${
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
            '<tr><td colspan="6" class="text-center">No data found</td></tr>'
          );
          $(".pagination").html("");
        }
      },
      error: function () {
        $("#customerTableBody").html(
          '<tr><td colspan="6" class="text-center text-danger">Error loading data</td></tr>'
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

    $(".pagination").html(html);
  }

  // 🔹 Pagination click
  $(document).on("click", ".pagination a.page-link", function (e) {
    e.preventDefault();
    let page = $(this).data("page");
    if (page) {
      currentPage = page;
      loadSites(currentPage, searchQuery);
    }
  });

  // 🔹 Search
  $("#serchSite").on("keyup", function () {
    searchQuery = $(this).val();
    currentPage = 1;
    loadSites(currentPage, searchQuery);
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
    const adminId = $(this).data("admin"); // ✅ get admin id

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
                  admin_id: adminId, // ✅ send admin id
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

  // 🔹 Initial load
  loadSites();
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
        }
    });
});

$(document).on('submit', '#editSiteForm', function (e) {
  e.preventDefault();

  const form = $(this);
  const actionUrl = form.attr('action'); // site/update_site/{id}
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
              Swal.fire("Error", res.message || "Something went wrong.", "error");
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
    let amount  = $("#upadAmount").val();

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
        cancelButtonText: "Cancel"
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: site_url +"user/save_upad",
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
                }
            });

        }

    });
});
$(document).ready(function () {
  // ✅ Run only if table exists
  if ($("#plotTable").length) {
    let currentPage = 1;
    let searchQuery = "";

   function loadPlots(page = 1, search = "") {
    let site_id = $("#site_id").val();

    $.ajax({
        url: site_url + "plots/get_plots_ajax",
        method: "GET",
        data: { 
            page: page, 
            search: search,
            site_id: site_id   
        },
        success: function (response) {
            const res = typeof response === "string" ? JSON.parse(response) : response;

            if (res.status && res.data.length > 0) {
                let rows = "";

                $.each(res.data, function (i, plot) {
                    let statusBadge = "";

                    const status = String(plot.status || "").toLowerCase();
                    if (status === "available") {
                        statusBadge =
                          '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Available</div>';
                    } else if (status === "sold") {
                        statusBadge =
                          '<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Sold</div>';
                    } else if (status === "pending") {
                        statusBadge =
                          '<div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Pending</div>';
                    } else if (plot.isActive == 0) {
                        statusBadge =
                          '<div class="badge rounded-pill text-secondary bg-light-secondary p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Inactive</div>';
                    }

                    rows += `
                        <tr>
                          <td>${(page - 1) * 10 + i + 1}</td>
                          <td>${plot.site_name || "-"}</td>
                          <td>${plot.plot_number || "-"}</td>
                          <td>${plot.size || "-"}</td>
                          <td>${plot.dimension || "-"}</td>
                          <td>${plot.facing || "-"}</td>
                          <td>${plot.price || "-"}</td>
                          <td>${statusBadge}</td>
                       <td>${status === "sold" ? (plot.name || "-") : "-"}</td>
                          <td>
                            <div class="d-flex order-actions">
                              <a href="${site_url}plot/edit_plot/${plot.id}" class="text"><i class="bx bxs-edit"></i></a>
                              <a href="javascript:;" class="ms-3 text deletePlot" data-id="${plot.id}"><i class="bx bxs-trash"></i></a>
                              ${(status === "sold" && plot.buyer_id)
              ? `<a href="${site_url}plots/buyer_details/${plot.id}" class="ms-3 text checkBuyer" data-id="${plot.id}" title="Check Buyer">
                    <i class="bx bxs-user-check"></i>
                 </a>`
              : ""
          }
                              
                            </div>
                          </td>
                        </tr>
                    `;
                });

                $("#plotTable").html(rows);
                renderPagination(res.pagination.total_pages, res.pagination.current_page);
            } else {
                $("#plotTable").html(
                  `<tr><td colspan="9" class="text-center text-muted">No plots found</td></tr>`
                );
                $(".pagination").html("");
            }
        },
    });
}


    // ✅ Pagination Rendering
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

      $(".pagination").html(paginationHTML);
    }

    // ✅ Pagination click (delegate)
    $(document).on("click", ".pagination .page-link", function (e) {
      e.preventDefault();
      const page = parseInt($(this).data("page"), 10);
      if (!page || $(this).closest("li").hasClass("disabled")) return;
      currentPage = page;
      loadPlots(currentPage, searchQuery);
    });

    // ✅ Search input
    $("#serchPlot").on("keyup", function () {
      searchQuery = $(this).val();
      loadPlots(1, searchQuery);
    });

    // ✅ Delete plot with confirmation
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

    // ✅ Initial Load
    loadPlots();
  }
});
$(document).ready(function () {
  if ($("#userTable").length) {
    let currentPage = 1;
    let searchQuery = "";

    // ✅ Fetch users with pagination + search
    function loadUsers(page = 1, search = "") {
      $.ajax({
        url: site_url + "user/get_users_ajax", // <-- your backend endpoint
        method: "GET",
        data: { page: page, search: search },
        success: function (response) {
          const res = typeof response === "string" ? JSON.parse(response) : response;

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
            renderPagination(res.pagination.total_pages, res.pagination.current_page);
          } else {
            $("#userTable").html(
              `<tr><td colspan="7" class="text-center text-muted">No users found</td></tr>`
            );
            $(".pagination").html("");
          }
        },
      });
    }

    // ✅ Render pagination (3 visible + Last + Next)
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

    // ✅ Search functionality
    $("#serchUser").on("keyup", function () {
      searchQuery = $(this).val();
      loadUsers(1, searchQuery);
    });

    // ✅ Delete user confirmation
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

    // ✅ Initial Load
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
            url: site_url+"user/get_user_upads",
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
            }
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
                    <td>₹${r.amount}</td>
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
        html += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link prevPage" href="javascript:;">Previous</a>
                 </li>`;

        let startPage = Math.floor((currentPage - 1) / 3) * 3 + 1;
        let endPage = Math.min(startPage + 2, totalPages);

        for (let p = startPage; p <= endPage; p++) {
            html += `
                <li class="page-item ${p === currentPage ? 'active' : ''}">
                    <a class="page-link pageBtn" data-page="${p}" href="javascript:;">${p}</a>
                </li>
            `;
        }

        // Next
        html += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
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

        let filtered = allData.filter(x =>
            x.user_name.toLowerCase().includes(q) ||
            x.amount.toString().includes(q) ||
            (x.notes ?? "").toLowerCase().includes(q)
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
        confirmButtonText: "Yes, delete it!"
    }).then(result => {

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
                }
            });

        }

    });

});


// expenses

$(document).ready(function () {

    let currentPage = 1;

    function loadExpenses(page = 1) {
    if ($("#expensesTable").length === 0) return;

    let search = $("#serchexp").val();
    let site_id = $("#siteID").val();

    $.ajax({
        url: site_url + "site/get_expenses",
        type: "POST",
        data: { 
            page: page, 
            search: search, 
            site_id: site_id 
        },
        success: function (res) {
            res = JSON.parse(res);

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
                if (row.site_images) {
                    try {
                        const imgs = JSON.parse(row.site_images);
                        if (Array.isArray(imgs)) {
                            imagesArr = imgs;
                            imagesHtml = imgs.slice(0, 3).map((p) => {
                                const fullSrc = `${site_url}${p}`;
                                return `<img src="${fullSrc}" data-full="${fullSrc}" class="siteImgPreview" style="width:40px;height:40px;object-fit:cover;border-radius:4px;margin-right:4px;cursor:pointer;" />`;
                            }).join("");
                        }
                    } catch (e) {
                        imagesHtml = "";
                    }
                }

                const fullDesc = row.description || "";
                const shortDesc = fullDesc.length > 30 ? fullDesc.slice(0, 30) + "..." : fullDesc;
                const encodedImages = encodeURIComponent(JSON.stringify(imagesArr));

                $("#expensesTable").append(`
                    <tr>
                        <td>${indexStart + i}</td>
                        <td>${row.site_name}</td>
                        <td>${imagesHtml || ""}</td>
                        <td>${row.user_name}</td>

                        <td>
                            <a href="javascript:;" class="expDesc text-decoration-none"
                               data-desc="${fullDesc.replace(/"/g, "&quot;")}"
                               data-images="${encodedImages}">
                               ${shortDesc || "-"}
                            </a>
                        </td>
                        <td>${row.date}</td>
                        <td>${row.amount}</td>

                        <td>
                            <select class="form-select statusUpdate" data-id="${row.id}">
                                <option value="pending" ${row.status == "pending" ? "selected" : ""}>Pending</option>
                                <option value="approve" ${row.status == "approve" ? "selected" : ""}>Approve</option>
                                <option value="reject" ${row.status == "reject" ? "selected" : ""}>Reject</option>
                            </select>
                        </td>

                        <td>
                            <div class="d-flex order-actions">
                                      

                                        <a href="javascript:;" class="ms-3 deleteExp" data-id="${
                                          row.id
                                        }">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                       
                                    </div>
                        </td>
                    </tr>
                `);
            });

            buildPagination(res.total, res.limit, res.page);
        }
    });
}


    // ➤ Pagination with only 3 pages
    function buildPagination(total, limit, page) {
    let totalPages = Math.ceil(total / limit);
    let pagination = $(".pagination");

    // Hide pagination if only 1 page
    if (totalPages <= 1) {
        pagination.html("");
        return;
    }

    pagination.html("");

    pagination.append(`
        <li class="page-item ${page == 1 ? 'disabled' : ''}">
            <a class="page-link" data-page="${page - 1}" href="#">Previous</a>
        </li>
    `);

    let start = Math.max(1, page - 1);
    let end = Math.min(totalPages, start + 2);

    for (let i = start; i <= end; i++) {
        pagination.append(`
            <li class="page-item ${i == page ? 'active' : ''}">
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


    // ➤ Click pagination
    $(document).on("click", ".pagination .page-link", function () {
        let page = $(this).data("page");
        loadExpenses(page);
    });

    // ➤ Search
    $("#serchexp").keyup(function () {
        loadExpenses(1);
    });

    // ➤ Delete
    $(document).on("click", ".deleteExp", function () {
    let id = $(this).data("id");

    Swal.fire({
        title: "Are you sure?",
        text: "This expense will be Remove.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete"
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: site_url + "site/delete/" + id,
                type: "POST",
                success: function () {
                    Swal.fire("Updated!", "Expense is Deleted.", "success");
                    loadExpenses(currentPage);
                }
            });

        }
    });
});


    // ➤ Status change
    $(document).on("change", ".statusUpdate", function () {
    let id = $(this).data("id");
    let newStatus = $(this).val();
    let element = $(this);

    Swal.fire({
        title: "Change Status?",
        text: "Do you want to update this status?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, update",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(site_url + "site/update_status", { id, status: newStatus }, function () {
                Swal.fire("Updated!", "Status changed successfully.", "success");
            });
        } else {
            element.val(element.data("old")); // reset to old status if cancelled
        }
    });
});


    // INITIAL LOAD
    loadExpenses(1);

});

// ➤ Show full description modal
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
                `<img src="${site_url}${p}" data-full="${site_url}${p}" class="expImagePreview" />`
            );
        });
    } else {
        $imgEmpty.removeClass("d-none");
    }

    const modal = new bootstrap.Modal(document.getElementById("expDescModal"));
    modal.show();
});

// ➤ Show full image from expense modal
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

// ➤ Show full site image
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
document.addEventListener("DOMContentLoaded", function () {

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
                let shortNote = note.length > 20 
                                ? note.substring(0, 20) + "..." 
                                : note;

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
        }
    });
}


    function renderPagination(total, limit, page) {
        let totalPages = Math.ceil(total / limit);
        let html = "";

        // Previous
        html += `<li class="page-item ${page === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${page - 1}">Previous</a>
                </li>`;

        // Show only 3 numbers
        let start = Math.max(1, page - 1);
        let end = Math.min(totalPages, start + 2);

        for (let i = start; i <= end; i++) {
            html += `<li class="page-item ${page === i ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>`;
        }

        // Next
        html += `<li class="page-item ${page === totalPages ? 'disabled' : ''}">
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
        confirmButtonText: "Yes, Delete"
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
                }
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

    if (status === "pending")      color = "text-warning";
    if (status === "present")      color = "text-success";
    if (status === "absent")       color = "text-danger";
    if (status === "rejected")     color = "text-danger";

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
            }
        });
    }

    function renderAttedancePagination(total, limit, currentPage) {

        let totalPages = Math.ceil(total / limit);
        let html = "";

        html += `<li class="page-item ${currentPage == 1 ? 'disabled' : ''}">
                    <a class="page-link" href="javascript:;" onclick="loadAttendance(${currentPage - 1})">Previous</a>
                 </li>`;

        let start = Math.max(1, currentPage - 1);
        let end = Math.min(totalPages, start + 2);

        for (let i = start; i <= end; i++) {
            html += `
                <li class="page-item ${i == currentPage ? 'active' : ''}">
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
            status: newStatus
        },
        dataType: "json",
        success: function (res) {
            if (res.status === true) {
                Swal.fire({
                    icon: "success",
                    title: "Status Updated!",
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                loadAttendance(); // Reload table
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: res.message
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: "error",
                title: "Server Error",
                text: "Unable to update status."
            });
        }
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

            $.post(site_url + "dashboard/delete_attendance", { id: id }, function (res) {
                
                Swal.fire("Deleted!", "Attendance removed.", "success");
                loadAttendance();
            }, "json");

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
                    `<tr><td colspan='8' class="text-center text-danger">Buyer ID missing</td></tr>`
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
                    search: search
                },
                dataType: "json",
                success: function (res) {

                    if (!res.status) {
                        $("#payment_data").html(
                            `<tr><td colspan='8' class="text-center">${res.message}</td></tr>`
                        );
                        $(".pagination").html(""); // clear pagination if no data
                        return;
                    }

                    if (!res.logs || res.logs.length === 0) {
                        $("#payment_data").html(
                            `<tr><td colspan='8' class="text-center text-muted">No payment records found</td></tr>`
                        );
                        $(".pagination").html("");
                        return;
                    }

                    let html = "";
                    let index = (page - 1) * 10 + 1;

                    res.logs.forEach(log => {
                        html += `
                            <tr>
                                <td>${index++}</td>
                                <td>${res.user?.name ?? "-"}</td>
                                <td>${res.buyer?.name ?? "-"}</td>
                                <td>${res.plot?.site_name ?? "-"}</td>
                                <td>${res.plot?.plot_number ?? "-"}</td>
                                <td>${log.created_on}</td>
                                <td>₹${log.paid_amount}</td>
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

                    loadPagination(res.pagination.total_pages, res.pagination.current_page);
                }
            });
        }

        // Pagination rendering
        function loadPagination(totalPages, current) {
            let phtml = "";

            phtml += `<li class="page-item ${current == 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${current - 1}">Previous</a>
                      </li>`;

            for (let i = 1; i <= totalPages; i++) {
                phtml += `<li class="page-item ${i == current ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                          </li>`;
            }

            phtml += `<li class="page-item ${current == totalPages ? 'disabled' : ''}">
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
        cancelButtonText: "Cancel"
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: site_url + "plots/update_payment_status",
                method: "POST",
                data: { id: log_id, status: status },
                success: function (res) {
                    console.log("Status updated:", res);
                    Swal.fire("Updated!", "Payment status updated successfully.", "success");
                },
                error: function () {
                    Swal.fire("Error", "Server error!", "error");
                }
            });

        }
    });
});
 $("#avatar-img").on("click", function() {
    $("#avatar-upload").click();
  });

  // ✅ Preview selected image instantly
  $("#avatar-upload").on("change", function() {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        $("#avatar-img").attr("src", e.target.result);
      };
      reader.readAsDataURL(file);
    }
  });

$(document).on("click", ".update_form", function () {

    // Clear previous errors
    $(".error-msg").html("");

    let name     = $("#fullName").val().trim();
    let email    = $("#email").val().trim();
    let mobile   = $("#mobile").val().trim();
    let password = $("#password").val().trim();

    let isValid = true;

    // ✅ Name validation
    if (name === "") {
        $("#fullName").closest(".col-sm-9").find(".error-msg")
            .text("Full name is required");
        isValid = false;
    }

    // ✅ Email validation
    if (email === "") {
        $("#email").closest(".col-sm-9").find(".error-msg")
            .text("Email is required");
        isValid = false;
    } 
    else if (!validateEmail(email)) {
        $("#email").closest(".col-sm-9").find(".error-msg")
            .text("Enter a valid email address");
        isValid = false;
    }

    // ❌ Stop if validation fails
    if (!isValid) return;

    // ✅ MUST use FormData for file upload
    let formData = new FormData();
    formData.append("name", name);
    formData.append("email", email);
    formData.append("mobile", mobile);
    formData.append("password", password);

    // ✅ Profile image (optional)
    const file = $("#avatar-upload")[0].files[0];
    if (file) {
        formData.append("profile_image", file);
    }

    // ✅ AJAX Request
    $.ajax({
        url: site_url + "profile/update_profile",
        type: "POST",
        data: formData,
        processData: false,   // 🔴 REQUIRED
        contentType: false,   // 🔴 REQUIRED
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
                    confirmButtonColor: "#3085d6"
                });

            } else {

                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: response.message
                });
            }
        },

        error: function () {
            Swal.fire({
                icon: "error",
                title: "Server Error",
                text: "Something went wrong. Please try again."
            });
        },

        complete: function () {
            $(".update_form").prop("disabled", false).val("Update Profile");
        }
    });

});

// ✅ Email validator
function validateEmail(email) {
    let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}


document.getElementById("printBtn").addEventListener("click", function () {

    let buyer_id = document.getElementById("buyer_id").value;

    if (!buyer_id) {
        Swal.fire({
            icon: "warning",
            title: "Buyer not selected",
            text: "Please select a buyer first"
        });
        return;
    }

    fetch(site_url + "plots/download_pdf/" + buyer_id, {
        method: "GET",
    })
    .then(response => response.blob())
    .then(blob => {

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
            text: "Unable to generate PDF"
        });
    });
});



$(document).ready(function () {
  let adminPage = 1;
  let adminSearch = "";
  let sitePage = 1;
  let siteSearch = "";

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

    if (start > 1) html += `<li class="page-item"><a class="page-link" href="javascript:;" data-page="1">1</a></li>`;
    if (start > 2) html += `<li class="page-item disabled"><a class="page-link">...</a></li>`;

    for (let i = start; i <= end; i++) {
      html += `<li class="page-item ${i === current ? "active" : ""}">
                  <a class="page-link" href="javascript:;" data-page="${i}">${i}</a>
               </li>`;
    }

    if (end < total - 1) html += `<li class="page-item disabled"><a class="page-link">...</a></li>`;
    if (end < total) html += `<li class="page-item"><a class="page-link" href="javascript:;" data-page="${total}">${total}</a></li>`;

    html += `<li class="page-item ${current === total ? "disabled" : ""}">
                <a class="page-link" href="javascript:;" data-page="${current + 1}">Next</a>
             </li>`;

    $(containerId).html(html);
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
            rows += `
              <tr>
                <td>${i + 1}</td>
                <td>${admin.name || "-"}</td>
                <td>${admin.business_name || "-"}</td>
                <td>${admin.mobile || "-"}</td>
                <td>${admin.email || "-"}</td>
                <td>${admin.sites_count || 0}</td>
                <td>${admin.plots_count || 0}</td>
                <td>${admin.users_count || 0}</td>
                <td>
                  <button class="btn btn-sm btn-primary viewAdmin" data-id="${admin.id}">View</button>
                </td>
              </tr>
            `;
          });
          $("#superAdminTable").html(rows);
          renderPagination("#adminPagination", res.pagination);
        } else {
          $("#superAdminTable").html(
            '<tr><td colspan="9" class="text-center text-muted">No admins found</td></tr>'
          );
          renderPagination("#adminPagination", { total_pages: 0, current_page: 1 });
        }
      },
      error: function () {
        $("#superAdminTable").html(
          '<tr><td colspan="9" class="text-center text-danger">Failed to load admins</td></tr>'
        );
        renderPagination("#adminPagination", { total_pages: 0, current_page: 1 });
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
            rows += `
              <tr>
                <td>${i + 1}</td>
                <td>${site.name || "-"}</td>
                <td>${site.admin_name || "-"}</td>
                <td>${site.location || "-"}</td>
                <td>${site.total_plots || 0}</td>
                <td>${site.total_expenses || 0}</td>
                <td>
                  <button class="btn btn-sm btn-primary viewSiteDetail" data-id="${site.id}">View</button>
                </td>
              </tr>
            `;
          });
          $("#superAdminSitesTable").html(rows);
          renderPagination("#sitePagination", res.pagination);
        } else {
          $("#superAdminSitesTable").html(
            '<tr><td colspan="7" class="text-center text-muted">No sites found</td></tr>'
          );
          renderPagination("#sitePagination", { total_pages: 0, current_page: 1 });
        }
      },
      error: function () {
        $("#superAdminSitesTable").html(
          '<tr><td colspan="7" class="text-center text-danger">Failed to load sites</td></tr>'
        );
        renderPagination("#sitePagination", { total_pages: 0, current_page: 1 });
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
          Swal.fire("Error", res.message || "Unable to load admin details", "error");
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
          sitesHtml = '<div class="text-muted">No sites found for this admin.</div>';
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
          Swal.fire("Error", res.message || "Unable to load site details", "error");
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

  // Admin pagination + search
  $(document).on("click", "#adminPagination .page-link", function (e) {
    e.preventDefault();
    const page = parseInt($(this).data("page"), 10);
    if (!page || $(this).closest("li").hasClass("disabled")) return;
    adminPage = page;
    loadAdmins(adminPage, adminSearch);
  });

  $("#adminSearch").on("keyup", function (e) {
    if (e.key === "Enter") {
      adminSearch = $(this).val();
      adminPage = 1;
      loadAdmins(adminPage, adminSearch);
    }
  });
  $("#adminSearchBtn").on("click", function () {
    adminSearch = $("#adminSearch").val();
    adminPage = 1;
    loadAdmins(adminPage, adminSearch);
  });

  // Site pagination + search
  $(document).on("click", "#sitePagination .page-link", function (e) {
    e.preventDefault();
    const page = parseInt($(this).data("page"), 10);
    if (!page || $(this).closest("li").hasClass("disabled")) return;
    sitePage = page;
    loadSuperSites(sitePage, siteSearch);
  });

  $("#siteSearch").on("keyup", function (e) {
    if (e.key === "Enter") {
      siteSearch = $(this).val();
      sitePage = 1;
      loadSuperSites(sitePage, siteSearch);
    }
  });
  $("#siteSearchBtn").on("click", function () {
    siteSearch = $("#siteSearch").val();
    sitePage = 1;
    loadSuperSites(sitePage, siteSearch);
  });

  loadAdmins(adminPage, adminSearch);
  loadSuperSites(sitePage, siteSearch);
});
