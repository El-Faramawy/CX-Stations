<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use PhotoTrait;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->user_id){
                $data = User::where('id',$request->user_id);
            }else{
                $data = User::latest();
            }
            return Datatables::of($data)
                ->addColumn('action', function ($item) {
                    return tableAction($item->id, false,true);
                })->addColumn('city', function ($item) {
                    return $item->city->name ?? '';
                })->addColumn('gender', function ($item) {
                    return $item->gender == 'female' ? 'انثى' : 'ذكر';
                })->editColumn('image', function ($item) {
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="' . get_file($item->image) . '">';
                })->editColumn('active', function ($item) {
                    $color = $item->active == 1 ? 'badge-success' : 'badge-danger';
                    $text = $item->active == 1 ? 'نشط' : ' غير نشط';
                    return '<span class="badge ' . $color . ' " >' . $text . '</span>';
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.User.index');
    }

    public function destroy(User $user)
    {
        $this->deleteImage($user->image);
        $user->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        $images = User::whereIn('id', $ids)->pluck('image')->toArray();
        $this->deleteImages($images);
        User::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

}
