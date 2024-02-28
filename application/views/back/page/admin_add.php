<!-- Modal Add Admin -->
<div class="modal fade" id="addAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-xs" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control text-xs" name="email">
                            <span class="invalid_email">Email ini tidak valid</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password *</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control text-xs" name="password" id="password">
                            <span toggle="#password" class="fa fa-eye-slash toggle-password eye-icon"></span>
                            <span class="invalid_password">Minimal 6 Karakter</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control text-xs" name="confirm_pass" id="confirm_pass">
                            <span toggle="#confirm_pass" class="fa fa-eye-slash toggle-password eye-icon"></span>
                            <span class="invalid_confirm_pass">Minimal 6 Karakter</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select name="role" class="form-control text-xs">
                                <option value="0">-- Pilih Role --</option>
                                <option value="1">Admin</option>
                                <option value="2">Keuangan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-xs" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary text-xs" onclick="admin_add()">Save</button>
            </div>
        </div>
    </div>
</div>