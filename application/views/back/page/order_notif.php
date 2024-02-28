<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Order Notif</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3"></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="notifData" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Order</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) { ?>
                        <tr>
                            <td><?php echo $row['no']; ?></td>
                            <td><?php echo $row['id_order']; ?></td>
                            <td><?php echo $row['clubname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['payment_status']; ?></td>
                            <td><?php echo $row['date_add']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                            <td><?php echo $row['option']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
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
                    <option value="0">Unprocessed</option>
                    <option value="2">Success</option>
                    <option value="7">Expired</option>
                    <option value="8">Cancelled</option>
                    <option value="9">Unknown</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-xs" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary text-xs" onclick="edit_status()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Order -->
<div class="modal fade" id="detailOrder">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-2">
                                    <label class="col-sm-4 font-weight-bold">Order Number</label>
                                    <label class="col-sm-8 detail_order_id"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 font-weight-bold">Name / Club Name</label>
                                    <label class="col-sm-8 detail_name"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 font-weight-bold">Phone Number</label>
                                    <label class="col-sm-8 detail_phone"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 font-weight-bold">Discount Code</label>
                                    <label class="col-sm-8 detail_disc_code"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 font-weight-bold">Payment Status</label>
                                    <label class="col-sm-8 detail_status"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 font-weight-bold">Date</label>
                                    <label class="col-sm-8 detail_date"></label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row mb-2">
                                    <label class="col-sm-4 font-weight-bold">Name</label>
                                    <label class="col-sm-8 detail_acc_name"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 font-weight-bold">Email Address</label>
                                    <label class="col-sm-8 detail_acc_email"></label>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 font-weight-bold">Phone</label>
                                    <label class="col-sm-8 detail_acc_phone"></label>
                                </div>
                                <div class="row mb-2 by-admin">
                                    <label class="col-sm-4 font-weight-bold">Added by</label>
                                    <label class="col-sm-8 admin-name"><span class="bg-success text-white rounded" style="padding:2px 7px 2px 7px;"></span></label>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-5">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Arena</th>
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

<script>
    function option(opt, id, status = 0) {
        if (opt == 0) {
            $('input[name="order_id"]').val(id);
            $('select[name="status"]').val(status).change();
            $('#editStatus').modal('show');
        } else if (opt == 1) {
            $.ajax({
                url: base_url + 'back/orders/data/detail_order',
                type: 'POST',
                data: {
                    csrf_name: csrf_hash,
                    'id': id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('.detail_order_id').text(data.data1.id_order);
                    $('.detail_name').text(data.data1.clubname);
                    $('.detail_phone').text(data.data1.phone2);
                    $('.detail_disc_code').text(data.data1.code);
                    $('.detail_status').html(data.data1.payment_status);
                    $('.detail_date').text(data.data1.date_add);
                    $('.detail_acc_name').text(data.data1.name);
                    $('.detail_acc_email').text(data.data1.email);
                    $('.detail_acc_phone').text(data.data1.phone1);

                    if (data.data1.admin_name == null) {
                        $('.by-user').show();
                        $('.by-admin').hide();
                    } else {
                        $('.by-admin').show();
                        $('.admin-name span').text(data.data1.admin_name);
                        $('.by-user').hide();
                    }

                    list_detail_order = '';
                    $.each(data.data2, function(key, val) {
                        list_detail_order += '<tr>' +
                            '<td>' + val.no + '</td>' +
                            '<td>' + val.arena + '</td>' +
                            '<td>' + val.date + '</td>' +
                            '<td>' + val.sesi + '</td>' +
                            '<td>' + val.price + '</td>' +
                            '</tr>';
                    });

                    list_detail_order += '<tr>' +
                        '<td colspan="4" class="text-right">Total Harga</td>' +
                        '<td>' + data.data1.total_price + '</td>' +
                        '</tr>' + '<tr>' +
                        '<td colspan="4" class="text-right">Kupon Diskon</td>' +
                        '<td>' + data.data1.amount + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td colspan="4" class="text-right">Diskon</td>' +
                        '<td>' + data.data1.disc_member + '</td>' +
                        '<tr>' +
                        '<td colspan="4" class="text-right">Grand Total</td>' +
                        '<td>' + data.data1.grand_total + '</td>' +
                        '</tr>';

                    $('#listDetailOrder').html(list_detail_order);

                    $('#detailOrder').modal('show');
                }
            });
        }
    }

    function edit_status() {
        $.ajax({
            url: base_url + 'back/orders/data/edit_status',
            type: 'POST',
            data: {
                csrf_name: csrf_hash,
                'id': $('input[name="order_id"]').val(),
                'status': $('select[name="status"]').val()
            },
            success: function() {
                $(".modal .close").click();
                location.reload();
            }
        });
    }
</script>