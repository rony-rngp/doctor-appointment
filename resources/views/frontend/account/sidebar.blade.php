<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;"><div class="profile-sidebar">
            <div class="widget-profile pro-widget-content">
                <div class="profile-info-widget">
                    <a href="#" class="booking-doc-img">
                        <img src="{{ file_exists($patient->image) ? url($patient->image) : asset('public/backend/upload/avatar.png') }}" alt="User Image">
                    </a>
                    <div class="profile-det-info">
                        <h3>{{ $patient->name }}</h3>
                        <div class="patient-details">
                            <h5><i class="fas fa-birthday-cake"></i> {{ $patient->dob }}</h5>
                            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{ $patient->address }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-widget">
                <nav class="dashboard-menu">
                    <ul>
                        <li class="{{ request()->is('patient/dashboard') || request()->is('patient/appointment*') ? 'active' : '' }}">
                            <a href="{{ route('patient.dashboard') }}">
                                <i class="fas fa-columns"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('patient/profile*') ? 'active' : '' }}">
                            <a href="{{ route('patient.view.profile') }}">
                                <i class="fas fa-user-cog"></i>
                                <span>Profile Settings</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('patient/review*') ? 'active' : '' }}">
                            <a href="{{ route('patient.view.review') }}">
                                <i class="fas fa-star"></i>
                                <span>Review</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('patient/password*') ? 'active' : '' }}">
                            <a href="{{ route('patient.change.password') }}">
                                <i class="fas fa-lock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('patient.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div><div class="resize-sensor" style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;"><div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;"><div style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 340px; height: 1528px;"></div></div><div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;"><div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div></div></div></div></div>
