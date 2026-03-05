<style>
  /* ===== Profile Page Custom Styles ===== */
  .profile-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    height: 200px;
    border-radius: 0.5rem 0.5rem 0 0;
    position: relative;
    overflow: hidden;
  }

  .profile-banner::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 60%);
    animation: shimmer 8s ease-in-out infinite;
  }

  @keyframes shimmer {

    0%,
    100% {
      transform: translate(0, 0) rotate(0deg);
    }

    50% {
      transform: translate(20px, -20px) rotate(5deg);
    }
  }

  .profile-avatar-wrapper {
    position: relative;
    display: inline-block;
    margin-top: -65px;
  }

  .profile-avatar-wrapper .avatar-img {
    width: 130px;
    height: 130px;
    object-fit: cover;
    border: 5px solid #fff;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .profile-avatar-wrapper:hover .avatar-img {
    transform: scale(1.05);
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
  }

  .profile-avatar-wrapper .avatar-overlay {
    position: absolute;
    bottom: 8px;
    right: 8px;
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
    border: 3px solid #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .profile-avatar-wrapper .avatar-overlay:hover {
    transform: scale(1.15);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.5);
  }

  .profile-left-card {
    border: none;
    border-radius: 0.5rem;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: box-shadow 0.3s ease;
  }

  .profile-left-card:hover {
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.12);
  }

  .profile-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 4px;
  }

  .profile-role-badge {
    display: inline-block;
    padding: 4px 18px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }

  .profile-stats {
    display: flex;
    justify-content: center;
    gap: 30px;
    padding: 15px 0;
  }

  .profile-stat-item {
    text-align: center;
  }

  .profile-stat-item .stat-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 8px;
    font-size: 1.2rem;
    transition: transform 0.3s ease;
  }

  .profile-stat-item:hover .stat-icon {
    transform: translateY(-3px);
  }

  .profile-stat-item .stat-label {
    font-size: 0.75rem;
    color: #8e9aaf;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .profile-info-item {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
  }

  .profile-info-item:last-child {
    border-bottom: none;
  }

  .profile-info-item .info-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    margin-right: 12px;
    flex-shrink: 0;
  }

  .profile-info-item .info-text {
    font-size: 0.85rem;
    color: #555;
    word-break: break-all;
  }

  .profile-info-item .info-label {
    font-size: 0.7rem;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
  }

  /* Right Form Card */
  .profile-form-card {
    border: none;
    border-radius: 0.5rem;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    transition: box-shadow 0.3s ease;
  }

  .profile-form-card:hover {
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.12);
  }

  .profile-form-card .card-header-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px 25px;
    border-radius: 0.5rem 0.5rem 0 0;
  }

  .profile-form-card .card-header-custom h5 {
    color: #fff;
    margin: 0;
    font-weight: 700;
    font-size: 1.15rem;
  }

  .profile-form-card .card-header-custom p {
    color: rgba(255, 255, 255, 0.7);
    margin: 4px 0 0;
    font-size: 0.85rem;
  }

  .form-label-custom {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .form-label-custom i {
    font-size: 1.1rem;
    color: #667eea;
  }

  .required-star {
    color: #dc2626;
    margin-left: 3px;
    font-weight: 700;
  }

  .form-control-custom {
    border: 2px solid #e8ecf1;
    border-radius: 10px;
    padding: 10px 15px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background-color: #fafbfc;
  }

  .form-control-custom:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
    background-color: #fff;
  }

  .form-control-custom::placeholder {
    color: #c0c6d0;
    font-size: 0.85rem;
  }

  .form-group-animated {
    padding: 15px 20px;
    border-radius: 12px;
    transition: background-color 0.3s ease;
    margin-bottom: 5px;
  }

  .form-group-animated:hover {
    background-color: #f8f9ff;
  }

  .btn-update-profile {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    padding: 12px 40px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.95rem;
    letter-spacing: 0.5px;
    color: #fff;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    cursor: pointer;
    text-transform: uppercase;
  }

  .btn-update-profile:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(102, 126, 234, 0.5);
  }

  .btn-update-profile:active {
    transform: translateY(0);
  }

  .password-toggle-wrapper {
    position: relative;
  }

  .password-toggle-wrapper .toggle-password {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #aaa;
    transition: color 0.3s ease;
  }

  .password-toggle-wrapper .toggle-password:hover {
    color: #667eea;
  }

  .divider-text {
    display: flex;
    align-items: center;
    gap: 15px;
    margin: 5px 0 15px;
    color: #c0c6d0;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
  }

  .divider-text::before,
  .divider-text::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(to right, transparent, #e0e0e0, transparent);
  }

  /* Breadcrumb Enhancement */
  .breadcrumb-enhanced {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 18px 25px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
  }

  .breadcrumb-enhanced .breadcrumb-title {
    color: #fff;
    font-weight: 700;
    font-size: 1.3rem;
  }

  .breadcrumb-enhanced .breadcrumb-item a,
  .breadcrumb-enhanced .breadcrumb-item.active,
  .breadcrumb-enhanced .breadcrumb-item+.breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.8) !important;
  }

  .breadcrumb-enhanced .breadcrumb-item a:hover {
    color: #fff !important;
  }

  /* Small helper badge */
  .helper-text {
    font-size: 0.78rem;
    color: #a0a8b5;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .helper-text i {
    font-size: 0.85rem;
  }

  /* Responsive Tweaks */
  @media (max-width: 991px) {
    .profile-banner {
      height: 150px;
    }

    .profile-avatar-wrapper {
      margin-top: -50px;
    }

    .profile-avatar-wrapper .avatar-img {
      width: 100px;
      height: 100px;
    }
  }
</style>

<div class="page-wrapper">
  <div class="page-content">

    <!--breadcrumb-->
    <div class="breadcrumb-enhanced d-none d-sm-flex align-items-center">
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
    $defaultImage = base_url('assets/images/54322.jpg');
    $profileImage = (!empty($admin->profile_image))
      ? base_url($admin->profile_image)
      : $defaultImage;
    $name    = isset($admin->name) && $admin->name !== '' ? ucfirst($admin->name) : 'Admin User';
    $email   = isset($admin->email) && $admin->email !== '' ? $admin->email : '';
    $mobile  = isset($admin->mobile) && $admin->mobile !== '' ? $admin->mobile : '';
    $address = isset($admin->address) && $admin->address !== '' ? $admin->address : '';
    ?>

    <div class="main-body">
      <div class="row g-4">

        <!-- ====== Left Profile Card ====== -->
        <div class="col-lg-4">
          <div class="card profile-left-card">

            <!-- Banner -->
            <div class="profile-banner"></div>

            <div class="card-body text-center" style="margin-top: -20px;">

              <!-- Avatar -->
              <div class="profile-avatar-wrapper">
                <input type="file" id="avatar-upload" accept="image/*" style="display:none;">
                <img
                  src="<?= $profileImage ?>"
                  alt="Admin"
                  class="rounded-circle avatar-img"
                  id="avatar-img">
                <label for="avatar-upload" class="avatar-overlay" title="Change profile image">
                  <i class="bx bx-camera"></i>
                </label>
              </div>

              <!-- Name & Role -->
              <div class="mt-3">
                <h4 class="profile-name" id="userName"><?= $name ?></h4>
                <span class="profile-role-badge" id="userRole">
                  <i class="bx bx-shield-quarter" style="margin-right:4px;"></i>
                  <?= isset($admin->role) ? ucfirst($admin->role) : '' ?>
                </span>
              </div>

              <!-- Quick Stats -->
              <div class="profile-stats mt-4">
                <div class="profile-stat-item">
                  <div class="stat-icon" style="background: rgba(102,126,234,0.12); color: #667eea;">
                    <i class="bx bx-envelope"></i>
                  </div>
                  <div class="stat-label">Email</div>
                </div>
                <div class="profile-stat-item">
                  <div class="stat-icon" style="background: rgba(40,199,111,0.12); color: #28c76f;">
                    <i class="bx bx-check-circle"></i>
                  </div>
                  <div class="stat-label">Verified</div>
                </div>
                <div class="profile-stat-item">
                  <div class="stat-icon" style="background: rgba(255,159,67,0.12); color: #ff9f43;">
                    <i class="bx bx-lock-alt"></i>
                  </div>
                  <div class="stat-label">Secure</div>
                </div>
              </div>

              <hr class="my-3" style="border-color: #f0f0f0;">

              <!-- Contact Info Summary -->
              <div class="px-3 text-start">
                <?php if ($email): ?>
                  <div class="profile-info-item">
                    <div class="info-icon" style="background: rgba(102,126,234,0.1); color: #667eea;">
                      <i class="bx bx-envelope"></i>
                    </div>
                    <div>
                      <div class="info-label">Email</div>
                      <div class="info-text"><?= htmlspecialchars($email) ?></div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if ($mobile): ?>
                  <div class="profile-info-item">
                    <div class="info-icon" style="background: rgba(40,199,111,0.1); color: #28c76f;">
                      <i class="bx bx-phone"></i>
                    </div>
                    <div>
                      <div class="info-label">Phone</div>
                      <div class="info-text"><?= htmlspecialchars($mobile) ?></div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if ($address): ?>
                  <div class="profile-info-item">
                    <div class="info-icon" style="background: rgba(255,159,67,0.1); color: #ff9f43;">
                      <i class="bx bx-map"></i>
                    </div>
                    <div>
                      <div class="info-label">Address</div>
                      <div class="info-text"><?= htmlspecialchars($address) ?></div>
                    </div>
                  </div>
                <?php endif; ?>
              </div>

            </div>
          </div>
        </div>

        <!-- ====== Right Form Section ====== -->
        <div class="col-lg-8">
          <form id="updateprofileForm">
            <div class="card profile-form-card">

              <!-- Card Header -->
              <div class="card-header-custom">
                <h5><i class="bx bx-edit" style="margin-right:8px;"></i>Edit Profile</h5>
                <p>Update your personal information and keep your account secure.</p>
              </div>

              <div class="card-body py-4 px-4">

                <!-- Full Name -->
                <div class="form-group-animated">
                  <div class="row align-items-center">
                    <div class="col-sm-3">
                      <label class="form-label-custom mb-0">
                        <i class="bx bx-user"></i> Full Name <span class="required-star">*</span>
                      </label>
                    </div>
                    <div class="col-sm-9">
                      <input
                        type="text"
                        id="fullName"
                        class="form-control form-control-custom"
                        name="name"
                        value="<?= htmlspecialchars($name) ?>"
                        placeholder="Enter your full name">
                      <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                    </div>
                  </div>
                </div>

                <!-- Email -->
                <div class="form-group-animated">
                  <div class="row align-items-center">
                    <div class="col-sm-3">
                      <label class="form-label-custom mb-0">
                        <i class="bx bx-envelope"></i> Email
                      </label>
                    </div>
                    <div class="col-sm-9">
                      <input
                        type="email"
                        id="email"
                        class="form-control form-control-custom"
                        name="email"
                        value="<?= htmlspecialchars($email) ?>"
                        placeholder="Enter your email address (optional)">
                      <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                    </div>
                  </div>
                </div>

                <!-- Mobile -->
                <div class="form-group-animated">
                  <div class="row align-items-center">
                    <div class="col-sm-3">
                      <label class="form-label-custom mb-0">
                        <i class="bx bx-phone"></i> Phone <span class="required-star">*</span>
                      </label>
                    </div>
                    <div class="col-sm-9">
                      <input
                        type="tel"
                        id="mobile"
                        class="form-control form-control-custom"
                        name="mobile"
                        value="<?= htmlspecialchars($mobile) ?>"
                        placeholder="Enter your phone number">
                      <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                    </div>
                  </div>
                </div>

                <!-- Address -->
                <div class="form-group-animated">
                  <div class="row align-items-start">
                    <div class="col-sm-3 pt-2">
                      <label class="form-label-custom mb-0">
                        <i class="bx bx-map"></i> Address
                      </label>
                    </div>
                    <div class="col-sm-9">
                      <textarea
                        id="address"
                        class="form-control form-control-custom"
                        name="address"
                        rows="3"
                        placeholder="Enter your full address (optional)"><?= htmlspecialchars($address) ?></textarea>
                      <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                    </div>
                  </div>
                </div>

                <!-- Divider -->
                <div class="divider-text">Security</div>

                <!-- Password -->
                <div class="form-group-animated">
                  <div class="row align-items-center">
                    <div class="col-sm-3">
                      <label class="form-label-custom mb-0">
                        <i class="bx bx-lock-alt"></i> Password
                      </label>
                    </div>
                    <div class="col-sm-9">
                      <div class="password-toggle-wrapper">
                        <input
                          type="password"
                          id="password"
                          class="form-control form-control-custom"
                          name="password"
                          placeholder="Enter new password"
                          style="padding-right: 45px;">
                        <span class="toggle-password" onclick="togglePassword()">
                          <i class="bx bx-show" id="toggleIcon"></i>
                        </span>
                      </div>
                      <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      <div class="helper-text">
                        <i class="bx bx-info-circle"></i>
                        Leave blank to keep your current password unchanged.
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="row mt-4 mb-2">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-9">
                    <button
                      type="button"
                      class="btn btn-update-profile update_form">
                      <i class="bx bx-save" style="margin-right:6px; font-size:1.1rem;"></i>
                      Update Profile
                    </button>
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

<script>
  // Toggle password visibility
  function togglePassword() {
    const pwd = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');
    if (pwd.type === 'password') {
      pwd.type = 'text';
      icon.classList.replace('bx-show', 'bx-hide');
    } else {
      pwd.type = 'password';
      icon.classList.replace('bx-hide', 'bx-show');
    }
  }

  // Click avatar image to trigger file upload
  document.getElementById('avatar-img').addEventListener('click', function() {
    document.getElementById('avatar-upload').click();
  });

  // Preview selected image
  document.getElementById('avatar-upload').addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
      const reader = new FileReader();
      reader.onload = function(ev) {
        document.getElementById('avatar-img').src = ev.target.result;
      };
      reader.readAsDataURL(e.target.files[0]);
    }
  });
</script>