<script src="{{url('Brand')}}/assets/js/jquery.min.js"></script>
<script src="{{url('Brand')}}/assets/js/plugins/popper.min.js"></script>
<script src="{{url('Brand')}}/assets/js/plugins/simplebar.min.js"></script>
<script src="{{url('Brand')}}/assets/js/plugins/bootstrap.min.js"></script>
<script src="{{url('Brand')}}/assets/js/pcoded.js"></script>
<script>layout_rtl_change('{{session()->get('locale') === 'ar' ? 'true' : 'false'}}');</script>
<script>layout_change({{session()->get('theme') ?? 'dark'}});</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@include('layouts.admin.inc.toaster')

