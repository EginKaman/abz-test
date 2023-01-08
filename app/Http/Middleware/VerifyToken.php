<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Crypt;

class VerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($token = $request->header('Token')) {
            $timestamp = (int) Crypt::decryptString($token);

            if ($timestamp <= ($timestamp + (40 * 60 * 60))) {
                return $next($request);
            }
        }

        throw new TokenMismatchException('Token mismatch.');
    }
}
