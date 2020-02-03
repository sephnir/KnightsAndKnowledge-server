<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\Character;

use Illuminate\Support\Facades\Auth;

use Validator;


class CharacterControllerAPI extends Controller

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
        if(!$user){
            return response()->json(['error' => 'Session expired'], 401);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->first()], 400);
        }
        
        $input = $request->all();

        $char = new Character;
        $char->user_id = $user->id;
        $char->name = $input['name'];
        $char->save();

        return response()->json(['success' => 'true'], $this->successStatus);
    }

    /**
     * Character details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        $user = Auth::guard('api')->user();
        if(!$user){
            return response()->json(['error' => 'Session expired'], 401);
        }
        
        $input = $request->all();

        $char = $user->characters;

        if(array_key_exists('charId', $input)){
            $char = $char->find($input['charId']);
        }

        return response()->json(['success' => $char], $this->successStatus);

    }
}
