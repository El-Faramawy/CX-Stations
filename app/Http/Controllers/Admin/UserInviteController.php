<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PhotoTrait;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserInviteController extends Controller
{
    use PhotoTrait;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user_phones = User::pluck('phone')->toArray();
            $phones = Coupon::whereNotIn('phone',$user_phones)->latest()->get();
            return Datatables::of($phones)
                ->addColumn('phone_code', function ($item) {
                    return $item->brand->phone_code ?? '';
                })->addColumn('whatsapp', function ($item) {
                    $full_phone = ($item->brand->phone_code ?? "+966") . $item->phone;
                    return '<a href="//wa.me/' . $full_phone . '" target="_blank">' . $full_phone . '</a>';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.UserInvite.index');
    }

}
