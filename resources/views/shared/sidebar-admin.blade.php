<aside class="main-sidebar">
    <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ url('admin/calendar') }}"><i class="fa fa-calendar-check-o"></i> <span>Availability Calendar</span></a></li>
        <li><a href="{{ url('admin/application') }}"><i class="fa fa-shopping-bag"></i> <span>POS</span></a></li>
        <!-- <li><a href="#"><i class="fa fa-send"></i> <span>Bookings</span></a></li> -->
        <li><a href="{{ url('admin/customers') }}"><i class="fa fa-users"></i> <span>Customers</span></a></li>
        <li><a href="{{ url('admin/vendors') }}"><i class="fa fa-th-list"></i> <span>Vendors</span></a></li>
        <!-- <li><a href="#"><i class="fa fa-dollar"></i> <span>Financial</span></a></li> -->
        <!-- <li><a href="#"><i class="fa fa-calendar-check-o"></i> <span>Feedback Management</span></a></li> -->
        <!-- <li><a href="#"><i class="fa fa-bullhorn"></i> <span>Promotion & Events</span></a></li> -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user"></i>
                <span>Registration</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('admin/registration/user') }}"><i class="fa fa-circle-o"></i>User</a></li>
                <li><a href="{{ url('admin/registration/vendor') }}"><i class="fa fa-circle-o"></i>Vendor</a></li>
                <!-- <li><a href="{{ url('settings/profile') }}"><i class="fa fa-circle-o"></i>My Profile</a></li> -->
            </ul>
        </li>
        <!-- <li><a href="{{ url('transactions') }}"><i class="fa fa-money"></i> <span>Transactions</span></a></li> -->
        @if(Auth::user()->role == 1)
        <li class="treeview">
            <a href="#">
                <i class="fa fa-gear"></i>
                <span>Settings</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('admin/settings/venues') }}"><i class="fa fa-circle-o"></i>Venues</a></li>
                <li><a href="{{ url('admin/settings/facilities') }}"><i class="fa fa-circle-o"></i>Facilities</a></li>
                <li><a href="{{ url('admin/settings/equiptments') }}"><i class="fa fa-circle-o"></i>Equiptments</a></li>
                <li><a href="{{ url('admin/settings/sports') }}"><i class="fa fa-circle-o"></i>Sports</a></li>
                <li><a href="{{ url('admin/settings/activities') }}"><i class="fa fa-circle-o"></i>Activities</a></li>
                <li><a href="{{ url('admin/settings/institutions') }}"><i class="fa fa-circle-o"></i>Institutions</a></li>
                <li><a href="{{ url('admin/settings/users') }}"><i class="fa fa-circle-o"></i>Users</a></li>
                <li><a href="{{ url('admin/settings/membership') }}"><i class="fa fa-circle-o"></i>Membership</a></li>
                <!-- <li><a href="{{ url('settings/profile') }}"><i class="fa fa-circle-o"></i>My Profile</a></li> -->
            </ul>
        </li>
        @endif
        <!-- <li><a href="#"><i class="fa fa-question"></i> <span>F.A.Q</span></a></li> -->
    </ul>
    </section>
</aside>