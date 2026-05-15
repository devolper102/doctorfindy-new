<?php

namespace App;

use RtcTokenBuilder;
// require_once app_path('Services/Agora/RtcTokenBuilder.php');
// use App\Services\Agora\RtcTokenBuilder;
class AgoraService
{
    public function generateRtcToken($channelName, $uid)
    {
        // dd($channelName, $uid);
        require_once app_path('Services/Agora/RtcTokenBuilder.php');
        // $appID = "78f8446472264988ac300aa429e2e014";
        // $appCertificate = "091faf6289c4400fbce7a5ae2c466031";
        $appID = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERT');
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 3600; // 1 hour token validity
        $currentTimestamp = (new \DateTime())->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
        $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
        $encryptionKey = bin2hex(random_bytes(32));
        // return $token;
        return [
            'token' => $token,
            'encryption_key' => $encryptionKey,
            // 'encryption_salt' => $encryptionSalt,
        ];
    }
}
