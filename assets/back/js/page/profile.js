function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}

$('input[name="email"]').keyup(function () {
    if (IsEmail($(this).val()) == false && $(this).val() != '') {
        $('.profile').attr('disabled', 'disabled');
    } else {
        $('.profile').removeAttr('disabled');
    }
});

$(document).ready(function () {
    $('.invalid_new_pass').hide();
    $('.invalid_confirm_pass').hide();
    $('.pass').attr('disabled', 'disabled');
});

$('#new_pass').keyup(function () {
    $('.invalid_new_pass').removeClass('text-success');
    $('.invalid_new_pass').removeClass('text-danger');

    if ($(this).val().length < 6 && $(this).val().length > 0) {
        $('.invalid_new_pass').show();
        $('.invalid_new_pass').text('Min 6 chars');
        $('.invalid_new_pass').addClass('text-danger');
    } else {
        $('.invalid_new_pass').hide();
    }
});

$('#confirm_pass').keyup(function () {
    $('.invalid_confirm_pass').removeClass('text-success');
    $('.invalid_confirm_pass').removeClass('text-danger');

    if ($(this).val() != '') {
        if ($(this).val().length < 6 && $(this).val().length > 0) {
            $('.invalid_confirm_pass').show();
            $('.invalid_confirm_pass').text('Min 6 chars');
            $('.invalid_confirm_pass').addClass('text-danger');
            $('.pass').attr('disabled', 'disabled');
        } else {
            if ($(this).val() == $('#new_pass').val()) {
                $('.invalid_confirm_pass').show();
                $('.invalid_confirm_pass').text('Password matches');
                $('.invalid_confirm_pass').addClass('text-success');
                $('.pass').removeAttr('disabled');
            } else {
                $('.invalid_confirm_pass').show();
                $('.invalid_confirm_pass').text('Password not match');
                $('.invalid_confirm_pass').addClass('text-danger');
                $('.pass').attr('disabled', 'disabled');
            }
        }
    } else {
        $('.pass').attr('disabled', 'disabled');
        $('.invalid_confirm_pass').hide();
    }
});

function form_submit(update) {
    if (update == 'profile') {
        $.ajax({
            url: base_url + 'back/admin/profile/update_profile',
            type: 'POST',
            data: {
                csrf_name: csrf_hash,
                'name': $('input[name="name"]').val(),
                'email': $('input[name="email"]').val()
            },
            success: function () {
                toastr.success('Update profile done.');
            }
        });
    } else if (update == 'password') {
        $.ajax({
            url: base_url + 'back/admin/profile/update_password',
            type: 'POST',
            data: {
                csrf_name: csrf_hash,
                'current_pass': $('input[name="current_pass"]').val(),
                'new_pass': $('input[name="new_pass"]').val(),
                'confirm_pass': $('input[name="confirm_pass"]').val()
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.success == 1) {
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }

                $('.pass').attr('disabled', 'disabled');

                $('#current_pass').val('');
                $('#new_pass').val('');
                $('#confirm_pass').val('');

                $('.invalid_new_pass').hide();
                $('.invalid_confirm_pass').hide();
            }
        });
    }
}