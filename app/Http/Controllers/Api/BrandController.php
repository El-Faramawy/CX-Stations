<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AdsByCategoryRequest;
use App\Http\Requests\Api\Brand\BrandProfileRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\Ad;
use App\Models\Brand;
use App\Models\Follow;

class BrandController extends Controller
{
    use PaginateTrait;

    public function getBrandsByCategory(AdsByCategoryRequest $request)
    {
        $categoryId = $request->category_id;
        $searchWord = $request->search_word;
        if ($categoryId === 'all') {
            $brands = Brand::where('status','active')->where('country_id', user_api()->user()->country_id);
        } else {
            $brands = Brand::where('status','active')->where('category_id', $categoryId)->where('country_id', user_api()->user()->country_id);
        }
        if (isset($searchWord)) {
            $brands = $brands->where('name', 'like', '%' . $searchWord . '%');
        }

        return $this->apiResponse($brands->orderBy('rate', 'desc'));
    }

    public function follow_brand(BrandProfileRequest $request)
    {
        $credits = ['user_id' => user_api()->id(), 'brand_id' => $request->brand_id];
        $follow = Follow::where($credits);
        if ($follow->exists()) {
            $follow->delete();
            $data = null;
        } else {
            $credits['category_id'] = Brand::where('id', $request->brand_id)->first()?->category_id;
            $data = Follow::create($credits);
        }
        return $this->apiResponse($data, 'done', 'simple');
    }

    public function one_brand(BrandProfileRequest $request)
    {
        $brand = Brand::where('id', $request->brand_id)->first();
        $ads_with_video = Ad::where('brand_id', $request->brand_id)
            ->where('video', '!=', null);
        $brand->ads_with_video = $this->apiResponse($ads_with_video);
        $ads_with_image = Ad::where('brand_id', $request->brand_id)
            ->where('video', null);
        $brand->ads_with_image = $this->apiResponse($ads_with_image);
        $brand->share_brand_url = url('share_brand', $request->brand_id);
        return $this->apiResponse($brand, '', 'simple');
    }

    public function followed()
    {
        $data = Follow::with('brand:id,name,image,address')->where('user_id', user_api()->id());
        return $this->apiResponse($data);
    }

}
