<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PhotoTrait;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    use NotificationTrait;
    use PhotoTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->brand_id) {
                $data = Brand::where('id', $request->brand_id);
            } else {
                $data = Brand::latest();
            }
            return Datatables::of($data)
                ->addColumn('action', function ($item) {
                    return tableAction($item->id, false, false, true)
                        . tableAction($item->id, false, true);
                })->addColumn('city', function ($item) {
                    return $item->city->name ?? '';
                })->addColumn('category', function ($item) {
                    return $item->category->name ?? '';
                })->addColumn('gender', function ($item) {
                    return $item->gender == 'female' ? 'انثى' : 'ذكر';
                })->editColumn('rate', function ($item) {
                    return ' <i class="py-2 fw-1 fa fa-star text-warning"></i> ' . round($item->rate, 1);
                })->editColumn('image', function ($item) {
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="' . get_file($item->image) . '">';
                })->editColumn('panner', function ($item) {
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="' . get_file($item->panner) . '">';
                })
                ->addColumn('ads', function ($item) {
                    return '<div class="card-options pr-2">
                                    <a class="btn btn-sm btn-info text-white"  href="' . route("ads.index", "brand_id=$item->id") . '"><i class="fa fa-list mb-0"></i></a>
                           </div>';
                })
                ->editColumn('status', function ($item) {
                    $color = "danger";
                    $color2 = "success";
                    $text = "الحظر";
                    $text2 = "التفعيل";
                    $url2 = url("admin/brand/status", $item->id) . "?status=active";
                    $url1 = url("admin/brand/status", $item->id) . "?status=not_active";
                    if ($item->status == "pending") {
                        return '<div class="text-center">
                        <span class="badge badge-warning badge-sm d-block"> معلق </span>
                        <a data-url="' . $url2 . '" data-toggle="tooltip" title="تفعيل" style="font-size: xx-large; display: inline-block!important;cursor: pointer " class="status text-center fw-3 pl-1 text-' . $color2 . '" data-text="' . $text2 . '" ><i class="py-2 fw-3  fa fa-check text-' . $color2 . '" ></i></a>
                        <a data-url="' . $url1 . '" data-toggle="tooltip" title="الغاء التفعيل" style="font-size: xx-large; display: inline-block!important;cursor: pointer" class="status text-center fw-3 pr-1 text-' . $color . '" data-text="' . $text . '" ><i class="py-2 fw-3  fa fa-times text-' . $color . '" ></i></a>
                                </div>';
                    } elseif ($item->status == "active") {
                        return '<div class="text-center">
                        <span class="badge badge-success badge-sm d-block"> مفعل </span>
                        <a data-url="' . $url1 . '" data-toggle="tooltip" title="الغاء التفعيل" style="font-size: xx-large; display: inline-block!important;cursor: pointer" class="status text-center fw-3 pr-1 text-' . $color . '" data-text="' . $text . '" ><i class="py-2 fw-3  fa fa-times text-' . $color . '" ></i></a>
                        </div>';
                    } else {
                        return '<div class="text-center">
                        <span class="badge badge-danger badge-sm d-block"> غير مفعل </span>
                        <a data-url="' . $url2 . '" data-toggle="tooltip" title="تفعيل" style="font-size: xx-large; display: inline-block!important;cursor: pointer " class="status text-center fw-3 pl-1 text-' . $color2 . '" data-text="' . $text2 . '" ><i class="py-2 fw-3  fa fa-check text-' . $color2 . '" ></i></a>
                        </div>';
                    }
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Brand.index');
    }

    public function show(Brand $brand)
    {
        return view('Admin.Brand.parts.show', compact('brand'));
    }

    public function destroy(Brand $brand)
    {
        $this->deleteImage($brand->image);
        $brand->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        $images = Brand::whereIn('id', $ids)->pluck('image')->toArray();
        $this->deleteImages($images);
        Brand::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function change_status(Request $request, $id)
    {
        $brand = Brand::where('id', $id)->first();
        $brand->status = $request->status;
        $brand->save();
        if ($brand->status == "active") {
            $text = "تم تفعيل البراند بنجاح";
            $userIds = User::where('city_id', $brand->city_id)->pluck('id')->toArray();
            $this->sendAllNotifications($userIds, 'New Brand in your city', $brand->name . ' New Brand in your city', $brand->image);
        } else {
            $text = "تم حظر البراند ";
        }

        return response()->json(
            [
                'code' => 200,
                'message' => $text
            ]);
    }

}
