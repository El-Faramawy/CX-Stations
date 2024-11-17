<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Question;
use App\Models\UserAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $questions = $this->getQuestionsByPeriod($request->questionPeriod);
        $questionsChange = $this->getQuestionData($request->surveyPeriod);
        return view('Brand.dashboard', [
            'questions' => $questions,
            'questionsChange' => $questionsChange,
        ]);
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

    public function getQuestionData($period = 'all')
    {
        $brandId = brand()->id();

        $currentEnd = Carbon::now()->endOfDay(); // The end of the current day
        $currentStart = null;
        $previousStart = null;
        $previousEnd = null;

        switch ($period) {
            case 'monthly':
                $currentStart = Carbon::now()->subMonth(); // One month ago from today
                $previousStart = Carbon::now()->subMonths(2); // Two months ago from today
                $previousEnd = Carbon::now()->subMonth()->subDay(); // One day before the current period starts
                break;

            case 'quarter':
                $currentStart = Carbon::now()->subMonths(3); // Three months ago
                $previousStart = Carbon::now()->subMonths(6); // Six months ago
                $previousEnd = Carbon::now()->subMonths(3)->subDay(); // One day before the current period starts
                break;

            case 'yearly':
                $currentStart = Carbon::now()->subYear(); // One year ago from today
                $previousStart = Carbon::now()->subYears(2); // Two years ago
                $previousEnd = Carbon::now()->subYear()->subDay(); // One day before the current period starts
                break;

            case 'all':
            default:
                break;
        }

        // Query questions with the same category as the brand
        $questions = Question::where('category_id', brand()->user()->category_id)->whereHas('question_answers')
            ->with(['userAnswers' => function ($query) use ($currentStart, $currentEnd) {
                if ($currentStart) {
                    $query->whereBetween('created_at', [$currentStart, $currentEnd]);
                }
            }])->get();
        $result = [];

        foreach ($questions as $question) {
            // Get users count and percentages for the current period
            $uniqueQuestionData = $question->userAnswers()->where('brand_id', $brandId)->distinct('survey_id');
            $nowUsersCount = $uniqueQuestionData->count('survey_id');
            $nowPercentageSum = $uniqueQuestionData->get()->sum('percentage');
            $nowPercentage = $nowUsersCount > 0 ? ($nowPercentageSum / $nowUsersCount) : 0;
            // Get users count and percentages for the previous period
            if ($previousStart && $previousEnd) {
                $previousUsersCount = UserAnswer::where('question_id', $question->id)
                    ->where('brand_id', $brandId)
                    ->whereBetween('created_at', [$previousStart, $previousEnd])
                    ->count();

                $previousPercentageSum = UserAnswer::where('question_id', $question->id)
                    ->where('brand_id', $brandId)
                    ->whereBetween('created_at', [$previousStart, $previousEnd])
                    ->sum('percentage');

                $previousPercentage = $previousUsersCount > 0 ? ($previousPercentageSum / $previousUsersCount) : 0;
            } else {
                $previousUsersCount = 0;
                $previousPercentage = 0;
            }

            // Calculate the percentage change
            if ($previousPercentage > 0) {
                $compare = (($nowPercentage - $previousPercentage) / $previousPercentage) * 100;
            } else {
                if ($nowPercentage > 0) {
                    $compare = 100;
                } else {
                    $compare = 0;
                }
            }

            // Format the data as required
            $result[] = [
                'question' => $question['question_' . app()->getLocale()],
                'users' => $nowUsersCount,
                'now' => round($nowPercentage, 2),
                'previous' => round($previousPercentage, 2),
                'compare' => round($compare, 2),
            ];
        }

        return $result;
    }

}
