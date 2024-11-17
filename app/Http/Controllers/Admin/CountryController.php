<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreCountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Country::latest();
            return Datatables::of($data)
                ->addColumn('action', function ($item) {
                    return tableAction($item->id, true,true);
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Country.index');
    }

    public function create()
    {
        return view('Admin.Country.parts.create')->render();
    }

    public function store(StoreCountryRequest $request)
    {
        $data = $request->all();
        Country::create($data);
        return response()->json(['message' => 'تم الاضافة بنجاح ']);
    }

    public function edit(Country $country)
    {
        return view('Admin.Country.parts.edit', compact('country'));
    }

    public function update(StoreCountryRequest $request, Country $country)
    {
        $data = $request->all();
        $country->update($data);

        return response()->json(['message' => 'تم التعديل بنجاح ']);
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        Country::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }


}
