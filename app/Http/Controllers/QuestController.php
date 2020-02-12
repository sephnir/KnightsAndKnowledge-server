<?php

namespace App\Http\Controllers;

use DB;
use App\Quest;
use App\Topic;
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

        $quests = $guild->quests()->select("quests.*")
            ->select("quests.*", DB::raw("COUNT(topics.id) as topic_count"))
            ->leftjoin("topics_in_quests", "quests.id", "=", "topics_in_quests.quest_id")
            ->leftjoin("topics", "topics_in_quests.topic_id", "=", "topics.id")
            ->groupBy(DB::getSchemaBuilder()->getColumnListing('quests'))
            ->get();


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

        $topics = $user->topics;
        $topics_active = $quest->topics;

        return view('guilds/quests/manage_quest', [
            'guild' => $guild,
            'quest' => $quest,
            'topics' => $topics,
            'topics_active' => $topics_active
        ]);
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
     * Update the relationship between quest and topic
     */
    public function sync(Request $request)
    {
        $topics_id = $request->topic;

        foreach ($topics_id as $topic_id) {
            $user = Auth::user();
            $topic = Topic::find($topic_id);
            if (!$topic) {
                $topics_id = \array_diff($topics_id, [$topic_id]);
            } else if ($topic->user != $user) {
                $topics_id = \array_diff($topics_id, [$topic_id]);
            }
        }

        $quest = Quest::find($request->quest_id);
        $guild = $quest->guild;
        $user = Auth::user();

        if ($user != $guild->user) {
            return abort(404);
        }

        $quest->topics()->sync($topics_id);

        return self::show($request->quest_id);
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
