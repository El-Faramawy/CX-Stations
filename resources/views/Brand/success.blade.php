<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    @include('layouts.brand.css')
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-direction="ltr" data-pc-theme="dark">


  <div class="auth-main">
    <!-- <div class="bg-overlay bg-dark"></div> -->
    <div class="auth-wrapper">
      <div class="auth-form">
        <div class="card row ">
          <div class="card-body col-md-8 text-center m-auto">
            <div class="logo">
              <!-- <button class="back" type="button" onclick="window.history.back()">
                <i class="fal fa-arrow-left"></i>
                Back
              </button> -->
              <img src="{{get_file(setting()->logo)}}" alt="img" class="img-fluid">
            </div>
            <img src="{{url('Brand')}}/assets/images/done.svg" alt="" class="successImage">
            <h3 class="text-center mb-2 text-white text-uppercase"> Success! </h3>
            <p class="text-center mb-4 text-balance"> Your Email has been verified. You can now Log in Now </p>
{{--            <p class="text-center mb-4 text-balance"> Your Password has been update and is Sucre.You can now Log in Again </p>--}}
            <a href="{{route('brand.login')}}"  class="btn btnMain w-100"> Back to login </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  @include('layouts.brand.js')
</body>
<!-- [Body] end -->

</html>
