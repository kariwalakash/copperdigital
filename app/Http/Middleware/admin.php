<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $admin = md5($request->header('username'));
        $pass = md5(base64_decode($request->header('pass')));

        if ($admin != env('admin'))
            return response()->json(['message' => 'invalid token']);

        if ($pass != env('pass'))
            return response()->json(['message' => 'invalid token']);

        return $next($request);
    }
}
