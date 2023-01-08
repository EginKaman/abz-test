<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $timestamp = now()->timestamp;
        $token = Crypt::encryptString($timestamp);
        return response()->json([
            'success' => true,
            'timestamp' => $timestamp,
            'token' => $token,
            'decrypted' => Crypt::decryptString($token)
        ]);
    }
}
