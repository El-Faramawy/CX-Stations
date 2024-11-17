@extends('layouts.admin.app')
@section('page_title')
     الثنائيات
@endsection
@section('content')
    <x-list.card>
    <x-list.card-header name="الثنائيات" :add_button="true" :delete_button="true"></x-list.card-header>
    <x-list.card-body :responsive="true">
        <th class="text-white"><input type="checkbox" id="master"></th>
        <th class="text-white">#</th>
        <th class="text-white">براند 1</th>
        <th class="text-white">براند 2</th>
        <th class="text-white">تاريخ البداية</th>
        <th class="text-white">تاريخ النهاية</th>
        <th class="text-white">خصم براند 1</th>
        <th class="text-white">خصم براند 2</th>
        <th class="text-white">تحكم</th>
    </x-list.card-body>
</x-list.card>

<x-list.modal name="الثنائيات" :save_button="true" ></x-list.modal>

@endsection
@push('admin_js')

    <script>
        var  columns =[
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'brand1', name: 'brand1'},
            {data: 'brand2', name: 'brand2'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'brand1_discount', name: 'brand1_discount'},
            {data: 'brand2_discount', name: 'brand2_discount'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('layouts.admin.inc.ajax',['url'=>'duets'])

@endpush
