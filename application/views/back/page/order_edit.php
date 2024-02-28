<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Order</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?php echo base_url(); ?>back/orders" class="btn btn-sm btn-primary text-xs float-right"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="row mb-2">
                    <label class="col-sm-4 font-weight-bold">Nomor Pesanan</label>
                    <label class="col-sm-8"><?php echo $order_data['data1']['no_pesanan']; ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 font-weight-bold">Nama Klub</label>
                    <label class="col-sm-8"><?php echo $order_data['data1']['nama_klub']; ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 font-weight-bold">Nomor Telepon</label>
                    <label class="col-sm-8"><?php echo $order_data['data1']['telepon2']; ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 font-weight-bold">Status Pembayaran</label>
                    <label class="col-sm-8"><?php echo $order_data['data1']['status_pembayaran']; ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 font-weight-bold">Tanggal Pesanan</label>
                    <label class="col-sm-8 "><?php echo $order_data['data1']['tanggal_pesanan']; ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 font-weight-bold">Tanggal Kadaluarsa</label>
                    <label class="col-sm-8 "><?php echo $order_data['data1']['tanggal_kadaluarsa']; ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 font-weight-bold">Tanggal Pembayaran</label>
                    <label class="col-sm-8 "><?php echo $order_data['data1']['tanggal_pembayaran']; ?></label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row mb-2">
                    <label class="col-sm-4 font-weight-bold">Nama</label>
                    <label class="col-sm-8"><?php echo $order_data['data1']['nama']; ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 font-weight-bold">Alamat Email</label>
                    <label class="col-sm-8"><?php echo $order_data['data1']['email']; ?></label>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 font-weight-bold">Telepon Lainnya</label>
                    <label class="col-sm-8"><?php echo $order_data['data1']['telepon1']; ?></label>
                </div>

                <?php
                if ($order_data['data1']['bukti_bayar'] != '') { ?>
                    <div class="row mb-2">
                        <label class="col-sm-4 font-weight-bold">Bukti Bayar</label>
                        <label class="col-sm-8"><img src="<?php echo base_url() . $order_data['data1']['bukti_bayar']; ?>" width="320"></label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-4 font-weight-bold">Bukti Bayar 2</label>
                        <label class="col-sm-8"><img src="<?php echo base_url() . $order_data['data1']['bukti_bayar_2']; ?>" width="320"></label>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-4 font-weight-bold">Catatan</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <input type="text" name="no_pesanan" value="<?php echo $order_data['data1']['no_pesanan']; ?>" hidden>
                                <div class="col-sm-9">
                                    <textarea name="catatan" cols="30" rows="3" class="form-control text-xs"><?php echo $order_data['data1']['catatan'] ?></textarea>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ($this->session->userdata('admin_role') == 1) { ?>
                                        <button class="btn btn-primary text-xs" onclick="simpan_catatan()">Simpan</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($order_data['data1']['nama_admin'] != null) { ?>
                    <div class="row mb-2 by-admin">
                        <label class="col-sm-4 font-weight-bold">Ditambahkan Oleh</label>
                        <label class="col-sm-8 admin-name"><span class="bg-success text-white rounded" style="padding:2px 7px 2px 7px;"><?php echo $order_data['data1']['nama_admin']; ?></span></label>
                    </div>
                <?php } ?>
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
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_data['data2'] as $row) { ?>
                        <tr>
                            <td><?php echo $row['no']; ?></td>
                            <td><?php echo $row['tanggal']; ?></td>
                            <td><?php echo $row['sesi']; ?></td>
                            <td><?php echo $row['harga']; ?></td>
                            <td><?php echo $row['option']; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3" class="text-right">Total Harga</td>
                        <td colspan="2"><?php echo $order_data['data1']['total_price'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Diskon</td>
                        <td colspan="2"><?php echo $order_data['data1']['disc_member'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Grand Total</td>
                        <td colspan="2"><?php echo $order_data['data1']['grand_total'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="tgl"></div>
    </div>
</div>

<!-- Modal Edit Date Order -->
<div class="modal fade" id="editOrder">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Date Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="text" name="id_detail_pesanan" hidden>
                <input type="text" name="tanggal_lama" hidden>
                <input type="text" name="sesi_lama" hidden>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Date</label>
                    <div class="col-sm-9">
                        <div class="input-group date" id="edit_date_order" data-target-input="nearest">
                            <input type="text" name="edit_date_order" class="form-control form-control-sm datetimepicker-input" data-target="#edit_date_order" />
                            <div class="input-group-append" data-target="#edit_date_order" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Session</label>
                    <div class="col-sm-9 row">
                        <div class="col-sm-6 col-6">
                            <?php for ($i = 1; $i <= 4; $i++) { ?>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="sesi" id="<?php echo 'sesi' . $i; ?>" value="<?php echo $i; ?>">
                                    <label class="form-check-label text-center" for="<?php echo 'sesi' . $i; ?>">
                                        <?php echo '<b>Session ' . $i . '</b><br>' . $order_data['dataJam'][$i - 1]; ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-6 col-6">
                            <?php for ($i = 5; $i <= 8; $i++) { ?>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="sesi" id="<?php echo 'sesi' . $i; ?>" value="<?php echo $i; ?>">
                                    <label class="form-check-label text-center" for="<?php echo 'sesi' . $i; ?>">
                                        <?php echo '<b>Session ' . $i . '</b><br>' . $order_data['dataJam'][$i - 1]; ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary text-xs" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary text-xs" onclick="editDateOrder()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Date -->
<div class="modal fade" id="deleteDate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="delete_date_id" hidden>
                Are you sure you want to Delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-xs" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger text-xs" onclick="date_delete()">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/back/js/page/order_edit.js"></script>