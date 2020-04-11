<?php declare(strict_types=1);

namespace App\Domain\Security\Service;

use App\Domain\Security\Data\SecuritySignUpData;
use App\Domain\Security\Repository\SecuritySignUpRepository;

final class SecuritySignUp
{
    private $repository;

    public function __construct(SecuritySignUpRepository $securitySignUpRepository)
    {
        $this->repository = $securitySignUpRepository;
    }

    public function signUp(SecuritySignUpData $securitySignUpData): bool
    {
        if($this->repository->signUp($securitySignUpData) > 0) {
            return true;
        } else {
            return false;
        }
        
    }

}