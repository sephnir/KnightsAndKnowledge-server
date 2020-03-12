<?php

namespace App\Http\Controllers\API;

use DB;
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
        if (!$user)
            return response()->json(['error' => 'Session expired'], 401);

        $guild = Guild::where('guild_token', $request->token ?? '')->first();

        if (!($guild->id ?? ''))
            return response()->json(['error' => 'No quests available currently in this guild.'], 404);

        $quests = $guild->quests()->has('topics')->get();
        $quest_arr = [];

        foreach ($quests as $quest) {
            if (sizeof($quest->topics()->has('questions')->get()) > 0) {
                array_push($quest_arr, $quest);
            }
        }

        if (sizeof($quest_arr) > 0)
            return response()->json(['success' => $quest_arr], $this->successStatus);
        else
            return response()->json(['error' => 'No quests available currently in this guild.'], 404);
    }

    /**
     * Clears a quest while adding rewards to a character.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clear(Request $request)
    {
        $user = Auth::guard('api')->user();
        if (!$user)
            return response()->json(['error' => 'Session expired'], 401);

        $guild = Guild::where('guild_token', $request->token ?? '')->first();
        if (!$guild) return response()->json(['error' => 'Invalid guild token'], 401);
        $quest = $guild->quests()->find($request->questID);
        if (!$quest) return response()->json(['error' => 'Invalid quest ID'], 401);
        $character = $user->characters()->find($request->characterID);
        if (!$character) return response()->json(['error' => 'Invalid character ID'], 401);

        $reward = $request->reward;
        $max_reward = 0;
        $diff = 0;
        $character = $quest->characters()->withPivot("max_reward")->find($request->characterID);
        if ($character) {
            $max_reward = $character->pivot->max_reward;
        }
        if ($reward > $max_reward) {
            $diff = $reward - $max_reward;
        }
        $reward = max($reward, $max_reward);

        $character->money += $diff;

        DB::beginTransaction();
        try {
            $character->save();
            $quest->characters()->sync([
                $request->characterID => [
                    'max_reward' => $reward
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return response()->json(['success' => true], $this->successStatus);
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
