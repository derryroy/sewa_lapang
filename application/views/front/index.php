<?php include 'includes_top.php'; ?>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-inner-pages">
        <?php include 'header.php'; ?>
    </header><!-- End Header -->

    <?php include 'page/' . $page_name . '.php'; ?>

    <?php if ($page_name != 'login' && $page_name != 'register') {
        include 'footer.php';
    } ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Modal Login -->
    <div class="modal fade text-xs" id="login" tabindex="-1" aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="login">Masuk</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                                <input type="password" name="password_login" class="form-control text-xs" placeholder="Masukkan Kata Sandi Anda" id="password-eye">
                                <span class="input-group-text fas fa-eye-slash toggle-password text-xs" toggle="#password-eye"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <a href="javascript:;" style="float:right;" data-bs-toggle="modal" data-bs-target="#forgotPass">Lupa Kata Sandi Anda</a>
                        </div>
                        <button type="button" class="btn btn-primary form-control mt-3 mb-2 text-sm" onclick="form_login()"><strong>Masuk</strong></button>
                    </div>
                    <div class="mt-3 text-center">
                        <span>Belum Punya Akun? </span>
                        <a href="<?php echo base_url(); ?>register">Daftar</a>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <!-- Modal Forgot Password -->
    <div class="modal fade text-xs" id="forgotPass">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Lupa Password</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email_forgot" class="form-control text-xs" placeholder="Masukkan Email Anda">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary form-control mt-3 text-sm" onclick="form_forgot()"><strong>Send Request</strong></button>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <!-- Vendor JS Files -->
    <script src="<?php echo base_url(); ?>assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo base_url(); ?>assets/front/js/main.js"></script>

    <script src="<?php echo base_url(); ?>assets/front/js/page/index.js"></script>

    <script>
        var base_url = "<?php echo base_url(); ?>";
        var ses_login = "<?php echo $this->session->userdata('user_login'); ?>";
        var ses_popup = '<?php echo $this->session->userdata('popup'); ?>';
    </script>

</body>

</html>