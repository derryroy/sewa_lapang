$(document).ready(function () {
    $("#form_register").on("submit", function (e) {
        e.preventDefault()
        $.ajax({
            url: base_url + "user/add_user",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    toastr.success(data.message);
                    setTimeout(function () {
                        location.href = base_url + 'login';
                    }, 5000);
                } else {
                    $('.invalid_email').removeAttr('hidden');
                }
            }
        });
    });

    $('input[name="phone_register"]').bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode

        if (!(keyCode >= 48 && keyCode <= 57)) {
            return false;
        }
    });
});

$('input[name="confirm_password_register"]').keyup(function () {
    if ($(this).val().length > 0) {
        if ($('input[name="password_register"]').val() == $(this).val()) {
            $('.confirm-pass').text('Kata Sandi Benar');
            $('.confirm-pass').addClass('text-success');
            $('.confirm-pass').removeClass('text-danger');
        } else {
            $('.confirm-pass').text('Kata Sandi Salah');
            $('.confirm-pass').removeClass('text-danger');
            $('.confirm-pass').addClass('text-danger');
        }
    } else {
        $('.confirm-pass').text('');
    }
});