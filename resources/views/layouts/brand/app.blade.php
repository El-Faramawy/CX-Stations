<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    @include('layouts.brand.css')
</head>

<body data-pc-direction="{{session()->get('locale') == 'en' ? 'ltr' : 'rtl'}}" data-pc-theme="{{session()->get('theme')}}">

    @include('layouts.brand.sidebar')
    @include('layouts.brand.header')

    @yield('site_content')

    @include('layouts.brand.js')
    @yield('brand_js')

</body>
<!-- [Body] end -->

</html>
