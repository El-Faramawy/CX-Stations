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
        $salla = SallaStore::where('brand_id', brand()->user()->id)->first();
        $brandsResponse = $this->getCartsOfBrands();
        $carts = is_object($brandsResponse) && method_exists($brandsResponse, 'getData') ? $brandsResponse->getData() : [];
        return view('Brand.carts', [
            'carts' => $carts,
            'salla' => $salla,
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
                $carts = json_decode($response->body(), true);

//                // Check if the response contains cart data
//                if (isset($carts['data']) && is_array($carts['data'])) {
//                    foreach ($carts['data'] as &$cart) {
//                        if (isset($cart['items']) && is_array($cart['items'])) {
//                            foreach ($cart['items'] as &$item) {
//                                // Access product details for each item's product_id
//                                $productUrl = config('salla.salla-api-url') . '/products/' . $item['product_id'];
//                                $productResponse = Http::withToken($salla->access_token)->acceptJson()->get($productUrl);
//                                // Attach product details to the item if successful
//                                if ($productResponse->successful()) {
//                                    $item['product_details'] = json_decode($productResponse->body(), true);
//                                } else {
//                                    $item['product_details'] = ['error' => $productResponse];
//                                }
//                            }
//                        }
//                    }
//                }

                return response()->json($carts);
            }
            return $response;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function productDetails($id)
    {
        try {
            $salla = SallaStore::where('brand_id', brand()->id())->first();

            // Define the endpoint URL
            $url = config('salla.salla-api-url') . '/carts/abandoned/' . $id;

            // Make the API request
            $response = Http::withToken($salla->access_token)->acceptJson()->get($url);
            $rows = [];
            if ($response->successful()) {
                $carts = json_decode($response->body(), true);
                $productResponse = [];
                foreach ($carts['data']['items'] as &$item) {
                    // Access product details for each item's product_id
                    $productUrl = config('salla.salla-api-url') . '/products/' . $item['product_id'];
                    $productResponse = Http::withToken($salla->access_token)->acceptJson()->get($productUrl);

                    $oneProductResponse = new \stdClass();
                    foreach ($productResponse['data']??[] as $key=>$oneProduct){
                        $oneProductResponse->$key = $oneProduct;
                    }
                    $rows[] = $oneProductResponse;
                }
            }
            return view('Brand.product-details', compact('rows'));
        }
        catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


}
