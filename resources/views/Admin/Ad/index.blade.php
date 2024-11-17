@extends('layouts.admin.app')
@section('page_title') الاعلانات @endsection
@section('content')
<x-list.card>
    <x-list.card-header name="الاعلانات" :add_button="false" :delete_button="true"></x-list.card-header>
    <x-list.card-body :responsive="true">
        <th class="text-white"><input type="checkbox" id="master"></th>
        <th class="text-white">#</th>
        <th class="text-white">الصورة</th>
        <th class="text-white">الفيديو</th>
        <th class="text-white">البراند</th>
        <th class="text-white">العنوان</th>
        <th class="text-white">عدد اللايكات</th>
        <th class="text-white">عدد الكومنتات</th>
        <th class="text-white">عدد الشير</th>
        <th class="text-white">عدد المشاهدات</th>
        <th class="text-white">تحكم</th>
    </x-list.card-body>
</x-list.card>

<x-list.modal name="الاعلانات" :save_button="false" ></x-list.modal>

@endsection
@push('admin_js')

    <script>
        var  columns =[
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'video', name: 'video'},
            {data: 'brand', name: 'brand'},
            {data: 'title', name: 'title'},
            {data: 'like_count', name: 'like_count'},
            {data: 'comment_count', name: 'comment_count'},
            {data: 'share_number', name: 'share_number'},
            {data: 'view_number', name: 'view_number'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('layouts.admin.inc.ajax',['url'=>'ads'])

@endpush
