<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\Ad\AddAdRequest;
use App\Http\Traits\PhotoTrait;
use App\Models\Ad;
use App\Models\AdComment;
use App\Models\AdLike;
use App\Models\AdShare;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnounceController extends Controller
{
    use PhotoTrait;

    public function index(Request $request)
    {
        $myTotalCommentsCount = Ad::where('brand_id', brand()->id())->withCount('comment')->get()->sum('comment_count');
        $myTotalUsersCount = DB::table('ads')
            ->leftJoin('ad_likes', 'ads.id', '=', 'ad_likes.ad_id')
            ->leftJoin('ad_comments', 'ads.id', '=', 'ad_comments.ad_id')
            ->leftJoin('ad_shares', 'ads.id', '=', 'ad_shares.ad_id')
            ->join('users', function ($join) {
                $join->on('ad_likes.user_id', '=', 'users.id')
                    ->orOn('ad_comments.user_id', '=', 'users.id')
                    ->orOn('ad_shares.user_id', '=', 'users.id');
            })
            ->where('ads.brand_id', '=', brand()->id())
            ->pluck(DB::raw('COUNT(DISTINCT users.id) as user_count'))
            ->first();
        $myTotalLikesCount = AdLike::whereHas('ad', function ($query) {
            $query->where('brand_id', brand()->id());
        })->count();
        $myTotalSharesCount = AdShare::whereHas('ad', function ($query) {
            $query->where('brand_id', brand()->id());
        })->count();

        $totalCommentsCount = Ad::whereHas('brand', function ($query) {
            $query->where('category_id', brand()->user()->category_id)->where('country_id', brand()->user()->country_id);
        })->withCount('comment')->get()->sum('comment_count');
        $totalLikesCount = Ad::whereHas('brand', function ($query) {
            $query->where('category_id', brand()->user()->category_id)->where('country_id', brand()->user()->country_id);
        })->withCount('like')->get()->sum('like_count');
        $totalUsersCount = DB::table('ads')
            ->leftJoin('ad_likes', 'ads.id', '=', 'ad_likes.ad_id')
            ->leftJoin('ad_comments', 'ads.id', '=', 'ad_comments.ad_id')
            ->leftJoin('ad_shares', 'ads.id', '=', 'ad_shares.ad_id')
            ->join('users', function ($join) {
                $join->on('ad_likes.user_id', '=', 'users.id')
                    ->orOn('ad_comments.user_id', '=', 'users.id')
                    ->orOn('ad_shares.user_id', '=', 'users.id');
            })
            ->join('brands', 'ads.brand_id', '=', 'brands.id')
            ->where('brands.category_id', '=', brand()->user()->category_id)
            ->where('brands.country_id', '=', brand()->user()->country_id)
            ->pluck(DB::raw('COUNT(DISTINCT users.id) as user_count'))
            ->first();

        $locale = app()->getLocale(); // Get the current locale
        $likesByCity = AdLike::whereHas('ad', function ($query) {
            $query->where('brand_id', brand()->id());
        })
            ->join('users', 'users.id', '=', 'ad_likes.user_id') // Join the users table to get user data
            ->join('cities', 'cities.id', '=', 'users.city_id') // Join the cities table to get city name
            ->select('cities.name_' . $locale, DB::raw('COUNT(ad_likes.id) as total_likes')) // Select name_ar and count likes
            ->groupBy('cities.name_' . $locale) // Group by name_ar
            ->get();

        $commentsByCity = AdComment::whereHas('ad', function ($query) {
            $query->where('brand_id', brand()->id());
        })
            ->join('users', 'users.id', '=', 'ad_comments.user_id') // Join the users table to get city_id
            ->join('cities', 'cities.id', '=', 'users.city_id') // Join the cities table to get city name
            ->select('cities.name_' . $locale, DB::raw('COUNT(ad_comments.id) as total_comments')) // Select name_ar and count likes
            ->groupBy('cities.name_' . $locale) // Group by name_ar
            ->get();

        $sharesByCity = AdShare::whereHas('ad', function ($query) {
            $query->where('brand_id', brand()->id());
        })
            ->join('users', 'users.id', '=', 'ad_shares.user_id') // Join the users table to get city_id
            ->join('cities', 'cities.id', '=', 'users.city_id') // Join the cities table to get city name
            ->select('cities.name_' . $locale, DB::raw('COUNT(ad_shares.id) as total_shares')) // Select name_ar and count likes
            ->groupBy('cities.name_' . $locale) // Group by name_ar
            ->get();

        $myAllUsersCount = DB::table('ads')
            ->leftJoin('ad_likes', 'ads.id', '=', 'ad_likes.ad_id')
            ->leftJoin('ad_comments', 'ads.id', '=', 'ad_comments.ad_id')
            ->leftJoin('ad_shares', 'ads.id', '=', 'ad_shares.ad_id')
            ->join('users', function ($join) {
                $join->on('ad_likes.user_id', '=', 'users.id')
                    ->orOn('ad_comments.user_id', '=', 'users.id')
                    ->orOn('ad_shares.user_id', '=', 'users.id');
            })
            ->where('ads.brand_id', '=', brand()->id())
            ->pluck(DB::raw('COUNT(DISTINCT users.id) as user_count'))
            ->first();

        $usersByCity = DB::table('ads')
            ->leftJoin('ad_likes', 'ads.id', '=', 'ad_likes.ad_id')
            ->leftJoin('ad_comments', 'ads.id', '=', 'ad_comments.ad_id')
            ->leftJoin('ad_shares', 'ads.id', '=', 'ad_shares.ad_id')
            ->join('users', function ($join) {
                $join->on('ad_likes.user_id', '=', 'users.id')
                    ->orOn('ad_comments.user_id', '=', 'users.id')
                    ->orOn('ad_shares.user_id', '=', 'users.id');
            })
            ->join('cities', 'users.city_id', '=', 'cities.id')
            ->where('ads.brand_id', '=', brand()->id())
            ->groupBy('cities.id', 'cities.name_' . $locale, 'cities.latitude', 'cities.longitude')
            ->select(
                'cities.name_' . $locale . ' as city_name',
                'cities.latitude as city_latitude',
                'cities.longitude as city_longitude',
                DB::raw('COUNT(DISTINCT users.id) as user_count')
            )
            ->get();
//        $usersByCity = User::select('city_id', DB::raw('count(*) as user_count'))
//            ->with('city:id,latitude,longitude,name_'.$locale) // Load city relationship and only fetch city_name
//            ->groupBy('city_id')
//            ->get();
//        $usersByCity = $usersByCity->map(function($user) {
//            return [
//                'city_name' => $user->city ? $user->city['name_'.app()->getLocale()] : 'Unknown', // If no city found, return 'Unknown'
//                'city_latitude' => $user->city['latitude'] ?? 0.0 ,
//                'city_longitude' => $user->city['longitude'] ?? 0.0 ,
//                'user_count' => $user->user_count,
//            ];
//        });

        $ads = Ad::with(['like', 'comment', 'share'])->where('brand_id', brand()->id())->latest()->paginate(9);

        return view('Brand.announce', compact('myTotalCommentsCount', 'myTotalUsersCount', 'myTotalLikesCount',
            'myTotalSharesCount', 'totalCommentsCount', 'totalLikesCount', 'totalUsersCount', 'myAllUsersCount',
            'likesByCity', 'commentsByCity', 'sharesByCity', 'usersByCity', 'ads'));
    }

    public function add_ad(AddAdRequest $request)
    {
        $data = $request->all();
        if ($request->image && $request->image != null) {
            $data['image'] = $this->saveImage($request->image, 'uploads/ad');
        }
        if ($request->video && $request->video != null) {
            $data['video'] = $this->saveImage($request->video, 'uploads/ad');
        }
        $data['brand_id'] = brand()->id();
        Ad::create($data);

        return response()->json(['message' => __('validation.added_successfully'), 'reset_form' => 'true']);
    }


}
