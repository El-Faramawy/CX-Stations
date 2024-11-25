<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('brand.home') }}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ get_file(setting()->logo) }}" alt="logo image" class="logo-lg">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <!-- link -->
                <li class="pc-item">
                    <a href="{{ route('brand.home') }}" class="pc-link">
                        <span class="pc-micon"> <img src="{{ url('Brand') }}/assets/images/home.svg" alt=""> </span>
                        <span class="pc-mtext">{{ __('messages.home') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('brand.duet') }}" class="pc-link">
                        <span class="pc-micon" >
                            <img src="{{ url('Brand') }}/assets/images/duet_mood.svg" alt="">
                        </span>
                        <span class="pc-mtext">{{ __('messages.duet_mode') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('brand.clients') }}" class="pc-link">
                        <span class="pc-micon" >
                            <img src="{{ url('Brand') }}/assets/images/clients.png" alt="">
                        </span>
                        <span class="pc-mtext">{{ __('messages.clients') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('brand.coupons') }}" class="pc-link">
                        <span class="pc-micon" >
                            <img src="{{ url('Brand') }}/assets/images/coupon.png" alt="">
                        </span>
                        <span class="pc-mtext">{{ __('messages.coupons_Salla') }}</span>
                    </a>
                </li>
                <!-- link -->
                <li class="pc-item">
                    <a href="{{ route('brand.dashboard') }}" class="pc-link">
                        <span class="pc-micon"> <img src="{{ url('Brand') }}/assets/images/dashboard.svg" alt=""> </span>
                        <span class="pc-mtext">{{ __('messages.dashboard') }}</span>
                    </a>
                </li>
                <!-- link -->
                <li class="pc-item">
                    <a href="{{ route('brand.comments') }}" class="pc-link">
                        <span class="pc-micon"> <img src="{{ url('Brand') }}/assets/images/comments.svg" alt=""> </span>
                        <span class="pc-mtext">{{ __('messages.comments') }}</span>
                    </a>
                </li>
                <!-- link -->
                <li class="pc-item">
                    <a href="{{ route('brand.announce') }}" class="pc-link">
                        <span class="pc-micon"> <img src="{{ url('Brand') }}/assets/images/announce.svg" alt=""> </span>
                        <span class="pc-mtext">{{ __('messages.announce') }}</span>
                    </a>
                </li>
                <!-- link -->
                <li class="pc-item">
                    <a href="{{ route('brand.settings') }}" class="pc-link">
                        <span class="pc-micon"> <img src="{{ url('Brand') }}/assets/images/setting.svg" alt=""> </span>
                        <span class="pc-mtext">{{ __('messages.settings') }}</span>
                    </a>
                </li>
                <!-- link -->
                <li class="pc-item">
                    <a href="{{ route('brand.logout') }}" class="pc-link">
                        <span class="pc-micon"> <img src="{{ url('Brand') }}/assets/images/Logout.svg" alt=""> </span>
                        <span class="pc-mtext">{{ __('messages.logout') }}</span>
                    </a>
                </li>
            </ul>
        </div>
        {{--        <div class="p-3">--}}
        {{--            <div class="trial p-3">--}}
        {{--                <h6> Your trial ends in 14 days </h6>--}}
        {{--                <p class="f-12"> Your subscription will automatically renew on <strong class="textChange"> Friday 29 January--}}
        {{--                        2024 </strong> </p>--}}
        {{--            </div>--}}
        {{--            <div class="card nav-action-card">--}}
        {{--                <div class="card-body p-3">--}}
        {{--                    <h5 class="text-dark"> Upgrade account </h5>--}}
        {{--                    <p class="text-dark text-opacity-75 f-12"> Upgrade your account now and get more features from us </p>--}}
        {{--                    <a href="#!" class="btn btnMain w-100" target="_blank"> Upgrade Now </a>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
