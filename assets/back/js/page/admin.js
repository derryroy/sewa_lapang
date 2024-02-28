$(document).ready(function () {
    table = $('#adminData').DataTable({
        'processing': true,
        'serverSide': true,
        'order': [],
        'ajax': {
            'url': base_url + 'back/admin/data/list',
            'type': 'POST',
            'data': {
                csrf_name: csrf_hash,
            },
            'dataSrc': function (data) {
                return data.data;
            }
        },
        'columnDefs': [{
            'targets': [0, 4],
            'orderable': false
        }],
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('DataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('DataTables'));
        }
    });
});

function option(opt, id) {
    if (opt == 0) {
        $('input[name="edit_admin_id"]').val(id);
        $('#editAdmin').modal('show');
        get_edit_admin(id);
    } else if (opt == 1) {
        $('input[name="delete_admin_id"]').val(id);
        $('#deleteAdmin').modal('show');
    }
}

function admin_delete() {
    $.ajax({
        url: base_url + 'back/admin/data/delete',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id_admin': $('input[name="delete_admin_id"]').val()
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.status == 1) {
                $('#adminData').DataTable().ajax.reload();
                toastr.success(data.message);
                $(".modal .close").click();
            } else {
                toastr.error(data.message);
            }
        }
    });
}

// Admin Add
$(document).ready(function () {
    $('.invalid_email').hide();
    $('.invalid_password').hide();
    $('.invalid_confirm_pass').hide();
    $('.addAdmin').attr('disabled', 'disabled');

});

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
        $('.invalid_email').show();
        $('.invalid_email').addClass('text-danger');
    } else {
        $('.invalid_email').hide();
        $('.invalid_email').removeClass('text-danger');
    }
});

$('#password').keyup(function () {
    $('.invalid_password').removeClass('text-success');
    $('.invalid_password').removeClass('text-danger');

    if ($(this).val().length < 6 && $(this).val().length > 0) {
        $('.invalid_password').show();
        $('.invalid_password').text('Minimal 6 Karakter');
        $('.invalid_password').addClass('text-danger');
    } else {
        $('.invalid_password').hide();
    }
});

$('#confirm_pass').keyup(function () {
    $('.invalid_confirm_pass').removeClass('text-success');
    $('.invalid_confirm_pass').removeClass('text-danger');

    if ($(this).val() != '') {
        if ($(this).val().length < 6 && $(this).val().length > 0) {
            $('.invalid_confirm_pass').show();
            $('.invalid_confirm_pass').text('Minimal 6 Karakter');
            $('.invalid_confirm_pass').addClass('text-danger');
        } else {
            if ($(this).val() == $('#password').val()) {
                $('.invalid_confirm_pass').show();
                $('.invalid_confirm_pass').text('Password Cocok');
                $('.invalid_confirm_pass').addClass('text-success');
            } else {
                $('.invalid_confirm_pass').show();
                $('.invalid_confirm_pass').text('Password Tidak Cocok');
                $('.invalid_confirm_pass').addClass('text-danger');
            }
        }
    } else {
        $('.invalid_confirm_pass').hide();
    }
});


function admin_add() {
    if ($('input[name="name"]').val()!=''&& $('input[name="email"]').val()!=''&& $('input[name="password"]').val()!=''&& $('input[name="confirm_pass"]').val()) {
        $.ajax({
            url: base_url + 'back/admin/data/add',
            type: 'POST',
            data: {
                csrf_name: csrf_hash,
                'nama': $('input[name="name"]').val(),
                'email': $('input[name="email"]').val(),
                'password': $('input[name="password"]').val(),
                'confirm_pass': $('input[name="confirm_pass"]').val(),
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    $('#adminData').DataTable().ajax.reload();
                    $('#addAdmin input').val('');
                    $('.invalid_confirm_pass').hide();
                    toastr.success(data.message);
                    $(".modal .close").click();
                } else {
                    toastr.error(data.message);
                }
            }
        });
    }
}

$('#addAdmin').on('hidden.bs.modal', function () {
    $('#addAdmin input').val('');
    $('.invalid_confirm_pass').hide();
})

// Admin Edit
$(document).ready(function () {
    $('.invalid_edit_email').hide();
    $('.invalid_edit_password').hide();
    $('.invalid_edit_confirm_pass').hide();
});

$('input[name="edit_email"]').keyup(function () {
    if (IsEmail($(this).val()) == false && $(this).val() != '') {
        $('.invalid_edit_email').show();
        $('.invalid_edit_email').addClass('text-danger');
    } else {
        $('.invalid_edit_email').hide();
        $('.invalid_edit_email').removeClass('text-danger');
    }
});

$('#edit_password').keyup(function () {
    $('.invalid_edit_password').removeClass('text-success');
    $('.invalid_edit_password').removeClass('text-danger');

    if ($(this).val().length < 6 && $(this).val().length > 0) {
        $('.invalid_edit_password').show();
        $('.invalid_edit_password').text('Minimal 6 Karakter');
        $('.invalid_edit_password').addClass('text-danger');
    } else {
        $('.invalid_edit_password').hide();
    }
});

$('#edit_confirm_pass').keyup(function () {
    $('.invalid_edit_confirm_pass').removeClass('text-success');
    $('.invalid_edit_confirm_pass').removeClass('text-danger');

    if ($(this).val() != '') {
        if ($(this).val().length < 6 && $(this).val().length > 0) {
            $('.invalid_edit_confirm_pass').show();
            $('.invalid_edit_confirm_pass').text('Minimal 6 Karakter');
            $('.invalid_edit_confirm_pass').addClass('text-danger');
        } else {
            if ($(this).val() == $('#edit_password').val()) {
                $('.invalid_edit_confirm_pass').show();
                $('.invalid_edit_confirm_pass').text('Password Cocok');
                $('.invalid_edit_confirm_pass').addClass('text-success');
            } else {
                $('.invalid_edit_confirm_pass').show();
                $('.invalid_edit_confirm_pass').text('Password Tidak Cocok');
                $('.invalid_edit_confirm_pass').addClass('text-danger');
            }
        }
    } else {
        $('.invalid_edit_confirm_pass').hide();
    }
});

function get_edit_admin(id) {
    $.ajax({
        url: base_url + 'back/admin/data/get_data',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id_admin': id
        },
        dataType: 'JSON',
        success: function (data) {
            $('input[name="edit_name"]').val(data.data.nama);
            $('input[name="edit_email"]').val(data.data.email);
            $('select[name="edit_role"]').val(data.data.role).change();
        }
    });
}

function admin_edit() {
    $.ajax({
        url: base_url + 'back/admin/data/edit',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id_admin': $('input[name="edit_admin_id"]').val(),
            'nama': $('input[name="edit_name"]').val(),
            'email': $('input[name="edit_email"]').val(),
            'password': $('input[name="edit_password"]').val(),
            'confirm_pass': $('input[name="edit_confirm_pass"]').val(),
            'role': $('select[name="edit_role"]').val()
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.status == 1) {
                $('#adminData').DataTable().ajax.reload();
                toastr.success(data.message);
                $(".modal .close").click();
            } else {
                toastr.error(data.message);
            }
        }
    });
}