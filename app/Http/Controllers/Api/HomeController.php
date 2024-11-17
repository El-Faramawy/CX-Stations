<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AdsByCategoryRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\Ad;
use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use PaginateTrait;

    public function vip_ads()
    {
        $data = Ad::where([['is_vip', 1], ['vip_date', '>=', Carbon::now()->subDay()]])
            ->whereRelation('brand', 'country_id', user_api()->user()->country_id);
        return $this->apiResponse($data);
    }

    public function top_rated()
    {
        $data = Brand::where('status','active')->where('country_id', user_api()->user()->country_id)
            ->orderBy('rate','desc')->take(12)->select('id','name','rate','image');
        return $this->apiResponse($data);
    }

    public function nearAds(Request $request)
    {
        $data = Brand::where('status', 'active')->where('city_id', user_api()->user()->city_id);
        $categoryIds = Category::pluck('id')->toArray();
        if (isset($request->category_id) && $request->category_id != 'all' && in_array($request->category_id, $categoryIds)) {
            $data = $data->where('category_id', $request->category_id);
        }
        $data = $data->select('id','name','rate','image');
        return $this->apiResponse($data);
    }

    public function getAdsByCategory(AdsByCategoryRequest $request)
    {
        $categoryId = $request->category_id;
        if ($categoryId === 'all') {
            $ads = Ad::with('brand:id,name,image,status')
                ->whereRelation('brand', 'country_id', user_api()->user()->country_id)
                ->where(function ($query) {
                    $query->whereNull('vip_date')->orWhere('vip_date', '<', Carbon::now()->subDay());
                })
                ->latest();
        } else {
            $ads = Ad::whereHas('brand', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId)->where('country_id', user_api()->user()->country_id);
            })->where(function ($query) {
                $query->whereNull('vip_date')->orWhere('vip_date', '<', Carbon::now()->subDay());
            })
                ->with('brand:id,name,image,status')
                ->latest();
        }

        return $this->apiResponse($ads);
    }

    public function getCategories()
    {
        $data = Category::query();
        return $this->apiResponse($data);
    }

}
