@extends('layouts.brand.app')
@section('site_content')
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.brand.phone_header',['currentPage'=>'Dashboard'])

            <div class="row m-0">
                <div class="col-12 p-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="cardFilters">
{{--                                <div class="btn-group">--}}
{{--                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"--}}
{{--                                            aria-haspopup="true"--}}
{{--                                            aria-expanded="false">--}}
{{--                                        <i class="fal fa-filter"></i>--}}
{{--                                        Filter--}}
{{--                                    </button>--}}
{{--                                    <div class="dropdown-menu ">--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fal fa-calendar"></i>{{ __('messages.select_time') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('brand.dashboard', ['questionPeriod' => 'monthly']) }}">
                                            {{ __('messages.monthly') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('brand.dashboard', ['questionPeriod' => 'quarter']) }}">
                                            {{ __('messages.quarter') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('brand.dashboard', ['questionPeriod' => 'yearly']) }}">
                                            {{ __('messages.yearly') }}
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div id="customer-rate-graph"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-2">
                    <div class="card">
                        <div class="card-header d-flex justify-content-end flex-wrap align-items-center">
                            <div class="cardFilters">
{{--                                <div class="btn-group">--}}
{{--                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"--}}
{{--                                            aria-haspopup="true"--}}
{{--                                            aria-expanded="false">--}}
{{--                                        <i class="fal fa-filter"></i>--}}
{{--                                        Filter--}}
{{--                                    </button>--}}
{{--                                    <div class="dropdown-menu ">--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fal fa-calendar"></i>
                                        {{ __('messages.select_time') }}
                                    </button>
                                    <div class="dropdown-menu ">
                                        <a class="dropdown-item" href="{{route('brand.dashboard',['surveyPeriod'=>'monthly'])}}"> {{ __('messages.monthly') }} </a>
                                        <a class="dropdown-item" href="{{route('brand.dashboard',['surveyPeriod'=>'quarter'])}}"> {{ __('messages.quarter') }} </a>
                                        <a class="dropdown-item" href="{{route('brand.dashboard',['surveyPeriod'=>'yearly'])}}"> {{ __('messages.yearly') }} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="dataTableTable display table table-striped table-hover dt-responsive nowrap"
                                   style="width: 100%">
                                <thead>
                                <tr>
                                    <th>{{ __('messages.the_question') }}</th>
                                    <th>{{ __('messages.users') }}</th>
                                    <th>{{ __('messages.now_percentage') }}</th>
                                    <th>{{ __('messages.previous_percentage') }}</th>
                                    <th>{{ __('messages.compare') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($questionsChange as $question)
                                    <tr>
                                        <td> {{$question['question']}}</td>
                                        <td> {{$question['users']}}</td>
                                        <td> {{$question['now']}}%</td>
                                        <td> {{$question['previous']}}%</td>
                                        <td class="text-{{$question['compare'] > 0 ? 'success' : 'danger'}}">
                                            <i class="fal fa-arrow-{{$question['compare'] > 0 ? 'up' : 'down'}}"></i> {{$question['compare']}}%</td>
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
@endsection

@section('brand_js')
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.responsive.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/responsive.bootstrap5.min.js"></script>
    <!-- apexcharts -->
    <script src="{{url('Brand')}}/assets/js/plugins/apexcharts.min.js"></script>
    <!-- charts -->
    <script>
        var options = {
            chart: {
                type: 'area',
                height: 300,
                toolbar: {
                    show: false
                }
            },
            colors: ['#0085FF'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    type: 'vertical',
                    inverseColors: false,
                    opacityFrom: 0.5,
                    opacityTo: 0
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 1
            },
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    borderRadius: 4
                }
            },
            grid: {
                strokeDashArray: 4
            },
            series: [
                {
                    data: [
                        @foreach($questions as $question)
                            {{$question->avg_percentage}},
                        @endforeach
                    ]
                }
            ],
            xaxis: {
                categories:
                    [
                        @foreach($questions as $key=>$question)
                            '{{app()->getLocale() == 'en' ? $question['question_en'] :'Q'.$key+1 }}',
                        @endforeach
                    ],
                labels: {
                    hideOverlappingLabels: true,
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                min: 0,
                max: 100
            }
        };
        var chart = new ApexCharts(document.querySelector('#customer-rate-graph'), options);
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
@endsection
