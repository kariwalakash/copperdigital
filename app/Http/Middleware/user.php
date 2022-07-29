<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class user {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle (Request $request, Closure $next) {
        if ( !isset($request->token) )
            return response()->json(['message' => 'unauthethicated']);

        $token = $request->token;
        $dbToken = Token::where('token_data', $token)->where('expires_at', '<', Carbon::now())->first();
        if (!isset($dbToken->id))
            return response()->json(['message' => 'invalid token']);

        return $next($request);
    }
}
