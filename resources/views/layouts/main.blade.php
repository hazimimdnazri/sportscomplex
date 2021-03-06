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
		<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">

		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
    	@include('sweet::alert')
    	
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
					{{-- <li class="dropdown messages-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope-o"></i>
						<span class="label label-success">4</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 4 messages</li>
							<li>
								<ul class="menu">
								<li>
									<a href="#">
									<div class="pull-left">
										<img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
									</div>
									<h4>
										Support Team
										<small><i class="fa fa-clock-o"></i> 5 mins</small>
									</h4>
									<p>Why not buy a new awesome theme?</p>
									</a>
								</li>
								<li>
									<a href="#">
									<div class="pull-left">
										<img src="{{ asset('assets/dist/img/user3-128x128.jpg') }}" class="img-circle" alt="User Image">
									</div>
									<h4>
										AdminLTE Design Team
										<small><i class="fa fa-clock-o"></i> 2 hours</small>
									</h4>
									<p>Why not buy a new awesome theme?</p>
									</a>
								</li>
								<li>
									<a href="#">
									<div class="pull-left">
										<img src="{{ asset('assets/dist/img/user4-128x128.jpg') }}" class="img-circle" alt="User Image">
									</div>
									<h4>
										Developers
										<small><i class="fa fa-clock-o"></i> Today</small>
									</h4>
									<p>Why not buy a new awesome theme?</p>
									</a>
								</li>
								<li>
									<a href="#">
									<div class="pull-left">
										<img src="{{ asset('assets/dist/img/user3-128x128.jpg') }}" class="img-circle" alt="User Image">
									</div>
									<h4>
										Sales Department
										<small><i class="fa fa-clock-o"></i> Yesterday</small>
									</h4>
									<p>Why not buy a new awesome theme?</p>
									</a>
								</li>
								<li>
									<a href="#">
									<div class="pull-left">
										<img src="{{ asset('assets/dist/img/user4-128x128.jpg') }}" class="img-circle" alt="User Image">
									</div>
									<h4>
										Reviewers
										<small><i class="fa fa-clock-o"></i> 2 days</small>
									</h4>
									<p>Why not buy a new awesome theme?</p>
									</a>
								</li>
								</ul>
							</li>
							<li class="footer"><a href="#">See All Messages</a></li>
						</ul>
					</li>
					<li class="dropdown notifications-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell-o"></i>
						<span class="label label-warning">10</span>
						</a>
						<ul class="dropdown-menu">
						<li class="header">You have 10 notifications</li>
						<li>
							<ul class="menu">
							<li>
								<a href="#">
								<i class="fa fa-users text-aqua"></i> 5 new members joined today
								</a>
							</li>
							<li>
								<a href="#">
								<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
								page and may cause design problems
								</a>
							</li>
							<li>
								<a href="#">
								<i class="fa fa-users text-red"></i> 5 new members joined
								</a>
							</li>
							<li>
								<a href="#">
								<i class="fa fa-shopping-cart text-green"></i> 25 sales made
								</a>
							</li>
							<li>
								<a href="#">
								<i class="fa fa-user text-red"></i> You changed your username
								</a>
							</li>
							</ul>
						</li>
						<li class="footer"><a href="#">View all</a></li>
						</ul>
					</li>
					<li class="dropdown tasks-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-flag-o"></i>
						<span class="label label-danger">9</span>
						</a>
						<ul class="dropdown-menu">
						<li class="header">You have 9 tasks</li>
						<li>
							<ul class="menu">
							<li>
								<a href="#">
								<h3>
									Design some buttons
									<small class="pull-right">20%</small>
								</h3>
								<div class="progress xs">
									<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
										aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">20% Complete</span>
									</div>
								</div>
								</a>
							</li>
							<li>
								<a href="#">
								<h3>
									Create a nice theme
									<small class="pull-right">40%</small>
								</h3>
								<div class="progress xs">
									<div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
										aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">40% Complete</span>
									</div>
								</div>
								</a>
							</li>
							<li>
								<a href="#">
								<h3>
									Some task I need to do
									<small class="pull-right">60%</small>
								</h3>
								<div class="progress xs">
									<div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
										aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">60% Complete</span>
									</div>
								</div>
								</a>
							</li>
							<li>
								<a href="#">
								<h3>
									Make beautiful transitions
									<small class="pull-right">80%</small>
								</h3>
								<div class="progress xs">
									<div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
										aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">80% Complete</span>
									</div>
								</div>
								</a>
							</li>
							</ul>
						</li>
						<li class="footer">
							<a href="#">View all tasks</a>
						</li>
						</ul>
					</li> --}}
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						{{-- <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image"> --}}
						<span class="hidden-xs"><i class="fa fa-user"></i>&nbsp;{{ Auth::user()->name }}</span>
						</a>
						<ul class="dropdown-menu">
						{{-- <li class="user-header">
							<img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
							<p>
							Alexander Pierce - Web Developer
							<small>Member since Nov. 2012</small>
							</p>
						</li> --}}
						{{-- <li class="user-body">
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
						</li> --}}
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
		<script src="{{ asset('js/default.js') }}"></script>
		<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
		<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
		@yield('postscript')
	</body>
</html>
