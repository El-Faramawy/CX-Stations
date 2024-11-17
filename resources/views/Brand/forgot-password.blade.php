<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->
<head>
    @include('layouts.brand.css')
</head>

<body data-pc-direction="ltr" data-pc-theme="dark">


  <div class="auth-main">
    <!-- <div class="bg-overlay bg-dark"></div> -->
    <div class="auth-wrapper">
      <div class="auth-form">
        <div class="card">
          <div class="card-body row justify-content-center">
            <div class="logo">
              <button class="back" type="button" onclick="window.history.back()">
                <i class="fal fa-arrow-left"></i>
                Back
              </button>
                <img src="{{get_file(setting()->logo)}}" alt="img" class="img-fluid">
            </div>
            <h3 class="text-center mb-2 text-white text-uppercase"> Forgot password? </h3>
            <p class="text-center mb-4"> No worries, we’ll send you reset instruction. </p>
            <form action="{{route('brand.post_get_code')}}" method="post" id="my_form" class="col-md-7 p-0">
                @csrf
              <div class="p-2">
                <label class="form-label" for="email"> Email </label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your phone number">
              </div>

              <div class="d-grid p-2 my-2">
                <button type="submit" class="btn btnMain"> Reset Password </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  @include('layouts.brand.js')
  @include('layouts.admin.inc.my-form')
</body>
<!-- [Body] end -->

</html>
