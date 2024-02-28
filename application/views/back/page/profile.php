<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile</h1>
</div>

<!-- Content Row -->
<div class="card col-lg-6 font-weight-bold">
    <div class="card-body">
        <h5 class="mb-4">Manage Details</h5>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" class="form-control text-xs" name="name" value="<?php echo $admin_data->nama; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control text-xs" name="email" value="<?php echo $admin_data->email; ?>">
            </div>
        </div>
        <button class="btn btn-info mb-3 float-right text-xs profile" onclick="form_submit('profile')">Update Profile</button>
    </div>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="card-body">
        <h5 class="mb-4">Change Password</h5>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Current Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control text-xs" name="current_pass" id="current_pass">
                <span toggle="#current_pass" class="fa fa-eye-slash toggle-password eye-icon"></span>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">New Password *</label>
            <div class="col-sm-9">
                <input type="password" class="form-control text-xs" name="new_pass" id="new_pass">
                <span toggle="#new_pass" class="fa fa-eye-slash toggle-password eye-icon"></span>
                <span class="invalid_new_pass">min 6 chars</span>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Confirm Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control text-xs" name="confirm_pass" id="confirm_pass">
                <span toggle="#confirm_pass" class="fa fa-eye-slash toggle-password eye-icon"></span>
                <span class="invalid_confirm_pass">min 6 chars</span>
            </div>
        </div>
        <button class="btn btn-info mb-3 float-right text-xs pass" onclick="form_submit('password')">Update Password</button>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/back/js/page/profile.js"></script>