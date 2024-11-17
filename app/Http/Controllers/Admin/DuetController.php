<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Duet\StoreDuetRequest;
use App\Models\Brand;
use App\Models\Duet;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DuetController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Duet::latest();
            return Datatables::of($data)
                ->addColumn('action', function ($item) {
                    return tableAction($item->id, true, true);
                })->addColumn('brand1', function ($item) {
                    return $item->brand1->name ?? '';
                })->addColumn('brand2', function ($item) {
                    return $item->brand2->name ?? '';
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Duet.index');
    }

    public function create()
    {
        $brands = Brand::all();
        return view('Admin.Duet.parts.create', compact('brands'))->render();
    }

    public function store(StoreDuetRequest $request)
    {
        $data = $request->all();
        Duet::create($data);
        return response()->json(['message' => 'تم الاضافة بنجاح ']);
    }

    public function edit(Duet $duet)
    {
        $brands = Brand::all();
        return view('Admin.Duet.parts.edit', compact('duet','brands'))->render();
    }

    public function update(StoreDuetRequest $request, Duet $duet)
    {
        $data = $request->all();
        $duet->update($data);
        return response()->json(['message' => 'تم التعديل بنجاح ']);
    }

    public function destroy(Duet $duet)
    {
        $duet->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        Duet::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }


}
