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
                            <h4> {{ __('messages.clients') }} </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($clients)
                            <table class="dataTableTable display table table-striped table-hover dt-responsive nowrap"
                                   style="width: 100%">
                                <thead>
                                <tr>
                                    <th>{{ __('messages.id') }}</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.mobile') }}</th>
                                    <th>{{ __('messages.email') }}</th>
                                    <th>{{ __('messages.gender') }}</th>
                                    <th>{{ __('messages.country') }}</th>
                                    <th>{{ __('messages.currency') }}</th>
                                    <th>{{ __('messages.lang') }}</th>
                                    <th>{{ __('messages.created_at') }}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clients->data as $client)
                                    <tr>
                                        <td> {{$client->id ?? ''}} </td>
                                        <td> {{$client->first_name." ".$client->last_name ?? ''}}</td>
                                        <td> {{$client->mobile_code.$client->mobile ?? ''}}</td>
                                        <td> {{$client->email ?? 'غير مدخل' }}</td>
                                        <td> {{$client->gender == 'male' ? 'ذكر' : 'أنثي' }}</td>
                                        <td> {{$client->country ?? '' }}</td>
                                        <td> {{$client->currency ?? '' }}</td>
                                        <td> {{$client->lang == 'ar' ? 'العربية' : $client->lang }}</td>
                                        <td> {{ \Carbon\Carbon::parse($client->created_at->date)->format('Y-m-d') }} </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @else
                            <p></p>
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
