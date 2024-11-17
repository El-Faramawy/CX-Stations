<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Brand\BrandProfileRequest;
use App\Http\Requests\Api\Survey\StoreRateRequest;
use App\Http\Requests\Api\Survey\StoreSurveyRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\Brand;
use App\Models\Question;
use App\Models\Rate;
use App\Models\Survey;
use App\Models\UserAnswer;

class SurveyController extends Controller
{
    use PaginateTrait;

    public function surveys()
    {
        $data = [];
        $recent_surveys = Survey::where(['phone'=> user_api()->user()->phone , 'status' => 0])
            ->with('brand:id,name,image');
        $data['recent_surveys'] = $recent_surveys->latest()->get();

        $previous_surveys = Survey::where(['phone'=> user_api()->user()->phone , 'status' => 1])
            ->with('brand:id,name,image');
        $data['previous_surveys'] = $previous_surveys->latest()->get();

        return $this->apiResponse($data, '', 'simple');
    }

    public function questions(BrandProfileRequest $request)
    {
        $category_id = Brand::find($request->brand_id)->category_id;
        $data = Question::with('answers')->whereHas('answers')->where('category_id', $category_id)->get();
        return $this->apiResponse($data, '', 'simple');
    }

    public function create(StoreSurveyRequest $request)
    {
        $this->storeUserAnswers($request['questions'],$request->survey_id,$request->brand_id);

        $survey = Survey::find($request->survey_id);
        $survey->update(['status'=>1]);

        $user = user_api()->user();
        $user->update(['points'=>($user->points + 30)]);

        return $this->apiResponse($survey, '', 'simple');
    }

    public function rate(StoreRateRequest $request)
    {
        $data = $request->only('brand_id', 'rate');
        $data['user_id'] = user_api()->id();
        $rate = Rate::create($data);

        $brand = $rate->brand;
        $average_rate = Rate::where('brand_id', $brand['id'])->pluck('rate')->avg() ?: 0;
        $brand['rate'] = round($average_rate,1);
        $brand->save();

//        if ($request['questions']) {
//            $this->storeUserAnswers($request['questions'],$request->survey_id,$request->brand_id);
//        }

//        $user = user_api()->user();
//        $user->update(['points'=>($user->points + 20)]);

        return $this->apiResponse($rate, '', 'simple');
    }

    public function storeUserAnswers($questions , $survey_id , $brand_id)
    {
        foreach ($questions as $question) {
            UserAnswer::create([
                'user_id' => user_api()->id(),
                'survey_id' => $survey_id,
                'brand_id' => $brand_id,
                'question_id' => $question['id'],
                'percentage' => $question['percentage'],
            ]);
        }
    }

}
