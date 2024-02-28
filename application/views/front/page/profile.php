<section id="hero" style="height:200px;">
    <div class="carousel-item active" style="background:url(<?php echo base_url(); ?>assets/front/img/lapang.jpg) bottom;">
        <div class="carousel-container">
            <div class="container text-start">
                <h3 class="animated fadeInDown text-white fw-bold"><span>PROFIL</span></h3>
            </div>
        </div>
    </div>
</section>

<main>
    <section>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-11 row">
                    <?php include 'menu_left.php'; ?>
                    <div class="col-md-9 col-lg-10">
                        <div class="card" style="font-size:13px;">
                            <div class="card-body pt-3">
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Ringkasan</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Ubah Profil</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ganti Kata Sandi</button>
                                    </li>

                                </ul>
                                <div class="tab-content pt-2">
                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <div class="card">
                                            <div class="card-body mb-3 row">
                                                <div class="col-lg-6">
                                                    <h5 class="card-title mt-3">Profil Lengkap</h5>
                                                    <div class="row mt-3">
                                                        <div class="col-md-4 label fw-semibold">Nama Lengkap</div>
                                                        <div class="col-md-8"><?php echo $user_data->nama; ?></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-4 label fw-semibold">Email</div>
                                                        <div class="col-md-8"><?php echo $user_data->email; ?></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-4 label fw-semibold">Telepon</div>
                                                        <div class="col-md-8"><?php echo $user_data->telepon; ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h5 class="card-title mt-3">Info Lainnya</h5>
                                                    <div class="row mt-3">
                                                        <div class="col-md-4 label fw-semibold">Nama Klub</div>
                                                        <div class="col-md-8"><?php echo $user_data->nama_klub != null ? $user_data->nama_klub : '&minus;'; ?></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-4 label fw-semibold">Telepon Lainnya</div>
                                                        <div class="col-md-8"><?php echo $user_data->telepon2 != null ? $user_data->telepon2 : '&minus;'; ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                        <div class="card">
                                            <div class="card-body mb-3">
                                                <form method="post" id="update_profile">
                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label">Nama Lengkap</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-sm" name="profile_name" value="<?php echo $user_data->nama; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label">Alamat Email</label>
                                                        <div class="col-md-9">
                                                            <input type="email" class="form-control form-control-sm" name="profile_email" value="<?php echo $user_data->email; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label">Telepon</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-sm" name="profile_phone" maxlength="13" value="<?php echo $user_data->telepon; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label">Nama Klub</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-sm" name="profile_clubname" value="<?php echo $user_data->nama_klub; ?>">
                                                            <i class="fas clubname fs-5" style="float:right;margin:-25px 15px 0px 0px;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label">Telepon Lainnya</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control form-control-sm" name="profile_phone2" maxlength="13" value="<?php echo $user_data->telepon2; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-sm btn-primary text-sm">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade pt-3" id="profile-change-password">
                                        <div class="card">
                                            <div class="card-body mb-3">
                                                <form method="post" id="update_password">
                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label">Kata Sandi Lama</label>
                                                        <div class="col-md-9">
                                                            <input type="password" class="form-control form-control-sm" name="old_pass" required>
                                                            <i class="fas old-pass fs-5" style="float:right;margin:-25px 15px 0px 0px;"></i>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label">Kata Sandi Baru</label>
                                                        <div class="col-md-9">
                                                            <input type="password" class="form-control form-control-sm" name="new_pass" required>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label">Ulang Kata Sandi Baru</label>
                                                        <div class="col-md-9">
                                                            <input type="password" class="form-control form-control-sm" name="confirm_new_pass" required>
                                                            <span class="confirm-new-pass" style="font-size:12px;">Kata Sandi Benar</span>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-sm btn-primary text-sm save-pass" disabled>Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo base_url() . 'assets/front/js/page/profile.js?version=' . time(); ?>"></script>