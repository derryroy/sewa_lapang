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
            'date': date
        },
        dataType: 'JSON',
        success: function (data) {
            jdwl = '';
            $.each(data.data, function (key, val) {
                id = 'GCA' + (val.tanggal).replaceAll('-', '') + '000' + val.sesi;
                if (val.booked == 1) {
                    jdwl += '<tr class="table-primary">' +
                        '<td><b>Sesi ' + val.sesi + '</b> <br> <span>' + val.jam + '</span></td>' +
                        '<td colspan="3" class="text-left"><b>' + val.nama + '</b></td>' +
                        '</tr>';
                } else {
                    if (val.disabled == '') {
                        btn_color = 'btn-primary';
                    } else {
                        btn_color = 'btn-secondary';
                    }

                    if (val.booking == 1) {
                        btn = '<td class="text-left"><button class="btn btn-sm text-xs btn-danger" onclick="unbooking(\'' + id + '\',\'' + val.tanggal + '\')"><i class="fas fa-trash"></i> Remove</button></td>';
                    } else {
                        btn = '<td class="text-left"><h6 class="price_mobile">' + val.nama + '</h6><button class="btn btn-sm text-xs ' + btn_color + '" onclick="booking(\'' + id + '\',\'' + val.tanggal + '\',' + val.sesi + ')"' + val.disabled + '><i class="fas fa-shopping-cart"></i> Book Now</button></td>';
                    }

                    if (val.payment_status == 0) {
                        jdwl += '<tr class="table-warning">' +
                            '<td><b>Sesi ' + val.sesi + '</b> <br> <span>' + val.jam + '</span> <h6 class="price_mobile">' + val.harga + '</h6></td>' +
                            '<td class="price text-left"><b>' + val.nama + '</b></td>' +
                            '<td class="price"><b>' + val.harga + '</b></td>' +
                            btn +
                            '</tr>';
                    } else {
                        jdwl += '<tr>' +
                            '<td><b>Sesi ' + val.sesi + '</b> <br> <span>' + val.jam + '</span> <h6 class="price_mobile">' + val.harga + '</h6></td>' +
                            '<td class="price text-left"><b>' + val.nama + '</b></td>' +
                            '<td class="price"><b>' + val.harga + '</b></td>' +
                            btn +
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

function booking(id, tanggal, sesi) {
    $.ajax({
        url: base_url + 'back/orders/order/booking/add',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id': id,
            'tanggal': tanggal,
            'sesi': sesi
        },
        success: function () {
            get_data(tanggal);
            cart_list();
            dataCalendar();
        }
    });
}

function unbooking(id, tanggal) {
    $.ajax({
        url: base_url + 'back/orders/order/booking/remove',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id': id
        },
        success: function () {
            get_data(tanggal);
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
        url: base_url + 'back/orders/order/cart_list',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
        },
        dataType: 'JSON',
        success: function (data) {
            table_cart(data);
            $('input[name="phone"]').val('');

            $('input[name="club_name"]').val('');
        }
    });
}

function table_cart(data) {
    tbl = '';

    if (data.data1.length > 0) {
        $.each(data.data1, function (key, val) {
            tbl += '<tr>' +
                '<td>' + val.tanggal + '</td>' +
                '<td>' + val.sesi + '</td>' +
                '<td>' + val.harga + '</td>' +
                '<td>' + val.opt + '</td>' +
                '</tr>';
        });

        tbl += '<tr>' +
            '<td colspan="2"><h6>Total Harga</h6></td>' +
            '<td colspan="2">' + data.data2.total_harga + '</td>' +
            '</tr>';
        tbl += '<tr>' +
            '<td colspan="2"><h6>Diskon</h6></td>' +
            '<td colspan="2">' + data.data2.diskon_member + '</td>' +
            '</tr>';
        tbl += '<tr>' +
            '<td colspan="2"><h5>Grand Total</h5></td>' +
            '<td colspan="2"><h5>' + data.data2.harga_keseluruhan + '</h5></td>' +
            '</tr>';
        tbl += '<tr>' +
            '<td colspan="4" class="text-right"><button class="btn btn-sm btn-primary" onclick="checkout()"><i class="fas fa-money-bill-wave"></i> Payment</button></td>' +
            '</tr>';
    } else {
        tbl += '<tr>' +
            '<td colspan="5"><div class="card-body bg-primary bg-opacity-25 text-center text-white" style="padding:30px 0px 30px 0px;"><h6>Belum ada pesanan</h6></div></td>' +
            '</tr>';
    }

    $('.cart_list').html(tbl);
}

function checkout() {
    nama_klub = $('input[name="nama_klub"]').val();
    telepon = $('input[name="telepon"]').val();

    if (nama_klub == '' && telepon == '') {
        $('input[name="nama_klub"], input[name="telepon"]').addClass('rounded border-danger');
        $('.invalid-clubname, .invalid-phone').removeAttr('hidden');
    } else if (nama_klub == '') {
        $('input[name="nama_klub"]').addClass('rounded border-danger');
        $('.invalid-clubname').removeAttr('hidden');
    } else if (telepon == '') {
        $('input[name="telepon"]').addClass('rounded border-danger');
        $('.invalid-phone').removeAttr('hidden');
    } else {
        $.ajax({
            url: base_url + 'back/orders/order/checkout',
            type: 'POST',
            data: {
                csrf_name: csrf_hash,
                'nama_klub': nama_klub,
                'telepon': telepon,
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    location.href = base_url + 'back/orders';
                } else {
                    cart_list();
                }
            }
        });
    }
}

$('input[name="club_name"]').keyup(function () {
    if ($(this).val().length > 0) {
        $('.invalid-clubname').attr('hidden', 'hidden');
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

function dataCalendar() {
    $.ajax({
        url: base_url + 'back/orders/order/get_data_calendar',
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