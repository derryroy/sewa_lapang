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

// Header
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const url = urlParams.get('page')

if (url) {
    location.href = url;
}

if (screen.width > 768) {
    $('#header .logo img').css({
        'max-height': '70px',
        'position': 'absolute',
        'top': '13px'
    });
    $('#header .logo span').css({
        'font-size': '16px',
        'margin': '7px 0px 0px 95px',
        'position': 'absolute'
    });
} else if (screen.width <= 768) {
    $('#header .logo img').css({
        'max-height': '50px',
        'position': 'absolute',
        'top': '15px'
    });
    $('#header .logo span').css({
        'font-size': '15px',
        'margin': '5px 0px 0px 70px',
        'position': 'absolute'
    });
    $('.navbar').css({
        'top': '0px'
    });
}

// Konversi
function rupiah(bilangan) {
    var reverse = bilangan.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return 'Rp ' + ribuan;
}

// Expired
$(document).ready(function () {
    expired();
});

function expired() {
    $.ajax({
        url: base_url + 'homepage/expired',
        type: 'GET',
    });
}

// Login
window.addEventListener("keydown", checkKeyPressed, false);

function checkKeyPressed(e) {
    if (e.keyCode == "13") {
        if ($('input[name="email_login"]').val() != '') {
            form_login();
        }
    }
}

function form_login() {
    $.ajax({
        url: base_url + 'user/do_login',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'email': $('input[name="email_login"]').val(),
            'password': $('input[name="password_login"]').val()
        },
        dataType: 'html',
        success: function (data) {
            if (data == 'lets_login') {
                setTimeout(function () {
                    window.location.href = base_url;
                }, 1);
            } else {
                toastr.error(data);
            }
        }
    });
}

function form_forgot() {
    $.ajax({
        url: base_url + 'user/forgot_password',
        type: 'POST',
        data: {
            csrf_name: csrf_hash,
            'email': $('input[name="email_forgot"]').val()
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.status == 1) {
                toastr.success(data.message);
                $("#forgotPass").modal('hide');
            } else {
                toastr.error(data.message);
            }
        }
    });
}

// Toggle Password
$(".toggle-password").click(function () {
    $(this).toggleClass("fa-eye-slash fa-eye");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});