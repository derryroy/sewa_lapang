<section id="hero" style="height:200px;">
    <div class="carousel-item active" style="background:url(<?php echo base_url(); ?>assets/front/img/lapang.jpg) bottom;">
        <div class="carousel-container">
            <div class="container text-start">
                <h3 class="animated fadeInDown text-white fw-bold"><span>ORDERS</span></h3>
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="listOrders" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Order Number</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Discount</th>
                                                <th>Grand Total</th>
                                                <th>Catatan</th>
                                                <th class="col-sm-1">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal Detail Order -->
<div class="modal fade" id="detail_order">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size:13px;">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-sm-4 fw-bold">Nomor Pesanan</label>
                                    <label class="col-sm-8 detail_order_id"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 fw-bold">Nama Lengkap</label>
                                    <label class="col-sm-8 detail_name"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 fw-bold">Alamat Email</label>
                                    <label class="col-sm-8 detail_email"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 fw-bold">Telepon</label>
                                    <label class="col-sm-8 detail_phone"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 fw-bold">Status</label>
                                    <label class="col-sm-8 detail_status"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 fw-bold">Tgl Pesanan</label>
                                    <label class="col-sm-8 detail_tanggal_pesanan"></label>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4 fw-bold">Tgl Kadalurasa</label>
                                    <label class="col-sm-8 detail_tanggal_kadaluarsa"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <label class="col-sm-4 fw-bold">Nama Klub</label>
                                    <label class="col-sm-8 detail_clubname"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 fw-bold">Telepon Lainnya</label>
                                    <label class="col-sm-8 detail_phone2"></label>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-5">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Sesi</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody id="listDetailOrder"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cancel Order -->
<div class="modal fade" id="cancel_order" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="font-size:13px;">
            <div class="modal-header">
                <h5 class="modal-title">Batalkan Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="id_pesanan" hidden>
                Apakah anda ingin membatalkan pesanan ini ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-xs" data-bs-toggle="modal" data-bs-target="#detail_order">Kembali</button>
                <button type="button" class="btn btn-danger text-xs" onclick="cancel_order()">Batalkan</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . 'assets/front/js/page/pesanan.js?version=' . time(); ?>"></script>