<style>
    .invalid-clubname,
    .invalid-phone {
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

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Order</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="<?php echo base_url(); ?>back/orders" class="btn btn-sm btn-primary text-xs float-right"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        <div class="content row">
            <div class="col-sm-6">
                <div class="mb-5" id="calendar"></div>
            </div>
            <div class="col-sm-6 result">
                <table class="table text-center" style="vertical-align:middle;">
                    <thead class="text-left">
                        <th colspan="4">
                            <h6 class="resDate">data</h6>
                        </th>
                    </thead>
                    <tbody class="jadwal"></tbody>
                </table>
            </div>
        </div>
        <div class="checkout">
            <div class="card-body row">
                <div class="col-sm-6 mt-3">
                    <label class="form-label">Nama Kontak atau Nama Klub</label>
                    <div class="input-group mb-3">
                        <input type="text" name="nama_klub" class="form-control form-control-sm rounded" placeholder="Nama Kontak atau Nama Klub">
                        <span class="invalid-clubname text-danger" hidden>Nama Kontak atau Nama Klub Diperlukan!</span>
                    </div>
                </div>
                <div class="col-sm-6 mt-3">
                    <label class="form-label">Nomor Telepon</label>
                    <div class="input-group mb-3">
                        <input type="text" name="telepon" class="form-control form-control-sm rounded" maxlength="13" placeholder="08XXX">
                        <span class="invalid-phone text-danger" hidden>Nomor Telepon Diperlukan!</span>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Sesi</th>
                                <th>Harga</th>
                                <th class="col-sm-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="cart_list"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/back/js/page/order_add.js"></script>