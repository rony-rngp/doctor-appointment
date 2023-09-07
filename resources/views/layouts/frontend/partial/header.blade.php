<header class="header">
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                    </span>
            </a>
            <a href="{{ url('/') }}" class="navbar-brand logo">
                <img src="{{ url($settings->header_logo) }}" class="img-fluid" alt="Logo">
            </a>
        </div>
        <div class="main-menu-wrapper">
            <div class="menu-header">
                <a href="{{ url('/') }}" class="menu-logo">
                    <img src="{{ url($settings->header_logo) }}" class="img-fluid" alt="Logo">
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <ul class="main-nav">
                <li class="">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="">
                    <a href="{{ route('doctors') }}">Doctors</a>
                </li>

                @foreach($cms_pages as $cms_page)
                    <li class="">
                        <a href="{{ route('cms', $cms_page->slug) }}">{{ $cms_page->title }}</a>
                    </li>
                @endforeach

                <li class="login-link">

                    @if(Auth::guard('patient')->check())
                        <a href="{{ route('login') }}">Dashboard </a>
                    @else
                        <a href="{{ route('login') }}">login / Signup </a>
                    @endif
                </li>
            </ul>
        </div>
        <ul class="nav header-navbar-rht">
            <li class="nav-item contact-item">
                <div class="header-contact-img">
                    <i class="far fa-hospital"></i>
                </div>
                <div class="header-contact-detail">
                    <p class="contact-header">Contact</p>
                    <p class="contact-info-header"> {{ $settings->website_phone }}</p>
                </div>
            </li>
            <li class="nav-item">


                @if(Auth::guard('patient')->check())
                <a class="nav-link header-login" href="{{ route('login') }}">Dashboard </a>
                @else
                    <a class="nav-link header-login" href="{{ route('login') }}">login / Signup </a>
                @endif
            </li>
        </ul>
    </nav>
</header>
