$(document).ready(function () {
    table = $('#userData').DataTable({
        'processing': true,
        'serverSide': true,
        'order': [],
        'ajax': {
            'url': base_url + 'back/users/data/list',
            'type': 'POST',
            'data': {
                csrf_name: csrf_hash,
            },
            'dataSrc': function (data) {
                return data.data;
            }
        },
        'columnDefs': [{
            'targets': [0, 3, 4, 5, 7],
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
        $('input[name="edit_user_id"]').val(id);
        $('#editUser').modal('show');
        get_edit_user(id);
    } else if (opt == 1) {
        $('input[name="delete_user_id"]').val(id);
        $('#deleteUser').modal('show');
    }
}

function user_delete() {
    $.ajax({
        url: base_url + 'back/users/data/delete',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id_user': $('input[name="delete_user_id"]').val()
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.status == 1) {
                $('#userData').DataTable().ajax.reload();
                toastr.success(data.message);
                $(".modal .close").click();
            } else {
                toastr.error(data.message);
            }
        }
    });
}

// User Add
$(document).ready(function () {
    $('.invalid_email').hide();
    $('.invalid_password').hide();

    $('input[name="phone"], input[name="phone2"]').bind("keypress", function (e) {
        var keyCode = e.which ? e.which : e.keyCode

        if (!(keyCode >= 48 && keyCode <= 57)) {
            return false;
        }
    });
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
        $('.invalid_password').text('Min 6 chars');
        $('.invalid_password').addClass('text-danger');
    } else {
        $('.invalid_password').hide();
    }
});

function user_add() {
    if ($('input[name="name"]').val() != '' && $('input[name="email"]').val() != '' && $('input[name="password"]').val() != '') {
        $.ajax({
            url: base_url + 'back/users/data/add',
            type: 'POST',
            data: {
                csrf_name: csrf_hash,
                'nama': $('input[name="name"]').val(),
                'email': $('input[name="email"]').val(),
                'telepon': $('input[name="phone"]').val(),
                'password': $('input[name="password"]').val(),
                'nama_klub': $('input[name="clubname"]').val(),
                'telepon2': $('input[name="phone2"]').val(),
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 1) {
                    $('#userData').DataTable().ajax.reload();
                    $('#addUser input').val('');
                    toastr.success(data.message);
                    $(".modal .close").click();
                } else {
                    toastr.error(data.message);
                }
            }
        });
    }
}

$('#addUser').on('hidden.bs.modal', function () {
    $('#addUser input').val('');
})

// User Edit
$(document).ready(function () {
    $('.invalid_edit_email').hide();
    $('.invalid_edit_password').hide();
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
        $('.invalid_edit_password').text('Min 6 chars');
        $('.invalid_edit_password').addClass('text-danger');
    } else {
        $('.invalid_edit_password').hide();
    }
});

function get_edit_user(id) {
    $.ajax({
        url: base_url + 'back/users/data/get_data',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id_user': id
        },
        dataType: 'JSON',
        success: function (data) {
            $('input[name="edit_name"]').val(data.data.nama);
            $('input[name="edit_email"]').val(data.data.email);
            $('input[name="edit_phone"]').val(data.data.telepon);
            $('input[name="edit_clubname"]').val(data.data.nama_klub);
            $('input[name="edit_phone2"]').val(data.data.telepon2);
        }
    });
}

function user_edit() {
    $.ajax({
        url: base_url + 'back/users/data/edit',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'id_user': $('input[name="edit_user_id"]').val(),
            'nama': $('input[name="edit_name"]').val(),
            'email': $('input[name="edit_email"]').val(),
            'telepon': $('input[name="edit_phone"]').val(),
            'password': $('input[name="edit_password"]').val(),
            'nama_klub': $('input[name="edit_clubname"]').val(),
            'telepon2': $('input[name="edit_phone2"]').val(),
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.status == 1) {
                $('#userData').DataTable().ajax.reload();
                toastr.success(data.message);
                $(".modal .close").click();
            } else {
                toastr.error(data.message);
            }
        }
    });
}