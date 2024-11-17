<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Models\Ad;
use App\Models\Coupon;
use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    use NotificationTrait;

    public function index(Request $request)
    {
//        return app()->getLocale();
        $counts = $this->getCounts();
        $questions = $this->getQuestionsByPeriod($request->questionPeriod);
//        $coupons = $this->getCouponsByPeriod($request->couponPeriod);
        $coupons = $this->getCouponsByStatus($request->status);

        return view('Brand.index', [
            'commentsChange' => $counts['commentsChange'],
            'likesChange' => $counts['likesChange'],
            'sharesChange' => $counts['sharesChange'],
            'surveyLikesChange' => $counts['surveyLikesChange'],
            'currentMonthComments' => $counts['currentMonthComments'],
            'currentMonthLikes' => $counts['currentMonthLikes'],
            'currentMonthShares' => $counts['currentMonthShares'],
            'currentMonthSurveyLikes' => $counts['currentMonthSurveyLikes'],
            'questions' => $questions,
            'coupons' => $coupons,
        ]);
    }

    public function getCounts()
    {
        // Current month: from today to exactly one month ago
        $currentMonthStart = now()->subMonth()->startOfDay();  // Start from exactly one month ago
        $currentMonthEnd = now()->endOfDay();  // Till the end of today

        // Previous month: from one month ago to two months ago (same day last month)
        $previousMonthStart = now()->subMonths(2)->startOfDay();  // Two months ago (start of day)
        $previousMonthEnd = now()->subMonth()->endOfDay();  // End of day one month ago

        // Total Comments (Current Month)
        $currentMonthComments = Ad::where('brand_id', brand()->id())
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->withCount('comment')
            ->get()
            ->sum('comment_count');

        // Total Comments (Previous Month)
        $previousMonthComments = Ad::where('brand_id', brand()->id())
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->withCount('comment')
            ->get()
            ->sum('comment_count');

        // Total Likes (Current Month)
        $currentMonthLikes = Ad::where('brand_id', brand()->id())
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->withCount('like')
            ->get()
            ->sum('like_count');

        // Total Likes (Previous Month)
        $previousMonthLikes = Ad::where('brand_id', brand()->id())
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->withCount('like')
            ->get()
            ->sum('like_count');

        // Total Shares (Current Month)
        $currentMonthShares = Ad::where('brand_id', brand()->id())
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->sum('share_number');

        // Total Shares (Previous Month)
        $previousMonthShares = Ad::where('brand_id', brand()->id())
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->sum('share_number');

        // Survey Likes (Current Month)
        $currentMonthSurveyLikes = Survey::where(['brand_id' => brand()->id(), 'status' => 1])
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->count();

        // Survey Likes (Previous Month)
        $previousMonthSurveyLikes = Survey::where(['brand_id' => brand()->id(), 'status' => 1])
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->count();

        // Calculate percentage changes
        $commentsChange = $this->calculatePercentageChange($currentMonthComments, $previousMonthComments);
        $likesChange = $this->calculatePercentageChange($currentMonthLikes, $previousMonthLikes);
        $sharesChange = $this->calculatePercentageChange($currentMonthShares, $previousMonthShares);
        $surveyLikesChange = $this->calculatePercentageChange($currentMonthSurveyLikes, $previousMonthSurveyLikes);

        return [
            'commentsChange' => $commentsChange,
            'likesChange' => $likesChange,
            'sharesChange' => $sharesChange,
            'surveyLikesChange' => $surveyLikesChange,
            'currentMonthComments' => $currentMonthComments,
            'currentMonthLikes' => $currentMonthLikes,
            'currentMonthShares' => $currentMonthShares,
            'currentMonthSurveyLikes' => $currentMonthSurveyLikes,
        ];
    }

    public function calculatePercentageChange($current, $previous)
    {
        if ($previous > 0) {
            return (($current - $previous) / $previous) * 100;
        } elseif ($current > 0) {
            return 100; // If previous month is 0 but current month has values, consider 100% increase
        } else {
            return 0; // No change if both months have 0
        }
    }

    public function getQuestionsByPeriod($period = 'all')
    {
        $query = Question::where('category_id', brand()->user()->category_id)->whereHas('question_answers');

        switch ($period) {
            case 'monthly':
                // From today to exactly one month ago
                $start = Carbon::now()->subMonth()->startOfDay();
                $end = Carbon::now()->endOfDay();
                $query->with(['userAnswers' => function ($query) use ($start, $end) {
                    $query->where('brand_id', brand()->id())
                        ->whereBetween('created_at', [$start, $end]);
                }]);
                break;

            case 'yearly':
                // From today to exactly one year ago
                $start = Carbon::now()->subYear()->startOfDay();
                $end = Carbon::now()->endOfDay();
                $query->with(['userAnswers' => function ($query) use ($start, $end) {
                    $query->where('brand_id', brand()->id())
                        ->whereBetween('created_at', [$start, $end]);
                }]);
                break;

            case 'quarter':
                // Calculate the previous quarter range
                $now = Carbon::now();
                $currentQuarter = ceil($now->month / 3);
                $lastQuarter = $currentQuarter - 1;

                if ($lastQuarter == 0) {
                    // Q4 of the previous year
                    $start = Carbon::create($now->year - 1, 10, 1)->startOfDay();  // October 1st, last year
                    $end = Carbon::create($now->year - 1, 12, 31)->endOfDay();     // December 31st, last year
                } else {
                    // Previous quarter within the same year
                    $start = Carbon::create($now->year, ($lastQuarter * 3) - 2, 1)->startOfDay();  // Quarter start
                    $end = Carbon::create($now->year, ($lastQuarter * 3), 1)->endOfMonth();        // Quarter end
                }

                $query->with(['userAnswers' => function ($query) use ($start, $end) {
                    $query->where('brand_id', brand()->id())
                        ->whereBetween('created_at', [$start, $end]);
                }]);
                break;

            case 'all':
            default:
                // All-time: no date filters, return all questions
                $query->with(['userAnswers' => function ($query) {
                    $query->where('brand_id', brand()->id());
                }]);
                break;
        }

        return $query->get()->map(function ($question) {
            // Calculate the average percentage for the question's answers
            $question->avg_percentage = $question->userAnswers->avg('percentage') ?? 0;
            return $question;
        });
    }


    public function getCouponsByStatus($status = null)
    {
        $now = Carbon::now('Asia/Riyadh');

        Coupon::whereDoesntHave('duet_user')->where('brand_id', brand()->id())->
        whereRaw('TIMESTAMPADD(HOUR, hours, created_at) < ?', [$now])->update(['status' => 'rejected']);

        if ($status == null || !in_array($status, ['pending', 'complete', 'rejected'])) {
            return Coupon::whereDoesntHave('duet_user')->where('brand_id', brand()->id())->latest()->get();
        }
        return Coupon::whereDoesntHave('duet_user')->where(['brand_id' => brand()->id(), 'status' => $status])->latest()->get();
    }

    public function getCouponsByPeriod($period = null)
    {
        $query = Coupon::where('brand_id', brand()->id());

        if ($period) {
            switch ($period) {
                case 'monthly':
                    // From today to a month ago (inclusive)
                    $start = Carbon::now()->subMonth()->startOfDay();  // Start from exactly one month ago
                    $end = Carbon::now()->endOfDay();  // Till the end of today
                    $query->whereBetween('created_at', [$start, $end]);
                    break;

                case 'yearly':
                    // From today to a year ago (inclusive)
                    $start = Carbon::now()->subYear()->startOfDay();  // Start from exactly one year ago
                    $end = Carbon::now()->endOfDay();  // Till the end of today
                    $query->whereBetween('created_at', [$start, $end]);
                    break;

                case 'quarter':
                    // From today to the start of the previous quarter (inclusive)
                    $now = Carbon::now();
                    $currentQuarter = ceil($now->month / 3);
                    $lastQuarter = $currentQuarter - 1;

                    if ($lastQuarter == 0) {
                        // Q4 of the previous year
                        $start = Carbon::create($now->year - 1, 10, 1);  // Q4 starts in October
                        $end = Carbon::create($now->year, $now->month, $now->day)->endOfDay();    // Until today
                    } else {
                        // Get the start and end dates of the last quarter
                        $start = Carbon::create($now->year, ($lastQuarter * 3) - 2, 1)->startOfDay();  // Quarter start
                        $end = Carbon::now()->endOfDay();  // Until today
                    }

                    $query->whereBetween('created_at', [$start, $end]);
                    break;
                default:
                    // If an invalid period is provided, return all coupons
                    break;
            }
        }

        return $query->get();
    }

    public function send_survey(Request $request)
    {
        $data = $request->all();
        $data['brand_id'] = brand()->id();
        Survey::create($data);
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $this->sendAllNotifications([$user->id], 'New survey for You ', 'New survey for You ', brand()->user()->image);
        }
        return response()->json(['message' => __('validation.survey_sent_successfully'), 'reset_form' => 'true']);
    }

    public function changeStatus(Request $request)
    {
        $coupon = Coupon::find($request->id);
        if ($coupon) {
            $coupon->total_purchases = $request->total_purchase;
            $coupon->total_after_discount = $request->total_after_discount;
            $coupon->status = 'complete';
            $coupon->save();
            return response()->json(['success' => true, 'message' => __('validation.status_updated_successfully')]);
        }
        return response()->json(['success' => false, 'message' => __('validation.coupon_not_found')]);
    }


}
