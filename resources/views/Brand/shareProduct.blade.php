<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->
<head>
@include('layouts.brand.css')
</head>
<!-- [Head] end -->
<!-- [Body] Start -->
<body data-pc-direction="ltr" data-pc-theme="dark">
  <!-- [ Main Content ] start -->
  <section class="shareLink">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6 p-2">
          <div class="singleAd">
            <a href="{{url('share_brand',$ad->brand_id)}}" class="adBrandInfo">
              <img class="logo" src="{{ isset($ad->brand->getAttributes()['image']) ? $ad->brand->image : url('Brand/assets/images/placeholder.svg') }}" alt="">
              <h4 class="title">{{$ad->brand->name ?? ''}} <span class="verify"> <i class="fa-solid fa-badge-check"></i> </span> </h4>
            </a>
            <p class="py-3">
                {{$ad->brand->about ?? ''}}
            </p>
            <a href="#" >
                @if($ad->video != null)
                    <video src="{{get_file($ad->video)}}"
                           controls
                           poster="{{get_file($ad->image)}}"></video>
                @else
                    <img src="{{get_file($ad->image)}}" alt="">
                @endif
            </a>
            <div class="views">
                <span> <i class="fa-light fa-eye"></i> {{$ad->view_number}} </span>
                <span> <i class="fa-light fa-thumbs-up"></i> {{count($ad->like)}} </span>
                <span> <i class="fa-sharp fa-light fa-comment"></i> {{count($ad->comment)}} </span>
                <span> <i class="fa-light fa-share-nodes"></i> {{count($ad->share)}} </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section class="getApp">
      <div class="container">
        <div class="row">
          <div class="col-md-6 p-2">
            <div class="downLoadApp  justify-content-center justify-content-md-start">
              <a href="#!" target="_blank"> <img src="assets/images/google-play-android.webp" alt="">  </a>
              <a href="#!" target="_blank"> <img src="assets/images/apple-iphone-ios.webp" alt="">  </a>
            </div>
          </div>
          <div class="col-md-6 p-2">
            <div class="socialMedia justify-content-center justify-content-md-end ">
              <a href="#!" target="_blank"> <i class="fab fa-twitter"></i> </a>
              <a href="#!" target="_blank"> <i class="fab fa-instagram"></i> </a>
              <a href="#!" target="_blank"> <i class="fab fa-linkedin-in"></i> </a>
              <a href="#!" target="_blank"> <i class="fab fa-youtube"></i> </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  @include('layouts.brand.js')
</body>
<!-- [Body] end -->
</html>
