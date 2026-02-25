<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">User Profile</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item">
              <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              User Profile
            </li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
<?php
// ✅ Default image fallback
$defaultImage = base_url('assets/images/54322.jpg');

// ✅ Profile image condition
$profileImage = (!empty($admin->profile_image))
    ? base_url($admin->profile_image)
    : $defaultImage;

// ✅ Safe values
$name   = isset($admin->name) && $admin->name !== '' ? ucfirst($admin->name) : 'Admin User';
$email  = isset($admin->email) && $admin->email !== '' ? $admin->email : '';
$mobile = isset($admin->mobile) && $admin->mobile !== '' ? $admin->mobile : '';
?>

   <div class="">
  <div class="main-body">
    <div class="row">

  <!-- Left Profile Image -->
  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex flex-column align-items-center text-center">

          <!-- Hidden File Upload -->
          <input type="file" id="avatar-upload" accept="image/*" style="display:none;">

          <!-- Profile Image -->
          <img
            src="<?= $profileImage ?>"
            alt="Admin"
            class="rounded-circle p-1"
            width="110"
            id="avatar-img"
            style="cursor:pointer;"
            title="Click to change profile image"
          >

          <div class="mt-3">
            <h4 id="userName">
              <?= $name ?>
            </h4>

            <p class="text-secondary mb-1 fw-bold" id="userRole">
              Admin
            </p>
          </div>

        </div>
        <hr class="my-4">
      </div>
    </div>
  </div>

  <!-- Right Form Section -->
  <div class="col-lg-8">
    <form id="updateprofileForm">
      <div class="card">
        <div class="card-body">

          <!-- Full Name -->
          <div class="row mb-3">
            <div class="col-sm-3">
              <h6 class="mb-0">Full Name</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <input
                type="text"
                id="fullName"
                class="form-control"
                name="name"
                value="<?= htmlspecialchars($name) ?>"
                placeholder="Enter your name"
              >
              <div class="error-msg text-danger"></div>
            </div>
          </div>

          <!-- Email -->
          <div class="row mb-3">
            <div class="col-sm-3">
              <h6 class="mb-0">Email</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <input
                type="email"
                id="email"
                class="form-control"
                name="email"
                value="<?= htmlspecialchars($email) ?>"
                placeholder="Enter your email"
              >
              <div class="error-msg text-danger"></div>
            </div>
          </div>

          <!-- Mobile -->
          <div class="row mb-3">
            <div class="col-sm-3">
              <h6 class="mb-0">Phone</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <input
                type="tel"
                id="mobile"
                class="form-control"
                name="mobile"
                value="<?= htmlspecialchars($mobile) ?>"
                placeholder="Enter your phone number"
              >
              <div class="error-msg text-danger"></div>
            </div>
          </div>

          <!-- Password -->
          <div class="row mb-3">
            <div class="col-sm-3">
              <h6 class="mb-0">Password</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <input
                type="password"
                id="password"
                class="form-control"
                name="password"
                placeholder="Enter new password"
              >
              <div class="error-msg text-danger"></div>
              <small>Leave blank to keep current password.</small>
            </div>
          </div>

          <!-- Submit -->
          <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-secondary">
              <input
                type="button"
                class="btn btn-primary px-4 update_form"
                value="Update Profile"
              >
            </div>
          </div>

        </div>
      </div>
    </form>
  </div>

</div>


  </div>
</div>

  </div>
</div>