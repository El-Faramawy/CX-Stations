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
                                            <span class="btn btn-success detailsBtn" data-id="{{$cart->id}}">
                                                {{__('messages.show_details') }}
                                            </span>
{{--                                            @if(isset($cart->items) && count($cart->items) > 0)--}}
{{--                                                <ul>--}}
{{--                                                    @foreach($cart->items as $item)--}}
{{--                                                        <li>{{ $item->product_id }} | x{{$item->quantity}}</li>--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
{{--                                            @else--}}
{{--                                                {{ __('messages.no_items') }}--}}
{{--                                            @endif--}}
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

    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg mw-650px">
            <div class="modal-content" id="modalContent">
                <div class="modal-header">
                    <h2>

                    </h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" style="cursor: pointer" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                  fill="black"/>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"/>
                        </svg>
                    </span>
                    </div>
                </div>
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-3" id="form-load">

                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <div class=" ">
                        <input type="button" class="btn btn-light me-3 " data-bs-modal="modal" id="close_model" style="width: 100px" value="غلق">
                    </div>
                </div>
            </div>

        </div>
    </div>

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
    <script>
        $(document).on('click', '.detailsBtn', function (event) {
            event.preventDefault(); // Prevent default action (e.g., form submit or link click)

            // Get the data-id or any attribute you need from the clicked button
            let itemId = $(this).data('id');

            // Show a loading spinner or clear previous content
            $('#form-load').html('<p>Loading...</p>');

            // Open the modal
            $('#Modal').modal('show');

            // Construct the URL dynamically
            let url = '{{ route("brand.productDetails", ":id") }}'.replace(':id', itemId);

            // Make AJAX call to fetch data
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    $('#form-load').html(response);
                },
                error: function (xhr, status, error) {
                    $('#form-load').html('<p>Error loading details. Please try again.</p>');
                    console.error(xhr.responseText);
                }
            });
        });
        $('#close_model').on('click', function () {
            $('#Modal').modal('hide');
        });
    </script>
@endsection
