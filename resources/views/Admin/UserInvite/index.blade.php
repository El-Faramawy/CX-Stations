@extends('layouts.admin.app')
@section('page_title') دعوة المستخدمين @endsection
@section('content')
<x-list.card>
    <x-list.card-header name="دعوة المستخدمين" :add_button="false" :delete_button="false"></x-list.card-header>
    <x-list.card-body :responsive="true">
        <th class="text-white">كود الهاتف</th>
        <th class="text-white">رقم الهاتف</th>
        <th class="text-white">واتساب</th>
    </x-list.card-body>
</x-list.card>

@endsection
@push('admin_js')

    <script>
        var  columns =[
            {data: 'phone_code', name: 'phone_code'},
            {data: 'phone', name: 'phone'},
            {data: 'whatsapp', name: 'whatsapp'},
        ];
    </script>
    @include('layouts.admin.inc.ajax',['url'=>'user_invite'])

@endpush
