<form id="form" enctype="multipart/form-data" method="POST" action="{{route('answers.store')}}">
    @csrf
    <div class="row mt-0">

        <x-form.input class="col-sm-12" title="الاجابة ( بالعربية ) " :required="true">
            <input type="text" class="form-control form-control-solid" placeholder="الاجابة ( بالعربية ) " name="answer_ar"/>
        </x-form.input>

        <x-form.input class="col-sm-12" title="الاجابة ( بالانجليزية ) " :required="true">
            <input type="text" class="form-control form-control-solid" placeholder="الاجابة ( بالانجليزية ) " name="answer_en"/>
        </x-form.input>

        <x-form.input class="col-sm-12" title="النسبة" :required="true">
            <input type="text" class="form-control form-control-solid numbersOnly" placeholder="النسبة " name="percentage"/>
        </x-form.input>
    </div>
</form>

