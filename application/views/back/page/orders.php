<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Orders</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php if ($this->session->userdata('admin_role') == 1) { ?>
            <a href="<?php echo base_url(); ?>back/orders/order/event" class="btn btn-sm btn-primary text-xs float-right"><i class="fas fa-calendar-alt"></i> Add Event</a>
            <a href="<?php echo base_url(); ?>back/orders/order/add" class="btn btn-sm btn-success text-xs float-right mr-1"><i class="fas fa-plus"></i> Add Order</a>
        <?php } ?>
        <button class="btn btn-sm btn-info text-xs float-right mr-1" data-toggle="modal" data-target="#exportExcel"><i class="fas fa-file-export"></i> Export</button>
    </div>
    <div class="card-body">
        <button class="btn btn-primary btn-sm text-xs mb-3" type="button" data-toggle="collapse" data-target="#collapseExample"><i class="fas fa-filter"></i> Filter</button>
        <div class="collapse mb-3" id="collapseExample">
            <div class="card card-body">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-toggle="tab" data-target="#date">By Date</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-toggle="tab" data-target="#month">By Month</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-toggle="tab" data-target="#year">By Year</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-toggle="tab" data-target="#all">All</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active" id="date">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-sm-12">
                                    <div class="row col-sm-3">
                                        <label class="col-sm-4 col-form-label">Start Date</label>
                                        <div class="col-sm-8">
                                            <div class="input-group date" id="date_sdate_report" data-target-input="nearest">
                                                <input type="text" name="date_sdate_report" class="form-control form-control-sm datetimepicker-input text-xs" data-target="#date_sdate_report" />
                                                <div class="input-group-append" data-target="#date_sdate_report" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar text-xs"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-sm-3">
                                        <label class="col-sm-4 col-form-label">End Date</label>
                                        <div class="col-sm-8">
                                            <div class="input-group date" id="date_edate_report" data-target-input="nearest">
                                                <input type="text" name="date_edate_report" class="form-control form-control-sm datetimepicker-input text-xs" data-target="#date_edate_report" />
                                                <div class="input-group-append" data-target="#date_edate_report" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar text-xs"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-sm-3">
                                        <label class="col-sm-4 col-form-label">Status</label>
                                        <select class="form-control form-control-sm text-xs col-sm-6" name="date_status_report">
                                            <option value="all">All</option>
                                            <?php for ($i = 0; $i < count($status); $i++) {
                                                if ($status[$i]) {
                                                    echo '<option value="' . $i . '">' . $status[$i] . '</option>';
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 row">
                                        <div class="col-sm-12">
                                            <button class="btn btn-sm btn-primary text-xs" onclick="ordersData('date')"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="month">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-sm-12">
                                    <div class="col-sm-3 row">
                                        <label class="col-sm-4 col-form-label">Year</label>
                                        <select class="form-control form-control-sm text-xs col-sm-6" name="month_year_report">
                                            <?php foreach ($year as $row) {
                                                $selected = '';

                                                if ($row->year == date('Y')) {
                                                    $selected = 'selected';
                                                }

                                                echo '<option value="' . $row->year . '"' . $selected . '>' . $row->year . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 row">
                                        <label class="col-sm-4 col-form-label">Month</label>
                                        <select class="form-control form-control-sm text-xs col-sm-6" name="month_report">
                                            <?php for ($i = 1; $i <= 12; $i++) {
                                                $selected = '';

                                                if ($i == date('m')) {
                                                    $selected = 'selected';
                                                }

                                                $date_str = date('F', mktime(0, 0, 0, $i));
                                                echo '<option value="' . $i . '"' . $selected . '>' . $date_str . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="row col-sm-3">
                                        <label class="col-sm-4 col-form-label">Status</label>
                                        <select class="form-control form-control-sm text-xs col-sm-6" name="month_status_report">
                                            <option value="all">All</option>
                                            <?php for ($i = 0; $i < count($status); $i++) {
                                                if ($status[$i]) {
                                                    echo '<option value="' . $i . '">' . $status[$i] . '</option>';
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 row">
                                        <div class="col-sm-12">
                                            <button class="btn btn-sm btn-primary text-xs" onclick="ordersData('month')"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="year">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-sm-12">
                                    <div class="col-sm-3 row">
                                        <label class="col-sm-4 col-form-label">Year</label>
                                        <select class="form-control form-control-sm text-xs col-sm-6" name="year_report">
                                            <?php foreach ($year as $row) {
                                                $selected = '';

                                                if ($row->year == date('Y')) {
                                                    $selected = 'selected';
                                                }

                                                echo '<option value="' . $row->year . '"' . $selected . '>' . $row->year . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="row col-sm-3">
                                        <label class="col-sm-4 col-form-label">Status</label>
                                        <select class="form-control form-control-sm text-xs col-sm-6" name="year_status_report">
                                            <option value="all">All</option>
                                            <?php for ($i = 0; $i < count($status); $i++) {
                                                if ($status[$i]) {
                                                    echo '<option value="' . $i . '">' . $status[$i] . '</option>';
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 row">
                                        <div class="col-sm-12">
                                            <button class="btn btn-sm btn-primary text-xs" onclick="ordersData('year')"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="all">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-sm-12">
                                    <div class="row col-sm-3">
                                        <label class="col-sm-4 col-form-label">Status</label>
                                        <select class="form-control form-control-sm text-xs col-sm-6" name="all_status_report">
                                            <option value="all">All</option>
                                            <?php for ($i = 0; $i < count($status); $i++) {
                                                if ($status[$i]) {
                                                    echo '<option value="' . $i . '">' . $status[$i] . '</option>';
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 row">
                                        <div class="col-sm-12">
                                            <button class="btn btn-sm btn-primary text-xs" onclick="ordersData('all')"><i class="fas fa-filter"></i> Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="ordersData" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pesanan</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Options</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Status -->
<div class="modal fade" id="editStatus">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="text" name="order_id" hidden>
                <select class="form-control text-xs" name="status">
                    <option value="0">Belum Diproses</option>
                    <option value="1">Dalam Proses</option>
                    <option value="2">Berhasil</option>
                    <!-- <option value="3">Kadaluarsa</option> -->
                    <option value="4">Dibatalkan</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-xs" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary text-xs" onclick="edit_status()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Loading -->
<div class="modal fade" id="loading" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class=" modal-body text-center">
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <strong class="text-primary">Loading...</strong>
            </div>
        </div>
    </div>
</div>

<!-- Modal Export Excel -->
<div class="modal fade" id="exportExcel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . 'back/orders/export_pdf' ?>" method="post" target="_blank">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Daterange</label>
                        <div class="col-sm-10">
                            <div class="daterange input-group float-left">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" name="daterange" class="form-control float-right text-xs">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control form-control-sm text-xs col-sm-4" name="status">
                                <option value="all">All</option>
                                <?php for ($i = 0; $i < count($status); $i++) {
                                    if ($status[$i]) {
                                        echo '<option value="' . $i . '">' . $status[$i] . '</option>';
                                    }
                                } ?>
                            </select>
                        </div>
                    </div> -->
                    <input type="text" name="sdate" hidden>
                    <input type="text" name="edate" hidden>
                    <button type="submit" class="btn btn-sm btn-info text-xs float-right"><i class="fas fa-file-export"></i> Export</button>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/back/js/page/orders.js"></script>