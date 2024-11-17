<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Setting;

class SettingController extends Controller
{
    use PaginateTrait;
    public function setting(){
        $setting = Setting::first();
        return $this->apiResponse($setting,'','simple');
    }

}
