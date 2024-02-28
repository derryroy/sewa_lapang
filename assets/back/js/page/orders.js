// List Orders
var date_now = new Date();

$(document).ready(function () {
    ordersData();

    //Date picker
    $('#date_sdate_report,#date_edate_report').datetimepicker({
        format: 'YYYY-MM-DD',
        locale: 'id',
    });

    moment.locale('id', {
        week: {
            dow: 1
        }
    });

    $('input[name="date_sdate_report"]').val(date_now.toISOString().slice(0, 10));
    $('input[name="date_edate_report"]').val(date_now.toISOString().slice(0, 10));

    daterange();
});

function ordersData(type = '') {
    var sdate = '';
    var edate = '';
    var status = '';
    var year = '';
    var month = '';

    if (type == 'date') {
        sdate = $('input[name="date_sdate_report"]').val();
        edate = $('input[name="date_edate_report"]').val();
        status = $('select[name="date_status_report"]').val();
    } else if (type == 'month') {
        year = $('select[name="month_year_report"]').val();
        month = $('select[name="month_report"]').val();
        status = $('select[name="month_status_report"]').val();
    } else if (type == 'year') {
        year = $('select[name="year_report"]').val();
        status = $('select[name="year_status_report"]').val();
    } else if (type == 'all') {
        status = $('select[name="all_status_report"]').val();
    }

    $('#ordersData').DataTable().destroy();
    table = $('#ordersData').DataTable({
        'processing': true,
        'serverSide': true,
        'order': [],
        'ajax': {
            'url': base_url + 'back/orders/data/list',
            'type': 'POST',
            'data': {
                csrf_name: csrf_hash,
                'type': type,
                'sdate': sdate,
                'edate': edate,
                'year': year,
                'month': month,
                'status': status
            },
            'dataSrc': function (data) {
                return data.data;
            }
        },
        'columnDefs': [{
            'targets': [0, 4, 6, 7],
            'orderable': false
        }],
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('DataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('DataTables'));
        }
    });
}

function option(opt, id, status = 0) {
    if (opt == 0) {
        $('input[name="order_id"]').val(id);
        $('select[name="status"]').val(status).change();
        $('#editStatus').modal('show');
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
        success: function () {
            $(".modal .close").click();
            $('#ordersData').DataTable().ajax.reload();
        }
    });
}

function daterange() {
    $('input[name="daterange"]').daterangepicker({
        maxDate: new Date(),
        opens: 'left',
        locale: {
            format: 'YYYY-MM-DD',
            separator: " to "

        },
    }, function(start, end) {
        $('input[name="sdate"]').val(start.format('YYYY-MM-DD'));
        $('input[name="edate"]').val(end.format('YYYY-MM-DD'));
    });

    $('input[name="sdate"]').val(date_now.toISOString().slice(0, 10));
    $('input[name="edate"]').val(date_now.toISOString().slice(0, 10));
}

$('#exportPdf').on('hidden.bs.modal', function() {
    $('#exportPdf input').val('');
    $('#exportPdf select').val('all');
    daterange();
});