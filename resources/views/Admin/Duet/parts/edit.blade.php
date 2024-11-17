<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('duets.update',$duet->id)}}">
    @csrf
    @method('PUT')
    <div class="row mt-0">
        <x-form.input class="col-sm-6" title="براند 1 " :required="true">
            <select name="brand1_id" class="form-control form-control-solid select2" data-placeholder="اختر براند 1" >
                <option value="" selected disabled>براند 1</option>
                @foreach($brands as $brand)
                    <option value="{{$brand->id}}" {{$duet->brand1_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                @endforeach
            </select>
        </x-form.input>
        <x-form.input class="col-sm-6" title="براند 2 " :required="true">
            <select name="brand2_id" class="form-control form-control-solid select2" data-placeholder="اختر براند 2" >
                <option value="" selected disabled>براند 2</option>
                @foreach($brands as $brand)
                    <option value="{{$brand->id}}" {{$duet->brand2_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                @endforeach
            </select>
        </x-form.input>

        <x-form.input class="col-sm-6" title="تاريخ البداية " :required="true">
            <input type="date" class="form-control form-control-solid" placeholder="تاريخ البداية " name="start_date" value="{{$duet->start_date}}"/>
        </x-form.input>
        <x-form.input class="col-sm-6" title="تاريخ النهاية " :required="true">
            <input type="date" class="form-control form-control-solid" placeholder="تاريخ النهاية " name="end_date" value="{{$duet->end_date}}"/>
        </x-form.input>

        <x-form.input class="col-sm-6" title="خصم براند 1" :required="true">
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="خصم براند 1" name="brand1_discount" value="{{$duet->brand1_discount}}"/>
        </x-form.input>
        <x-form.input class="col-sm-6" title="خصم براند 2" :required="true">
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="خصم براند 2" name="brand2_discount" value="{{$duet->brand2_discount}}"/>
        </x-form.input>

    </div>

</form>

<script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>
<script src="{{url('Admin')}}/assets/js/select2.js"></script>
