@extends('layouts.admin.app')
@section('page_title')
     الأسئلة
@endsection
@section('content')
    <x-list.card>
    <x-list.card-header name="الأسئلة" :add_button="true" :delete_button="true"></x-list.card-header>
    <x-list.card-body :responsive="true">
        <th class="text-white"><input type="checkbox" id="master"></th>
        <th class="text-white">#</th>
        <th class="text-white">القسم</th>
        <th class="text-white">السؤال</th>
        <th class="text-white">تحكم</th>
    </x-list.card-body>
</x-list.card>

<x-list.modal name="الأسئلة" :save_button="true" ></x-list.modal>

@endsection
@push('admin_js')

    <script>
        var  columns =[
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'category', name: 'category'},
            {data: 'question_ar', name: 'question_ar'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('layouts.admin.inc.ajax',['url'=>'questions'])

@endpush
