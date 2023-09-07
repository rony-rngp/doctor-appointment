<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i data-feather="airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="{{ request()->is('admin/profile*') ? 'menuitem-active' : '' }}">
                    <a href="#sidebarTasks" data-toggle="collapse" class="collapsed" aria-expanded="false">
                        <i data-feather="user"></i>
                        <span> Profile Setting </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse {{ request()->is('admin/profile*') ? 'show' : '' }}" id="sidebarTasks" style="">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.view.profile') }}" style="color: {{ request()->is('admin/profile/view') ||  request()->is('admin/profile/edit*') ? '#00ACC1' : '' }}">Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.change.password') }}" style="color: {{ request()->is('admin/profile/password*') ? '#00ACC1' : '' }}">Change Password</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('admin.specialist.view') }}" style="color: {{ request()->is('admin/specialist*') ? '#00ACC1' : '' }}">
                        <i data-feather="airplay"></i>
                        <span> Specialist </span>
                    </a>
                </li>

                <li>
                    <a style="color: {{ request()->is('admin/day*') ? '#00ACC1' : '' }}" href="{{ route('admin.day.view') }}" >
                        <i data-feather="airplay"></i>
                        <span> Day </span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('admin.doctor.view') }}" style="color: {{ request()->is('admin/doctor*') ? '#00ACC1' : '' }}">
                        <i data-feather="airplay"></i>
                        <span> Doctor </span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('admin.patient.view') }}" style="color: {{ request()->is('admin/patient*') ? '#00ACC1' : '' }}">
                        <i data-feather="airplay"></i>
                        <span> Patient </span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('admin.appointment.view') }}" style="color: {{ request()->is('admin/appointment*') ? '#00ACC1' : '' }}">
                        <i data-feather="airplay"></i>
                        <span> Appointment </span>
                        <span style="float: right" class="badge badge-danger"> {{ \App\Models\Appointment::where('status', 'Pending')->count() }} </span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('admin.withdrawal-method.view') }}" style="color: {{ request()->is('admin/withdrawal-method*') ? '#00ACC1' : '' }}">
                        <i data-feather="airplay"></i>
                        <span> Withdrawal Method </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.withdraw.view') }}" style="color: {{ request()->is('admin/withdraw/view') ? '#00ACC1' : '' }}">
                        <i data-feather="airplay"></i>
                        <span> Withdraw </span>
                        <span style="float: right" class="badge badge-danger"> {{ \App\Models\Withdraw::where('status', 0)->count() }} </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.review.view') }}" style="color: {{ request()->is('admin/review*') ? '#00ACC1' : '' }}">
                        <i data-feather="star"></i>
                        <span> Review </span>
                        <span style="float: right" class="badge badge-danger"> {{ \App\Models\Review::where('status', 0)->count() }} </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.cms.view') }}" style="color: {{ request()->is('admin/cms*') ? '#00ACC1' : '' }}">
                        <i data-feather="airplay"></i>
                        <span> CMS </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.settings.view') }}" style="color: {{ request()->is('admin/settings*') ? '#00ACC1' : '' }}">
                        <i data-feather="settings"></i>
                        <span> Settings </span>
                    </a>
                </li>


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
