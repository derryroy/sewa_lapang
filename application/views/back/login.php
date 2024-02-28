<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Citra Arena</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/front/img/logo.png" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>assets/back/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>assets/back/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/toastr/toastr.min.css">

    <style>
        .eye-icon {
            float: right;
            margin: -26px 10px 0px 0px;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Admin</h1>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control rounded-pill" name="email" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control rounded-pill" name="password" id="password-eye" placeholder="Password">
                                        <span toggle="#password-eye" class="fa fa-eye-slash toggle-password eye-icon"></span>
                                    </div>
                                    <button class="btn btn-primary btn-block rounded-pill" onclick="form_submit()">Login</button>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugin/toastr/toastr.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/back/js/page/login.js"></script>
    <script>
        var base_url = "<?php echo base_url(); ?>";
    </script>

</body>

</html>