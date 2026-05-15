<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenController extends Controller
{
    public function generateToken(Request $request)
    {
        $agoraAppId="78f8446472264988ac300aa429e2e014";
        $agoraAppCert="091faf6289c4400fbce7a5ae2c466031";
        $channelName = $request->query('channelName');
        $userId = $request->query('userId');
        $role = $request->query('role');
        $token_type = $request->query('token_type');

        
        if (!$channelName || !$userId) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }
        $expirationTime = now()->addHours(24)->timestamp;
        $payload = [
            'channelName' => $channelName,
            'userId' => $userId,
            'role' => $role,
            'token_type' => $token_type,
            'exp' => $expirationTime,
            'agoraAppId' => $agoraAppId,
            'agoraAppCert' => $agoraAppCert
        ];
        $jwtSecret = env('JWT_SECRET');
        $token = JWT::encode($payload, $jwtSecret, 'HS256');
        return response()->json(['token' => $token]);
    }
}
