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

    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ url('calendar') }}"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
        <li><a href="{{ url('application') }}"><i class="fa fa-calendar-check-o"></i> <span>Applications</span></a></li>
        <li><a href="{{ url('registration') }}"><i class="fa fa-user"></i> <span>Registration</span></a></li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-gear"></i>
                <span>Settings</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('settings/categories') }}"><i class="fa fa-circle-o"></i>Facility Categories</a></li>
                <li><a href="{{ url('settings/groups') }}"><i class="fa fa-circle-o"></i>Facility Groups</a></li>
                <li><a href="{{ url('settings/facilities') }}"><i class="fa fa-circle-o"></i>Facilities</a></li>
                <li><a href="{{ url('settings/equiptments') }}"><i class="fa fa-circle-o"></i>Equiptments</a></li>
                <li><a href="{{ url('settings/activities') }}"><i class="fa fa-circle-o"></i>Activities</a></li>
                <li><a href="{{ url('settings/users') }}"><i class="fa fa-circle-o"></i>Users</a></li>
                <li><a href="{{ url('settings/customers') }}"><i class="fa fa-circle-o"></i>Customers</a></li>
                <li><a href="{{ url('settings/membership') }}"><i class="fa fa-circle-o"></i>Membership</a></li>
                <li><a href="{{ url('settings/profile') }}"><i class="fa fa-circle-o"></i>My Profile</a></li>
            </ul>
            <li><a href="{{ url('transactions') }}"><i class="fa fa-money"></i> <span>Transactions</span></a></li>
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-question"></i> <span>F.A.Q</span></a></li>
        </li>
    </ul>
    </section>
</aside>