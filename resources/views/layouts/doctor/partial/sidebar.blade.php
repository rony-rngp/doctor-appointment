<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li>
                    <a href="{{ route('doctor.dashboard') }}" style="color: {{ request()->is('doctor/dashboard') ? '#00ACC1' : '' }}">
                        <i data-feather="airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('doctor.view.profile') }}" style="color: {{ request()->is('doctor/profile*') ? '#00ACC1' : '' }}">
                        <i class="fa fa-user"></i>
                        <span> Profile </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('doctor.schedule.view') }}" style="color: {{ request()->is('doctor/schedule*') ? '#00ACC1' : '' }}">
                        <i class="fa fa-list-alt"></i>
                        <span> Schedule </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('doctor.appointment.view') }}" style="color: {{ request()->is('doctor/appointment*') ? '#00ACC1' : '' }}">
                        <i class="fa fa-list-alt"></i>
                        <span> Appointment </span>
                        <span style="float: right" class="badge badge-danger"> {{ \App\Models\Appointment::where('doctor_id', Auth::guard('doctor')->id())->where('status', 'Pending')->count() }} </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('doctor.withdraw.add') }}" style="color: {{ request()->is('doctor/withdraw/add') ? '#00ACC1' : '' }}">
                        <i class="fa fa-list-alt"></i>
                        <span> Withdraw </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('doctor.withdraw.list') }}" style="color: {{ request()->is('doctor/withdraw/list') ? '#00ACC1' : '' }}">
                        <i class="fa fa-list-alt"></i>
                        <span> My Withdraw List </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('doctor.change.password') }}" style="color: {{ request()->is('admin/password*') ? '#00ACC1' : '' }}">
                        <i class="fa fa-cog"></i>
                        <span> Password Setting </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
