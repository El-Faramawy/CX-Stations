<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.brand.css')
    <style>
        .choices__list.choices__list--dropdown {
            z-index: 5;
        }
    </style>
</head>

<body data-pc-direction="ltr" data-pc-theme="dark">

  <div class="auth-main">
    <!-- <div class="bg-overlay bg-dark"></div> -->
    <div class="auth-wrapper">
      <div class="auth-form">
        <div class="card">
          <div class="card-body">
            <div class="logo">
              <button class="back" type="button" onclick="window.history.back()">
                <i class="fal fa-arrow-left"></i>
                Back
              </button>
              <img src="{{get_file(setting()->logo)}}" alt="img" class="img-fluid">
            </div>
            <h3 class="text-center mb-4 text-white text-uppercase"> Sign up for free </h3>
            <form action="{{route('brand.post_register')}}" id="my_form" method="post" class="row">
                @csrf
              <div class="col-md-6 p-2">
                <label class="form-label" for="phone"> phone number </label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
              </div>
              <div class="col-md-6 p-2">
                <label class="form-label" for="email"> Email </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your phone Email">
              </div>
              <div class="col-md-6 p-2">
                <label class="form-label" for="password">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  <button class="btn btn-outline-secondary showPassword" type="button" id="togglePassword">
                    <i class="fal fa-eye" id="toggleIcon"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-6 p-2">
                <label class="form-label" for="brand"> Brand name </label>
                <input type="text" class="form-control" id="brand" name="name" placeholder="Enter your Brand number">
              </div>
              <div class="col-md-6 p-2">
                <label class="form-label" for="category"> Business type </label>
                  <select class="form-control" name="category_id" id="category">
                      <option value="" selected disabled> select category </option>
                      @foreach($categories as $category)
                          <option value="{{$category->id}}"> {{$category->name_en}} </option>
                      @endforeach
                  </select>
              </div>
              <div class="col-md-6 p-2">
                <label class="form-label" for="commercial"> Commercial register number </label>
                <input type="text" class="form-control" id="commercial" name="commercial_number"
                  placeholder="Enter your Commercial register number">
              </div>
              <div class="col-md-6 p-2">
                <label class="form-label" for="country"> Country </label>
                <select class="form-control" name="country_id" id="country">
                  <option value="" selected disabled> Select Country </option>
                    @foreach($countries as $country)
                        <option value="{{$country->id}}"> {{$country->name_en}} </option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-6 p-2">
                <label class="form-label" for="City"> City </label>
                <select class="form-control" name="city_id" id="city">
                  <option value="" selected disabled> Select City </option>
{{--                    @foreach($cities as $city)--}}
{{--                        <option value="{{$city->id}}"> {{$city->name_en}} </option>--}}
{{--                    @endforeach--}}
                </select>
              </div>
              <div class="col-md-12 p-2 d-flex mt-1 justify-content-between">
                <div class="form-check">
                  <input class="form-check-input input-primary" required type="checkbox" id="customCheckc1">
                  <label class="form-check-label text-muted" for="customCheckc1"> You are agreeing to the
                    <a href="https://hardycx.com/en/terms-of-use" target="_blank"> Terms of Services </a> and
                      <a href="https://hardycx.com/en/privacy-policy" target="_blank"> Privacy Policy </a>
                  </label>
                </div>
              </div>
              <div class="d-grid p-2 my-2">
                <button type="submit" class="btn btnMain w-100"> Get Started </button>
              </div>
              <p class="p-2"> you already have an Account? <a href="{{url('brand/login')}}" class=" ms-1"> Login </a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  @include('layouts.brand.js')
  @include('layouts.admin.inc.my-form')
  <!-- choices select -->
  <script src="{{url('Brand')}}/assets/js/plugins/choices.min.js"></script>
  <!-- Required Js -->
  <!-- choices select -->
  <script>
      var countrySelect = new Choices('#country', {});
      var citySelect = new Choices('#city', {});
      var categorySelect = new Choices('#category', {});
  </script>
  <script>
      const passwordInput = document.getElementById('password');
      const togglePassword = document.getElementById('togglePassword');
      const toggleIcon = document.getElementById('toggleIcon');
      togglePassword.addEventListener('click', function () {
          // Toggle the password visibility
          if (passwordInput.type === 'password') {
              passwordInput.type = 'text';
              toggleIcon.classList.remove('fa-eye');
              toggleIcon.classList.add('fa-eye-slash');
          } else {
              passwordInput.type = 'password';
              toggleIcon.classList.remove('fa-eye-slash');
              toggleIcon.classList.add('fa-eye');
          }
      });
  </script>
  <script>
    $(document).on('change', '#country', function () {
        $.ajax({
            type: 'GET',
            url: '{{url("brand/get_country_cities")}}?country_id=' + $(this).val(),
            success: function (data) {
               updateCityOptions(data);
            },
            error: function () {
                console.log(data);
            }
        });
    })
    function updateCityOptions(newOptions) {
        citySelect.destroy();
        var citySelectElement = document.getElementById('city');
        citySelectElement.innerHTML = '';

        var newOption = document.createElement('option');
        newOption.value = '';
        newOption.text = "Select City";
        newOption.selected = true;
        newOption.disabled = true;
        citySelectElement.add(newOption);

        newOptions.forEach(function(option) {
            var newOption = document.createElement('option');
            newOption.value = option.id;
            newOption.text = option.name_en;
            citySelectElement.add(newOption);
        });

        citySelect = new Choices('#city', {
            shouldSort: false
        });
    }
  </script>
</body>
<!-- [Body] end -->

</html>
