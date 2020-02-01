<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Character;

use Illuminate\Support\Facades\Auth;

use Validator;


class CharacterController extends Controller

{
    public $successStatus = 200;

    /**
     * Create character api
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::guard('api')->user();
        $input = $request->all();
        if($user){
            $input = $request->all();

        $char = new Character;
        $char->user_id = $user->id;
        $char->name = $input['name'];
        $char->save();
            $char = new Character;
            $char->user_id = $user->id;
            $char->name = $input['name'];
            $char->save();

        return response()->json(['success' => 'true'], $this->successStatus);
            return response()->json(['success' => 'true'], $this->successStatus);
        }
        else{
            return response()->json(['error' => 'Session expired'], 401);
        }
    }

    /**
     * Character details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        $user = Auth::guard('api')->user();
        $input = $request->all();
        if($user){
            $input = $request->all();

        $char = $user->characters;
            $char = $user->characters;

        if(array_key_exists('charId', $input)){
            $char = $char->find($input['charId']);
            if(array_key_exists('charId', $input)){
                $char = $char->find($input['charId']);
            }

            return response()->json(['success' => $char], $this->successStatus);
        }

        return response()->json(['success' => $char], $this->successStatus);
        else{
            return response()->json(['error' => 'Session expired'], 401);
        }
        
    }
}
