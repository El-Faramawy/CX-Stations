<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    @include('layouts.brand.css')
</head>

<body data-pc-direction="{{session()->get('locale') == 'en' ? 'ltr' : 'rtl'}}" data-pc-theme="{{session()->get('theme')}}">

    @include('layouts.brand.sidebar')
    @include('layouts.brand.header')
    <div id="global-loader" class="global-loader">
        <div class="spinner"></div>
    </div>
    @yield('site_content')

    @include('layouts.brand.js')
    @yield('brand_js')

</body>
<!-- [Body] end -->

</html>
