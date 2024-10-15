<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService {
    private $secretKey;

    public function __construct()
    {
        $this->secretKey = env('JWT_SECRET');
    }

    public function generateToken()
    {
        $payload = [
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'iat' => 1356999524,
            'nbf' => 1357000000
        ];
        
        $jwt = JWT::encode($payload, $this->secretKey, 'HS256');

        return $jwt;
    }

    public function decodeToken($token)
    {
        try {
            return JWT::decode($token, new Key($this->secretKey, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }
}