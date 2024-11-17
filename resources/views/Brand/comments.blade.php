@extends('layouts.brand.app')
@section('site_content')
    <div class="pc-container">
        <div class="pc-content">
            @include('layouts.brand.phone_header',['currentPage'=>'Comments'])
            <!-- [ Main Content ] start -->
            <div class="row m-0">
                <!-- CONTENT HERE -->
                <div class="col-md-6 col-xl-4 p-2">
                    <div class="card h-100 mb-0">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <div class="d-flex align-items-center">
                                <div class="avatar2 rounded-circle linear1 text-white me-3">
                                    <img src="{{url('Brand')}}/assets/images/comments.svg" alt="">
                                </div>
                                <div>
                                    <h4 class="opacity-90 fw-normal">{{ __('messages.total_comments') }}</h4>
                                    <div class="d-flex align-items-end">
                                        <h1 class="mb-0 fw-bold"> {{$myTotalCommentsCount}} </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 p-2">
                    <div class="card h-100 mb-0">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <div class="d-flex align-items-center">
                                <div class="avatar2 rounded-circle linear2 text-white me-3">
                                    <img src="{{url('Brand')}}/assets/images/users.svg" alt="">
                                </div>
                                <div>
                                    <h4 class="opacity-90 fw-normal">{{ __('messages.total_users') }}</h4>
                                    <div class="d-flex align-items-end">
                                        <h1 class="mb-0 fw-bold"> {{$myTotalUsersCount}} </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-4 p-2">
                    <div class="card h-100 mb-0">
                        <div class="card-body">
                            <h5 class="opacity-90 fw-normal">{{ __('messages.account_interactions') }}</h5>
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="card">
                        <div class="card-body">
                            <table
                                class="dataTableTable commentsTable display table table-striped table-hover dt-responsive nowrap"
                                style="width: 100%">
                                <thead>
                                <tr>
                                    <th>{{ __('messages.name_number') }}</th>
                                    <th>{{ __('messages.comments') }}</th>
                                    <th>{{ __('messages.reply') }}</th>
                                    <th>{{ __('messages.the_action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <img src="{{get_file($comment->user->image ?? '')}}" alt="">
                                                <div class="user-info">
                                                    <p class="name"> {{$comment->user->name ?? ''}} </p>
                                                    <p class="phone"> {{$comment->user->phone_code ?? ''}}  {{$comment->user->phone ?? ''}} </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="max-width: 300px;">
                                            <div class="comment">
                                                <p class="text">{{$comment->comment}}</p>
                                            </div>
                                        </td>
                                        <td style="max-width: 300px;">
                                            <div class="comment">
                                                <p class="text">{{$comment->reply ?? '----'}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            @if($comment->reply)
                                                <button type="button" class="btn btn-success" id="viewComment" data-id="{{$comment->id}}">
                                                    {{ __('messages.view') }}
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-outline-blue" id="replayComment" data-id="{{$comment->id}}">
                                                    {{ __('messages.reply') }}
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <!-- Modal for Viewing Comment -->
    <div class="modal fade" id="viewCommentModal" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" id="viewCommentModalContent">

            </div>
        </div>
    </div>

    <!-- Modal for Replying to Comment -->
    <div class="modal fade" id="replayCommentModal" tabindex="-1"
         role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" id="replayCommentModalContent">

            </div>
        </div>
    </div>

@endsection

@section('brand_js')
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.responsive.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/responsive.bootstrap5.min.js"></script>
    <!-- apexcharts -->
    <script src="{{url('Brand')}}/assets/js/plugins/apexcharts.min.js"></script>

    <script>
        var options = {
            chart: {
                type: 'radialBar',
                height: 300,
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
                {{$totalCommentsCount != 0 ? ($myTotalCommentsCount /$totalCommentsCount ) * 100 : 0}},
                {{$totalLikesCount != 0 ? ($myTotalLikesCount /$totalLikesCount ) * 100 : 0 }}],  // Example values for the 3 sections
            labels: ['{{ __('messages.users') }}', '{{ __('messages.comments') }}', '{{ __('messages.likes') }}'], // Translated labels
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
    <!-- datatable Js -->
    <script>
        // [ Configuration Option ]
        $('.dataTableTable').DataTable({
            responsive: true,
            searching: true,
            lengthChange: true,
            // pageLength: 5
            language: {
                @if(app()->getLocale() == 'ar')
                "url": "{{url('Brand')}}/assets/js/plugins/dataTable-ar.json"
                @endif
            }
        });
    </script>
    <script>
        $(document).on('click', '#viewComment', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $('#viewCommentModal').modal('show')
            var url = "{{route("brand.comments.view",':id')}}";
            url = url.replace(':id', id)

            setTimeout(function () {
                $('#viewCommentModalContent').load(url)
            }, 100)
        });
        $(document).on('click', '#replayComment', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $('#replayCommentModal').modal('show')
            var url = "{{route("brand.comments.reply",':id')}}";
            url = url.replace(':id', id)
            setTimeout(function () {
                $('#replayCommentModalContent').load(url)
            }, 100)
        });
    </script>
@endsection
