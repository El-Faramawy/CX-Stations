<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\StoreCityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = City::with('country')->latest();
            return Datatables::of($data)
                ->addColumn('action', function ($item) {
                    return tableAction($item->id, true, true);
                })->addColumn('country', function ($item) {
                    return $item->country->name_ar ?? '';
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.City.index');
    }

    public function create()
    {
        $countries = Country::all();
        return view('Admin.City.parts.create', compact('countries'))->render();
    }

    public function store(StoreCityRequest $request)
    {
        $data = $request->all();
        City::create($data);
        return response()->json(['message' => 'تم الاضافة بنجاح ']);
    }

    public function edit(City $city)
    {
        $countries = Country::all();
        return view('Admin.City.parts.edit', compact('city', 'countries'))->render();
    }

    public function update(StoreCityRequest $request, City $city)
    {
        $data = $request->all();
        $city->update($data);

        return response()->json(['message' => 'تم التعديل بنجاح ']);
    }

    public function destroy(City $city)
    {
        $city->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        City::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }


}
