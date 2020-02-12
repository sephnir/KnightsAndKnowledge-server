<?php

namespace App\Http\Controllers\API;

use App\Guild;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestControllerAPI extends Controller
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
        $guild = Guild::where('guild_token', $request->token ?? '')->first();

        if (!($guild->id ?? ''))
            return response()->json(['error' => 'No quests available currently in this guild.'], 404);

        $quests = $guild->quests()->has('topics')->get();

        if ($quests)
            return response()->json(['success' => $quests], $this->successStatus);
        else
            return response()->json(['error' => 'No quests available currently in this guild.'], 404);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
