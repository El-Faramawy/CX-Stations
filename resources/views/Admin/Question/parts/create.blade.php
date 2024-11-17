<link href="{{url('Admin')}}/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="{{url('Admin')}}/assets/plugins/multipleselect/multiple-select.css">
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('questions.store')}}">
    @csrf
    <div class="row mt-0">
        <x-form.input class="col-sm-12" title="القسم " :required="true">
            <select name="category_id" class="form-control form-control-solid select2" data-placeholder="اختر القسم" >
                <option value="" selected disabled>القسم</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name_ar}}</option>
                @endforeach
            </select>
        </x-form.input>
        <x-form.input class="col-sm-12" title="السؤال ( بالعربية ) " :required="true">
            <input type="text" class="form-control form-control-solid" placeholder="السؤال ( بالعربية ) " name="question_ar"/>
        </x-form.input>

        <x-form.input class="col-sm-12" title="السؤال ( بالانجليزية ) " :required="true">
            <input type="text" class="form-control form-control-solid" placeholder="السؤال ( بالانجليزية ) " name="question_en"/>
        </x-form.input>

        <x-form.input class="col-sm-12" title="الاجابات" :required="true">
            <select class="form-control select2" name="question_answers[]" data-placeholder="اختر الاجابات" multiple>
                @foreach($answers as $answer)
                    <option value="{{$answer->id}}"> {{$answer->answer_ar}} </option>
                @endforeach
            </select>
        </x-form.input>
    </div>
</form>

<script src="{{url('Admin')}}/assets/plugins/select2/select2.full.min.js"></script>
<script src="{{url('Admin')}}/assets/js/select2.js"></script>

<script src="{{url('Admin')}}/assets/plugins/multipleselect/multiple-select.js"></script>
<script src="{{url('Admin')}}/assets/plugins/multipleselect/multi-select.js"></script>
