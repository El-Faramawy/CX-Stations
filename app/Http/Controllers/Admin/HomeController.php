<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Admin;
use App\Models\Answer;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request){
        $created_from = $request->created_from ? date('Y-m-d',strtotime($request->created_from)):date('2024-1-1');
        $created_to = $request->created_to ?date('Y-m-d' ,strtotime($request->created_to)):date('Y-m-d' , strtotime('+1 day') );
        $date_from = new \DateTime($created_from);
        $date_to = new \DateTime($created_to);
        $interval = $date_from->diff($date_to);
        $days_difference = $interval->days;

        $chart_day_array  = $chart_coupon_array = [];
        $total_purchases = 0;

        for($i= $days_difference ; $i>=0 ; $i--){
            array_push($chart_day_array , (string)date('d/m', strtotime($created_to.'-'.$i.'day')));
            $coupons = Coupon::whereDate('created_at' , date('Y-m-d',strtotime($created_to.'-'.$i.'day') ))
                ->where('status','complete')->sum('total_after_discount');
            $total_purchases += $coupons;
            array_push($chart_coupon_array , (string)$coupons );
        }
        $admin_count = Admin::whereBetween('created_at',[$created_from,$created_to])->count();
        $ad_count = Ad::whereBetween('created_at',[$created_from,$created_to])->count();
        $brand_count = Brand::whereBetween('created_at',[$created_from,$created_to])->count();
        $category_count = Category::whereBetween('created_at',[$created_from,$created_to])->count();
        $question_count = Question::whereBetween('created_at',[$created_from,$created_to])->count();
        $answer_count = Answer::whereBetween('created_at',[$created_from,$created_to])->count();
        $user_count = User::whereBetween('created_at',[$created_from,$created_to])->count();

        $cities = City::whereHas('users')->withCount('users')->get();

        return view('Admin.index',['created_from'=>$created_from,'created_to'=>$created_to],
            compact('chart_day_array','chart_coupon_array','total_purchases','user_count',
                'ad_count','brand_count', 'category_count','question_count','admin_count','answer_count','cities'));
    }

    //###################################################


}
