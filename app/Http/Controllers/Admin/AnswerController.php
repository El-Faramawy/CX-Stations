<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Answer\StoreAnswerRequest;
use App\Models\Answer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AnswerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $answers = Answer::latest();
            return Datatables::of($answers)
                ->addColumn('action', function ($item) {
                    return tableAction($item->id, true,true);
                })->addColumn('checkbox', function ($item) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $item->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.Answer.index');
    }

    public function create()
    {
        return view('Admin.Answer.parts.create')->render();
    }

    public function store(StoreAnswerRequest $request)
    {
        $data = $request->all();
        Answer::create($data);
        return response()->json(['message' => 'تم الاضافة بنجاح ']);
    }

    public function edit(Answer $answer)
    {
        return view('Admin.Answer.parts.edit', compact('answer'));
    }

    public function update(StoreAnswerRequest $request, Answer $answer)
    {
        $data = $request->all();
        $answer->update($data);

        return response()->json(['message' => 'تم التعديل بنجاح ']);
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        Answer::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }


}
