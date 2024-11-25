<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Duet;
use App\Models\DuetUser;
use App\Models\SallaStore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    use NotificationTrait;

    public function index(Request $request)
    {
        $salla = SallaStore::where('brand_id',brand()->user()->id)->first();
        $brandsResponse = $this->getCouponsOfBrands();
        $coupons = is_object($brandsResponse) && method_exists($brandsResponse, 'getData') ? $brandsResponse->getData() : [];
        return view('Brand.coupons', [
            'coupons' => $coupons,
            'salla'   => $salla,
        ]);
    }

    public function getData()
    {
        Carbon::now('Asia/Riyadh');
        $brands = $this->getCouponsOfBrands()->getData()->data;
        return DataTables::of($brands)
            ->addColumn('discount', function ($coupon) {
                return '<span class="discount">' . $coupon->discount . '</span>' . '%';
            })
            ->addColumn('date', function ($coupon) {
                return date('Y-m-d', strtotime($coupon->created_at));
            })
            ->addColumn('total_purchases', function ($coupon) {
                return view('Brand.parts.total_purchases', ['coupon' => $coupon])->render();
            })
            ->addColumn('total_after_discount', function ($coupon) {
                return '<span class="total-after-discount" data-id="' . $coupon->id . '">' . ($coupon->total_after_discount ?? 0) . '</span>';
            })
            ->addColumn('status', function ($coupon) {
                return view('Brand.parts.coupon_status_button', ['coupon' => $coupon])->render();
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function getCouponsOfBrands()
    {
        try {
            $salla = SallaStore::where('brand_id', brand()->id())->first();

            // Define the endpoint URL
            $url = config('salla.salla-api-url') . '/coupons';

            // Make the API request
            $response = Http::withToken($salla->access_token)->acceptJson()->get($url);

            if ($response->successful()) {
                return response()->json(json_decode($response->body()));
            }
            return $response;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }


}
