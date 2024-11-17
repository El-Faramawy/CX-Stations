@extends('layouts.admin.app')
@section('page_title') البراند @endsection
@section('content')
<x-list.card>
    <x-list.card-header name="البراند" :add_button="false" :delete_button="true"></x-list.card-header>
    <x-list.card-body :responsive="true">
        <th class="text-white"><input type="checkbox" id="master"></th>
        <th class="text-white">#</th>
        <th class="text-white">الصورة</th>
        <th class="text-white">صورة الخلفية</th>
        <th class="text-white">الاسم</th>
        <th class="text-white">البريد الالكترونى</th>
        <th class="text-white">رقم الهاتف</th>
        <th class="text-white">السجل التجارى</th>
        <th class="text-white">القسم</th>
        <th class="text-white">المدينة</th>
        <th class="text-white">التقييم</th>
        <th class="text-white">الحالة</th>
        <th class="text-white">الاعلانات</th>
        <th class="text-white">تحكم</th>
    </x-list.card-body>
</x-list.card>

<x-list.modal name="البراند" :save_button="false" ></x-list.modal>

@endsection
@push('admin_js')

    <script>
        var  columns =[
            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image'},
            {data: 'panner', name: 'panner'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'commercial_number', name: 'commercial_number'},
            {data: 'category', name: 'category'},
            {data: 'city', name: 'city'},
            {data: 'rate', name: 'rate'},
            {data: 'status', name: 'status'},
            {data: 'ads', name: 'ads'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('layouts.admin.inc.ajax',['url'=>'brands'])
    @include('Admin.Brand.parts.status',['url'=>'brands'])

    <script>
        $(document).on('click', '.view', function () {
            var  id = $(this).data('id');
            $('#form-load').html(loader)
            $('#Modal').modal('show')

            var url = "{{route("brands.show",':id')}}";
            url = url.replace(':id',id)

            setTimeout(function (){
                $('#form-load').load(url)
            },100)


        });
    </script>

@endpush
