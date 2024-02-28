$(document).ready(function () {
    table = $('#listOrders').DataTable({
        'processing': true,
        'serverSide': true,
        'order': [],
        'ajax': {
            'url': base_url + 'user/orders',
            'type': 'POST',
            'data': {
                csrf_name: csrf_hash
            },
        'dataSrc': function (data) {
            return data.data;
        }
        },
    'columnDefs': [{
        'targets': [1, 2, 3, 4, 5, 6],
        'orderable': false
    }]
    });
});

function detail_order(id) {
    $.ajax({
        url: base_url + 'user/detail_order',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id': id
        },
        dataType: 'JSON',
        success: function (data) {
            $('#detail_order').modal('show');
            $('#time').addClass(data.order.no_pesanan);
            batasWaktu(data.order.tanggal_kadaluarsa);

            $('.detail_order_id').text(data.order.no_pesanan);
            $('.detail_name').text(data.order.nama);
            $('.detail_email').text(data.order.email);
            $('.detail_phone').text(data.order.telepon);
            $('.detail_clubname').text(data.order.nama_klub);
            $('.detail_phone2').text(data.order.telepon2);
            $('.detail_status').html(data.order.status_pembayaran);
            $('.detail_tanggal_pesanan').html(data.order.tanggal_pesanan);
            $('.detail_tanggal_kadaluarsa').html(data.order.tanggal_kadaluarsa);

            list_detail_order = '';
            ttl_hrg = 0;

            $.each(data.detail_order, function (key, val) {
                ttl_hrg += parseInt(val.harga);
                list_detail_order += '<tr>' +
                    '<td>' + val.no + '</td>' +
                    '<td>' + val.tanggal + '</td>' +
                    '<td>' + val.sesi + '</td>' +
                    '<td>' + rupiah(val.harga) + '</td>' +
                    '</tr>';
            });

            grand_total = ttl_hrg - data.order.disc_member;

            list_detail_order += '<tr>' +
                '<td colspan="3" class="text-end">Total harga</td>' +
                '<td>' + rupiah(ttl_hrg) + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td colspan="3" class="text-end">Diskon</td>' +
                '<td>' + rupiah(data.order.disc_member) + '</td>' +
                '<tr>' +
                '<td colspan="3" class="text-end">Grand Total</td>' +
                '<td>' + rupiah(grand_total) + '</td>' +
                '</tr>';

            $('#listDetailOrder').html(list_detail_order);
            $('.total_harga').text(rupiah(grand_total));
            $('input[name="id_pesanan"]').val(data.order.id_pesanan);
            $('input[name="nomor_pesanan"]').val(data.order.no_pesanan);
            $('.catatan').text(data.order.catatan);
            $('input[name="id_pesanan_2"]').val(data.order.id_pesanan);
            $('input[name="no_pesanan_2"]').val(data.order.no_pesanan);
        }
    });
}

function cancel_order() {
    $.ajax({
        url: base_url + 'pesanan/batalkan_pesanan',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id_pesanan': $('input[name="id_pesanan"]').val()
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.status == 1) {
                $('#listOrders').DataTable().ajax.reload();
                $('input[name="id_pesanan"]').val('');
                $('#cancel_order').modal('hide');
                toastr.success(data.message);
            }
        }
    });
}

if (screen.width > 768) {
    $('main').css('height', '100vh');
}