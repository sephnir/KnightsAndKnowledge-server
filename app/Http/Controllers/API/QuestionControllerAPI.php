<?php

namespace App\Http\Controllers\API;

use App\Quest;
use App\Question;
use App\Guild;
use App\Attempt;
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
     * Update the quest with new attempts.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attempt(Request $request){
        $user = Auth::guard('api')->user();
        if (!$user)
            return response()->json(['error' => 'Session expired'], 401);

        $guild = Guild::where('guild_token', $request->token ?? '')->first();
        if(!$guild) return response()->json(['error' => 'Invalid guild token'], 401);
        $quest = $guild->quests()->find($request->questID);
        if(!$quest) return response()->json(['error' => 'Invalid quest ID'], 401);
        $topic = $quest->topics()->find($request->topicID);
        if(!$topic) return response()->json(['error' => 'Invalid topic ID'], 401);
        $question = $topic->questions()->find($request->questionID);
        if(!$question) return response()->json(['error' => 'Invalid question ID'], 401);
        
        $attempt = new Attempt;
        $attempt->question_id = $request->questionID;
        $attempt->user_id = $user->id;
        $attempt->answer_id = $request->answerID;

        $attempt->save();

        return response()->json(['success' => 'true'], $this->successStatus);
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
