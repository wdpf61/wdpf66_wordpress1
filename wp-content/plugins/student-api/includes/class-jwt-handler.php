<?php
namespace StudentAPI;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWT_Handler {
    private static $secret = '12345'; // change this!

    // Generate token
    public static function generate_token($user_id) {
        $issuedAt = time();
        $expire = $issuedAt + (60 * 60 * 24); // 1 day
        $payload = [
            'iss' => get_site_url(),
            'iat' => $issuedAt,
            'exp' => $expire,
            'user_id' => $user_id
        ];
        return JWT::encode($payload, self::$secret, 'HS256');
    }

    // Validate token and return user ID
    public static function validate_token($token) {
        try {
            $decoded = JWT::decode($token, new Key(self::$secret, 'HS256'));
            return $decoded->user_id ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
