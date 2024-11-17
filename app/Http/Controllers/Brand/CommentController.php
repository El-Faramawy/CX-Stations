<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Models\Ad;
use App\Models\AdComment;
use App\Models\AdLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    use NotificationTrait;

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

        $totalCommentsCount = Ad::whereHas('brand', function ($query) {
            $query->where('category_id', brand()->user()->category_id)->where('country_id', brand()->user()->country_id);
        })->withCount('comment')->get()->sum('comment_count');
        $totalLikesCount = Ad::whereHas('brand', function ($query) {
            $query->where('category_id', brand()->user()->category_id)->where('country_id', brand()->user()->country_id);
        })->withCount('like')->get()->sum('like_count');
//        $totalUsers = AdComment::whereHas('ad', function ($query){
//            $query->whereHas('brand', function ($query2){
//                $query2->where('category_id', brand()->user()->category_id);
//            });
//        })->pluck('user_id')->toArray();
//        $totalUsersCount = count(array_unique($totalUsers));
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

        $comments = AdComment::whereHas('ad', function ($query) {
            $query->where('brand_id', brand()->id());
        })->get();

        return view('Brand.comments', compact('myTotalCommentsCount', 'myTotalUsersCount', 'myTotalLikesCount',
            'totalCommentsCount', 'totalLikesCount', 'totalUsersCount', 'comments'));
    }

    public function view($id)
    {
        $comment = AdComment::where('id', $id)->first();
        return view('Brand.parts.comment-view-modal', compact('comment'))->render();
    }

    public function reply($id)
    {
        $comment = AdComment::where('id', $id)->first();
        return view('Brand.parts.comment-reply-modal', compact('comment'))->render();
    }

    public function add_comment_reply(Request $request)
    {
        $comment = AdComment::where('id', $request->id)->first();
        $this->sendAllNotifications([$comment->user_id], 'New reply to your comment', $request->reply, brand()->user()->image);
        $comment->update(['reply' => $request->reply]);
        my_toaster(__('validation.reply_sent_successfully'));
        return redirect()->back();
    }


}
