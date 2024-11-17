@extends('layouts.brand.app')
<style>
    button.swal2-confirm.btn.btn-success {
        padding: 10px 20px;
    }
</style>
@section('site_content')
  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
        @include('layouts.brand.phone_header',['currentPage'=> __('messages.home') ])
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row m-0">
        <!-- CONTENT HERE -->
        <div class="col-md-6 col-xl-3 p-2">
          <div class="card statistics-card-1">
            <div class="card-body">
              <img src="{{url('Brand')}}/assets/images/widget/img-status-1.svg" alt="img" class="img-fluid img-bg">
              <div class="d-flex align-items-center">
                <div class="avtar rounded-circle bgColor1 text-white me-3">
                  <img src="{{url('Brand')}}/assets/images/comments.svg" alt="">
                </div>
                <div>
                    <p class="opacity-90 mb-0">{{ __('messages.total_comments') }}</p>
                  <div class="d-flex align-items-end">
                      @if($commentsChange > 0)
                          <h2 class="mb-0 f-w-500">{{$currentMonthComments}}</h2>
                          <button class="badge bg-light-success  lightGreenColor rounded-5 ms-2"><i class="fa-regular fa-arrow-up-right"></i>{{$commentsChange}}%</button>
                      @elseif($commentsChange < 0)
                          <h2 class="mb-0 f-w-500">{{$currentMonthComments}}</h2>
                          <button class="badge bg-light-danger rounded-5 ms-2"><i class="fa-regular fa-arrow-down-right"></i> {{$commentsChange}}%</button>
                      @else
                          <h2 class="mb-0 f-w-500">{{$currentMonthComments}}</h2>
                      @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3 p-2">
          <div class="card statistics-card-1">
            <div class="card-body">
              <img src="{{url('Brand')}}/assets/images/widget/img-status-2.svg" alt="img" class="img-fluid img-bg">
              <div class="d-flex align-items-center">
                <div class="avtar rounded-circle bgColor2 text-white me-3">
                  <img src="{{url('Brand')}}/assets/images/like.svg" alt="">
                </div>
                <div>
                    <p class="opacity-90 mb-0">{{ __('messages.total_likes') }}</p>
                  <div class="d-flex align-items-end">
                      @if($likesChange > 0)
                          <h2 class="mb-0 f-w-500">{{$currentMonthLikes}}</h2>
                          <button class="badge bg-light-success  lightGreenColor rounded-5 ms-2"><i class="fa-regular fa-arrow-up-right"></i>{{$likesChange}}%</button>
                      @elseif($likesChange < 0)
                          <h2 class="mb-0 f-w-500">{{$currentMonthLikes}}</h2>
                          <button class="badge bg-light-danger rounded-5 ms-2"><i class="fa-regular fa-arrow-down-right"></i> {{$likesChange}}%</button>
                      @else
                          <h2 class="mb-0 f-w-500">{{$currentMonthLikes}}</h2>
                      @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3 p-2">
          <div class="card statistics-card-1">
            <div class="card-body">
              <img src="{{url('Brand')}}/assets/images/widget/img-status-7.svg" alt="img" class="img-fluid img-bg">
              <div class="d-flex align-items-center">
                <div class="avtar rounded-circle bgColor3 text-white me-3">
                  <img src="{{url('Brand')}}/assets/images/share.svg" alt="">
                </div>
                <div>
                  <p class="opacity-90 mb-0">{{ __('messages.total_share') }}</p>
                  <div class="d-flex align-items-end">
                      @if($sharesChange > 0)
                          <h2 class="mb-0 f-w-500">{{$currentMonthShares}}</h2>
                          <button class="badge bg-light-success  lightGreenColor rounded-5 ms-2"><i class="fa-regular fa-arrow-up-right"></i>{{$sharesChange}}%</button>
                      @elseif($sharesChange < 0)
                          <h2 class="mb-0 f-w-500">{{$currentMonthShares}}</h2>
                          <button class="badge bg-light-danger rounded-5 ms-2"><i class="fa-regular fa-arrow-down-right"></i> {{$sharesChange}}%</button>
                      @else
                          <h2 class="mb-0 f-w-500">{{$currentMonthShares}}</h2>
                      @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-3 p-2">
          <div class="card statistics-card-1">
            <div class="card-body">
              <img src="{{url('Brand')}}/assets/images/widget/img-status-4.svg" alt="img" class="img-fluid img-bg">
              <div class="d-flex align-items-center">
                <div class="avtar rounded-circle bgColor4 text-white me-3">
                  <img src="{{url('Brand')}}/assets/images/survey.svg" alt="">
                </div>
                <div>
                    <p class="opacity-90 mb-0">{{ __('messages.survies') }}</p>
                  <div class="d-flex align-items-end">
                      @if($surveyLikesChange > 0)
                          <h2 class="mb-0 f-w-500">{{$currentMonthSurveyLikes}}</h2>
                          <button class="badge bg-light-success  lightGreenColor rounded-5 ms-2"><i class="fa-regular fa-arrow-up-right"></i>{{$surveyLikesChange}}%</button>
                      @elseif($surveyLikesChange < 0)
                          <h2 class="mb-0 f-w-500">{{$currentMonthSurveyLikes}}</h2>
                          <button class="badge bg-light-danger rounded-5 ms-2"><i class="fa-regular fa-arrow-down-right"></i> {{$surveyLikesChange}}%</button>
                      @else
                          <h2 class="mb-0 f-w-500">{{$currentMonthSurveyLikes}}</h2>
                      @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 p-2">
          <div class="card">
            <div class="card-header">
              <div class="cardFilters">
{{--                <div class="btn-group">--}}
{{--                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true"--}}
{{--                    aria-expanded="false">--}}
{{--                    <i class="fal fa-filter"></i>--}}
{{--                    Filter--}}
{{--                  </button>--}}
{{--                  <div class="dropdown-menu ">--}}
{{--                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                  </div>--}}
{{--                </div>--}}
                <div class="btn-group">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fal fa-filter"></i>
                    {{ __('messages.select_time') }}
                  </button>
                  <div class="dropdown-menu ">
                    <a class="dropdown-item" href="{{route('brand.home',['questionPeriod'=>'monthly'])}}"> {{ __('messages.monthly') }} </a>
                    <a class="dropdown-item" href="{{route('brand.home',['questionPeriod'=>'quarter'])}}"> {{ __('messages.quarter') }} </a>
                    <a class="dropdown-item" href="{{route('brand.home',['questionPeriod'=>'yearly'])}}"> {{ __('messages.yearly') }} </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="customer-rate-graph"></div>
            </div>
          </div>
        </div>
        <div class="col-12 p-2 mb-4">
          <form class="sendSurvey" action="{{route('brand.send-survey')}}" id="my_form" method="post" >
              @csrf
            <div class="phone"> {{--+996--}} <input type="text" class="form-control" name="phone" placeholder="{{__('messages.phone_number')}}"> </div>
            <button type="submit" class="btn btnMain"> <i class="ph-duotone ph-navigation-arrow"></i> <p class="opacity-90 mb-0">{{ __('messages.send_survey') }}</p>
            </button>
          </form>
        </div>
        <div class="col-12 p-2">
          <div class="card">
            <div class="card-header d-flex justify-content-between flex-wrap align-items-center">
              <h4> {{ __('messages.coupons') }} </h4>
              <div class="cardFilters">
{{--                <div class="btn-group">--}}
{{--                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true"--}}
{{--                    aria-expanded="false">--}}
{{--                    <i class="fal fa-filter"></i>--}}
{{--                    Filter--}}
{{--                  </button>--}}
{{--                  <div class="dropdown-menu ">--}}
{{--                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                    <a class="dropdown-item" href="#">Action</a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="btn-group">--}}
{{--                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true"--}}
{{--                    aria-expanded="false">--}}
{{--                    <i class="fal fa-calendar"></i>--}}
{{--                    {{ __('messages.select_time') }}--}}
{{--                  </button>--}}
{{--                  <div class="dropdown-menu ">--}}
{{--                      <a class="dropdown-item" href="{{route('brand.home',['couponPeriod'=>'monthly'])}}"> {{ __('messages.monthly') }} </a>--}}
{{--                      <a class="dropdown-item" href="{{route('brand.home',['couponPeriod'=>'quarter'])}}"> {{ __('messages.quarter') }} </a>--}}
{{--                      <a class="dropdown-item" href="{{route('brand.home',['couponPeriod'=>'yearly'])}}"> {{ __('messages.yearly') }} </a>--}}
{{--                  </div>--}}
                </div>
                <div class="btn-group">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fal fa-calendar"></i>
                    {{ __('messages.select_status') }}
                  </button>
                  <div class="dropdown-menu ">
                      <a class="dropdown-item" href="{{route('brand.home',['status'=>'pending'])}}"> {{ __('messages.pending') }} </a>
                      <a class="dropdown-item" href="{{route('brand.home',['status'=>'complete'])}}"> {{ __('messages.completed') }} </a>
                      <a class="dropdown-item" href="{{route('brand.home',['status'=>'rejected'])}}"> {{ __('messages.rejected') }} </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table class="dataTableTable display table table-striped table-hover dt-responsive nowrap"
                style="width: 100%">
                <thead>
                  <tr>
                      <th>{{ __('messages.phone_number') }}</th>
                      <th>{{ __('messages.discount') }}</th>
                      <th>{{ __('messages.coupon_time') }}</th>
                      <th>{{ __('messages.total_purchases') }}</th>
                      <th>{{ __('messages.total_amount_after_discount') }}</th>
                      <th>{{ __('messages.status') }}</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($coupons as $coupon)
                    <tr>
                        <td> {{$coupon->user->phone_code ?? ''}} {{$coupon->user->phone ?? ''}} </td>
                        <td> <span class="discount"> {{$coupon->discount ?? ''}}% </span></td>
                        <td> {{date('Y-m-d',strtotime($coupon->created_at))}} </td>
                        <td> <input {{$coupon->status !== 'pending' ? 'disabled' : ''}} type="text" class="form-control total-purchases" data-id="{{ $coupon->id }}" value="{{ $coupon->total_purchases ?? 0}}"> </td>
                        <td> <span class="total-after-discount" data-id="{{ $coupon->id }}">{{ $coupon->total_after_discount ?? 0}}</span> </td>
                        <td>
                            @if($coupon->status == 'pending')
                                <button class="badge bg-light-primary rounded-5 change-status" data-id="{{ $coupon->id }}" data-status="pending"> {{ __('messages.pending') }} </button>
                            @elseif($coupon->status == 'complete')
                                <button class="badge bg-light-success lightGreenColor rounded-5"> {{ __('messages.completed') }} </button>
                            @else
                                <button class="badge bg-light-danger rounded-5"> {{ __('messages.rejected') }} </button>
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

@endsection

@section('brand_js')
    @include('layouts.admin.inc.my-form')
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.responsive.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/responsive.bootstrap5.min.js"></script>
    <!-- apexcharts -->
    <script src="{{url('Brand')}}/assets/js/plugins/apexcharts.min.js"></script>
    <!-- charts -->
    <!-- Include SweetAlert2 CSS and JS -->
    <script src="https://cdn.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    data:[
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
                max: 100,
                labels: {
                    formatter: function (value) {
                        return Math.round(value);
                    }
                }
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all total purchases input fields
            const purchaseInputs = document.querySelectorAll('.total-purchases');

            purchaseInputs.forEach(input => {
                // Add event listener for each input
                input.addEventListener('input', function() {
                    const row = this.closest('tr'); // Get the closest row
                    const discount = parseFloat(row.querySelector('.discount').textContent); // Get the discount
                    const totalPurchases = parseFloat(this.value); // Get the input value

                    if (!isNaN(totalPurchases) && !isNaN(discount)) {
                        const discountAmount = totalPurchases * (discount / 100);
                        const totalAfterDiscount = totalPurchases - discountAmount;

                        // Update the total after discount
                        row.querySelector('.total-after-discount').textContent = totalAfterDiscount.toFixed(2);
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all status buttons
            const statusButtons = document.querySelectorAll('.change-status');

            statusButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const row = this.closest('tr'); // Get the closest row
                    const totalPurchases = parseFloat(row.querySelector('.total-purchases').value); // Get the input value
                    const couponId = this.getAttribute('data-id');  // Get the coupon ID
                    const totalAfterDiscount = parseFloat(row.querySelector('.total-after-discount').textContent); // Get the input value
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                        title: '{{ __('messages.confirm_complete') }}',
{{--                        text: "{{ __('messages.confirm_complete') }}",--}}
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '{{ __('messages.complete') }}',
                        cancelButtonText: '{{ __('messages.cancel') }}',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send AJAX request to update the status
                            fetch('{{ route("changeCouponStatus") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Laravel CSRF token for security
                                },
                                body: JSON.stringify({
                                    id: couponId,
                                    total_purchase: totalPurchases,
                                    total_after_discount: totalAfterDiscount
                                })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Update the button on success
                                        this.classList.remove('bg-light-primary');
                                        this.classList.add('bg-light-success', 'lightGreenColor');
                                        this.textContent = '{{ __('messages.complete') }}';
                                        row.querySelector('.total-purchases').setAttribute('disabled', 'disabled');
                                        {{--my_toaster('{{ __('messages.coupon_completed_success') }}');--}}
                                        swalWithBootstrapButtons.fire(
                                            '{{ __('messages.coupon_completed_success') }}',
                                            '',
                                            'info'
                                        )
                                    }
                                    {{--else {--}}
                                    {{--    my_toaster('{{ __('messages.failed_try_again') }}', 'error');--}}
                                    {{--}--}}
                                })
                                .catch(error => {
                                    my_toaster('{{ __('messages.failed_try_again') }}', 'error');
                                });
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                '{{ __('messages.failed_try_again') }} ',
                                '',
                                'error'
                            )
                        }
                    });
                });
            });
        });
    </script>
@endsection
