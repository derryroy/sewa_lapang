<section id="hero" style="height:200px;">
    <div class="carousel-item active" style="background-image:url(<?php echo base_url(); ?>assets/front/img/lapang.jpg);background-position:bottom;">
        <div class="carousel-container">
            <div class="container text-start">
                <h3 class="animated fadeInDown text-white fw-bold"><span>DAFTAR KERANJANG</span></h3>
            </div>
        </div>
    </div>
</section>

<main>
    <section>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="card shadow mb-4">
                        <div class="card-body row justify-content-center">
                            <div class="col-sm-11" style="font-size:13px;">
                                <h5 class="card-title mt-3">Detail Informasi</h5>

                                <div class="row">
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
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

                            <hr class="mt-4 mb-0">

                            <div class="card-body mt-3">
                                <table class="table" style="vertical-align:middle;font-size:13px;">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Sesi</th>
                                            <th>Harga</th>
                                            <th class="col-sm-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="daftar_keranjang"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo base_url() . 'assets/front/js/page/keranjang.js?version=' . time(); ?>"></script>