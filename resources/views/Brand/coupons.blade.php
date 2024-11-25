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
            @include('layouts.brand.phone_header',['currentPage'=> __('messages.duet_mode') ])
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row m-0">
                <div class="col-12 p-2">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between flex-wrap align-items-center">
                            <h4> {{ __('messages.coupons') }} </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($coupons)
                            <table class="dataTableTable display table table-striped table-hover dt-responsive nowrap"
                                   style="width: 100%">
                                <thead>
                                <tr>
                                    <th>{{ __('messages.id') }}</th>
                                    <th>{{ __('messages.code') }}</th>
                                    <th>{{ __('messages.type') }}</th>
                                    <th>{{ __('messages.status') }}</th>
                                    <th>{{ __('messages.amount') }}</th>
                                    <th>{{ __('messages.minimum_amount') }}</th>
                                    <th>{{ __('messages.maximum_amount') }}</th>
                                    <th>{{ __('messages.expiry_date') }}</th>
                                    <th>{{ __('messages.start_date') }}</th>
                                    <th>{{ __('messages.free_shipping') }}</th>
                                    <th>{{ __('messages.usage_limit') }}</th>
                                    <th>{{ __('messages.usage_limit_per_user') }}</th>

                                    <th>{{ __('messages.co_created_at') }}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupons->data as $coupon)
                                    <tr>
                                        <td> {{$coupon->id ?? ''}} </td>
                                        <td> {{$coupon->code ?? ''}}</td>
                                        <td> {{$coupon->type == 'percentage' ? 'نسبة' : 'قيمة' }}</td>
                                        <td> {{$coupon->status == 'active' ? 'نشط' : 'غير نشط' }}</td>
                                        <td> {{$coupon->amount->amount ?? '' }}</td>
                                        <td> {{$coupon->minimum_amount->amount ?? '' }}</td>
                                        <td> {{$coupon->maximum_amount->amount ?? '' }}</td>
                                        <td> {{$coupon->expiry_date ?? '' }}</td>
                                        <td> {{$coupon->start_date ?? '' }}</td>
                                        <td> {{$coupon->free_shipping ? 'نعم' : 'لا' }}</td>
                                        <td> {{$coupon->usage_limit }}</td>
                                        <td> {{$coupon->usage_limit_per_user }}</td>

                                        <td> {{ \Carbon\Carbon::parse($coupon->created_at->date)->format('Y-m-d') }} </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @else
                            <p> {{__('messages.unable_to_read')}} </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- [ Main Content ] end -->

@endsection

@section('brand_js')
    @include('layouts.admin.inc.my-form')
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/dataTables.responsive.min.js"></script>
    <script src="{{url('Brand')}}/assets/js/plugins/responsive.bootstrap5.min.js"></script>
    <!-- Include SweetAlert2 CSS and JS -->
    <script src="https://cdn.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
