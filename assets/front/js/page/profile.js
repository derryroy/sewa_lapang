$(document).ready(function () {
    $("#myTab li:eq(0) a").tab("show");

    $("#update_profile").on("submit", function (e) {
        e.preventDefault()
        $.ajax({
            url: base_url + "user/edit_user/profile",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function () {
                location.reload();
            }
        });
    });

    $('input[name="profile_clubname"]').keyup(function () {
        if ($(this).val() == '') {
            $('.clubname').hide();
        } else {
            $('.clubname').show();

            $.ajax({
                url: base_url + 'user/edit_user/get_data',
                type: 'POST',
                data: {
                    csrf_name: csrf_hash,
                    'clubname': $(this).val()
                },
                success: function (status) {
                    if (status == 0) {
                        $('.clubname').removeClass('fa-times text-danger');
                        $('.clubname').addClass('fa-check text-success');
                        $('#update_profile button').removeAttr('disabled');
                    } else {
                        $('.clubname').removeClass('fa-check text-success');
                        $('.clubname').addClass('fa-times text-danger');
                        $('#update_profile button').attr('disabled', 'disabled');
                    }
                }
            });
        }
    });

    $('input[name="profile_phone"],input[name="profile_phone2"]').bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode

        if (!(keyCode >= 48 && keyCode <= 57)) {
            return false;
        }
    });

    $("#update_password").on("submit", function (e) {
        e.preventDefault()
        $.ajax({
            url: base_url + "user/edit_user/password",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                location.reload();
            }
        });
    });

    $('.old-pass').hide();
    $('.confirm-new-pass').hide();
});

$('input[name="old_pass"]').keyup(function () {
    if ($(this).val() == '') {
        $('.old-pass').hide();
    } else {
        $('.old-pass').show();

        $.ajax({
            url: base_url + 'user/edit_user/password/check',
            type: 'POST',
            data: {
                csrf_name: csrf_hash,
                'old_pass': $(this).val()
            },
            dataType: 'text',
            success: function (status) {
                if (status == 1) {
                    $('.old-pass').removeClass('fa-times text-danger');
                    $('.old-pass').addClass('fa-check text-success');
                } else {
                    $('.old-pass').removeClass('fa-check text-success');
                    $('.old-pass').addClass('fa-times text-danger');
                }
            }
        });
    }
});

$('input[name="confirm_new_pass"]').keyup(function () {
    if ($(this).val() == '') {
        $('.confirm-new-pass').hide();
    } else {
        $('.confirm-new-pass').show();

        if ($(this).val() == $('input[name="new_pass"]').val() && $(this).val().length > 0) {
            $('.confirm-new-pass').removeClass('text-danger');
            $('.confirm-new-pass').addClass('text-success');
            $('.confirm-new-pass').text('Kata Sandi Benar');

            $('.save-pass').removeAttr('disabled');
        } else {
            $('.confirm-new-pass').removeClass('text-success');
            $('.confirm-new-pass').addClass('text-danger');
            $('.confirm-new-pass').text('Kata Sandi Salah');

            $('.save-pass').attr('disabled', 'disabled');
        }
    }
});

if (screen.width > 768) {
    $('main').css('height', '100vh');
}