<?php declare(strict_types=1);

namespace App\Domain\Security\Service;

use App\Domain\Security\Data\SecuritySignInData;
use App\Domain\Security\Data\SecuritySignInDtoData;
use App\Domain\Security\Repository\SecuritySignInRepository;
use DateTime;

final class SecuritySignIn
{
    private $repository;
    private $jwtCustom;

    public function __construct(SecuritySignInRepository $securitySignInRepository, JwtCustom $jwtCustom)
    {
        $this->repository = $securitySignInRepository;
        $this->jwtCustom = $jwtCustom;
    }

    public function signIn(SecuritySignInData $securitySignInData): string
    {
        $result = '';
        $user = $this->repository->signIn($securitySignInData);

        if($user !== null) {

            $now = new DateTime();
            
            $payload = array(
                "iss" => "http://localhost:8888",
                "aud" => "http://localhost:8888",
                "iat" => $now->getTimeStamp(),
                "nbf" => 1357000000,
                "sub" => (int)$user->id
            );

            $result = $this->jwtCustom->encodeToken($payload);

            // $decode = $this->jwtCustom->decodeToken($result);

        }

        return $result;
    }

}