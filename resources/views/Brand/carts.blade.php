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
                            <h4> {{ __('messages.salla_carts') }} </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($carts && isset($carts->data) && count($carts->data) > 0)
                            <table class="dataTableTable display table table-striped table-hover dt-responsive nowrap" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>{{ __('messages.id') }}</th>
                                    <th>{{ __('messages.customer_name') }}</th>
                                    <th>{{ __('messages.total') }}</th>
                                    <th>{{ __('messages.subtotal') }}</th>
                                    <th>{{ __('messages.total_discount') }}</th>
                                    <th>{{ __('messages.currency') }}</th>
                                    <th>{{ __('messages.items') }}</th>
                                    <th>{{ __('messages.created_at') }}</th>
                                    <th>{{ __('messages.updated_at') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carts->data as $cart)
                                    <tr>
                                        <td>{{ $cart->id ?? '' }}</td>
                                        <td>{{ $cart->customer->name ?? __('messages.unknown_customer') }}</td>
                                        <td>{{ $cart->total->amount ?? 0 }}</td>
                                        <td>{{ $cart->subtotal->amount ?? 0 }}</td>
                                        <td>{{ $cart->total_discount->amount ?? 0 }}</td>
                                        <td>{{ $cart->total->currency ?? __('messages.unknown_currency') }}</td>
                                        <td>
                                            @if(isset($cart->items) && count($cart->items) > 0)
                                                <ul>
                                                    @foreach($cart->items as $item)
                                                        <li>{{ $item->notes ?? __('messages.unknown_item') }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                {{ __('messages.no_items') }}
                                            @endif
                                        </td>
                                        <td>{{ isset($cart->created_at->date) ? \Carbon\Carbon::parse($cart->created_at->date)->format('Y-m-d H:i:s') : '' }}</td>
                                        <td>{{ isset($cart->updated_at->date) ? \Carbon\Carbon::parse($cart->updated_at->date)->format('Y-m-d H:i:s') : '' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>{{ __('messages.unable_to_read') }}</p>
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
