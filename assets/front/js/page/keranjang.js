var code_coupon = '';
var coupon = 0;
var coupon_type = 0;

$(document).ready(function () {
    daftar_keranjang();
});

function daftar_keranjang() {
    $.ajax({
        url: base_url + 'keranjang/daftar_keranjang',
        type: 'POST',
        data: {
            csrf_name: csrf_hash
        },
        dataType: 'JSON',
        success: function (data) {
            table_cart(data);
        }
    });
}

function table_cart(data) {
    tbl = '';
    ttl_hrg = 0;
    grand_total = 0;

    if (data.data.length > 0) {
        $.each(data.data, function (key, val) {
            ttl_hrg += val.price;

            tbl += '<tr>' +
                '<td>' + val.date + '</td>' +
                '<td>' + val.sesi + '</td>' +
                '<td>' + rupiah(val.price) + '</td>' +
                '<td>' + val.opt + '</td>' +
                '</tr>';
        });

        if (coupon_type == 2) {
            coupon = ttl_hrg * coupon / 100;
        }

        grand_total = ttl_hrg - data.disc_member - coupon;

        tbl += '<tr>' +
            '<td colspan="2"><h6>Total Harga</h6></td>' +
            '<td colspan="2"><h6>' + rupiah(ttl_hrg) + '</h6></td>' +
            '</tr>';
        tbl += '<tr>' +
            '<td colspan="2">Diskon</td>' +
            '<td colspan="2">' + rupiah(data.disc_member) + '</td>' +
            '</tr>';
        tbl += '<tr>' +
            '<td colspan="2"><h6>Grand Total</h6></td>' +
            '<td colspan="2"><h6>' + rupiah(grand_total) + '</h6></td>' +
            '</tr>';
        tbl += '<tr>' +
            '<td colspan="4" class="text-end"><button class="btn btn-primary btn-sm" onclick="checkout()"><i class="fas fa-money-bill-wave"></i> Payment</button></td>' +
            '</tr>';
    } else {
        tbl += '<tr>' +
            '<td colspan="4"><div class="card-body bg-primary bg-opacity-25 text-center" style="padding:50px 0px 50px 0px;"><h6>Belum ada pesanan</h6><a href="' + base_url + '" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Cari Lapangan</a> <a href="' + base_url + 'orders" class="btn btn-sm btn-primary"><i class="fa-solid fa-bars"></i> Daftar Pesanan</a></div></td>' +
            '</tr>';
    }

    $('.daftar_keranjang').html(tbl);
}

function hapus_keranjang(id) {
    $.ajax({
        url: base_url + 'keranjang/hapus_keranjang',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id': id
        },
        success: function () {
            daftar_keranjang();
        }
    });
}

function checkout() {
    $.ajax({
        url: base_url + 'pesanan/checkout',
        type: 'POST',
        data: {
            csrf_name: csrf_hash
        },
        dataType: 'JSON',
        success: function (data) {
            daftar_keranjang();

            if (data.status == 1) {
                $('#payment').modal('show');
                $('input[name="id_pesanan"]').val(data.id_pesanan);
                $('input[name="no_pesanan"]').val(data.no_pesanan);
                $('input[name="nomor_pesanan"]').val(data.no_pesanan);
                $('.total_harga').text('Total Harga : ' + rupiah(data.total));
                batasWaktu(data.expired);
            }
        }
    });
}