<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sports Complex | Registration Page</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}">
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="{{ url('/') }}"><b>Sports</b>Complex</a>
            </div>

            <div class="register-box-body">
                <div id="register_div">
                    <p class="login-box-msg">Register a new membership</p>
                    <form id="userData">
                        @csrf
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="name" placeholder="Full name">
                        </div>
                        <div class="form-group div_email">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                            <span class="help-block error-email"></span>
                        </div>
                        <div class="form-group div_password">
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                            <span class="help-block error-password"></span>
                        </div>
                        <div class="form-group div_retype">
                            <input type="password" id="retype_password" class="form-control" placeholder="Retype password">
                            <span class="help-block error-retype"></span>
                        </div>
                        <div class="form-group">
                            <select onChange="nat(this.value)" class="form-control" name="nationality">
                                <option value="" selected>-- Nationality --</option>
                                <option value="1" >Malaysian</option>
                                <option value="2" >Foriegner</option>
                            </select>
                        </div>
                        <div class="form-group" id="ic" style="display:none">
                            <input type="text" class="form-control" name="ic" placeholder="Enter IC number">
                        </div>
                        <div class="form-group" id="passport" style="display:none">
                            <input type="text" class="form-control" name="passport" placeholder="Enter passport number">
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox"> I agree to the <a href="#">terms</a>
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="button" onClick="register()" class="btn btn-primary btn-block btn-flat">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <div class="social-auth-links text-center">
                        <p>- OR -</p>
                    </div>
                    <a href="{{ url('guest/login') }}" class="text-center">I already have a membership</a>
                </div>
                <div id="spinner_div" class="text-center" style="display:none">
                    <h3><i class='fa fa-spin fa-spinner'></i><br><br>&nbsp; Registering</h3>
                </div>
            </div>
        </div>

        <!-- jQuery 3 -->
        <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
        <script>
        $(() => {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        })

        nat = (value) => {
            if(value == 1){
                $("#ic").show();
                $("#passport").hide();
            } else if(value == 2){
                $("#ic").hide();
                $("#passport").show();
            } else {
                $("#ic").hide();
                $("#passport").hide();
            }
        }
        register = () => { 
            if(!($("#password").val())){
                    $(".div_password").addClass('has-error')
                    $(".div_retype").removeClass('has-error')
                    $(".error-password").text('Please enter your password')
                    $(".error-retype").text('')
            } else {
                if($("#password").val() == $("#retype_password").val()){
                    $("#register_div").toggle();
                    $("#spinner_div").toggle();
                    
                    var formData = new FormData($('#userData')[0]);

                    $.ajax({
                        url: "",
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    }).done((response) => {
                        if(response == 'email exist'){
                            $("#register_div").toggle();
                            $("#spinner_div").toggle();
                            $(".div_retype, .div_password").removeClass('has-error')
                            $(".error-retype, .error-password").text('')
                            $(".div_email").addClass('has-error')
                            $(".error-email").text('E-Mail already registered')
                        } else if(response == 'success'){
                            window.location.replace("{{ url('guest/verify') }}");
                        } else {
                            console.log(response)
                        }
                    });
                } else {
                    $(".div_retype").addClass('has-error')
                    $(".error-password").text('')
                    $(".div_password").removeClass('has-error')
                    $(".error-retype").text('Retype password does not match')
                }
            }
        }
        </script>
    </body>
</html>
