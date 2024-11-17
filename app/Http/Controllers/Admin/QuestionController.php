<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Question\StoreQuestionRequest;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Question::latest();
            return Datatables::of($data)
                ->addColumn('action', function ($item) {
                    return tableAction($item->id, true, true);
                })->addColumn('category', function ($item) {
                    return $item->category->name_ar ?? '';
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Question.index');
    }

    public function create()
    {
        $categories = Category::all();
        $answers = Answer::all();
        return view('Admin.Question.parts.create', compact('categories', 'answers'))->render();
    }

    public function store(StoreQuestionRequest $request)
    {
        $data = $request->except('question_answers');
        $question = Question::create($data);
        if ($request->question_answers) {
            foreach ($request['question_answers'] as $answer) {
                QuestionAnswer::create([
                    'question_id' => $question->id,
                    'answer_id' => $answer
                ]);
            }
        }
        return response()->json(['message' => 'تم الاضافة بنجاح ']);
    }

    public function edit(Question $question)
    {
        $categories = Category::all();
        $answers = Answer::all();
        $selectedQuestionAnswersIds = $question->answers()->pluck('answer_id')->toArray();
        return view('Admin.Question.parts.edit', compact('question', 'categories','answers','selectedQuestionAnswersIds'));
    }

    public function update(StoreQuestionRequest $request, Question $question)
    {
        $data = $request->except('question_answers');
        $question->update($data);
        QuestionAnswer::where('question_id', $question->id)->delete();
        if ($request->question_answers) {
            foreach ($request['question_answers'] as $answer) {
                QuestionAnswer::create([
                    'question_id' => $question->id,
                    'answer_id' => $answer
                ]);
            }
        }
        return response()->json(['message' => 'تم التعديل بنجاح ']);
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        Question::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }


}
