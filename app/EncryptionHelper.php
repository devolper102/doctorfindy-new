<?php

namespace App;

class EncryptionHelper
{
    private $key;
    private $salt;

    public function __construct()
    {
        $this->key = env('ENCRYPTION_KEY');
        $this->salt = env('ENCRYPTION_SALT');
    }

    public function encrypt($data)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $this->getKey(), 0, $iv);
        return base64_encode($iv . $encrypted);
    }

    public function decrypt($data)
    {
        $data = base64_decode($data);
        $iv = substr($data, 0, openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = substr($data, openssl_cipher_iv_length('aes-256-cbc'));
        return openssl_decrypt($encrypted, 'aes-256-cbc', $this->getKey(), 0, $iv);
    }

    private function getKey()
    {
        return hash_pbkdf2("sha256", $this->key, $this->salt, 1000, 32, true);
    }
}
