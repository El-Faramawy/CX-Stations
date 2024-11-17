<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::query();
            return Datatables::of($categories)
                ->addColumn('action', function ($item) {
                    return tableAction($item->id, true,true);
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Category.index');
    }

    public function create()
    {
        return view('Admin.Category.parts.create')->render();
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();
        Category::create($data);
        return response()->json(['message' => 'تم الاضافة بنجاح ']);
    }

    public function edit(Category $category)
    {
        return view('Admin.Category.parts.edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        $data = $request->all();
        $category->update($data);

        return response()->json(['message' => 'تم التعديل بنجاح ']);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        Category::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }


}
