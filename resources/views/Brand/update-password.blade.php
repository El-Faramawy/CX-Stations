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
            <div class="card">
                <div class="card-body row justify-content-center">
                    <div class="logo">
                        <!-- <button class="back" type="button" onclick="window.history.back()">
                          <i class="fal fa-arrow-left"></i>
                          Back
                        </button> -->
                        <img src="{{get_file(setting()->logo)}}" alt="img" class="img-fluid">
                    </div>
                    <form id="my_form" action="{{route('brand.update_password')}}" method="post" class="col-md-7 p-0">
                        @csrf
                        <input type="hidden" class="form-control" name="email" value="{{$email}}">
                        <div class="p-2">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                <button class="btn btn-outline-secondary showPassword" type="button"
                                        id="togglePassword">
                                    <i class="fal fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-2">
                            <label class="form-label" for="confirm_password">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password">
                                <button class="btn btn-outline-secondary showPassword" type="button"
                                        id="togglePassword">
                                    <i class="fal fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-grid p-2 my-2">
                            <button type="submit" class="btn btnMain"> Change Password</button>
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

</body>
<!-- [Body] end -->

</html>
