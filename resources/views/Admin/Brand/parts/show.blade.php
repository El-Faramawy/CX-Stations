 <div class="row mt-0">
    <table class="table table-hover table-striped table-bordered">
{{--        <thead class="thead-dark">--}}
{{--        <tr>--}}
{{--            <th scope="col">Field</th>--}}
{{--            <th scope="col">Value</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
        <tbody>
        <tr>
            <td>الصورة</td>
            <td>
                <div class="col-6 col-lg-4">
                    <a href="{{get_file($brand->image)}}" target="_blank" class="d-block link-overlay">
                        <img class="d-block img-fluid rounded" src="{{get_file($brand->image)}}" onclick="window.open(this.src)" alt="">
                        <span class="link-overlay-bg rounded">
                                                    <i class="fa fa-search"></i>
                                                </span>
                    </a>
                </div>
            </td>
        </tr>
        <tr>
            <td>البانر</td>
            <td>
                <div class="col-6 col-lg-4">
                    <a href="{{get_file($brand->panner)}}" target="_blank" class="d-block link-overlay">
                        <img class="d-block img-fluid rounded" src="{{get_file($brand->panner)}}" onclick="window.open(this.src)" alt="">
                        <span class="link-overlay-bg rounded">
                            <i class="fa fa-search"></i>
                        </span>
                    </a>
                </div>
            </td>
        </tr>
        <tr>
            <td>الاسم</td>
            <td>{{ $brand->name }}</td>
        </tr>
        <tr>
            <td>البريد الالكترونى</td>
            <td>{{ $brand->email }}</td>
        </tr>
        <tr>
            <td>رقم الهاتف</td>
            <td>{{ $brand->phone }}</td>
        </tr>
        <tr>
            <td>السجل التجارى</td>
            <td>{{ $brand->commercial_number }}</td>
        </tr>
        <tr>
            <td>القسم</td>
            <td>{{ $brand->category->name ?? '' }}</td>
        </tr>
        <tr>
            <td>المدينة</td>
            <td>{{ $brand->city->name ?? '' }}</td>
        </tr>
        <tr>
            <td>التقييم</td>
            <td><i class="py-2 fw-1 fa fa-star text-warning"></i>  {{round($brand->rate, 1)}} </td>
        </tr>
        <tr>
            <td>الحالة</td>
            <td>
                @if($brand->status == 'pending')
                    <span class="badge badge-warning badge-sm d-inline-block"> معلق </span>
                @elseif($brand->status == 'active')
                    <span class="badge badge-success badge-sm d-inline-block"> مفعل </span>
                @else
                    <span class="badge badge-danger badge-sm d-inline-block"> غير مفعل </span>
                @endif
            </td>
        </tr>
        <tr>
            <td>الخصم</td>
            <td>{{ $brand->discount }}</td>
        </tr>
        <tr>
            <td>عدد نقاط الخصم</td>
            <td>{{ $brand->discount_points }}</td>
        </tr>
        <tr>
            <td>عدد ساعات الخصم</td>
            <td>{{ $brand->discount_hours }}</td>
        </tr>
        <tr>
            <td>فيسبوك</td>
            <td>{{ $brand->facebook }}</td>
        </tr>
        <tr>
            <td>تويتر</td>
            <td>{{ $brand->twitter }}</td>
        </tr>
        <tr>
            <td>انستجرام</td>
            <td>{{ $brand->insta }}</td>
        </tr>
        <tr>
            <td>يوتيوب</td>
            <td>{{ $brand->youtube }}</td>
        </tr>
        <tr>
            <td>تيكتوك</td>
            <td>{{ $brand->tiktok }}</td>
        </tr>
        <tr>
            <td>الموقع الالكترونى</td>
            <td>{{ $brand->website }}</td>
        </tr>
        <tr>
            <td>من نحن</td>
            <td>{{ $brand->about }}</td>
        </tr>
        <tr>
            <td>العنوان</td>
            <td>{{ $brand->address }}</td>
        </tr>
        <!-- Add more rows as necessary -->
        </tbody>
    </table>
</div>

