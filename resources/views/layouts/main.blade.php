<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>EduCity Sports Complex</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
		@yield('prescript')
		<link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition skin-blue-light sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<a href="{{ url('/') }}" class="logo">
				<span class="logo-mini"><b>A</b>LT</span>
				<span class="logo-lg"><b>Sports</b>Complex</span>
				</a>
				<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
						<span class="hidden-xs">{{ Auth::user()->name }}</span>
						</a>
						<ul class="dropdown-menu">
						<li class="user-header">
							<img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

							<p>
							{{ Auth::user()->name }}
							<small></small>
							</p>
						</li>
						<li class="user-body">
							<div class="row">
							<div class="col-xs-4 text-center">
								<a href="#">Followers</a>
							</div>
							<div class="col-xs-4 text-center">
								<a href="#">Sales</a>
							</div>
							<div class="col-xs-4 text-center">
								<a href="#">Friends</a>
							</div>
							</div>
						</li>
						<li class="user-footer">
							<div class="pull-left">
							<a href="#" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
						</ul>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
					</ul>
				</div>
				</nav>
			</header>
			@include('shared.sidebar')
			<div class="content-wrapper">
				@yield('content')
			</div>
			@include('shared.footer')
		</div>
		<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
		<script>
		$.widget.bridge('uibutton', $.ui.button);
		</script>
		<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
		<script src="{{ asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
		<script src="{{ asset('assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
		<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
		<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
		@yield('postscript')
	</body>
</html>
