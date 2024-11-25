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

class CartController extends Controller
{
    use NotificationTrait;

    public function index(Request $request)
    {
        $salla = SallaStore::where('brand_id',brand()->user()->id)->first();
        $brandsResponse = $this->getCartsOfBrands();
        $carts = is_object($brandsResponse) && method_exists($brandsResponse, 'getData') ? $brandsResponse->getData() : [];
        return view('Brand.carts', [
            'carts' => $carts,
            'salla'   => $salla,
        ]);
    }

    public function getData()
    {
        Carbon::now('Asia/Riyadh');
        $rows = $this->getCartsOfBrands()->getData()->data;
        return DataTables::of($rows)
            ->escapeColumns([])
            ->make(true);
    }

    public function getCartsOfBrands()
    {
        try {
            $salla = SallaStore::where('brand_id', brand()->id())->first();

            // Define the endpoint URL
            $url = config('salla.salla-api-url') . '/carts/abandoned';

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
