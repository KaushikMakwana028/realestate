<?php $this->load->view('partials/admin_form_theme'); ?>
<div class="page-wrapper admin-form-page">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard'); ?>">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Edit User Card -->
        <div class="card admin-form-card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit User</h5>
                <hr>

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col">
                            <form id="editUserForm" method="post"  
      enctype="multipart/form-data" class="needs-validation" novalidate>

    <!-- User Name -->
    <div class="mb-3">
        <label for="userName" class="form-label">User Name</label>
        <input type="text" name="user_name" class="form-control" id="userName"
            value="<?= isset($user->name) ? htmlspecialchars($user->name) : ''; ?>"
            placeholder="Enter user name" required>
        <div class="invalid-feedback">Please enter the user name.</div>
    </div>
<input type="hidden" value="<?= $user->id ?>" id="user_id">
    <!-- Email -->
    <div class="mb-3">
        <label for="userEmail" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="userEmail"
            value="<?= isset($user->email) ? htmlspecialchars($user->email) : ''; ?>"
            placeholder="Enter email address" required>
        <div class="invalid-feedback">Please enter a valid email address.</div>
    </div>

    <!-- Mobile -->
    <div class="mb-3">
        <label for="userMobile" class="form-label">Mobile</label>
        <input type="text" name="mobile" class="form-control" id="userMobile"
            value="<?= isset($user->mobile) ? htmlspecialchars($user->mobile) : ''; ?>"
            placeholder="Enter 10-digit mobile number" pattern="[0-9]{10}" required>
        <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
    </div>

    <!-- ⭐ Daily Salary -->
    <div class="mb-3">
        <label for="dailySalary" class="form-label">Daily Salary (INR)</label>
        <input type="number" name="daily_salary" class="form-control" id="dailySalary"
            value="<?= isset($user->daily_salary) ? htmlspecialchars($user->daily_salary) : ''; ?>"
            placeholder="Enter daily salary amount" required>
        <div class="invalid-feedback">Please enter a valid daily salary.</div>
    </div>

    <!-- Profile Image -->
    <div class="mb-3">
        <label for="profileImage" class="form-label">Profile Image</label>
        <input type="file" name="profile_image" class="form-control" id="profileImage" accept="image/*">
        <div class="form-text">Allowed formats: JPG, JPEG, PNG. Max size: 2MB</div>

        <?php if (!empty($user->profile_image)) : ?>
            <div class="mt-2">
                <img id="imagePreview" src="<?= base_url(htmlspecialchars($user->profile_image)); ?>" 
                     alt="Profile Image" style="max-width:150px; border-radius:10px;">
            </div>
        <?php else : ?>
            <img id="imagePreview" src="#" alt="Preview" 
                 style="display:none; margin-top:10px; max-width:150px; border-radius:10px;">
        <?php endif; ?>
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="userPassword" class="form-label">Password</label>
        <div class="input-group" id="show_hide_password">
            <input type="password" name="password" class="form-control border-end-0" id="userPassword"
                placeholder="Leave blank to keep current password">
            <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
        </div>
        <div class="form-text text-muted">Leave blank if you don't want to change the password.</div>
    </div>

    <!-- Submit Button -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary w-100">Update User</button>
    </div>

</form>

                        </div>
                    </div><!-- end row -->
                </div>

            </div>
        </div>

    </div>
</div>
