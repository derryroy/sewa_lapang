<!-- Modal Edit User -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <input type="text" class="form-control text-xs" name="edit_user_id" hidden>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-xs" name="edit_name" required="">
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
                        <label class="col-sm-3 col-form-label">Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-xs" name="edit_phone" maxlength="13">
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
                        <label class="col-sm-3 col-form-label">Nama Klub</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-xs" name="edit_clubname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Telepon Lainnya</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-xs" name="edit_phone2" maxlength="13">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-xs" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary text-xs editUser" onclick="user_edit()">Save</button>
            </div>
        </div>
    </div>
</div>