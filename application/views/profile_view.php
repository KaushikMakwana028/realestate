<style>
  /* ===== Profile Page Custom Styles ===== */
  .profile-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    height: 150px;
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
    margin-top: -55px;
  }

  .profile-avatar-wrapper .avatar-img {
    width: 110px;
    height: 110px;
    object-fit: cover;
    border: 5px solid #fff;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }

  .profile-avatar-wrapper:hover .avatar-img {
    transform: scale(1.05);
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
  }

  .profile-avatar-wrapper .avatar-overlay {
    position: absolute;
    bottom: 6px;
    right: 6px;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 13px;
    cursor: pointer;
    border: 3px solid #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .profile-avatar-wrapper .avatar-overlay:hover {
    transform: scale(1.15);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.5);
  }

  .profile-left-card,
  .profile-form-card {
    border: none;
    border-radius: 0.5rem;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    transition: box-shadow 0.3s ease;
  }

  .profile-left-card {
    overflow: hidden;
  }

  .profile-left-card:hover,
  .profile-form-card:hover {
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.12);
  }

  .profile-name {
    font-size: 1.35rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 2px;
  }

  .profile-business-sub {
    font-size: 0.82rem;
    color: #8e9aaf;
    font-weight: 500;
  }

  .profile-role-badge {
    display: inline-block;
    padding: 4px 18px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 6px;
  }

  /* Trust badges - replaces the old tall 3-column stat block */
  .profile-trust-badges {
    display: flex;
    gap: 8px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 14px;
  }

  .trust-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 13px;
    border-radius: 50px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.4px;
  }

  .trust-badge.tb-verified {
    background: rgba(40, 199, 111, 0.12);
    color: #28c76f;
  }

  .trust-badge.tb-secure {
    background: rgba(255, 159, 67, 0.12);
    color: #ff9f43;
  }

  /* Collapsible "more details" accordion in the left card */
  .profile-accordion {
    margin-top: 18px;
    text-align: left;
    border-top: 1px solid #f0f0f0;
  }

  .profile-accordion .accordion-item {
    border: none;
    border-bottom: 1px solid #f0f0f0;
  }

  .profile-accordion .accordion-item:last-child {
    border-bottom: none;
  }

  .profile-accordion .accordion-button {
    font-size: 0.85rem;
    font-weight: 600;
    color: #2c3e50;
    padding: 14px 5px;
    background: transparent;
    box-shadow: none;
  }

  .profile-accordion .accordion-button i {
    color: #667eea;
    margin-right: 10px;
    font-size: 1.1rem;
  }

  .profile-accordion .accordion-button:not(.collapsed) {
    color: #667eea;
    background: transparent;
  }

  .profile-accordion .accordion-button:focus {
    box-shadow: none;
    border-color: transparent;
  }

  .profile-accordion .accordion-button::after {
    background-size: 1rem;
  }

  .profile-accordion .accordion-body {
    padding: 0 5px 16px 5px;
  }

  .profile-info-item {
    display: flex;
    align-items: center;
    padding: 8px 0;
  }

  .profile-info-item .info-icon {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
    margin-right: 12px;
    flex-shrink: 0;
  }

  .profile-info-item .info-text {
    font-size: 0.85rem;
    color: #555;
    word-break: break-all;
  }

  .profile-info-item .info-label {
    font-size: 0.68rem;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
  }

  /* Right Form Card */
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

  /* Section tabs - this is what replaces the one giant scrolling form.
     flex-wrap (not nowrap+scroll) so every tab is always visible, on any
     screen width, with nothing clipped off the edge. */
  .profile-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    border-bottom: none;
    margin-bottom: 22px;
  }

  .profile-tabs .nav-link {
    white-space: nowrap;
    border-radius: 50px;
    padding: 9px 18px;
    font-size: 0.84rem;
    font-weight: 600;
    color: #8e9aaf;
    background: #f4f5fb;
    border: none;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.25s ease;
  }

  .profile-tabs .nav-link i {
    font-size: 1.05rem;
  }

  .profile-tabs .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    box-shadow: 0 4px 14px rgba(102, 126, 234, 0.35);
  }

  .profile-tabs .nav-link:hover:not(.active) {
    background: #eef0fb;
    color: #667eea;
  }

  .profile-tabs .nav-link:focus-visible {
    outline: 2px solid #667eea;
    outline-offset: 2px;
  }

  .form-label-custom {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 6px;
  }

  .form-label-custom i {
    font-size: 1.05rem;
    color: #667eea;
  }

  .required-star {
    color: #dc2626;
    margin-left: 2px;
    font-weight: 700;
  }

  .form-control-custom {
    border: 2px solid #e8ecf1;
    border-radius: 10px;
    padding: 10px 15px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background-color: #fafbfc;
    width: 100%;
  }

  .form-control-custom:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
    background-color: #fff;
    outline: none;
  }

  .form-control-custom::placeholder {
    color: #c0c6d0;
    font-size: 0.85rem;
  }

  .field-block {
    margin-bottom: 18px;
  }

  .btn-update-profile {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    padding: 12px 40px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.9rem;
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

  .btn-update-profile:focus-visible {
    outline: 2px solid #2c3e50;
    outline-offset: 3px;
  }

  .profile-save-bar {
    display: flex;
    justify-content: flex-end;
    border-top: 1px solid #f0f0f0;
    padding-top: 18px;
    margin-top: 8px;
  }

  .helper-text {
    font-size: 0.78rem;
    color: #a0a8b5;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .helper-text i {
    font-size: 0.85rem;
  }

  /* Breadcrumb */
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

  /* Responsive */
  @media (max-width: 991px) {
    .profile-banner {
      height: 120px;
    }

    .profile-avatar-wrapper {
      margin-top: -45px;
    }

    .profile-avatar-wrapper .avatar-img {
      width: 90px;
      height: 90px;
    }
  }

  @media (max-width: 575px) {
    .profile-banner {
      height: 100px;
    }

    .profile-avatar-wrapper {
      margin-top: -40px;
    }

    .profile-avatar-wrapper .avatar-img {
      width: 80px;
      height: 80px;
    }

    .profile-form-card .card-body {
      padding: 1.25rem 1rem !important;
    }

    .field-block {
      margin-bottom: 14px;
    }

    .profile-tabs .nav-link {
      padding: 8px 14px;
      font-size: 0.8rem;
    }

    .profile-save-bar {
      justify-content: stretch;
    }

    .profile-save-bar .btn-update-profile {
      width: 100%;
      text-align: center;
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
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->

    <?php
    $defaultImage = base_url('assets/images/54322.jpg');
    $profileImage = (!empty($admin->profile_image)) ? base_url($admin->profile_image) : $defaultImage;
    $name          = isset($admin->name) && $admin->name !== '' ? ucfirst($admin->name) : 'Admin User';
    $business_name = isset($admin->business_name) && $admin->business_name !== '' ? $admin->business_name : '';
    $email         = isset($admin->email) && $admin->email !== '' ? $admin->email : '';
    $mobile        = isset($admin->mobile) && $admin->mobile !== '' ? $admin->mobile : '';
    $address       = isset($admin->address) && $admin->address !== '' ? $admin->address : '';
    $gst_number    = isset($admin->gst_number) && $admin->gst_number !== '' ? $admin->gst_number : '';
    $facebook      = isset($admin->facebook) && $admin->facebook !== '' ? $admin->facebook : '';
    $instagram     = isset($admin->instagram) && $admin->instagram !== '' ? $admin->instagram : '';
    $bank_name      = isset($admin->bank_name) && $admin->bank_name !== '' ? $admin->bank_name : '';
    $account_number = isset($admin->account_number) && $admin->account_number !== '' ? $admin->account_number : '';
    $ifsc_code      = isset($admin->ifsc_code) && $admin->ifsc_code !== '' ? $admin->ifsc_code : '';
    $signature      = isset($admin->signature) && $admin->signature !== '' ? $admin->signature : '';
    ?>

    <div class="main-body">
      <div class="row g-4">

        <!-- ====== Left Profile Card ====== -->
        <div class="col-lg-4">
          <div class="card profile-left-card">

            <div class="profile-banner"></div>

            <div class="card-body text-center pt-0">

              <div class="profile-avatar-wrapper">
                <input type="file" id="avatar-upload" accept="image/*" style="display:none;">
                <img src="<?= $profileImage ?>" alt="Admin" class="rounded-circle avatar-img" id="avatar-img">
                <label for="avatar-upload" class="avatar-overlay" title="Change profile image">
                  <i class="bx bx-camera"></i>
                </label>
              </div>

              <div class="mt-2">
                <h4 class="profile-name" id="userName"><?= $name ?></h4>
                <?php if ($business_name): ?>
                  <div class="profile-business-sub"><?= htmlspecialchars($business_name) ?></div>
                <?php endif; ?>
                <span class="profile-role-badge" id="userRole">
                  <i class="bx bx-shield-quarter" style="margin-right:4px;"></i>
                  <?= isset($admin->role) ? ucfirst($admin->role) : '' ?>
                </span>
              </div>

              <div class="profile-trust-badges">
                <span class="trust-badge tb-verified"><i class="bx bx-check-circle"></i> Verified</span>
                <span class="trust-badge tb-secure"><i class="bx bx-lock-alt"></i> Secure</span>
              </div>

              <!-- Collapsible details: nothing here unless the user taps to open it,
                   which is what keeps mobile short instead of dumping every field up top -->
              <div class="accordion profile-accordion" id="profileAccordion">

                <?php if ($email || $mobile || $address): ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContact">
                        <i class="bx bx-id-card"></i> Contact Info
                      </button>
                    </h2>
                    <div id="collapseContact" class="accordion-collapse collapse" data-bs-parent="#profileAccordion">
                      <div class="accordion-body">
                        <?php if ($email): ?>
                          <div class="profile-info-item">
                            <div class="info-icon" style="background: rgba(102,126,234,0.1); color: #667eea;"><i class="bx bx-envelope"></i></div>
                            <div>
                              <div class="info-label">Email</div>
                              <div class="info-text"><?= htmlspecialchars($email) ?></div>
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php if ($mobile): ?>
                          <div class="profile-info-item">
                            <div class="info-icon" style="background: rgba(40,199,111,0.1); color: #28c76f;"><i class="bx bx-phone"></i></div>
                            <div>
                              <div class="info-label">Phone</div>
                              <div class="info-text"><?= htmlspecialchars($mobile) ?></div>
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php if ($address): ?>
                          <div class="profile-info-item">
                            <div class="info-icon" style="background: rgba(255,159,67,0.1); color: #ff9f43;"><i class="bx bx-map"></i></div>
                            <div>
                              <div class="info-label">Address</div>
                              <div class="info-text"><?= htmlspecialchars($address) ?></div>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if ($business_name || $gst_number): ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBusiness">
                        <i class="bx bx-briefcase"></i> Business Details
                      </button>
                    </h2>
                    <div id="collapseBusiness" class="accordion-collapse collapse" data-bs-parent="#profileAccordion">
                      <div class="accordion-body">
                        <?php if ($business_name): ?>
                          <div class="profile-info-item">
                            <div class="info-icon" style="background: rgba(118,75,162,0.1); color: #764ba2;"><i class="bx bx-briefcase"></i></div>
                            <div>
                              <div class="info-label">Business Name</div>
                              <div class="info-text"><?= htmlspecialchars($business_name) ?></div>
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php if ($gst_number): ?>
                          <div class="profile-info-item">
                            <div class="info-icon" style="background: rgba(23,162,184,0.1); color: #17a2b8;"><i class="bx bx-receipt"></i></div>
                            <div>
                              <div class="info-label">GSTIN</div>
                              <div class="info-text"><?= htmlspecialchars($gst_number) ?></div>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if ($facebook || $instagram): ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSocial">
                        <i class="bx bx-share-alt"></i> Social Media
                      </button>
                    </h2>
                    <div id="collapseSocial" class="accordion-collapse collapse" data-bs-parent="#profileAccordion">
                      <div class="accordion-body">
                        <?php if ($facebook): ?>
                          <div class="profile-info-item">
                            <div class="info-icon" style="background: rgba(24,119,242,0.1); color: #1877f2;"><i class="bx bxl-facebook"></i></div>
                            <div>
                              <div class="info-label">Facebook</div>
                              <div class="info-text"><a href="<?= htmlspecialchars(prep_url($facebook)) ?>" target="_blank" style="color: #1877f2; text-decoration: none;">View Page</a></div>
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php if ($instagram): ?>
                          <div class="profile-info-item">
                            <div class="info-icon" style="background: rgba(225,48,108,0.1); color: #e1306c;"><i class="bx bxl-instagram"></i></div>
                            <div>
                              <div class="info-label">Instagram</div>
                              <div class="info-text"><a href="<?= htmlspecialchars(prep_url($instagram)) ?>" target="_blank" style="color: #e1306c; text-decoration: none;">View Profile</a></div>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if ($bank_name || $account_number || $ifsc_code): ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBank">
                        <i class="bx bxs-bank"></i> Bank Details
                      </button>
                    </h2>
                    <div id="collapseBank" class="accordion-collapse collapse" data-bs-parent="#profileAccordion">
                      <div class="accordion-body">
                        <?php if ($bank_name): ?>
                          <div class="profile-info-item">
                            <div class="info-icon" style="background: rgba(0,123,255,0.1); color: #007bff;"><i class="bx bx-home"></i></div>
                            <div>
                              <div class="info-label">Bank Name</div>
                              <div class="info-text"><?= htmlspecialchars($bank_name) ?></div>
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php if ($account_number): ?>
                          <div class="profile-info-item">
                            <div class="info-icon" style="background: rgba(40,167,69,0.1); color: #28a745;"><i class="bx bx-credit-card"></i></div>
                            <div>
                              <div class="info-label">Account Number</div>
                              <div class="info-text"><?= htmlspecialchars($account_number) ?></div>
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php if ($ifsc_code): ?>
                          <div class="profile-info-item">
                            <div class="info-icon" style="background: rgba(108,117,125,0.1); color: #6c757d;"><i class="bx bx-barcode"></i></div>
                            <div>
                              <div class="info-label">IFSC Code</div>
                              <div class="info-text"><?= htmlspecialchars($ifsc_code) ?></div>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if ($signature): ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSignature">
                        <i class="bx bx-pen"></i> Signature
                      </button>
                    </h2>
                    <div id="collapseSignature" class="accordion-collapse collapse" data-bs-parent="#profileAccordion">
                      <div class="accordion-body">
                        <img src="<?= base_url($signature) ?>" alt="Signature" style="max-height: 60px; max-width: 180px; object-fit: contain;">
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

              </div>
              <!-- /profile-accordion -->

            </div>
          </div>
        </div>

        <!-- ====== Right Form Section ====== -->
        <div class="col-lg-8">
          <form id="updateprofileForm">
            <div class="card profile-form-card">

              <div class="card-header-custom">
                <h5><i class="bx bx-edit" style="margin-right:8px;"></i>Edit Profile</h5>
                <p>Update your personal information and keep your account secure.</p>
              </div>

              <div class="card-body py-4 px-4">

                <!-- Section tabs: each one only shows its own fields, so you're never
                     scrolling past 11 fields just to fix a phone number -->
                <ul class="nav nav-pills profile-tabs" id="profileSectionTabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-personal-btn" data-bs-toggle="pill" data-bs-target="#pane-personal" type="button" role="tab" aria-controls="pane-personal" aria-selected="true">
                      <i class="bx bx-user"></i> Personal
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-business-btn" data-bs-toggle="pill" data-bs-target="#pane-business" type="button" role="tab" aria-controls="pane-business" aria-selected="false">
                      <i class="bx bx-briefcase"></i> Business &amp; Tax
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-social-btn" data-bs-toggle="pill" data-bs-target="#pane-social" type="button" role="tab" aria-controls="pane-social" aria-selected="false">
                      <i class="bx bx-share-alt"></i> Social Media
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-bank-btn" data-bs-toggle="pill" data-bs-target="#pane-bank" type="button" role="tab" aria-controls="pane-bank" aria-selected="false">
                      <i class="bx bxs-bank"></i> Bank Details
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-signature-btn" data-bs-toggle="pill" data-bs-target="#pane-signature" type="button" role="tab" aria-controls="pane-signature" aria-selected="false">
                      <i class="bx bx-pen"></i> Signature
                    </button>
                  </li>
                </ul>

                <div class="tab-content" id="profileSectionTabContent">

                  <!-- Personal -->
                  <div class="tab-pane fade show active" id="pane-personal" role="tabpanel" aria-labelledby="tab-personal-btn">
                    <div class="row">
                      <div class="col-md-6 field-block">
                        <label class="form-label-custom"><i class="bx bx-user"></i> Full Name <span class="required-star">*</span></label>
                        <input type="text" id="fullName" class="form-control form-control-custom" name="name" value="<?= htmlspecialchars($name) ?>" placeholder="Enter your full name">
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      </div>
                      <div class="col-md-6 field-block">
                        <label class="form-label-custom"><i class="bx bx-envelope"></i> Email</label>
                        <input type="email" id="email" class="form-control form-control-custom" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Enter your email address (optional)">
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      </div>
                      <div class="col-md-6 field-block">
                        <label class="form-label-custom"><i class="bx bx-phone"></i> Phone <span class="required-star">*</span></label>
                        <input type="tel" id="mobile" class="form-control form-control-custom" name="mobile" value="<?= htmlspecialchars($mobile) ?>" placeholder="Enter your phone number">
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      </div>
                      <div class="col-md-6 field-block">
                        <!-- spacer keeps Address full-width on its own row at md+ -->
                      </div>
                      <div class="col-12 field-block">
                        <label class="form-label-custom"><i class="bx bx-map"></i> Address</label>
                        <textarea id="address" class="form-control form-control-custom" name="address" rows="3" placeholder="Enter your full address (optional)"><?= htmlspecialchars($address) ?></textarea>
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      </div>
                    </div>
                  </div>

                  <!-- Business & Tax -->
                  <div class="tab-pane fade" id="pane-business" role="tabpanel" aria-labelledby="tab-business-btn">
                    <div class="row">
                      <div class="col-md-6 field-block">
                        <label class="form-label-custom"><i class="bx bx-briefcase"></i> Business Name <span class="required-star">*</span></label>
                        <input type="text" id="businessName" class="form-control form-control-custom" name="business_name" value="<?= htmlspecialchars($business_name) ?>" placeholder="Enter your business name">
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      </div>
                      <div class="col-md-6 field-block">
                        <label class="form-label-custom"><i class="bx bx-receipt"></i> GST Number</label>
                        <input type="text" id="gstNumber" class="form-control form-control-custom" name="gst_number" value="<?= htmlspecialchars($gst_number) ?>" placeholder="Enter your GST number (optional)">
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      </div>
                    </div>
                  </div>

                  <!-- Social Media -->
                  <div class="tab-pane fade" id="pane-social" role="tabpanel" aria-labelledby="tab-social-btn">
                    <div class="row">
                      <div class="col-md-6 field-block">
                        <label class="form-label-custom"><i class="bx bxl-facebook"></i> Facebook Page</label>
                        <input type="text" id="facebook" class="form-control form-control-custom" name="facebook" value="<?= htmlspecialchars($facebook) ?>" placeholder="Enter your Facebook page link (optional)">
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      </div>
                      <div class="col-md-6 field-block">
                        <label class="form-label-custom"><i class="bx bxl-instagram"></i> Instagram</label>
                        <input type="text" id="instagram" class="form-control form-control-custom" name="instagram" value="<?= htmlspecialchars($instagram) ?>" placeholder="Enter your Instagram profile link (optional)">
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      </div>
                    </div>
                  </div>

                  <!-- Bank Details -->
                  <div class="tab-pane fade" id="pane-bank" role="tabpanel" aria-labelledby="tab-bank-btn">
                    <div class="row">
                      <div class="col-md-6 field-block">
                        <label class="form-label-custom"><i class="bx bxs-bank"></i> Bank Name</label>
                        <input type="text" id="bankName" class="form-control form-control-custom" name="bank_name" value="<?= htmlspecialchars($bank_name) ?>" placeholder="Enter bank name (optional)">
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      </div>
                      <div class="col-md-6 field-block">
                        <label class="form-label-custom"><i class="bx bx-credit-card"></i> Account Number</label>
                        <input type="text" id="accountNumber" class="form-control form-control-custom" name="account_number" value="<?= htmlspecialchars($account_number) ?>" placeholder="Enter account number (optional)">
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      </div>
                      <div class="col-md-6 field-block">
                        <label class="form-label-custom"><i class="bx bx-barcode"></i> IFSC Code</label>
                        <input type="text" id="ifscCode" class="form-control form-control-custom" name="ifsc_code" value="<?= htmlspecialchars($ifsc_code) ?>" placeholder="Enter IFSC code (optional)">
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                      </div>
                    </div>
                  </div>

                  <!-- Signature -->
                  <div class="tab-pane fade" id="pane-signature" role="tabpanel" aria-labelledby="tab-signature-btn">
                    <div class="row">
                      <div class="col-12 field-block">
                        <label class="form-label-custom"><i class="bx bx-pen"></i> Authorized Signature</label>
                        <input type="file" id="signatureUpload" class="form-control form-control-custom" name="signature" accept="image/*">
                        <div class="helper-text mt-1"><i class="bx bx-info-circle"></i> Recommended format: Transparent PNG or crisp JPEG signature. Max size: 2MB.</div>
                        <div class="error-msg text-danger" style="font-size:0.82rem; margin-top:4px;"></div>
                        <?php if ($signature): ?>
                          <div class="mt-2 p-2 border rounded bg-light" style="display: inline-block;">
                            <div style="font-size: 0.75rem; color: #888; margin-bottom: 4px;">Current Signature Preview:</div>
                            <img id="sig-preview" src="<?= base_url($signature) ?>" alt="Signature Preview" style="max-height: 80px; max-width: 250px; object-fit: contain;">
                          </div>
                        <?php else: ?>
                          <div class="mt-2 p-2 border rounded bg-light d-none" id="sig-preview-container" style="display: inline-block;">
                            <div style="font-size: 0.75rem; color: #888; margin-bottom: 4px;">Selected Signature Preview:</div>
                            <img id="sig-preview" src="" alt="Signature Preview" style="max-height: 80px; max-width: 250px; object-fit: contain;">
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /tab-content -->

                <!-- Save button stays put no matter which tab is open -->
                <div class="profile-save-bar">
                  <button type="button" class="btn btn-update-profile update_form">
                    <i class="bx bx-save" style="margin-right:6px; font-size:1.1rem;"></i>
                    Update Profile
                  </button>
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
  // Click avatar image to trigger file upload
  document.getElementById('avatar-img').addEventListener('click', function() {
    document.getElementById('avatar-upload').click();
  });

  // Preview selected avatar image
  document.getElementById('avatar-upload').addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
      const reader = new FileReader();
      reader.onload = function(ev) {
        document.getElementById('avatar-img').src = ev.target.result;
      };
      reader.readAsDataURL(e.target.files[0]);
    }
  });

  // Preview signature upload
  const sigUpload = document.getElementById('signatureUpload');
  if (sigUpload) {
    sigUpload.addEventListener('change', function(e) {
      if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(ev) {
          const sigPreview = document.getElementById('sig-preview');
          const sigContainer = document.getElementById('sig-preview-container');
          if (sigPreview) {
            sigPreview.src = ev.target.result;
            if (sigContainer) {
              sigContainer.classList.remove('d-none');
            }
          }
        };
        reader.readAsDataURL(e.target.files[0]);
      }
    });
  }
</script>