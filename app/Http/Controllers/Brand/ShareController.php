<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Brand;

class ShareController extends Controller
{
    public function ShareBrand($id)
    {
        $brand = Brand::where('id', $id)->first();
        $ads_with_video = Ad::where('brand_id', $id)
            ->where('video', '!=', null)->select('id', 'image', 'video')->get();
        $ads_with_image = Ad::where('brand_id', $id)
            ->where('video', null)->select('id', 'image')->get();
        return view('Brand.shareBrand', compact('brand','ads_with_video', 'ads_with_image'));
    }
    public function ShareProduct($id)
    {
        $ad = Ad::where('id', $id)->first();
        return view('Brand.shareProduct', compact('ad'));
    }


}
