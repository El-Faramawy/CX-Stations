<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Brand\BrandProfileRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\Brand;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    use PaginateTrait;

    public function create(BrandProfileRequest $request)
    {
        $user = user_api()->user();
        $data = $request->only('brand_id');
        $brand = Brand::find($data['brand_id']);
        if ($brand->discount_points > $user->points) {
            return $this->apiResponse(null, 'your points not enough', 'simple',422);
        }
        $data['user_id'] = $user->id;
        $data['hours'] = $brand->discount_hours;
        $data['discount'] = $brand->discount;
        $response = Coupon::create($data);

        $user->points -= $brand->discount_points;
        $user->save();

        return $this->apiResponse($response, 'done', 'simple');
    }

    public function active_coupons()
    {
        $now = Carbon::now('Asia/Riyadh');

        $coupons = Coupon::where('user_id',user_api()->id())->
            whereRaw('TIMESTAMPADD(HOUR, hours, created_at) > ?', [$now])
            ->with('brand:id,name,image')->get();

        foreach ($coupons as $coupon) {
            $expirationTime = Carbon::parse($coupon->created_at)->addHours($coupon->hours);
            if ($now->diffInHours($expirationTime) > 0) {
                $coupon->time_left = floor($now->diffInHours($expirationTime));
                $coupon->time_in = 'hours';
            } else {
                $coupon->time_left = floor($now->diffInMinutes($expirationTime));
                $coupon->time_in = 'minutes';
            }
        }

        return $this->apiResponse($coupons, '', 'simple');
    }

}
