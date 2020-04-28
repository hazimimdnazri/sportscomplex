<aside class="main-sidebar">
    <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{ url('vendor/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ url('vendor/calendar') }}"><i class="fa fa-calendar-check-o"></i> <span>Availability Calendar</span></a></li>
        <li><a href="{{ url('vendor/applications') }}"><i class="fa fa-shopping-bag"></i> <span>Applications</span></a></li>
        <li><a href="#"><i class="fa fa-question"></i> <span>F.A.Q</span></a></li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-gear"></i>
                <span>Settings</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Change Password</a></li>
                <li><a href="{{ url('vendor/settings/profile') }}"><i class="fa fa-circle-o"></i>My Profile</a></li>
            </ul>
        </li>
    </ul>
    </section>
</aside>