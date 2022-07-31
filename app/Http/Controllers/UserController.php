<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login (Request $request) {
//        $token = $request->token;
//        $dbToken = Token::where('token', $token)->where('expires_at', '<', Carbon::now())->first();
//
//        if ( !isset($dbToken->id) )
//            return response()->json(['message' => 'login failed']);

        //ths route already comes with the tests done in middleware

        return response()->json(['message' => 'successful login']);
    }

    public function validateToken (Request $request) {
        $token = $request->token;
        $dbToken = Token::where('token', $token)->where('expires_at', '>', Carbon::now())->first();

        if ( !isset($dbToken->id) )
            return response()->json(['message' => 'invalid token']);

        return response()->json(['message' => 'valid token']);

    }
}
