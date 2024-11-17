<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use  PaginateTrait;

    public function index(Request $request){
        $data = City::query();
        if (isset($request->country_id)){
            $data->where('country_id',$request->country_id);
        }
        return $this->apiResponse($data);
    }

    public function countries(){
        $data = Country::query();
        return $this->apiResponse($data);
    }

}
