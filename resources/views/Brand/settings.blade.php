@extends('layouts.brand.app')
@section('site_content')
    <style>
        #iframe{
            position: absolute;
            top: 10%;
            height: 100%;
            width: 100%;
            border :0px;
        }
    </style>
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.brand.phone_header',['currentPage'=>'Settings'])
            <div class="row m-0">
                <!-- CONTENT HERE -->
                <div class="col-12 p-2">
                    <div class="card">
                        <div class="card-body">
                            @if (session('errors'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach (session('errors')->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Nav tabs -->
                            <div class="nav settingNav">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile">
                                    {{ __('messages.profile') }}
                                </button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Password">
                                    {{ __('messages.password') }}
                                </button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#SocialMedia">
                                    {{ __('messages.social_media') }}
                                </button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#SallaStore">
                                    {{ __('messages.salla_store_config') }}
                                </button>
                                {{-- <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Notification"> --}}
                                {{-- {{ __('messages.notification') }} --}}
                                {{-- </button> --}}
                            </div>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <form id="my_form1" action="{{ route('brand.post_setting') }}" method="post"
                                          class="row" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-12 p-2">
                                            <div class="uploadImage wide">
                                                <input type="file" class="uploadImageInput" id="uploadImageInput"
                                                       name="panner" accept="image/*" multiple/>
                                                <label for="uploadImageInput" class="uploadImageLabel">
                                                    <div id="previewContainer">
                                                        <img
                                                            src="{{ isset(brand()->user()->getAttributes()['panner']) ? get_file(brand()->user()->panner) : 'https://dummyimage.com/1920x1024/070914/070914' }}"
                                                            alt="Profile Image" class="uploadImagePreview"/>
                                                    </div>
                                                </label>
                                                <span><img src="{{ url('Brand/assets/images/plus.svg') }}"
                                                           alt=""/></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-2 mt-100 pb-5">
                                            <div class="uploadImage">
                                                <input type="file" class="uploadImageInput" id="uploadImageInput2"
                                                       name="image" accept="image/*" multiple/>
                                                <label for="uploadImageInput2" class="uploadImageLabel">
                                                    <div id="previewContainer2">
                                                        <img
                                                            src="{{ isset(brand()->user()->getAttributes()['image']) ? brand()->user()->image : url('Brand/assets/images/placeholder.svg') }}"
                                                            alt="Profile Image" class="uploadImagePreview"/>
                                                    </div>
                                                </label>
                                                <span><img src="{{ url('Brand/assets/images/plus.svg') }}"
                                                           alt=""/></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label"
                                                   for="Display">{{ __('messages.display_name') }}</label>
                                            <input type="text" class="form-control" readonly id="Display"
                                                   value="{{ brand()->user()->name }}">
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label"
                                                   for="phone">{{ __('messages.phone_number') }}</label>
                                            <input type="number" class="form-control" readonly id="phone"
                                                   value="{{ brand()->user()->phone }}">
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label" for="email">{{ __('messages.email') }}</label>
                                            <input type="email" class="form-control" readonly id="email"
                                                   value="{{ brand()->user()->email }}">
                                        </div>
                                        {{--                                        <div class="col-md-6 col-xl-4 p-2">--}}
                                        {{--                                            <label class="form-label" for="Location">{{ __('messages.location') }}</label>--}}
                                        {{--                                            <input type="text" class="form-control" readonly id="Location" value="{{ brand()->user()->address }}">--}}
                                        {{--                                        </div>--}}
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label"
                                                   for="business">{{ __('messages.business_type') }}</label>
                                            <input type="text" class="form-control" readonly id="Business"
                                                   value="{{ brand()->user()->category['name_'.session()->get('locale')] ?? '' }}">
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label" for="business">{{ __('messages.city') }}</label>
                                            <input type="text" class="form-control" readonly id="Business"
                                                   value="{{ brand()->user()->city['name_'.session()->get('locale')] ?? '' }}">
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label"
                                                   for="commercial">{{ __('messages.commercial_register_number') }}</label>
                                            <input type="text" class="form-control" readonly id="commercial"
                                                   value="{{ brand()->user()->commercial_number }}">
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label"
                                                   for="points">{{ __('messages.number_of_points') }}</label>
                                            <input type="text" class="form-control" id="points"
                                                   value="{{ brand()->user()->discount_points }}" name="discount_points"
                                                {{!$discount_points_last_updated ? 'disabled readonly' : ''}}>
                                            <small id="pointsNum"
                                                   class="form-text text-muted">{{ __('messages.data_updated_monthly') }}</small>
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label"
                                                   for="Specify">{{ __('messages.specify_discount_rate') }}</label>
                                            <input type="text" class="form-control" id="Specify"
                                                   placeholder="{{ __('messages.enter_discount_rate') }}"
                                                   aria-describedby="discountRate"
                                                   value="{{ brand()->user()->discount }}"
                                                   {{!$discount_last_updated ? 'disabled readonly' : ''}} name="discount">
                                            <small id="discountRate"
                                                   class="form-text text-muted">{{ __('messages.data_updated_monthly') }}</small>
                                        </div>
                                        <div class="d-grid p-2 my-2">
                                            <button type="submit" class="btn btnMain"
                                                    style="width: fit-content;">{{ __('messages.save') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="Password">
                                    <form id="my_form2" action="{{ route('brand.post_setting') }}" method="post"
                                          class="row" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label"
                                                   for="currentPassword">{{ __('messages.current_password') }}</label>
                                            <input type="password" class="form-control" id="currentPassword"
                                                   name="current_password"
                                                   placeholder="{{ __('messages.current_password') }}">
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label"
                                                   for="NewPassword">{{ __('messages.new_password') }}</label>
                                            <input type="password" class="form-control" id="NewPassword" name="password"
                                                   placeholder="{{ __('messages.new_password') }}"
                                                   aria-describedby="NewPasswordHelp">
                                            <small id="NewPasswordHelp"
                                                   class="form-text text-muted">{{ __('messages.password_help') }}</small>
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label"
                                                   for="ConfirmNewPassword">{{ __('messages.confirm_new_password') }}</label>
                                            <input type="password" class="form-control" id="ConfirmNewPassword"
                                                   name="confirm_password"
                                                   placeholder="{{ __('messages.confirm_new_password') }}"
                                                   aria-describedby="ConfirmNewPasswordHelp">
                                            <small id="ConfirmNewPasswordHelp"
                                                   class="form-text text-muted">{{ __('messages.password_help') }}</small>
                                        </div>
                                        <div class="d-grid p-2 my-2">
                                            <button type="submit" class="btn btnMain"
                                                    style="width: fit-content;">{{ __('messages.save') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="SocialMedia">
                                    <form id="my_form3" action="{{ route('brand.post_setting') }}" method="post"
                                          class="row" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label" for="Website">{{ __('messages.website') }}</label>
                                            <input type="text" class="form-control" id="Website"
                                                   placeholder="{{ __('messages.website') }}" name="website"
                                                   value="{{ brand()->user()->website }}">
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label"
                                                   for="Facebook">{{ __('messages.facebook') }}</label>
                                            <input type="text" class="form-control" name="facebook"
                                                   value="{{ brand()->user()->facebook }}" id="Facebook"
                                                   placeholder="{{ __('messages.facebook') }}">
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label"
                                                   for="Insagram">{{ __('messages.instagram') }}</label>
                                            <input type="text" class="form-control" name="insta"
                                                   value="{{ brand()->user()->insta }}" id="Insagram"
                                                   placeholder="{{ __('messages.instagram') }}">
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label" for="Tiktok">{{ __('messages.tiktok') }}</label>
                                            <input type="text" class="form-control" id="Tiktok" name="tiktok"
                                                   value="{{ brand()->user()->tiktok }}"
                                                   placeholder="{{ __('messages.tiktok') }}">
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label" for="Youtube">{{ __('messages.youtube') }}</label>
                                            <input type="text" class="form-control" id="Youtube" name="youtube"
                                                   value="{{ brand()->user()->youtube }}"
                                                   placeholder="{{ __('messages.youtube') }}">
                                        </div>
                                        <div class="col-md-6 col-xl-4 p-2">
                                            <label class="form-label" for="X">{{ __('messages.twitter') }}</label>
                                            <input type="text" class="form-control" id="X"
                                                   placeholder="{{ __('messages.twitter') }}" name="twitter"
                                                   value="{{ brand()->user()->twitter }}">
                                        </div>
                                        <div class="col-md-12 p-2">
                                            <label class="form-label" for="Bio">{{ __('messages.bio') }}</label>
                                            <textarea class="form-control" rows="5" id="Bio" name="about"
                                                      placeholder="{{ __('messages.bio') }}">{{ brand()->user()->about }}</textarea>
                                        </div>
                                        <div class="d-grid p-2 my-2">
                                            <button type="submit" class="btn btnMain"
                                                    style="width: fit-content;">{{ __('messages.save') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="SallaStore">
                                    <form id="my_form4" action="{{ route('brand.post_salla_setting') }}" method="post"
                                          class="row" enctype="multipart/form-data">
                                        @csrf

                                        <p>
                                            <i class="fa fa-info-circle"></i>
                                            {{ __('messages.to_get_the_salla') }}
                                            <a href="https://portal.salla.partners/apps"> انشاء تطبيق </a>
                                            <span class="d-block">
                                                {{ __('messages.be_aware') }}
                                                <span>{{env('APP_URL').'/brand/callback'}}</span>
                                            </span>
                                        </p>

                                        <div class="col-6">
                                            <div class="col-md-12 col-xl-12 p-2">
                                                <label class="form-label"
                                                       for="client_id">{{ __('messages.client_id') }}</label>
                                                <input type="text" class="form-control" id="client_id"
                                                       placeholder="{{ __('messages.client_id') }}" name="client_id"
                                                       value="{{ @$salla->client_id }}">
                                            </div>

                                            <div class="col-md-12 col-xl-12 p-2">
                                                <label class="form-label"
                                                       for="client_secret">{{ __('messages.client_secret') }}</label>
                                                <input type="text" class="form-control" id="client_secret"
                                                       placeholder="{{ __('messages.client_secret') }}" name="client_secret"
                                                       value="{{ @$salla->client_secret }}">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <img src="{{ url('Brand') }}/assets/images/salla.png" style="height: 70%;width: 82%">
                                        </div>

                                        @if($salla->expire_at)
                                            <div class="col-12">
                                                <p>{{__("messages.expire_at")}} : <span class="fw-bold">{{$salla->expire_at}}</span> </p>
                                                <p><i class="fa fa-warning"></i> {{__("messages.renew_the_data")}} </p>
                                            </div>
                                        @endif


                                        <div class="d-grid p-2 my-2">
                                            <button type="submit" class="btn btnMain"
                                                    style="width: fit-content;">{{ __('messages.save') }}</button>
                                        </div>
                                    </form>
                                </div>

                                {{--                                <div class="tab-pane" id="Notification">--}}
                                {{--                                    Notification--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

    <iframe id="iframe" class="d-none"></iframe>

@endsection

@section('brand_js')
    <script>
        // Function to handle image preview
        function handleFileUpload(inputElement, previewContainer) {
            const files = inputElement.files;
            previewContainer.innerHTML = ""; // Clear the current previews
            Array.from(files).forEach((file) => {
                const reader = new FileReader();
                const imgElement = document.createElement("img");
                imgElement.classList.add("uploadImagePreview");
                reader.onload = function (e) {
                    imgElement.setAttribute("src", e.target.result);
                    previewContainer.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            });
        }

        // Event listeners for both file inputs
        const uploadInput1 = document.getElementById("uploadImageInput");
        const previewContainer1 = document.getElementById("previewContainer");
        uploadInput1.addEventListener("change", function () {
            handleFileUpload(uploadInput1, previewContainer1);
        });
        const uploadInput2 = document.getElementById("uploadImageInput2");
        const previewContainer2 = document.getElementById("previewContainer2");
        uploadInput2.addEventListener("change", function () {
            handleFileUpload(uploadInput2, previewContainer2);
        });
    </script>

    <script>
        sendFormData('my_form1');
        sendFormData('my_form2');
        sendFormData('my_form3');
        sendFormData('my_form4');

        function sendFormData(id) {
            $(document).on('submit', '#' + id, function (event) {
                event.preventDefault();
                var form_data = new FormData(document.getElementById(id));
                var url = $('#' + id).attr('action');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#global-loader').addClass('show');
                    },
                    complete: function () {
                        $('#global-loader').removeClass('show');
                    },
                    success: function (data, textStatus, jqXHR) {
                        if (jqXHR.status === 202) {
                            location.href = data.custom_url;
                            var iframe = $('#iframe');
                            iframe.attr('src', data.custom_url);
                            iframe.removeClass('d-none');
                        }
                        window.setTimeout(function () {
                            $('#global-loader').hide()
                            if (data.message != null) {
                                my_toaster(data.message)
                            }
                            if (data.url != null) {
                                location.href = data.url;
                            }
                        }, 500);
                    },
                    error: function (data) {
                        $('#global-loader').hide()
                        if (data.status === 422) {
                            var errors = Object.values(data.responseJSON.messages);
                        } else {
                            var errors = Object.values(data.responseJSON.errors);
                        }
                        $(errors).each(function (index, message) {
                            my_toaster(message, 'error')
                        });
                    }
                });
            });
        }
    </script>

@endsection
