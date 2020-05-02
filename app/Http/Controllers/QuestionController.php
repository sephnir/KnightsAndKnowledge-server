<?php

namespace App\Http\Controllers;

use DB;
use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($topic_id)
    {
        $topic = Auth::user()->topics->find($topic_id);

        if (!$topic) {
            return abort(404);
        }

        $questions = $topic->questions;

        return view('topics/questions/list_questions', ['questions' => $questions, 'topic' => $topic]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($topic_id)
    {
        $topic = Auth::user()->topics->find($topic_id);

        if (!$topic) {
            return abort(404);
        }

        return view('topics/questions/edit_question', ['topic' => $topic]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|max:512',
            'ans0' => 'required|max:255',
            'ans1' => 'required|max:255',
            'ans2' => 'required|max:255',
            'ans3' => 'required|max:255',
            'correct' => 'required|integer|digits_between:0,3'
        ]);

        $topic = Auth::user()->topics->find($request->topic_id);

        if (!$topic) {
            return abort(404);
        }

        DB::beginTransaction();

        try {
            $question = new Question;
            $question->question = $request->question;
            $question->type = "mcq";
            $question->topic_id = $request->topic_id;
            $question->save();

            $ans_str = [$request->ans0, $request->ans1, $request->ans2, $request->ans3];
            for ($i = 0; $i < 4; $i++) {
                $answer = new Answer;
                $answer->answer = $ans_str[$i];
                $answer->correct = $request->correct == $i;
                $answer->question_id = $question->id;
                $answer->save();
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return redirect('/topic/' . $topic->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        $answers = $question->answers;
        $topic = $question->topic;
        $user = Auth::user();

        if (!$topic) {
            return abort(404);
        }

        if ($user != $topic->user) {
            return abort(404);
        }

        return view('topics/questions/edit_question', ['topic' => $topic, 'question' => $question, 'answers' => $answers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|max:512',
            'ans0' => 'required|max:255',
            'ans1' => 'required|max:255',
            'ans2' => 'required|max:255',
            'ans3' => 'required|max:255',
            'correct' => 'required|integer|digits_between:0,3'
        ]);

        $topic = Auth::user()->topics->find($request->topic_id);
        if (!$topic) {
            return abort(404, "Unable to retrieve 'Topic'");
        }

        $question = $topic->questions->find($request->id);
        if (!$question) {
            return abort(404, "Unable to retrieve 'Question'");
        }

        $answers = $question->answers;

        DB::beginTransaction();

        try {
            $question->question = $request->question;
            $question->type = "mcq";
            $question->save();

            $ans_str = [$request->ans0, $request->ans1, $request->ans2, $request->ans3];
            for ($i = 0; $i < 4; $i++) {
                $answers[$i]->answer = $ans_str[$i];
                $answers[$i]->correct = $request->correct == $i;
                $answers[$i]->save();
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return redirect('/topic/' . $topic->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
