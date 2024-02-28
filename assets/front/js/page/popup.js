$(document).keydown(function(e) {
    if (e.keyCode == 82 && e.ctrlKey && e.shiftKey) {
        localStorage.clear();
    }
});

$(document).ready(function () {
    $("#kirim_bukti").on("submit", function (e) {
        e.preventDefault()
        $.ajax({
            url: base_url + "pesanan/kirim_bukti",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    $('#payment').modal('hide');
                    $('#payment_status').modal('show');
                    html = '<h5 class="card-title mt-3 pb-3 text-center">Terima Kasih <br> Sudah Melakukan Pemesanan <br> Pembayaran Kamu Akan Segera Kami Proses</h5>';
                    $('.payment_status').html(html);
                } else if (data.status == 0){
                    alert('Silahkan Unggah Bukti Pembayaran!');
                }
            }
        });
    });
});

$(document).ready(function () {
    $("#kirim_bukti_2").on("submit", function (e) {
        e.preventDefault()
        $.ajax({
            url: base_url + "pesanan/kirim_bukti_2",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    $('#payment2').modal('hide');
                    $('#payment_status').modal('show');
                    html = '<h5 class="card-title mt-3 pb-3 text-center">Terima Kasih <br> Sudah Melakukan Pemesanan <br> Pembayaran Kamu Akan Segera Kami Proses</h5>';
                    $('.payment_status').html(html);
                } else if (data.status == 0){
                    alert('Silahkan Unggah Bukti Pembayaran!');
                }
            }
        });
    });
});

$('#file').change(function () {
    var files = this.files;
    var img = '<div class="row mb-3">';

    for (var i = 0; i < files.length; i++) {
        img += '<figure class="figure col-sm-6"><img src="' + URL.createObjectURL(event.target.files[i]) + '" class="figure-img img-fluid rounded"></figure>';
        $('#filename').val(files[i].name);
    }

    img += '</div>';

    $('.preview').html(img);
});

$('#file2').change(function () {
    var files = this.files;
    var img = '<div class="row mb-3">';

    for (var i = 0; i < files.length; i++) {
        img += '<figure class="figure col-sm-6"><img src="' + URL.createObjectURL(event.target.files[i]) + '" class="figure-img img-fluid rounded"></figure>';
        $('#filename2').val(files[i].name);
    }

    img += '</div>';

    $('.preview2').html(img);
});

function batasWaktu(expired) {
    var countDownDate = new Date(expired).getTime();

    var x = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("time").innerHTML = "Batas Waktu : " + days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("time").innerHTML = "EXPIRED";
        }
    }, 1000);
}

function copyText(id) {
    var copyText = document.getElementById(id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    alert("Berhasil Disalin");
}