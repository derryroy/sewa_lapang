<main>
    <section>
        <div class="container-fluid">
            <div class="section-title">
                <h3>Masuk Akun Anda</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body text-xs">
                            <div class="container">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email_login" class="form-control text-xs" placeholder="Masukkan Email Anda">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kata Sandi</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        <input type="password" name="password_login" class="form-control text-xs" id="password-login" placeholder="Masukkan Kata Sandi Anda">
                                        <span class="input-group-text fas fa-eye-slash toggle-password text-xs" toggle="#password-login"></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <a href="javascript:;" style="float:right;" data-bs-toggle="modal" data-bs-target="#forgotPass">Lupa Kata Sandi Anda</a>
                                </div>
                                <button type="button" class="btn btn-primary form-control mt-3 mb-2 text-sm" onclick="form_login()"><strong>Masuk</strong></button>
                            </div>
                            <div class="mt-3 text-center">
                                <span>Tidak punya akun? </span>
                                <a href="<?php echo base_url(); ?>register">Daftar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>