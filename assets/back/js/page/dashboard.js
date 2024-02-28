var sdate = '';
var edate = '';

var month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
var day = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

var date_now = new Date();

$(document).ready(function () {
    dateNow();
    getData();
    $('.today').attr('disabled', 'disabled');

    $('.resDate').text(day[date_now.getDay()] + ', ' + date_now.getDate() + ' ' + month[date_now.getMonth()] + ' ' + date_now.getFullYear());
    get_data(date_now.toISOString().slice(0, 10));
    dataCalendar(date_now.toISOString().slice(0, 10));
    $('#calendar button').addClass('btn-sm text-xs');

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

function frmt_date(d, opt) {
    dt = d.split('-');
    date = new Date(dt[0], dt[1] - 1, dt[2]);

    if (opt == 'next') {
        date.setDate(date.getDate() + 2);
        sdate = date.toISOString().slice(0, 10);
        date.setDate(date.getDate() + 6);
        edate = date.toISOString().slice(0, 10);
    } else if (opt == 'prev') {
        date.setDate(date.getDate());
        edate = date.toISOString().slice(0, 10);
        date.setDate(date.getDate() - 6);
        sdate = date.toISOString().slice(0, 10);
    }
}

function dateNow() {
    var d = new Date();

    sdate = d.setDate(d.getDate() - d.getDay() + 1);
    sdate = d.toISOString().slice(0, 10);

    edate = d.setDate(d.getDate() + (7 - d.getDay()));
    edate = d.toISOString().slice(0, 10);
}

function week(opt = '') {
    if (opt == 'next') {
        frmt_date(edate, 'next');
        getData();
        $('.today').removeAttr('disabled');
    } else if (opt == 'prev') {
        frmt_date(sdate, 'prev');
        getData();
        $('.today').removeAttr('disabled');
    } else if (opt == 'today') {
        dateNow();
        getData();
        $('.today').attr('disabled', 'disabled');
    }
}

function getData() {
    $('.date').text(dateFormat(sdate) + ' to ' + dateFormat(edate));

    $.ajax({
        url: base_url + 'back/dashboard/getDataBooking',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'sdate': sdate,
            'edate': edate
        },
        dataType: 'TEXT',
        success: function (data) {
            $('.dataTable').html(data);
        }
    });
}

function dateFormat(date) {
    var d = new Date(date);
    return d.getDate() + ' ' + month[d.getMonth()] + ' ' + d.getFullYear();
}

// fullcalendar
var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: 'bootstrap',
    headerToolbar: {
        left: 'title',
        center: '',
        right: 'today prev,next'
    },
    initialDate: new Date(),
    selectable: true,
    firstDay: 1,
    locale: 'id',
    select: function (arg) {
        get_data(arg.startStr);

        if (screen.width < 768) {
            location.href = '#result';
        }
    },
    longPressDelay: 0,
    contentHeight: 430,
});

calendar.render();

function get_data(date) {
    $.ajax({
        url: base_url + 'back/orders/order/get_data',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'date': date
        },
        dataType: 'JSON',
        success: function (data) {
            jdwl = '';
            $.each(data.data, function (key, val) {
                id = 'GCA' + (val.tanggal).replaceAll('-', '') + '000' + val.sesi;
                if (val.booked == 1) {
                    jdwl += '<tr class="table-primary">' +
                        '<td class="col-md-3 col-6">Sesi ' + val.sesi + ' <br> <span>' + val.jam + '</span></td>' +
                        '<td class="text-left col-md-7 col-6">' + val.nama + '</td>' +
                        '<td class="text-left col-md-2">' + val.opt + '</td>' +
                        '</tr>';
                } else {
                    if (val.payment_status == 0) {
                        jdwl += '<tr class="table-warning">' +
                            '<td class="col-md-3 col-6"><b>Sesi ' + val.sesi + '</b> <br> <span>' + val.jam + '</span></td>' +
                            '<td class="text-left col-md-7 col-6"><b>' + val.nama + '</b></td>' +
                            '</tr>';
                    } else {
                        jdwl += '<tr>' +
                            '<td class="col-md-3 col-6"><b>Sesi ' + val.sesi + '</b> <br> <span>' + val.jam + '</span></td>' +
                            '<td class="text-left col-md-7 col-6"><b>' + val.nama + '</b></td>' +
                            '</tr>';
                    }
                }
            });

            $('.jadwal').html(jdwl);

            d = new Date(date);
            $('.resDate').text(day[d.getDay()] + ', ' + d.getDate() + ' ' + month[d.getMonth()] + ' ' + d.getFullYear());
        }
    });
}

function dataCalendar(date) {
    $.ajax({
        url: base_url + 'back/dashboard/get_data_calendar',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'date_now': date
        },
        dataType: 'JSON',
        success: function (data) {
            calendar.removeAllEvents();

            $.each(data, function (key, val) {
                calendar.addEvent({
                    start: val.date,
                    display: 'background',
                    color: '#ffcc00',
                })
            });
        }
    });
}

function option(opt, id, date, sesi, id_order) {
    if (opt == 0) {
        $('input[name="id_detail_order"]').val(id);
        $('input[name="current_date"]').val(date);
        $('input[name="edit_date_order"]').val(date);
        $('input[name="sesi"][value="' + sesi + '"]').prop('checked', true);
        $('input[name="current_sesi"]').val(sesi);
        $('#id_order').text(id_order);

        $('#editOrder').modal('show');
    }
}

function editDateOrder() {
    $.ajax({
        url: base_url + 'back/orders/data/edit_order',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id_detail_pesanan': $('input[name="id_detail_order"]').val(),
            'tanggal_lama': $('input[name="current_date"]').val(),
            'tanggal': $('input[name="edit_date_order"]').val(),
            'sesi': $('input[name="sesi"]:checked').val(),
            'sesi_lama': $('input[name="current_sesi"]').val()
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.status == 1) {
                toastr.success(data.message);
                $(".modal .close").click();
                get_data($('input[name="edit_date_order"]').val());
                dataCalendar(date_now.toISOString().slice(0, 10));
            } else {
                toastr.error(data.message);
            }
        }
    });
}