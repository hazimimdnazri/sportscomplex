<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sports Complex | E-Mail Verified</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=10, maximum-scale=10, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>

    <style>
        html, body {
            height: 60%;
            background-color: #f5f5f5;
        }

    </style>

    <body>
        <div style="width:50%" class="register-box">
            <div class="register-logo">
                <a href="{{ url('/') }}"><b>Sports</b>Complex</a>
            </div>

            <div class="box-body">
                <div class="panel panel-default">
                    <div class="panel-heading">E-Mail Verified</div>
                        <div class="panel-body">
                            <p>Your e-mail has been verified and your account has been activated. Please proceed to the <a href="{{ url('guest/login') }}">login page</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>


    <!-- jQuery 3 -->
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
</html>
