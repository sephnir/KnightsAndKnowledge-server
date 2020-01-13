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
    public function create_character(Request $request)
    {
        $user = Auth::guard('api')->user();
        $input = $request->all();

        $char = new Character;
        $char->user_id = $user->id;
        $char->name = $input['name'];
        $char->save();

        return response()->json(['success' => 'true'], $this->successStatus);
    }
}
