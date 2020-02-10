<?php

namespace App\Http\Controllers\API;

use App\Guild;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuildControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Guild  $guild
     * @return \Illuminate\Http\Response
     */
    public function show(Guild $guild)
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
