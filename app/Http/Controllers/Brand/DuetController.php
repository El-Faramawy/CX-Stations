<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Duet;
use App\Models\DuetUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class DuetController extends Controller
{
    use NotificationTrait;

    public function index(Request $request)
    {
        $brands = $this->getDuetBrands();
//        $duet = $this->getDuetByBrandId($request->brand_id);
        if ($request->ajax()) {
            return $this->getCoupons($request->brand_id, $request->status);
        }
        return view('Brand.duet', [
            'brands' => $brands,
            'brand_id' => $request->brand_id,
            'status' => $request->status,
//            'duet' => $duet
        ]);
    }

    public function getCoupons($brand_id = null, $status = null)
    {
        $now = Carbon::now('Asia/Riyadh');
        Coupon::where('brand_id', brand()->id())->whereHas('duet')
            ->whereRaw('DATE_ADD(created_at, INTERVAL 10 DAY) < ?', [$now])
            ->update(['status' => 'rejected']);

        $coupons = Coupon::where('brand_id', brand()->id())->whereHas('duet');
        if (isset($brand_id)) {
            $coupons->where('duet_brand_id', $brand_id);
        }
        if (in_array($status, ['pending', 'complete', 'rejected'])) {
            $coupons->where('status', $status);
        }
        $coupons->latest()->get();

        return DataTables::of($coupons)
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

    public function getDuetBrands()
    {
        $brandId = brand()->id();
        $duets = Duet::where(function ($query) use ($brandId) {
            $query->where('brand1_id', $brandId)
                ->orWhere('brand2_id', $brandId);
        })
            ->whereDate('start_date', '<=', Carbon::now())
            ->whereDate('end_date', '>=', Carbon::now())
            ->get();

        $otherBrandIds = $duets->map(function ($duet) use ($brandId) {
            return $duet->brand1_id === $brandId ? $duet->brand2_id : $duet->brand1_id;
        })->unique();

        return Brand::whereIn('id', $otherBrandIds)->get();
    }

    public function getDuetByBrandId($duetBrandId = null)
    {
        if (isset($duetBrandId)) {
            $myBrandId = brand()->id();
            return Duet::where(function ($query) use ($myBrandId, $duetBrandId) {
                $query->where(['brand1_id' => $myBrandId, 'brand2_id' => $duetBrandId])
                    ->orWhere(['brand2_id' => $myBrandId, 'brand1_id' => $duetBrandId]);
            })
                ->whereDate('start_date', '<=', Carbon::now())
                ->whereDate('end_date', '>=', Carbon::now())
                ->first();
        } else {
            return null;
        }
    }

    public function addDuetCoupon(Request $request)
    {
        $previous_duet_user = DuetUser::where(['phone' => $request->phone, 'brand_id' => brand()->id()])->latest()->first();
        if ($previous_duet_user) {
            Log::info('1');
            $coupons = Coupon::where('duet_user_id', $previous_duet_user->id)->where('brand_id', '!=', brand()->id());
            if ($coupons->exists()) {
                Log::info('2');
                $hasCompleteCoupon = $coupons->where('status', 'complete')->exists();
                if (!$hasCompleteCoupon) {
                    $createdAt = $previous_duet_user->created_at;
                    Log::info('3');
                    $tenDaysAgo = Carbon::now()->subDays(10);
                    if ($createdAt->greaterThanOrEqualTo($tenDaysAgo)) {
                        Log::info('4');
                        return response()->json(['message' => __('validation.purchase_duet_first'), 'success' => false]);
                    }
                }
            }
        }

        $duet_user = DuetUser::create([
            'phone' => $request->phone,
            'brand_id' => brand()->id()
        ]);

        $data = $request->all();
        $data['brand_id'] = brand()->id();
        $data['duet_user_id'] = $duet_user->id;
        Coupon::create($data);

        $duetBrands = $this->getDuetBrands();
        foreach ($duetBrands as $duetBrand) {
            $data['brand_id'] = $duetBrand['id'] ?? null;
            $data['duet_brand_id'] = brand()->id();
            $data['total_purchases'] = $data['total_after_discount'] = 0;
            $duet = $this->getDuetByBrandId($duetBrand->id);
            $data['duet_id'] = $duet['id'] ?? null;
            $data['discount'] = $duet?->brand1_id == brand()->id() ? $duet?->brand2_discount : $duet?->brand1_discount;
            Coupon::create($data);
        }
        return response()->json(['message' => __('validation.coupon_sent_successfully'), 'success' => true]);
    }


}
