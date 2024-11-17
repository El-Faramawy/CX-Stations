<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ad\AdCommentRequest;
use App\Http\Requests\Api\Ad\AdLikeRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\Ad;
use App\Models\AdComment;
use App\Models\AdLike;
use App\Models\AdShare;
use App\Models\AdView;

class AdController extends Controller
{
    use PaginateTrait;

    public function like(AdLikeRequest $request)
    {
        $credits = ['ad_id' => $request['ad_id'], 'user_id' => user_api()->id()];
        $ad_like = AdLike::where($credits);
        if ($ad_like->exists()) {
            $ad_like->delete();
            $data = null;
        } else {
            $data = AdLike::create($credits);
        }

        return $this->apiResponse($data, 'done', 'simple');
    }

    public function comment(AdCommentRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = user_api()->id();
        $data = AdComment::create($data);
        return $this->apiResponse($data, 'done', 'simple');
    }

    public function share(AdLikeRequest $request)
    {
        $data = Ad::where('id', $request->ad_id)->first();
        $data->update(['share_number' => ($data->share_number + 1)]);

        $credits = ['ad_id' => $request['ad_id'], 'user_id' => user_api()->id()];
        AdShare::create($credits);

        return $this->apiResponse($data, 'done', 'simple');
    }

    public function view(AdLikeRequest $request)
    {
        $data = Ad::where('id', $request->ad_id)->first();
        $data->update(['view_number' => ($data->view_number + 1)]);
        return $this->apiResponse($data, 'done', 'simple');
    }

    public function one_ad(AdLikeRequest $request)
    {
        $data = Ad::where('id', $request->ad_id)
            ->with('brand:id,name,image,status')
            ->withCount('like')
            ->withCount('comment')
            ->first();
        $adViewData = ['ad_id' => $request->ad_id , 'user_id' => user_api()->id()];
        if (!AdView::where($adViewData)->exists()) {
            AdView::create($adViewData);
            $data->update(['view_number' => ($data->view_number + 1)]);
        }
        $data['brand']['follow_count'] = $data->brand->follow?->count();
        unset($data['brand']['follow']);
        return $this->apiResponse($data, 'done', 'simple');
    }

}
