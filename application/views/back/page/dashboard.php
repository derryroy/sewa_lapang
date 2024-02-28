<style>
    @media (max-width: 1140px) {
        .price {
            display: none;
        }
    }
</style>

<!-- DataTales -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="text-center mb-5">
            <h3>Jadwal Penggunaan Lapangan Basket</h3>
        </div>
        <div class="content row">
            <div class="col-sm-6">
                <div class="mb-5" id="calendar"></div>
            </div>
            <div class="col-sm-6 result" id="result">
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
    </div>
</div>
<!--  -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="text-center">
            <h6 class="date"></h6>
            <div>
                <button type="button" class="btn btn-sm btn-info text-xs mr-1" onclick="week('prev')"><i class="fas fa-angle-left"></i> Prev</button>
                <button type="button" class="btn btn-sm btn-success text-xs mr-1 today" onclick="week('today')">Today</button>
                <button type="button" class="btn btn-sm btn-info text-xs" onclick="week('next')">Next <i class="fas fa-angle-right"></i></button>
            </div>
        </div>
        <div class="mt-5 dataTable"></div>
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
                <input type="text" name="id_detail_order" hidden>
                <input type="text" name="current_date" hidden>
                <input type="text" name="current_sesi" hidden>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Order ID</label>
                    <div class="col-sm-9">
                        <label class="col-form-label font-weight-bold" id="id_order"></label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Date</label>
                    <div class="col-sm-9">
                        <div class="input-group" id="edit_date_order" data-target-input="nearest">
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
                                        <?php echo '<b>Session ' . $i . '</b><br>' . $dataJam[$i - 1]; ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-6 col-6">
                            <?php for ($i = 5; $i <= 8; $i++) { ?>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="sesi" id="<?php echo 'sesi' . $i; ?>" value="<?php echo $i; ?>">
                                    <label class="form-check-label text-center" for="<?php echo 'sesi' . $i; ?>">
                                        <?php echo '<b>Session ' . $i . '</b><br>' . $dataJam[$i - 1]; ?>
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

<script src="<?php echo base_url(); ?>assets/back/js/page/dashboard.js"></script>