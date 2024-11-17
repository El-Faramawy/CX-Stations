<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function updatePreferences(Request $request)
    {
        $brand = brand()->user();
        if (isset($request->language)) {
            $brand->language = $request->language;
        }
        if (isset($request->theme)) {
            $brand->theme = $request->theme;
        }
        $brand->save();

        app()->setLocale($brand->language);
        session()->put('theme', $brand->theme);
        session()->put('locale', $brand->language);
//        return app()->getLocale();
        return redirect()->back();
    }
}
