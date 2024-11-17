@extends('layouts.brand.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
@section('site_content')
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.brand.phone_header',['currentPage'=>__('messages.announce')])
            <div class="row m-0">
                <!-- CONTENT HERE -->
                <div class="col-md-12 col-xl-8 p-2">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="fw-bold text-center m-0"> {{__('messages.create_ads')}} </h4>
                        </div>
                        <div class="card-body crateAds">
                            <div class="user">
                                <img src="{{ isset(brand()->user()->getAttributes()['image']) ? brand()->user()->image : url('Brand/assets/images/placeholder.svg') }}" alt="">
                                <div class="user-info">
                                    <p class="name"> {{brand()->user()->name}} </p>
                                    <p class="phone"> {{brand()->user()->category->name_en ?? ''}} </p>
                                </div>
                            </div>
                            <form action="{{route('brand.add-ad')}}" class="repaly" id="my_form" enctype="multipart/form-data" method="post">
                                @csrf
                                <textarea rows="5" class="form-control shadow-none border-0 bg-transparent" name="title"
                                          placeholder="{{__('messages.describe_advertisement')}}"></textarea>
                                <div class="addedInPost">
                          <span id="imageSpan" style="display: none">
                            <i class="fa-regular fa-image f-14"></i>
                            <img id="imagePreview" src="{{url('Brand')}}/assets/images/ads/old ads-1.jpg" alt="">
                          </span>
                                    <span id="videoSpan" style="display: none">
                            <i class="fa-regular fa-video f-14"></i>
                            <!-- <video src="{{url('Brand')}}/assets/images/ads/old ads-1.mp4"></video> -->
                            <img id="videoPreview" src="{{url('Brand')}}/assets/images/ads/old ads-2.jpg" alt="">
                          </span>
                                    {{--                                <span>--}}
                                    {{--                        <i class="fa-regular fa-calendar-clock f-14"></i>--}}
                                    {{--                        20/10/2024 - 12:00 PM--}}
                                    {{--                      </span>--}}
                                    {{--                                <span>--}}
                                    {{--                        <i class="fa-regular fa-location-dot f-14"></i>--}}
                                    {{--                        KSA - Riyadh--}}
                                    {{--                      </span>--}}
                                </div>
                                <div class="d-flex align-items-center  border-top pt-2 px-0 pb-0" >
                                    <a href="#" class="avtar avtar-xs btn-link-secondary colorMain mx-2"
                                       data-bs-target="#addImage"
                                       data-bs-toggle="modal">
                                        <i class="fa-regular fa-image f-18"></i>
                                    </a>
                                    <a href="#" class="avtar avtar-xs btn-link-secondary colorMain mx-2"
                                       data-bs-target="#addVideo"
                                       data-bs-toggle="modal">
                                        <i class="fa-regular fa-video f-18"></i>
                                    </a>
                                    {{--                                <a href="#" class="avtar avtar-xs btn-link-secondary colorMain mx-2"--}}
                                    {{--                                   data-bs-target="#addDate"--}}
                                    {{--                                   data-bs-toggle="modal">--}}
                                    {{--                                    <i class="fa-regular fa-calendar-clock f-18"></i>--}}
                                    {{--                                </a>--}}
                                    {{--                                <a href="#" class="avtar avtar-xs btn-link-secondary colorMain mx-2"--}}
                                    {{--                                   data-bs-target="#addLocation"--}}
                                    {{--                                   data-bs-toggle="modal">--}}
                                    {{--                                    <i class="fa-regular fa-location-dot f-18"></i>--}}
                                    {{--                                </a>--}}
                                    <button type="submit" class=" py-2  rounded-circlen btn btnMain ms-auto">
                                        {{__('messages.post')}}
                                    </button>
                                </div>
                                <!-- Add image Modal -->
                                <div class="modal fade announceModal" id="addImage" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body p-0 d-flex flex-column gap-3">
                                                <!-- Dropify for image files -->
                                                <input id="imageUpload" type="file" class="dropify-image" name="image"
                                                       data-allowed-file-extensions="jpg jpeg png gif webp"/>
                                                <button type="button" class="btnMain align-self-end" data-bs-dismiss="modal" aria-label="Close">
                                                    {{__('messages.add')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Video Modal -->
                                <div class="modal fade announceModal" id="addVideo" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body p-0 d-flex flex-column gap-3">
                                                <!-- Dropify for video files -->
                                                <input id="videoUpload" type="file" class="dropify-video" name="video"
                                                       data-allowed-file-extensions="mp4 avi mov mkv mpeg"/>
                                                <button type="button" class="btnMain align-self-end" data-bs-dismiss="modal" aria-label="Close">
                                                    {{__('messages.add')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Add Date Modal -->
                    {{--                <div class="modal fade announceModal" id="addDate" tabindex="-1" role="dialog">--}}
                    {{--                    <div class="modal-dialog modal-dialog-centered">--}}
                    {{--                        <div class="modal-content">--}}
                    {{--                            <div class="modal-body p-0 d-flex flex-column gap-3">--}}
                    {{--                                <input type="datetime-local" class="form-control">--}}
                    {{--                                <button class="btnMain align-self-end" data-bs-dismiss="modal" aria-label="Close">--}}
                    {{--                                    Add--}}
                    {{--                                </button>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                    {{--                <!-- Add Location Modal -->--}}
                    {{--                <div class="modal fade announceModal" id="addLocation" tabindex="-1" role="dialog">--}}
                    {{--                    <div class="modal-dialog modal-dialog-centered">--}}
                    {{--                        <div class="modal-content">--}}
                    {{--                            <div class="modal-body p-0 d-flex flex-column gap-3">--}}
                    {{--                                <input type="text" class="form-control" id="searchLocation"--}}
                    {{--                                       placeholder="Enter location"--}}
                    {{--                                       autocomplete="off">--}}
                    {{--                                <div id="mapLocation"></div>--}}
                    {{--                                <button class="btnMain align-self-end" data-bs-dismiss="modal" aria-label="Close">--}}
                    {{--                                    Add--}}
                    {{--                                </button>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                </div>
                <div class="col-md-12 col-xl-4 p-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="opacity-90 fw-normal"> {{__('messages.account_interactions')}} </h5>
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 p-2">
                    <div class="card">
                        <div class="card-header pb-2">
                            <h4 class="colorMain"> {{__('messages.shares')}} </h4>
                            <h2 class="mb-0 fw-normal"> {{$myTotalSharesCount}}
                                {{--                            <span--}}
                                {{--                                class="badge bg-light-success  lightGreenColor lightGreenColor f-14 ms-2"> 10.0% <i--}}
                                {{--                                    class="fa-regular fa-arrow-up-right"></i> </span>--}}
                            </h2>
                        </div>
                        <div class="card-body">
                            @foreach($sharesByCity as $key=>$share)
                                <div class="announceProgress">
                                    <p class="city"> {{$share['name_'.app()->getLocale()]}} </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar
                                    @if($key % 5 == 0) linear1 @endif
                                    @if($key % 5 == 1) linear2 @endif
                                    @if($key % 5 == 2) bg-success @endif
                                    @if($key % 5 == 3) bg-info @endif
                                    @if($key % 5 == 4) bg-white @endif
                                    " style="width: {{($share->total_shares/$myTotalSharesCount)*100}}%"></div>
                                    </div>
                                    {{round(($share->total_shares/$myTotalSharesCount)*100,2)}}%
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 p-2">
                    <div class="card">
                        <div class="card-header pb-2">
                            <h4 class="colorMain"> {{__('messages.likes')}} </h4>
                            <h2 class="mb-0 fw-normal"> {{$myTotalLikesCount}}
                                {{--                            <span--}}
                                {{--                                class="badge bg-light-success  lightGreenColor lightGreenColor f-14 ms-2"> 10.0% <i--}}
                                {{--                                    class="fa-regular fa-arrow-up-right"></i> </span>--}}
                            </h2>
                        </div>
                        <div class="card-body">
                            @foreach($likesByCity as $key=>$like)
                                <div class="announceProgress">
                                    <p class="city"> {{$like['name_'.app()->getLocale()]}} </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar
                                    @if($key % 5 == 0) linear1 @endif
                                    @if($key % 5 == 1) linear2 @endif
                                    @if($key % 5 == 2) bg-success @endif
                                    @if($key % 5 == 3) bg-info @endif
                                    @if($key % 5 == 4) bg-white @endif
                                    " style="width: {{($like->total_likes/$myTotalLikesCount)*100}}%"></div>
                                    </div>
                                    {{round(($like->total_likes/$myTotalLikesCount)*100,2)}}%
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 p-2">
                    <div class="card">
                        <div class="card-header pb-2">
                            <h4 class="colorMain"> {{__('messages.comments')}} </h4>
                            <h2 class="mb-0 fw-normal"> {{$myTotalCommentsCount}}
                                {{--                            <span--}}
                                {{--                                class="badge bg-light-success  lightGreenColor lightGreenColor f-14 ms-2"> 10.0% <i--}}
                                {{--                                    class="fa-regular fa-arrow-up-right"></i> </span>--}}
                            </h2>
                        </div>
                        <div class="card-body">
                            @foreach($commentsByCity as $key=>$comment)
                                <div class="announceProgress">
                                    <p class="city"> {{$comment['name_'.app()->getLocale()]}} </p>
                                    <div class="progress" style="height: 4px">
                                        <div class="progress-bar
                                    @if($key % 5 == 0) linear1 @endif
                                    @if($key % 5 == 1) linear2 @endif
                                    @if($key % 5 == 2) bg-success @endif
                                    @if($key % 5 == 3) bg-info @endif
                                    @if($key % 5 == 4) bg-white @endif
                                    " style="width: {{($comment->total_comments/$myTotalCommentsCount)*100}}%"></div>
                                    </div>
                                    {{round(($comment->total_comments/$myTotalCommentsCount)*100,2)}}%
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-12 p-2">
                    <div class="card">
                        <div class="row">
                            <div class="col-xl-4 p-2">
                                <div class="card-header pb-2">
                                    <h4 class="colorMain"> {{__('messages.users_by_place')}} </h4>
                                    <h2 class="mb-0 fw-normal"> {{$myAllUsersCount}}
                                        {{--                                    <span class="badge bg-light-success  lightGreenColor lightGreenColor f-14 ms-2"> 10.0% <i--}}
                                        {{--                                            class="fa-regular fa-arrow-up-right"></i> </span>--}}
                                    </h2>
                                </div>
                                <div class="card-body">
                                    @foreach($usersByCity as $key=>$user)
                                        <div class="announceProgress">
                                            <p class="city"> {{$user->city_name}} </p>
                                            <div class="progress" style="height: 4px">
                                                <div class="progress-bar
                                    @if($key % 5 == 0) linear1 @endif
                                    @if($key % 5 == 1) linear2 @endif
                                    @if($key % 5 == 2) bg-success @endif
                                    @if($key % 5 == 3) bg-info @endif
                                    @if($key % 5 == 4) bg-white @endif
                                    " style="width: {{($user->user_count/$myAllUsersCount)*100}}%"></div>
                                            </div>
                                            {{round(($user->user_count/$myAllUsersCount)*100,2)}}%
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xl-8 p-0">
                                <div id="map"></div>
                            </div>
                        </div>
                        <!-- END CONTENT -->
                    </div>
                    <!-- [ Main Content ] end -->
                </div>
                <div class="col-md-12 p-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3"> {{ __('messages.previous_ads') }} </h4>
                            <div class="row">
                                @foreach($ads as $ad)
                                    <div class="col-md-6 col-xl-4 col-xxl-3 p-2">
                                        <div class="singleAd">
                                            <a href="{{url('share_ad',$ad->id)}}">
                                                <img src="{{get_file($ad->image)}}" alt="">
                                            </a>
                                            <div class="views">
                                                <span> <i class="fa-light fa-eye"></i> {{$ad->view_number}} </span>
                                                <span> <i class="fa-light fa-thumbs-up"></i> {{count($ad->like)}} </span>
                                                <span> <i class="fa-sharp fa-light fa-comment"></i> {{count($ad->comment)}} </span>
                                                <span> <i class="fa-light fa-share-nodes"></i> {{count($ad->share)}} </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- pagination -->
{{--                            <nav aria-label="Page navigation">--}}
{{--                                <ul class="pagination    ">--}}
{{--                                    {{ $ads->links() }}--}}
                                    {{--                                <li class="page-item disabled">--}}
                                    {{--                                    <a class="page-link" href="#" aria-label="Previous">--}}
                                    {{--                                        <span aria-hidden="true">&laquo;</span>--}}
                                    {{--                                    </a>--}}
                                    {{--                                </li>--}}
                                    {{--                                <li class="page-item active" aria-current="page">--}}
                                    {{--                                    <a class="page-link" href="#">1</a>--}}
                                    {{--                                </li>--}}
                                    {{--                                <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                                    {{--                                <li class="page-item">--}}
                                    {{--                                    <a class="page-link" href="#">3</a>--}}
                                    {{--                                </li>--}}
                                    {{--                                <li class="page-item">--}}
                                    {{--                                    <a class="page-link" href="#" aria-label="Next">--}}
                                    {{--                                        <span aria-hidden="true">&raquo;</span>--}}
                                    {{--                                    </a>--}}
                                    {{--                                </li>--}}
{{--                                </ul>--}}
{{--                            </nav>--}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection

@section('brand_js')
    @include('layouts.admin.inc.my-form')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbazTEugbVa6nosp0-21SCtN-GHSSQd2s"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>
    <!-- Required Js -->
    <script src="{{url('Brand')}}/assets/js/plugins/index.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/apexcharts.min.js"></script>
    <script>
        // Dropify configuration for video files
        $('.dropify-video').dropify({
            messages: {
                'default': '{{ __("messages.drag_video") }}',
                'replace': '{{ __("messages.replace_video") }}',
                'remove': '{{ __("messages.remove") }}',
                'error': '{{ __("messages.error") }}'
            },
            error: {
                'fileExtension': '{{ __("messages.video_extension_error") }}'
            }
        }).on('change', function (event) {
            $('#videoSpan').show();
            var input = this;
            if (input.files && input.files[0]) {
                // Replace the video preview with the video placeholder image
                var videoPreview = document.getElementById('videoPreview');
                videoPreview.src = "{{url('Admin')}}/imgs/video.webp"; // Video placeholder image
            }
        });

        // Dropify configuration for image files
        $('.dropify-image').dropify({
            messages: {
                'default': '{{ __("messages.drag_image") }}',
                'replace': '{{ __("messages.replace_image") }}',
                'remove': '{{ __("messages.remove") }}',
                'error': '{{ __("messages.error") }}'
            },
            error: {
                'fileExtension': '{{ __("messages.image_extension_error") }}'
            }
        }).on('change', function (event) {
            $('#imageSpan').show();
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // Replace the image preview with the uploaded image
                    var imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
    <script>
        let locationMap;

        // Initialize the map
        function initMap() {
            locationMap = new google.maps.Map(document.getElementById("mapLocation"), {
                center: {lat: 24.774265, lng: 46.738586}, // Default center location
                zoom: 12,
                styles: [
                    {"elementType": "geometry", "stylers": [{"color": "#21263A"}]},
                    {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]},
                    {"elementType": "labels.text.fill", "stylers": [{"color": "#757575"}]},
                    {"elementType": "labels.text.stroke", "stylers": [{"color": "#21263A"}]},
                    {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [{"color": "#757575"}]
                    },
                    {"featureType": "road", "elementType": "geometry", "stylers": [{"color": "#383838"}]},
                    {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#000000"}]},
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#3d3d3d"}]
                    }
                ],
                mapTypeControl: false,
                streetViewControl: false,
                fullscreenControl: true,
                zoomControl: true,
                scaleControl: false
            });
        }

        // Load the map after the page loads
        document.addEventListener("DOMContentLoaded", initMap);
    </script>
    <script>
        var options = {
            chart: {
                type: 'radialBar',
                height: 400,
            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,
                    hollow: {
                        margin: 50,
                        size: '50%',
                        background: 'transparent',
                    },
                    track: {
                        background: '#f0f0f0',
                        strokeWidth: '100%',
                        margin: 5,
                    },
                    dataLabels: {
                        name: {
                            show: true,
                        },
                        value: {
                            show: true,
                        }
                    }
                }
            },
            series: [{{$totalUsersCount != 0 ? ($myTotalUsersCount /$totalUsersCount ) * 100 : 0 }},
                {{$totalCommentsCount != 0 ? ($myTotalCommentsCount /$totalCommentsCount ) * 100 : 0 }},
                {{$totalLikesCount != 0 ? ($myTotalLikesCount /$totalLikesCount ) * 100 : 0 }}],  // Example values for the 3 sections
            labels: ['{{ __("messages.users") }}', '{{ __("messages.comments") }}', '{{ __("messages.likes") }}'],
            colors: ['#A420EB', '#0C68E9', '#00C2FF'],  // Colors for each section
            stroke: {
                lineCap: 'round'
            },
            legend: {
                show: true,
                floating: false,
                position: 'bottom',
                horizontalAlign: 'center',
                labels: {
                    colors: ['#A420EB', '#0C68E9', '#00C2FF'], // Legend text colors
                },
                markers: {
                    width: 12,
                    height: 12,
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
    <script>
        let map;
        let activeInfoWindow;  // Keep track of the currently open info window
        const locations = [
            @foreach($usersByCity as $city)
                {name: '{{$city->city_name}}', lat: {{$city->city_latitude}}, lng: {{$city->city_longitude}}, seriesValue: '{{round(($city->user_count/$myAllUsersCount)*100,2)}}' },
            @endforeach
        ];

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: 23.8859, lng: 45.0792}, // Center of Saudi Arabia
                zoom: 6,
                styles: [
                    {"elementType": "geometry", "stylers": [{"color": "#21263A"}]},
                    {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]},
                    {"elementType": "labels.text.fill", "stylers": [{"color": "#757575"}]},
                    {"elementType": "labels.text.stroke", "stylers": [{"color": "#21263A"}]},
                    {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [{"color": "#757575"}]
                    },
                    {"featureType": "road", "elementType": "geometry", "stylers": [{"color": "#383838"}]},
                    {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#000000"}]},
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#3d3d3d"}]
                    }
                ],
                mapTypeControl: false,
                streetViewControl: false,
                fullscreenControl: true,
                zoomControl: true,
                scaleControl: false
            });
            // Add markers for each location
            locations.forEach((location) => {
                const marker = new google.maps.Marker({
                    position: {lat: location.lat, lng: location.lng},
                    map,
                    title: location.name,
                    icon: {
                        url: "{{url('Brand')}}/assets/images/markerIcon.svg",
                        scaledSize: new google.maps.Size(40, 40),
                    }
                });
                const infoWindow = new google.maps.InfoWindow({
                    content: `
      <div class="info-window">
          <div id="chart-${location.name}" class="info-chart"></div>
      </div>
  `,
                });
                // Handle marker click event
                marker.addListener("click", () => {
                    // Close any open info window
                    if (activeInfoWindow) {
                        activeInfoWindow.close();
                    }
                    // Open the clicked marker's info window
                    infoWindow.open(map, marker);
                    activeInfoWindow = infoWindow;
                    // Delay loading the chart to ensure the InfoWindow is rendered
                    setTimeout(() => {
                        if (!document.querySelector(`#chart-${location.name}`).hasChildNodes()) {
                            loadChart(location.name, location.seriesValue);  // Use custom seriesValue for the chart
                        }
                    }, 300);  // Adjust the
                });
            });
        }

        // Function to load the chart
        function loadChart(city, seriesValue) {
            var options = {
                series: [seriesValue],  // Custom series value
                chart: {
                    type: 'radialBar',
                    height: 200,
                },
                colors: ['#00C2FF'],
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: '65%',
                        },
                        track: {
                            background: '#ffffff20',
                            strokeWidth: '100%',
                        },
                        dataLabels: {
                            name: {
                                offsetY: -8,
                                fontSize: '12px',
                                fontWeight: 'normal',
                            },
                            value: {
                                fontSize: '16px',
                                fontWeight: 'bold',
                                offsetY: -2,
                                show: true
                            }
                        }
                    }
                },
                labels: [city],
                stroke: {
                    lineCap: 'round',
                    colors: ['#FFFFFF']  // Change the stroke color around the bar (optional)
                }
            };
            var chart = new ApexCharts(document.querySelector(`#chart-${city}`), options);
            chart.render();
        }

        // Initialize the map when the window loads
        window.onload = initMap;
    </script>
@endsection
