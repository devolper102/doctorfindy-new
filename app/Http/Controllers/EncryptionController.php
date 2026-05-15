<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EncryptionHelper;
use Exception;
use App\Models\AgoraEncryptionService;
use Illuminate\Http\JsonResponse;
class EncryptionController extends Controller
{
    protected $encryptionHelper;
    protected $agoraEncryptionService;

    public function __construct(AgoraEncryptionService $agoraEncryptionService)
    {
        $this->agoraEncryptionService = $agoraEncryptionService;
    }

    public function generateEncryptionKeys(): JsonResponse
    {
        $keys = $this->agoraEncryptionService->generateKeys();
        return response()->json($keys);
    }

    // public function __construct(EncryptionHelper $encryptionHelper)
    // {
    //     $this->encryptionHelper = $encryptionHelper;
    // }

    // public function encrypt(Request $request)
    // {
    //     $data = $request->input('data');

    //     if (!$data) {
    //         return response()->json(['error' => 'No data provided'], 400);
    //     }

    //     $encryptedData = $this->encryptionHelper->encrypt($data);

    //     return response()->json(['encrypted_data' => $encryptedData]);
    // }

    // public function decrypt(Request $request)
    // {
    //     $encryptedData = $request->input('encrypted_data');

    //     if (!$encryptedData) {
    //         return response()->json(['error' => 'No encrypted data provided'], 400);
    //     }

    //     try {
    //         $decryptedData = $this->encryptionHelper->decrypt($encryptedData);
    //         return response()->json(['decrypted_data' => $decryptedData]);
    //     } catch (Exception $e) {
    //         return response()->json(['error' => 'Decryption failed'], 500);
    //     }
    // }
}
