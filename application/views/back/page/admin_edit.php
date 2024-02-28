<!-- Modal Edit Admin -->
<div class="modal fade" id="editAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <input type="text" class="form-control text-xs" name="edit_admin_id" hidden>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-xs" name="edit_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control text-xs" name="edit_email">
                            <span class="invalid_edit_email">Email ini tidak valid</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password *</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control text-xs" name="edit_password" id="edit_password">
                            <span toggle="#edit_password" class="fa fa-eye-slash toggle-password eye-icon"></span>
                            <span class="invalid_edit_password">Minimal 6 Karakter</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control text-xs" name="edit_confirm_pass" id="edit_confirm_pass">
                            <span toggle="#edit_confirm_pass" class="fa fa-eye-slash toggle-password eye-icon"></span>
                            <span class="invalid_edit_confirm_pass">Minimal 6 Karakter</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select name="edit_role" class="form-control text-xs">
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
                <button type="button" class="btn btn-primary text-xs" onclick="admin_edit()">Save</button>
            </div>
        </div>
    </div>
</div>