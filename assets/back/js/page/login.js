var base_url = '';
var csrf_hash = function () {
    var tmp = null;
    $.ajax({
        async: false,
        type: "GET",
        global: false,
        dataType: 'html',
        url: base_url + 'homepage/csrf_hash',
        success: function (data) {
            tmp = data;
        }
    });
    return tmp;
}();

window.addEventListener("keydown", checkKeyPressed, false);

function checkKeyPressed(e) {
    if (e.keyCode == "13") {
        if ($('input[name="email"]').val() != '') {
            form_submit();
        }
    }
}

function form_submit() {
    $.ajax({
        url: base_url + 'back/admin/login',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'email': $('input[name="email"]').val(),
            'password': $('input[name="password"]').val()
        },
        dataType: 'html',
        success: function (data) {
            if (data == 'lets_login') {
                setTimeout(function () {
                    window.location.href = base_url + 'admin';
                }, 1);

            } else {
                toastr.error(data);
            }
        }
    });
}

$(".toggle-password").click(function () {
    $(this).toggleClass("fa-eye-slash fa-eye");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});