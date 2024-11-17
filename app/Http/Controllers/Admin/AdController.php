<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\Ad;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdController extends Controller
{
    use PhotoTrait;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->brand_id){
                $data = Ad::where('brand_id',$request->brand_id);
            }else{
                $data = Ad::latest();
            }
            return Datatables::of($data)
                ->addColumn('action', function ($item) {
                    return tableAction($item->id, false,true);
                })->addColumn('brand', function ($item) {
                    return $item->brand->name ?? '';
                })->addColumn('like_count', function ($item) {
                    return $item->like->count();
                })->addColumn('comment_count', function ($item) {
                    return $item->comment->count();
                })->editColumn('rate', function ($item) {
                    return ' <i class="py-2 fw-1 fa fa-star text-warning"></i> ' . round($item->rate, 1);
                })->editColumn('image', function ($item) {
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="' . get_file($item->image) . '">';
                })->editColumn('video', function ($item) {
                    if (!$item->video) return null;
                    $video = "'".get_file($item->video)."'";
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open('.$video.')" src="' . url('Admin/imgs/video.webp') . '">';
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Ad.index');
    }

    public function show(Ad $ad)
    {
        return view('Admin.Ad.parts.show',compact('ad'));
    }

    public function destroy(Ad $ad)
    {
        $this->deleteImage($ad->image);
        $ad->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        $images = Ad::whereIn('id', $ids)->pluck('image')->toArray();
        $this->deleteImages($images);
        Ad::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }


}
