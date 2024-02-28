var month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
var day = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

var date_now = new Date();

$(document).ready(function () {
    $('.resDate').text(day[date_now.getDay()] + ', ' + date_now.getDate() + ' ' + month[date_now.getMonth()] + ' ' + date_now.getFullYear());
    get_data(date_now.toISOString().slice(0, 10));

    $('#calendar button').addClass('btn-sm text-xs');

    cart_list();
    dataCalendar();
});

function get_data(date) {
    $.ajax({
        url: base_url + 'back/orders/order/get_data',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'date': date,
            'event': 'event'
        },
        dataType: 'JSON',
        success: function (data) {
            jdwl = '';
            disabled = 0;
            btn_disabled = '';
            booking = 0;

            $.each(data.data, function (key, val) {
                if (val.booked == 1) {
                    jdwl += '<tr class="table-primary">' +
                        '<td class="col-sm-4"><b>Sesi ' + val.sesi + '</b> <br> <span>' + val.jam + '</span></td>' +
                        '<td class="col-sm-8 text-left"><b>' + val.nama + '</b></td>' +
                        '</tr>';
                    disabled++;
                } else {
                    if (val.disabled == 'disabled') {
                        if (val.user) {
                            jdwl += '<tr class="table-secondary">' +
                                '<td class="col-sm-4"><b>Sesi ' + val.sesi + '</b> <br> <span>' + val.jam + '</span></td>' +
                                '<td class="col-sm-8 price text-left"><b>' + val.user + '</b></td>' +
                                '</tr>';

                            disabled++;
                        } else {
                            jdwl += '<tr class="table-secondary">' +
                                '<td class="col-sm-4"><b>Sesi ' + val.sesi + '</b> <br> <span>' + val.jam + '</span></td>' +
                                '<td class="col-sm-8 price text-left"><b>' + val.nama + '</b></td>' +
                                '</tr>';

                            disabled++;
                        }
                    } else if (val.booking == 1 && val.event == 0) {
                        jdwl += '<tr class="table-secondary">' +
                            '<td class="col-sm-4"><b>Sesi ' + val.sesi + '</b> <br> <span>' + val.jam + '</span></td>' +
                            '<td class="col-sm-8 price text-left"><b>' + val.user + '</b></td>' +
                            '</tr>';

                        disabled++;
                    } else {
                        jdwl += '<tr>' +
                            '<td class="col-sm-4"><b>Sesi ' + val.sesi + '</b> <br> <span>' + val.jam + '</span></td>' +
                            '<td class="col-sm-8 price text-left"><b>' + val.nama + '</b></td>' +
                            '</tr>';
                    }

                    if (val.booking == 1 && val.event == 1) {
                        booking++;
                    }
                }
            });

            if (disabled > 0) {
                btn_disabled = 'disabled';
            }

            if (booking == 8) {
                jdwl += '<tr>' +
                    '<td colspan="2"><h5>Harga Event : ' + data.price_event + '</h5><button class="form-control btn btn-sm btn-danger text-xs" onclick="unbooking_event(\'' + date + '\')"><i class="fas fa-trash-alt"></i> Remove Event</button></td>' +
                    '</tr>';
            } else {
                jdwl += '<tr>' +
                    '<td colspan="2"><h5>Harga Event : ' + data.price_event + '</h5><button class="form-control btn btn-sm btn-primary text-xs" onclick="booking_event(\'' + date + '\')" ' + btn_disabled + '><i class="fas fa-shopping-cart"></i> Book Event</button></td>' +
                    '</tr>';
            }

            $('.jadwal').html(jdwl);

            d = new Date(date);
            $('.resDate').text(day[d.getDay()] + ', ' + d.getDate() + ' ' + month[d.getMonth()] + ' ' + d.getFullYear());
        }
    });
}

function booking_event(date) {
    $.ajax({
        url: base_url + 'back/orders/order/booking_event/add',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'date': date
        },
        success: function () {
            get_data(date);
            cart_list();
            dataCalendar();
        }
    });
}

function unbooking_event(date) {
    $.ajax({
        url: base_url + 'back/orders/order/booking_event/remove',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'date': date
        },
        success: function () {
            get_data(date);
            cart_list();
            dataCalendar();
        }
    });
}

// fullcalendar
// document.addEventListener('DOMContentLoaded', function() {
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
    },
    longPressDelay: 0,
    contentHeight: 430,
});

calendar.render();
// });

function cart_list() {
    $.ajax({
        url: base_url + 'back/orders/order/cart_list_event',
        type: 'POST',
        data: {
            csrf_name: csrf_hash
        },
        dataType: 'JSON',
        success: function (data) {
            table_cart(data);
            $('input[name="event_name"]').val('');
            $('input[name="phone"]').val('');
        }
    });
}

function table_cart(data) {
    tbl = '';

    if (data.data1.length > 0) {
        $.each(data.data1, function (key, val) {
            tbl += '<tr>' +
                '<td>' + val.date + '</td>' +
                '<td>' + val.sesi + '</td>' +
                '<td>' + val.price + '</td>' +
                '<td>' + val.opt + '</td>' +
                '</tr>';
        });

        tbl += '<tr>' +
            '<td colspan="3"><h6>Total Harga</h6></td>' +
            '<td colspan="2"><h5>' + rupiah(data.data2.total_price) + '</h5></td>' +
            '</tr>';
        tbl += '<tr>' +
            '<td colspan="5" class="text-right"><button class="btn btn-sm btn-primary" onclick="checkout()"><i class="fas fa-money-bill-wave"></i> Payment</button></td>' +
            '</tr>';
    } else {
        tbl += '<tr>' +
            '<td colspan="5"><div class="card-body bg-primary bg-opacity-25 text-center text-white" style="padding:30px 0px 30px 0px;"><h6>Belum ada pesanan</h6></div></td>' +
            '</tr>';
    }

    $('.cart_list').html(tbl);
}

function checkout() {
    event_name = $('input[name="event_name"]').val();
    phone = $('input[name="phone"]').val();

    if (event_name == '' && phone == '') {
        $('input[name="event_name"], input[name="phone"]').addClass('rounded border-danger');
        $('.invalid-eventname, .invalid-phone').removeAttr('hidden');
    } else if (event_name == '') {
        $('input[name="event_name"]').addClass('rounded border-danger');
        $('.invalid-eventname').removeAttr('hidden');
    } else if (phone == '') {
        $('input[name="phone"]').addClass('rounded border-danger');
        $('.invalid-phone').removeAttr('hidden');
    } else {
        $.ajax({
            url: base_url + 'back/orders/order/checkout',
            type: 'POST',
            data: {
                csrf_name: csrf_hash,
                'nama_klub': event_name,
                'telepon': phone,
                'event': 'event',
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    location.href = base_url + 'back/orders';
                }
            }
        });
    }
}

$('input[name="event_name"]').keyup(function () {
    if ($(this).val().length > 0) {
        $('.invalid-eventname').attr('hidden', 'hidden');
        $(this).removeClass('rounded border-danger');
    }
});

$('input[name="phone"]').keyup(function () {
    if ($(this).val().length > 0) {
        $('.invalid-phone').attr('hidden', 'hidden');
        $(this).removeClass('rounded border-danger');
    }
});

$('input[name="phone"]').bind("keypress", function (e) {
    var keyCode = e.which ? e.which : e.keyCode

    if (!(keyCode >= 48 && keyCode <= 57)) {
        return false;
    }
});

// konversi
function rupiah(bilangan) {
    var reverse = bilangan.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return 'Rp ' + ribuan;
}

function dataCalendar() {
    $.ajax({
        url: base_url + 'back/orders/order/get_data_calendar/event',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
        },
        dataType: 'JSON',
        success: function (data) {
            calendar.removeAllEvents();

            $.each(data, function (key, val) {
                calendar.addEvent({
                    start: val.tanggal,
                    display: 'background',
                    color: '#90C2FF',
                })
            });
        }
    });
}