$(document).ready(function () {
    //Date picker
    $('#edit_date_order').datetimepicker({
        format: 'YYYY-MM-DD',
        locale: 'id',
    });

    moment.locale('id', {
        week: {
            dow: 1
        }
    });
});

function option(opt, id, date, sesi) {
    if (opt == 0) {
        $('input[name="id_detail_pesanan"]').val(id);
        $('input[name="tanggal_lama"]').val(date);
        $('input[name="edit_date_order"]').val(date);
        $('input[name="sesi"][value="' + sesi + '"]').prop('checked', true);
        $('input[name="sesi_lama"]').val(sesi);

        $('#editOrder').modal('show');
    } else if (opt == 1) {
        $('input[name="delete_date_id"]').val(id);
        $('#deleteDate').modal('show');
    }
}

function editDateOrder() {
    $.ajax({
        url: base_url + 'back/orders/data/edit_order',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id_detail_pesanan': $('input[name="id_detail_pesanan"]').val(),
            'tanggal_lama': $('input[name="tanggal_lama"]').val(),
            'tanggal': $('input[name="edit_date_order"]').val(),
            'sesi': $('input[name="sesi"]:checked').val(),
            'sesi_lama': $('input[name="sesi_lama"]').val()
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.status == 1) {
                toastr.success(data.message);
                $(".modal .close").click();

                setTimeout(function () {
                    location.reload();
                }, 2000);
            } else {
                toastr.error(data.message);
            }
        }
    });
}


function date_delete() {
    $.ajax({
        url: base_url + 'back/orders/data/delete_date',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id': $('input[name="delete_date_id"]').val()
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.status == 1) {
                toastr.success(data.message);
                $(".modal .close").click();
                location.reload();
            } else {
                toastr.error(data.message);
            }
        }
    });
}

function simpan_catatan() { 
    $.ajax({
        url: base_url + 'back/orders/catatan',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'no_pesanan': $('input[name="no_pesanan"]').val(),
            'catatan': $('textarea[name="catatan"]').val(),
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.status == 1) {
                toastr.success(data.message);
                $(".modal .close").click();
            } else {
                toastr.error(data.message);
            }
        }
    });
}