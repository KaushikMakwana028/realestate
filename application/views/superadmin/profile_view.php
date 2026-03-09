<?php
$defaultImage = base_url('assets/images/54322.jpg');
$profileImage = (!empty($admin->profile_image)) ? base_url($admin->profile_image) : $defaultImage;
$name = isset($admin->name) && $admin->name !== '' ? ucfirst($admin->name) : 'Super Admin';
$email = isset($admin->email) ? $admin->email : '';
$mobile = isset($admin->mobile) ? $admin->mobile : '';
$address = isset($admin->address) ? $admin->address : '';
?>

<style>
  .sa-profile-page {
    background: linear-gradient(180deg, #eef4ff 0%, #f7fbff 100%);
    min-height: calc(100vh - 110px);
    padding: 10px 0 24px;
  }

  .sa-profile-hero {
    border-radius: 16px;
    padding: 22px;
    margin-bottom: 18px;
    background: linear-gradient(110deg, #0f172a 0%, #1d4ed8 56%, #0ea5e9 100%);
    color: #fff;
    box-shadow: 0 14px 34px rgba(37, 99, 235, 0.24);
  }

  .sa-profile-hero h4 {
    margin: 0;
    font-weight: 700;
    font-size: 24px;
    letter-spacing: 0.2px;
  }

  .sa-profile-hero p {
    margin: 6px 0 0;
    opacity: 0.92;
    font-size: 13px;
  }

  .sa-profile-card {
    border: 1px solid #dbeafe;
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 10px 26px rgba(15, 23, 42, 0.07);
    overflow: hidden;
  }

  .sa-profile-banner {
    height: 130px;
    background: linear-gradient(130deg, #0f172a 0%, #1d4ed8 70%, #22d3ee 100%);
    position: relative;
  }

  .sa-profile-avatar-wrap {
    position: relative;
    width: 124px;
    height: 124px;
    margin: -62px auto 10px;
  }

  .sa-profile-avatar {
    width: 124px;
    height: 124px;
    border-radius: 50%;
    border: 5px solid #fff;
    object-fit: cover;
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.2);
  }

  .sa-profile-avatar-edit {
    position: absolute;
    right: 2px;
    bottom: 4px;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #1d4ed8;
    color: #fff;
    border: 2px solid #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
  }

  .sa-role-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 999px;
    background: #dbeafe;
    color: #1e3a8a;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
  }

  .sa-info-line {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 0;
    border-bottom: 1px solid #eef2ff;
    color: #475569;
    font-size: 13px;
  }

  .sa-info-line:last-child {
    border-bottom: none;
  }

  .sa-form-card {
    border: 1px solid #dbeafe;
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 10px 26px rgba(15, 23, 42, 0.07);
  }

  .sa-form-header {
    padding: 18px 22px;
    border-bottom: 1px solid #e2e8f0;
    background: linear-gradient(180deg, #f8fbff 0%, #eff6ff 100%);
  }

  .sa-form-header h5 {
    margin: 0;
    font-weight: 700;
    color: #0f172a;
  }

  .sa-form-header p {
    margin: 5px 0 0;
    font-size: 12px;
    color: #64748b;
  }

  .sa-field-row {
    padding: 18px 22px 0;
  }

  .sa-label {
    font-size: 13px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
  }

  .sa-input.form-control {
    border: 1.8px solid #cbd5e1;
    border-radius: 11px;
    min-height: 44px;
    font-size: 14px;
  }

  .sa-input.form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.14);
  }

  .sa-password-wrap {
    position: relative;
  }

  .sa-password-toggle {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #64748b;
  }

  .sa-submit {
    margin: 20px 22px 22px;
    border: none;
    border-radius: 11px;
    padding: 11px 20px;
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(90deg, #0ea5e9 0%, #2563eb 100%);
    box-shadow: 0 8px 18px rgba(37, 99, 235, 0.25);
  }

  .sa-submit:hover {
    color: #fff;
  }

  @media (max-width: 991px) {
    .sa-profile-hero h4 {
      font-size: 20px;
    }
  }
</style>

<div class="page-wrapper sa-profile-page">
  <div class="page-content container-fluid">
    <div class="sa-profile-hero">
      <h4>Super Admin Profile</h4>
      <p>Manage your head office identity and security settings.</p>
    </div>

    <div class="row g-4">
      <div class="col-xl-4">
        <div class="sa-profile-card">
          <div class="sa-profile-banner"></div>
          <div class="p-4 text-center">
            <input type="file" id="avatar-upload" accept="image/*" style="display:none;">
            <div class="sa-profile-avatar-wrap">
              <img src="<?= $profileImage ?>" alt="Super Admin Avatar" class="sa-profile-avatar" id="avatar-img">
              <label for="avatar-upload" class="sa-profile-avatar-edit" title="Change profile image"><i class="bx bx-camera"></i></label>
            </div>
            <h5 class="mb-1 fw-bold text-dark"><?= htmlspecialchars($name) ?></h5>
            <span class="sa-role-chip"><i class="bx bx-shield-quarter"></i>Super Admin</span>
            <div class="text-start mt-4">
              <?php if (!empty($email)): ?>
                <div class="sa-info-line"><i class="bx bx-envelope"></i><span><?= htmlspecialchars($email) ?></span></div>
              <?php endif; ?>
              <?php if (!empty($mobile)): ?>
                <div class="sa-info-line"><i class="bx bx-phone"></i><span><?= htmlspecialchars($mobile) ?></span></div>
              <?php endif; ?>
              <?php if (!empty($address)): ?>
                <div class="sa-info-line"><i class="bx bx-map"></i><span><?= htmlspecialchars($address) ?></span></div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-8">
        <form id="updateprofileForm">
          <div class="sa-form-card">
            <div class="sa-form-header">
              <h5>Edit Profile</h5>
              <p>Changes are applied instantly after successful update.</p>
            </div>

            <div class="row sa-field-row">
              <div class="col-md-6">
                <label class="sa-label">Full Name *</label>
                <input type="text" id="fullName" class="form-control sa-input" name="name" value="<?= htmlspecialchars($name) ?>">
                <div class="error-msg text-danger mt-1" style="font-size:12px;"></div>
              </div>
              <div class="col-md-6">
                <label class="sa-label">Email</label>
                <input type="email" id="email" class="form-control sa-input" name="email" value="<?= htmlspecialchars($email) ?>">
                <div class="error-msg text-danger mt-1" style="font-size:12px;"></div>
              </div>
            </div>

            <div class="row sa-field-row">
              <div class="col-md-6">
                <label class="sa-label">Phone *</label>
                <input type="text" id="mobile" class="form-control sa-input" name="mobile" value="<?= htmlspecialchars($mobile) ?>">
                <div class="error-msg text-danger mt-1" style="font-size:12px;"></div>
              </div>
              <div class="col-md-6">
                <label class="sa-label">New Password</label>
                <div class="sa-password-wrap">
                  <input type="password" id="password" class="form-control sa-input" name="password" placeholder="Leave blank to keep current password">
                  <span class="sa-password-toggle" onclick="togglePassword()"><i class="bx bx-show" id="toggleIcon"></i></span>
                </div>
                <div class="error-msg text-danger mt-1" style="font-size:12px;"></div>
              </div>
            </div>

            <div class="row sa-field-row">
              <div class="col-12">
                <label class="sa-label">Address</label>
                <textarea id="address" class="form-control sa-input" name="address" rows="4"><?= htmlspecialchars($address) ?></textarea>
                <div class="error-msg text-danger mt-1" style="font-size:12px;"></div>
              </div>
            </div>

            <button type="button" class="btn sa-submit update_form"><i class="bx bx-save me-1"></i>Update Profile</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function togglePassword() {
    var input = document.getElementById('password');
    var icon = document.getElementById('toggleIcon');
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.replace('bx-show', 'bx-hide');
    } else {
      input.type = 'password';
      icon.classList.replace('bx-hide', 'bx-show');
    }
  }

  document.getElementById('avatar-img').addEventListener('click', function() {
    document.getElementById('avatar-upload').click();
  });

  document.getElementById('avatar-upload').addEventListener('change', function(e) {
    if (!e.target.files || !e.target.files[0]) return;
    var reader = new FileReader();
    reader.onload = function(ev) {
      document.getElementById('avatar-img').src = ev.target.result;
    };
    reader.readAsDataURL(e.target.files[0]);
  });
</script>