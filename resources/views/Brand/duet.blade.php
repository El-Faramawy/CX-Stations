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
              <div class="cardFilters">
                <div class="btn-group">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fal fa-calendar"></i>
                    {{ __('messages.select_brand') }}
                  </button>
                  <div class="dropdown-menu ">
                      @foreach($brands as $brand)
                          <a class="dropdown-item" {{$brand_id == $brand->id ? 'selected' : ''}}
                          href="{{route('brand.duet',['brand_id'=>$brand->id,'status'=>$status])}}"> {{ $brand->name }} </a>
                      @endforeach
                  </div>
                </div>
                <div class="btn-group">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <i class="fal fa-filter"></i>
                        {{ __('messages.select_status') }}
                    </button>
                    <div class="dropdown-menu ">
                        <a class="dropdown-item" href="{{route('brand.duet',['status'=>'pending','brand_id'=>$brand_id])}}"> {{ __('messages.pending') }} </a>
                        <a class="dropdown-item" href="{{route('brand.duet',['status'=>'complete','brand_id'=>$brand_id])}}"> {{ __('messages.completed') }} </a>
                        <a class="dropdown-item" href="{{route('brand.duet',['status'=>'rejected','brand_id'=>$brand_id])}}"> {{ __('messages.rejected') }} </a>
                    </div>
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
{{--                @foreach($coupons as $coupon)--}}
{{--                    <tr>--}}
{{--                        <td> {{$coupon->phone ?? ''}} </td>--}}
{{--                        <td> <span class="discount"> {{$coupon->discount ?? ''}}% </span></td>--}}
{{--                        <td> {{date('Y-m-d',strtotime($coupon->created_at))}} </td>--}}
{{--                        <td> <input {{$coupon->status !== 'pending' ? 'disabled' : ''}} type="text" class="form-control total-purchases" data-id="{{ $coupon->id }}" value="{{ $coupon->total_purchases ?? 0}}"> </td>--}}
{{--                        <td> <span class="total-after-discount" data-id="{{ $coupon->id }}">{{ $coupon->total_after_discount ?? 0}}</span> </td>--}}
{{--                        <td>--}}
{{--                            @if($coupon->status == 'pending')--}}
{{--                                <button class="badge bg-light-primary rounded-5 change-status" data-id="{{ $coupon->id }}" data-status="pending"> {{ __('messages.pending') }} </button>--}}
{{--                            @elseif($coupon->status == 'complete')--}}
{{--                                <button class="badge bg-light-success lightGreenColor rounded-5"> {{ __('messages.completed') }} </button>--}}
{{--                            @else--}}
{{--                                <button class="badge bg-light-danger rounded-5"> {{ __('messages.rejected') }} </button>--}}
{{--                            @endif--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}

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

{{--  <tr class="static-row">--}}
{{--      <td> <input type="text" class="form-control phone" value=""> </td>--}}
{{--      <td> <span class="discount"> {{setting()->duet_discount}} % </span></td>--}}
{{--      <td> {{date('Y-m-d')}} </td>--}}
{{--      <td> <input type="text" class="form-control total-purchases" value="0"> </td>--}}
{{--      <td> <span class="total-after-discount">0</span> </td>--}}
{{--      <td>--}}
{{--          <button class="badge bg-light-primary rounded-5 duet-submit" data-status="pending"> {{ __('messages.pending') }} </button>--}}
{{--      </td>--}}
{{--  </tr>--}}

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

    <!-- datatable Js -->
    <script>
        // [ Configuration Option ]
        $('.dataTableTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("duet.data") }}',
                data: function(d) {
                    d.status = '{{ $status ?? null }}';
                    d.brand_id = '{{ $brand_id ?? null }}';
                },
                dataType: 'json',
            },
            columns: [
                { data: 'phone', name: 'phone' },
                { data: 'discount', name: 'discount' },
                { data: 'date', name: 'created_at' },
                { data: 'total_purchases', name: 'total_purchases', orderable: false, searchable: false },
                { data: 'total_after_discount', name: 'total_after_discount', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: false, searchable: false }
            ],
            responsive: true,
            searching: true,
            lengthChange: true,
            language: {
                @if(app()->getLocale() == 'ar')
                "url": "{{ url('Brand') }}/assets/js/plugins/dataTable-ar.json"
                @endif
            },
            drawCallback: function() {
                // Add the static row at the top on every redraw
                let staticRow = `
                <tr>
                    <td><input type="text" class="form-control phone" value=""></td>
                    <td><span class="discount">{{ setting()->duet_discount }} %</span></td>
                    <td>{{ date('Y-m-d') }}</td>
                    <td><input type="text" class="form-control total-purchases" value="0"></td>
                    <td><span class="total-after-discount">0</span></td>
                    <td>
                        <button class="badge bg-light-primary rounded-5 duet-submit" data-status="pending">
                            {{ __('messages.pending') }}
                        </button>
                    </td>
                </tr>
        `;
                // Prepend the static row to the tbody
                $('.dataTableTable tbody').prepend(staticRow);
            }
        });
        // $('.dataTableTable tbody').prepend($('.static-row'));
    </script>
    <script>
        $(document).ready(function() {
            // Event listener for changes in total-purchases input fields
            $(document).on('input', '.total-purchases', function() {
                const row = $(this).closest('tr'); // Get the closest row
                const discount = parseFloat(row.find('.discount').text()); // Get the discount value
                const totalPurchases = parseFloat($(this).val()); // Get the current input value

                if (!isNaN(totalPurchases) && !isNaN(discount)) {
                    const discountAmount = totalPurchases * (discount / 100);
                    const totalAfterDiscount = totalPurchases - discountAmount;

                    // Update the total after discount, formatted to 2 decimal places
                    row.find('.total-after-discount').text(totalAfterDiscount.toFixed(2));
                }
            });
        });
    </script>

  <script>
      $(document).ready(function() {
          // Change Status Button Click Event
          $(document).on('click', '.change-status', function() {
              const button = $(this);
              const row = button.closest('tr');
              const totalPurchases = parseFloat(row.find('.total-purchases').val());
              const couponId = button.data('id');
              const totalAfterDiscount = parseFloat(row.find('.total-after-discount').text());

              Swal.fire({
                  title: '{{ __('messages.confirm_complete') }}',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: '{{ __('messages.complete') }}',
                  cancelButtonText: '{{ __('messages.cancel') }}',
                  reverseButtons: true
              }).then((result) => {
                  if (result.isConfirmed) {
                      fetch('{{ route("changeCouponStatus") }}', {
                          method: 'POST',
                          headers: {
                              'Content-Type': 'application/json',
                              'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                                  button.removeClass('bg-light-primary').addClass('bg-light-success lightGreenColor');
                                  button.text('{{ __('messages.complete') }}');
                                  row.find('.total-purchases').prop('disabled', true);
                                  Swal.fire('{{ __('messages.coupon_completed_success') }}', '', 'info');
                              } else {
                                  Swal.fire('{{ __('messages.failed_try_again') }}', '', 'error');
                              }
                          })
                          .catch(error => {
                              Swal.fire('{{ __('messages.failed_try_again') }}', '', 'error');
                          });
                  }
              });
          });

          // Duet Submit Button Click Event
          $(document).on('click', '.duet-submit', function() {
              const button = $(this);
              const row = button.closest('tr');
              const phone = row.find('.phone').val();
              const discount = parseFloat(row.find('.discount').text());
              const totalPurchases = parseFloat(row.find('.total-purchases').val());
              const totalAfterDiscount = parseFloat(row.find('.total-after-discount').text());

              Swal.fire({
                  title: '{{ __('messages.confirm_complete') }}',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: '{{ __('messages.complete') }}',
                  cancelButtonText: '{{ __('messages.cancel') }}',
                  reverseButtons: true
              }).then((result) => {
                  if (result.isConfirmed) {
                      fetch('{{ route("addDuetCoupon") }}', {
                          method: 'POST',
                          headers: {
                              'Content-Type': 'application/json',
                              'X-CSRF-TOKEN': '{{ csrf_token() }}'
                          },
                          body: JSON.stringify({
                              phone: phone,
                              discount: discount,
                              total_purchases: totalPurchases,
                              total_after_discount: totalAfterDiscount
                          })
                      })
                          .then(response => response.json())
                          .then(data => {
                              if (data.success) {
                                  button.removeClass('bg-light-primary').addClass('bg-light-success lightGreenColor');
                                  button.text('{{ __('messages.complete') }}');
                                  Swal.fire('{{ __('validation.coupon_sent_successfully') }}', '', 'info');
                                  setTimeout(() => location.reload(), 2000);
                              } else {
                                  Swal.fire("{{__('validation.coupon_sent_successfully')}}", '', 'error');
                              }
                          })
                          .catch(error => {
                              Swal.fire('{{ __('messages.failed_try_again') }}', '', 'error');
                          });
                  }
              });
          });

          // Phone Input Keyup Event to Remove Leading Zero
          $(document).on('keyup', '.phone', function() {
              let value = $(this).val();
              if (value.startsWith('0') && value.length > 1) {
                  $(this).val(value.substring(1));
              }
          });
      });

  </script>
@endsection
