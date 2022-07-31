<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function generateToken (Request $request) {
        $length = $request->get('length');
        if ( $length < 8 || $length > 24 )
            return response()->json(['success' => 'false', 'message' => 'invalid token length']);

        $dbToken = new Token();
        $dbToken->token = \Utility::generateRandomCharacters($length);
        $expiresAt = $request->get('validity');

        if ( $expiresAt > 0 )
            $dbToken->expires_at = Carbon::now()->addDays($expiresAt);
        else
            $dbToken->expires_at = Carbon::now()->addDays(30);

        $dbToken->save();

        return response()->json(['success' => 'true', 'data' => $dbToken]);


    }

    public function revokeToken (Request $request) {
        $token = $request->token;
        $dbToken = Token::where('token', $token)->where('expires_at', '<', Carbon::now())->first();

        if ( !isset($dbToken->id) )
            return response()->json(['message' => 'invalid token']);

        $dbToken->expires_at = Carbon::now();
        $dbToken->save();

        return response()->json(['success' => 'true']);
    }

    public function seeAllTokens (Request $request) {

        $dbTokens = Token::get();
        $respData = [];
        foreach ( $dbTokens as $token ) {

            $data = [
                'token' => $token->token,
                'expires_at' => $token->expires_at,
                'validity' => ($token->expires_at > Carbon::now()) ? 'active' : 'inactive'
            ];

            $respData[] = $data;
        }

        return response()->json(['success' => 'true', 'data' => $respData]);

    }


}
