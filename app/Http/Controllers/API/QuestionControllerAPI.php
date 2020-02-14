<?php

namespace App\Http\Controllers\API;

use App\Quest;
use App\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionControllerAPI extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::guard('api')->user();
        if(!$user)
            return response()->json(['error' => 'Session expired'], 401);

        $topics = Quest::find($request->quest_id)->topics()->select("id")->get();
        $topics_arr = [];
        foreach($topics as $topic){
            $questions = $topic->questions()->select("id","question","type")->get();
            foreach($questions as $question){
                $answers = $question->answers()->select("id","answer","correct")->get();
                $question->answers = $answers;
            }

            if(count($questions) > 0){
                $topic->questions = $questions;
                array_push($topics_arr, $topic);
            }
        }

        return response()->json(['success' => $topics_arr], $this->successStatus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = Auth::guard('api')->user();
        if(!$user)
            return response()->json(['error' => 'Session expired'], 401);

        $answers = Question::find($request->question_id)->answers;

        return response()->json(['success' => $answers], $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
