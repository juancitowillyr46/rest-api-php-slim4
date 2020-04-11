<?php declare(strict_types=1);

namespace App\Domain\Security\Service;

use DateTime;
use Firebase\JWT\JWT;

final class JwtCustom 
{

    // private $getToken; 
    private $exp;
    private $secretKey;

    public function __construct(string $secretKey, string $exp)
    {
        $this->exp = $exp;
        $this->secretKey = $secretKey;  
    }

    public function encodeToken($payload): string {

        $future = new DateTime($this->exp);

        $payload['exp'] = $future->getTimeStamp();

        return JWT::encode($payload, $this->secretKey);
    }

    public function decodeToken(string $jwt) {
        $decoded = JWT::decode($jwt, $this->secretKey, array('HS256'));
        return $decoded;
    }
}
