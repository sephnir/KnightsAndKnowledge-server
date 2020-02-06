<?php

namespace App\Http\Controllers;

use App\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($guild_token)
    {
        $guild = Auth::user()->guilds->where('guild_token', $guild_token)->first();

        if (!$guild) {
            return abort(404);
        }

        $quests = $guild->quests;

        return view('guilds/quests/list_quests', ['quests' => $quests, 'guild' => $guild]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($guild_token)
    {
        $guild = Auth::user()->guilds->where('guild_token', $guild_token)->first();

        if (!$guild) {
            return abort(404);
        }

        return view('guilds/quests/edit_quest', ['guild' => $guild]);
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
            'name' => 'required|max:255',
            'seed' => 'nullable|max:255',
            'level' => 'required|integer|digits_between:1,255'
        ]);

        $guild = Auth::user()->guilds->find($request->gid);

        if (!$guild) {
            return abort(404);
        }

        $quest = new Quest;
        $quest->guild_id = $guild->id;
        $quest->name = $request->name;
        $quest->boss = 0;
        $quest->dungeon_seed = $request->seed;
        $quest->level = $request->level;
        $quest->save();

        return redirect('/guild/' . $guild->guild_token);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quest  $quest
     * @return \Illuminate\Http\Response
     */
    public function show($quest_id)
    {
        $quest = Quest::find($quest_id);
        $guild = $quest->guild;
        $user = Auth::user();

        if ($user != $guild->user) {
            return abort(404);
        }

        return view('guilds/quests/manage_quest', ['guild' => $guild, 'quest' => $quest]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quest  $quest
     * @return \Illuminate\Http\Response
     */
    public function edit($quest_id)
    {
        $quest = Quest::find($quest_id);
        $guild = $quest->guild;
        $user = Auth::user();

        if ($user != $guild->user) {
            return abort(404);
        }

        return view('guilds/quests/edit_quest', ['guild' => $guild, 'quest' => $quest]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quest  $quest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'seed' => 'nullable|max:255',
            'level' => 'required|integer|digits_between:1,255'
        ]);

        $quest = Auth::user()->guilds->find($request->gid)->quests->find($request->id);

        if (!$quest) {
            return abort(404);
        }

        $quest->name = $request->name;
        $quest->dungeon_seed = $request->seed;
        $quest->level = $request->level;
        $quest->save();

        return redirect('/quest/' . $quest->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quest  $quest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quest $quest)
    {
        //
    }
}
