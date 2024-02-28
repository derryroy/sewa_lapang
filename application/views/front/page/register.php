<main>
    <section>
        <div class="container-fluid">
            <div class="section-title">
                <h3>Daftar Akun Anda</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body text-xs">
                            <div class="container">
                                <form id="form_register">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Anda</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                            <input type="text" name="name_register" class="form-control text-xs" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat Email</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" name="email_register" class="form-control text-xs" required>
                                        </div>
                                        <span class="invalid_email text-danger" hidden>Email sudah ada.</span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Telepon</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="text" name="phone_register" maxlength="13" class="form-control text-xs" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kata Sandi</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" name="password_register" class="form-control text-xs" id="password-register" required>
                                            <span class="input-group-text fas fa-eye-slash toggle-password text-xs" toggle="#password-register"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Sandi</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            <input type="password" name="confirm_password_register" class="form-control text-xs" id="confirm-password-register" required>
                                            <span class="input-group-text fas fa-eye-slash toggle-password text-xs" toggle="#confirm-password-register"></span>
                                        </div>
                                        <span class="confirm-pass"></span>
                                    </div>
                                    <div class="mt-5" style="margin:auto;">
                                        <button type="submit" class="btn btn-primary form-control"><strong>Daftar</strong></button>
                                    </div>
                                    <div class="mt-3 text-sm text-center">
                                        <span>Punya akun? </span>
                                        <a href="<?php echo base_url(); ?>login">Masuk</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo base_url() . 'assets/front/js/page/register.js?version=' . time(); ?>"></script>