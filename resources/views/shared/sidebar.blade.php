<aside class="main-sidebar">
    <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ url('calendar') }}"><i class="fa fa-calendar-check-o"></i> <span>Availability Calendar</span></a></li>
        <li><a href="{{ url('application') }}"><i class="fa fa-shopping-bag"></i> <span>POS</span></a></li>
        <li><a href="#"><i class="fa fa-send"></i> <span>Bookings</span></a></li>
        <li><a href="#"><i class="fa fa-users"></i> <span>Memberships</span></a></li>
        <li><a href="#"><i class="fa fa-th-list"></i> <span>Vendor Managment</span></a></li>
        <li><a href="#"><i class="fa fa-dollar"></i> <span>Financial</span></a></li>
        <li><a href="#"><i class="fa fa-calendar-check-o"></i> <span>Feedback Management</span></a></li>
        <li><a href="#"><i class="fa fa-bullhorn"></i> <span>Promotion & Events</span></a></li>
        <li><a href="{{ url('registration') }}"><i class="fa fa-user"></i> <span>Registration</span></a></li>
        <li><a href="{{ url('transactions') }}"><i class="fa fa-money"></i> <span>Transactions</span></a></li>
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
        </li>
        <li><a href="#"><i class="fa fa-question"></i> <span>F.A.Q</span></a></li>
    </ul>
    </section>
</aside>