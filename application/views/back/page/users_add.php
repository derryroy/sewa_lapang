<!-- Modal Add User -->
<style>
    .invalid-nama,
    .invalid_password {
        position: absolute;
        margin-top: 40px;
        padding-left: 15px;
        font-size: 12px;
    }

    @media (max-width: 768px) {
        .price {
            display: none;
        }
    }

    @media (min-width: 769px) {
        .price_mobile {
            display: none;
        }
    }
</style>

<div class="modal fade" id="addUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
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
                        <label class="col-sm-3 col-form-label">Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-xs" name="phone" maxlength="13">
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
                        <label class="col-sm-3 col-form-label">Nama Klub</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-xs" name="clubname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Telepon Lainnya</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-xs" name="phone2" maxlength="13">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-xs" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary text-xs addUser" onclick="user_add()">Save</button>
            </div>
        </div>
    </div>
</div>