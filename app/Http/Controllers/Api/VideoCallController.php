<?php

namespace App\Http\Controllers\Api;

// use App\AgoraService;
use App\AgoraService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Services\Agora\RtcTokenBuilder;
class VideoCallController extends Controller
{
    protected $agoraService;

    public function __construct(AgoraService $agoraService)
    {
        $this->agoraService = $agoraService;
    }

    public function getRtcToken(Request $request)
    {
        // dd($request->all());
        // Validate the request parameters
        $request->validate([
            'channelName' => 'required|string',
            'uid' => 'required|integer',
        ]);
        $channelName = $request->query('channelName');
        $uid = $request->query('uid');
        // Generate the RTC token using AgoraService
        $token = $this->agoraService->generateRtcToken($channelName, $uid);
    // dd( $token);
        // Return the token as a JSON response

                // return response()->json(['data' => $token]);
          return response()->json($token);

    }
}
