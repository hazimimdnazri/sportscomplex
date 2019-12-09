<aside class="main-sidebar">
    <section class="sidebar">
    <div class="user-panel">
        <div class="pull-left image">
        <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>

    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ url('calendar') }}"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
        <li><a href="{{ url('application') }}"><i class="fa fa-calendar-check-o"></i> <span>Application</span></a></li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-gear"></i>
                <span>Settings</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('settings/assets') }}"><i class="fa fa-circle-o"></i>Assets</a></li>
                <li><a href="{{ url('settings/users') }}"><i class="fa fa-circle-o"></i>Users</a></li>
            </ul>
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-question"></i> <span>F.A.Q</span></a></li>
        </li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
    </ul>
    </section>
    <!-- /.sidebar -->
</aside>