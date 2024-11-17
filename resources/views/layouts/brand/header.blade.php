<header class="pc-header">
    <div class="header-wrapper">
        <!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled gap-3 align-items-center">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="fa-regular fa-bars"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="fa-regular fa-bars"></i>
                    </a>
                </li>
                <li class="pc-h-item d-none d-md-flex">
                    <h4 class="mb-0">{{ __('messages.dashboard') }}</h4>
                </li>
                <li class="pc-h-item d-none d-md-flex">
                    <a href="{{ route('brand.announce') }}" class="btnMain">{{ __('messages.new_ads') }}</a>
                </li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="ph-duotone ph-sun-dim"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <a href="{{ route('brand.updatePreferences',['theme'=>'dark']) }}" class="dropdown-item">
                            <i class="ph-duotone ph-moon"></i>
                            <span>{{ __('messages.dark_mode') }}</span>
                        </a>
                        <a href="{{ route('brand.updatePreferences',['theme'=>'light']) }}" class="dropdown-item">
                            <i class="ph-duotone ph-sun-dim"></i>
                            <span>{{ __('messages.light_mode') }}</span>
                        </a>
                    </div>
                </li>

                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="ph-duotone ph-globe-simple"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <a href="{{ route('brand.updatePreferences',['language'=>'en']) }}" class="dropdown-item">
                            <span>{{ __('messages.english') }}</span>
                        </a>
                        <a href="{{ route('brand.updatePreferences',['language'=>'ar']) }}" class="dropdown-item">
                            <span>{{ __('messages.arabic') }}</span>
                        </a>
                    </div>
                </li>
                <li class="dropdown pc-h-item">
                    <a class="dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <img src="{{ isset(brand()->user()->getAttributes()['image']) ? brand()->user()->image : url('Brand/assets/images/user/avatar-1.jpg') }}" alt="user image" class="rounded-circle mx-2"
                             style="height: 40px; aspect-ratio: 1; object-fit: cover">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center">
                            <div class="avtar avtar-s">
                                <img src="{{ isset(brand()->user()->getAttributes()['image']) ? brand()->user()->image : url('Brand/assets/images/user/avatar-1.jpg') }}" alt="user image" class="img-fluid rounded-circle">
                            </div>
                            <div class="ms-3 lh-1">
                                <h5 class="mb-1">{{ brand()->user()->name }}</h5>
                                <small>{{brand()->user()->category->name['name_'.app()->getLocale()] ?? ''}}</small>
{{--                                <small>{{ __('messages.admin') }}</small>--}}
                            </div>
                        </div>
                        <div class="dropdown-body">
                            <a href="{{ route('brand.settings') }}" class="dropdown-item">
                                <i class="ph-duotone ph-gear-six"></i>
                                <span>{{ __('messages.settings') }}</span>
                            </a>
                            <a href="{{ route('brand.logout') }}" class="dropdown-item">
                                <i class="ph-duotone ph-sign-out"></i>
                                <span>{{ __('messages.logout') }}</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
