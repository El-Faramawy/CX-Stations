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
      <div class="row">
        <div class="col-xl-4 p-2">
          <div class="brandInfo">
            <img class="banner" src="{{ isset($brand->getAttributes()['panner']) ? get_file($brand->panner) : url('Brand/assets/images/ads/old ads-1.jpg') }}" alt="">
            <img class="logo" src="{{ isset($brand->getAttributes()['image']) ? $brand->image : url('Brand/assets/images/placeholder.svg') }}" alt="">
            <h4 class="title">Brand Name <span class="verify"> <i class="fa-solid fa-badge-check"></i> </span> </h4>
          </div>
        </div>
        <div class="col-xl-8 p-2">
          <div class="nav nav-tabs">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#posts">
              posts
            </button>
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#videos">
              videos
            </button>
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#about">
              about
            </button>
          </div>
          <div class="tab-content">
            <div class="tab-pane active" id="posts">
              <div class="row">
                  @foreach($ads_with_image as $ad)
                      <div class="col-md-6 col-xl-4 p-2">
                          <div class="singleAd">
                              <a href="{{url('share_ad',$ad->id)}}">
                                  <img src="{{get_file($ad->image)}}" alt="">
                              </a>
                              <div class="views">
                                  <span> <i class="fa-light fa-eye"></i> {{$ad->view_number}} </span>
                                  <span> <i class="fa-light fa-thumbs-up"></i> {{count($ad->like)}} </span>
                                  <span> <i class="fa-sharp fa-light fa-comment"></i> {{count($ad->comment)}} </span>
                                  <span> <i class="fa-light fa-share-nodes"></i> {{count($ad->share)}} </span>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
            </div>
            <div class="tab-pane" id="videos">
              <div class="row">
                  @foreach($ads_with_video as $ad)
                      <div class="col-lg-6 p-2">
                          <div class="singleAd">
                              <video src="{{get_file($ad->video)}}"
                                     controls
                                     poster="{{get_file($ad->image)}}"></video>
                              <div class="views">
                                  <span> <i class="fa-light fa-eye"></i> {{$ad->view_number}} </span>
                                  <span> <i class="fa-light fa-thumbs-up"></i> {{count($ad->like)}} </span>
                                  <span> <i class="fa-sharp fa-light fa-comment"></i> {{count($ad->comment)}} </span>
                                  <span> <i class="fa-light fa-share-nodes"></i> {{count($ad->share)}} </span>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
            </div>
            <div class="tab-pane" id="about">
              <div class="aboutBrand">
                <div class="single">
                  <h5 class="subTitle"> Address </h5>
                  <p> {{$brand->address}} </p>
                </div>
                <div class="single">
                  <h5 class="subTitle"> phone </h5>
                  <a href="tel:{{$brand->phone}}"> {{$brand->phone}} </a>
{{--                  <a href="tel:0123456789"> 0123456789 </a>--}}
                </div>
                <div class="single">
                  <h5 class="subTitle"> social Media </h5>
                  <div class="socialMedia">
                    <a href="//{{$brand->facebook ?? '#'}}" target="_blank"> <i class="fab fa-facebook-f"></i> </a>
                    <a href="//{{$brand->twitter ?? '#'}}" target="_blank"> <i class="fab fa-twitter"></i> </a>
                    <a href="//{{$brand->insta ?? '#'}}" target="_blank"> <i class="fab fa-instagram"></i> </a>
{{--                    <a href="{{$brand->website ?? '#'}}" target="_blank"> <i class="fab fa-globe"></i> </a>--}}
                    <a href="//{{$brand->youtube ?? '#'}}" target="_blank"> <i class="fab fa-youtube"></i> </a>
                    <a href="//{{$brand->tiktok ?? '#'}}" target="_blank"> <i class="fab fa-tiktok"></i> </a>
                  </div>
                </div>
                <div class="single">
                  <h5 class="subTitle"> Website </h5>
                  <a href="//{{$brand->website ?? '#'}}" target="_blank"> {{$brand->website ?? '#'}} </a>
                </div>
              </div>
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
