var month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
var day = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

var date_now = new Date();

$(document).ready(function () {
    $('.resDate').text(day[date_now.getDay()] + ', ' + date_now.getDate() + ' ' + month[date_now.getMonth()] + ' ' + date_now.getFullYear());
    get_data(date_now.toISOString().slice(0, 10));

    $('#calendar button').addClass('btn-sm');

    dataCalendar();
});

function get_data(date) {
    $.ajax({
        url: base_url + 'homepage/get_data',
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
                        '<td colspan="3" class="text-start col-md-9 col-6">' + val.nama + '</td>' +
                        '</tr>';
                } else {
                    if (val.disabled == '') {
                        btn_color = 'btn-primary';
                    } else {
                        btn_color = 'btn-secondary';
                    }

                    if (val.booking == 1) {
                        btn = '<td class="text-start col-md-3 col-6"><h6 class="price_mobile">' + val.nama + '</h6> <button class="btn btn-sm btn-danger text-xs" onclick="unbooking(\'' + id + '\',\'' + val.tanggal + '\')"><i class="fas fa-trash"></i> Remove</button></td>';
                    } else if (ses_login == '') {
                        btn = '<td class="text-start col-md-3 col-6"><h6 class="price_mobile">' + val.nama + '</h6> <a href="' + base_url + 'login" class="btn btn-sm btn-warning text-xs"><i class="fas fa-shopping-cart"' + val.disabled + '></i> Book Now (Sign!)</a></td>';
                    } else {
                        btn = '<td class="text-start col-md-3 col-6"><h6 class="price_mobile">' + val.nama + '</h6> <button class="btn btn-sm ' + btn_color + ' text-xs" onclick="booking(\'' + id + '\',\'' + val.tanggal + '\',' + val.sesi + ')"' + val.disabled + '><i class="fas fa-shopping-cart"></i> Book Now</button></td>';
                    }

                    if (val.payment_status == 0) {
                        jdwl += '<tr class="table-warning">' +
                            '<td class="col-md-3 col-6">Sesi ' + val.sesi + ' <br> <span>' + val.jam + '</span> <h6 class="price_mobile">' + rupiah(val.harga) + '</h6></td>' +
                            '<td class="price text-start col-md-3 col-6">' + val.nama + '</td>' +
                            '<td class="price col-md-3 col-6">' + rupiah(val.harga) + '</td>' +
                            btn +
                            '</tr>';
                    } else {
                        jdwl += '<tr>' +
                            '<td class="col-md-3 col-6">Sesi ' + val.sesi + ' <br> <span>' + val.jam + '</span> <h6 class="price_mobile">' + rupiah(val.harga) + '</h6></td>' +
                            '<td class="price text-start col-md-3 col-6">' + val.nama + '</td>' +
                            '<td class="price col-md-3 col-6">' + rupiah(val.harga) + '</td>' +
                            btn +
                            '</tr>';
                    }
                }
            });

            $('.jadwal').html(jdwl);
            btn = '';

            if (data.count_cart > 0 && ses_login != '') {
                btn = '<a href="' + base_url + 'keranjang" class="btn btn-primary form-control"><i class="fas fa-shopping-cart"></i> Checkout</a>';
            }

            $('.checkout').html(btn);
        }
    });
}

function booking(id, tanggal, sesi) {
    $.ajax({
        url: base_url + 'keranjang/booking/add',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id': id,
            'tanggal': tanggal,
            'sesi': sesi
        },
        success: function () {
            get_data(tanggal);
            dataCalendar();
        }
    });
}

function unbooking(id, tanggal) {
    $.ajax({
        url: base_url + 'keranjang/booking/remove',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id': id
        },
        success: function () {
            get_data(tanggal);
            dataCalendar();
        }
    });
}

// fullcalendar
// document.addEventListener('DOMContentLoaded', function() {
var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: 'bootstrap5',
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
        $('.resDate').text(day[arg.start.getDay()] + ', ' + arg.start.getDate() + ' ' + month[arg.start.getMonth()] + ' ' + arg.start.getFullYear());
        expired();
        get_data(arg.startStr);

        if (screen.width < 1024) {
            location.href = '#result';
        }
    },
    longPressDelay: 0,
    contentHeight: 430,
    eventOverlap: false,
});

calendar.render();
// });

function dataCalendar() {
    $.ajax({
        url: base_url + 'homepage/get_data_calendar',
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
                    color: '#000',
                })
            });
        }
    });
}

if (screen.width < 1024) {
    $('#result').css('padding-top', '70px');
}