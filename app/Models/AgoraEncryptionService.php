<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class AgoraEncryptionService
{
    public function generateKeys()
    {
        // Generate a random encryption key (32 characters)
        $encryptionKey = Str::random(32);
        // Generate a random salt (32 bytes) and encode it in Base64
        $salt = random_bytes(32);
        $base64Salt = base64_encode($salt);
        return [
            'encryptionKey' => $encryptionKey,
            'base64Salt' => $base64Salt,
        ];
    }
}
