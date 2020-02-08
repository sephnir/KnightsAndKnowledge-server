<?php

namespace App\Http\Controllers;

use App\Guild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class GuildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guilds = Auth::user()->guilds;

        return view('guilds/list_guilds', ['guilds' => $guilds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    private function unique_token()
    {
        do {
            $token = strtoupper(Str::random(6));
            $exist = Guild::where('guild_token', $token)->first();
        } while (!empty($exist));

        return $token;
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
            'name' => 'required|max:255'
        ]);

        $name = $request->name;

        $guild = new Guild;
        $guild->name = $name;
        $guild->guild_token = self::unique_token();
        $guild->creator_user_id = Auth::id();
        $guild->save();

        return redirect('guilds');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guild  $guild
     * @return \Illuminate\Http\Response
     */
    public function show(Guild $guild)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guild  $guild
     * @return \Illuminate\Http\Response
     */
    public function edit(Guild $guild)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guild  $guild
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guild $guild)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guild  $guild
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guild $guild)
    {
        //
    }
}
