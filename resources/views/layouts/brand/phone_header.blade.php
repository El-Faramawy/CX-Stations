<div class="page-header d-md-none">
    <div class="page-block">
        <div class="row m-0 align-items-center">
            <div class="col-8 p-2">
                <ul class="breadcrumb d-flex">
                    <li class="breadcrumb-item"><a href="{{ route('brand.home') }}">{{ __('messages.home') }}</a></li>
                    <li class="breadcrumb-item" aria-current="page"> {{$currentPage}} </li>
                </ul>
                <div class="page-header-title">
                    <h2 class="mb-0">{{ __('messages.home') }}</h2>
                </div>
            </div>
            <div class="col-4 p-2 d-flex align-items-end justify-content-end">
                <a href="{{ route('brand.announce') }}" class="btnMain spaceNoWrap">{{ __('messages.new_ads') }}</a>
            </div>
        </div>
    </div>
</div>
