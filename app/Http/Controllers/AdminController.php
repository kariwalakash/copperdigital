<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function generateToken (Request $request) {
        $length = $request->get('length');
        if ( $length < 8 || $length > 24 )
            return;

        $dbToken = new Token();
        $dbToken->token_data = \Utility::generateRandomCharacters($length);
        $expiresAt = $request->get('validity');

        if ( $expiresAt > 0 )
            $dbToken->expires_at = Carbon::now()->addDays($expiresAt);
        else
            $dbToken->expires_at = Carbon::now()->addDays(30);

        $dbToken->save();

        return [];


    }

    public function revokeToken (Request $request) {
        $token = $request->token;
        $dbToken = Token::where('token_data', $token)->where('expires_at', '<', Carbon::now())->first();

        if ( !isset($dbToken->id) )
            return response()->json(['message' => 'invalid token']);

        $dbToken->expires_at = Carbon::now();
        $dbToken->save();

        return [];
    }

    public function seeAllTokens (Request $request) {
        $token = $request->token;
        $dbTokens = Token::get();
        $respData = [];
        foreach ( $dbTokens as $token ) {

        }

        return response()->json(['message' => 'invalid token']);
    }


}
