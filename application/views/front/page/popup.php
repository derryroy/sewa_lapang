<!-- Modal Bayar-->
<div class="modal fade" id="payment" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="font-size:13px;">
            <form method="post" id="kirim_bukti">
                <div class="modal-header">
                    <h5 class="modal-title">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <h3 class="text-center">C-tra Arena</h3>
                        <div class="mb-4">
                            <h6>Silahkan selesaikan pembayaran anda :</h6>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="text" name="id_pesanan" hidden>
                            <input type="text" name="no_pesanan" hidden>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">
                                    <h6>Nomor Pesanan</h6>
                                </label>
                                <div class="col-sm-6 text-end">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" name="nomor_pesanan" id="nomor_pesanan" disabled style="background:transparent;text-align:right;border:0px;">
                                        <a href="javascript:;" class="input-group-text" onclick="copyText('nomor_pesanan')"><i class="far fa-copy"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">
                                    <h6>Pembayaran Melalui</h6>
                                </label>
                                <div class="col-sm-6 text-end">
                                    <img src="<?php echo base_url() . 'assets/front/img/logo-permata.png'; ?>" width="100">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">
                                    <h6>Nomor Rekening</h6>
                                </label>
                                <div class="col-sm-6 text-end">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="no_rekening" value="1234567890" disabled style="background:transparent;text-align:right;border:0px;">
                                        <a href="javascript:;" class="input-group-text" onclick="copyText('no_rekening')"><i class="far fa-copy"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">
                                    <h6>Total Pembayaran</h6>
                                </label>
                                <div class="col-sm-6 text-end">
                                    <h6 class="total_harga mb-3"></h6>
                                </div>
                            </div>
                            <br>
                            <h7>&#10033;Nomor Pesanan masukan di berita transfer</h7>
                            <br>
                            <h7>&#10033;Transaksi yang sudah dibayar tidak bisa dikembalikan</h7>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="preview mt-4"></div>
                                    <div class="input-group mb-3">
                                        <input type="file" name="file" accept="image/*" class="form-control" id="file" hidden>
                                        <label for="file" class="btn btn-sm btn-primary"><i class="fas fa-sm fa-search"></i> Unggah</label>
                                        <input type="text" class="form-control form-control-sm" id="filename" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="text-center" id="time"></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary text-xs">KIRIM</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Kurang Bayar-->
<div class="modal fade" id="payment2" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="font-size:13px;">
            <form method="post" id="kirim_bukti_2">
                <div class="modal-header">
                    <h5 class="modal-title">Pembayaran Kurang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <h3 class="text-center">C-tra Arena</h3>
                        <div class="mb-4">
                            <h6>Silahkan selesaikan pembayaran anda yang kurang :</h6>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="text" name="id_pesanan_2" hidden>
                            <input type="text" name="no_pesanan_2" hidden>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">
                                    <h6>Nomor Pesanan</h6>
                                </label>
                                <div class="col-sm-6 text-end">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" name="nomor_pesanan" id="nomor_pesanan" disabled style="background:transparent;text-align:right;border:0px;">
                                        <a href="javascript:;" class="input-group-text" onclick="copyText('nomor_pesanan')"><i class="far fa-copy"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">
                                    <h6>Pembayaran Melalui</h6>
                                </label>
                                <div class="col-sm-6 text-end">
                                    <img src="<?php echo base_url() . 'assets/front/img/logo-permata.png'; ?>" width="100">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">
                                    <h6>Nomor Rekening</h6>
                                </label>
                                <div class="col-sm-6 text-end">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="no_rekening" value="1234567890" disabled style="background:transparent;text-align:right;border:0px;">
                                        <a href="javascript:;" class="input-group-text" onclick="copyText('no_rekening')"><i class="far fa-copy"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row border">
                                <label class="col-sm-12 col-form-label">
                                    <h6>Catatan :</h6>
                                </label>
                                <h6 class="catatan mb-3"></h6>
                            </div>
                            <br>
                            <h7>&#10033;Nomor Pesanan masukan di berita transfer</h7>
                            <br>
                            <h7>&#10033;Transaksi yang sudah dibayar tidak bisa dikembalikan</h7>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="preview2 mt-4"></div>
                                    <div class="input-group mb-3">
                                        <input type="file" name="file2" accept="image/*" class="form-control" id="file2" hidden>
                                        <label for="file2" class="btn btn-sm btn-primary"><i class="fas fa-sm fa-search"></i> Unggah</label>
                                        <input type="text" class="form-control form-control-sm" id="filename2" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="text-center" id="time"></h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary text-xs">KIRIM</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Payment Status -->
<div class="modal fade" id="payment_status">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" style="font-size:12px;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position:absolute;top:-10px;right:-10px;background-color:#fff;"></button>
                <div class="payment_status"></div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . 'assets/front/js/page/popup.js?version=' . time(); ?>"></script>