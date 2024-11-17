@extends('layouts.admin.app')
@section('page_title')
     الاجابات
@endsection
@section('content')
    <x-list.card>
    <x-list.card-header name="الاجابات" :add_button="true" :delete_button="true"></x-list.card-header>
    <x-list.card-body :responsive="true">
        <th class="text-white"><input type="checkbox" id="master"></th>
        <th class="text-white">#</th>
        <th class="text-white">الاجابة</th>
        <th class="text-white">النسبة</th>
        <th class="text-white">تحكم</th>
    </x-list.card-body>
</x-list.card>

<x-list.modal name="الاجابات" :save_button="true" ></x-list.modal>

@endsection
@push('admin_js')

    <script>
        var  columns =[
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'answer_ar', name: 'answer_ar'},
            {data: 'percentage', name: 'percentage'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('layouts.admin.inc.ajax',['url'=>'answers'])

@endpush
