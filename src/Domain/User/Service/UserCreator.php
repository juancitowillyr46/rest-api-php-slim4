<?php declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Data\UserReadData;
use App\Domain\User\Repository\UserCreatorRepository;
use UnexpectedValueException;

final class UserCreator
{
    private $repository;

    public function __construct(UserCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser(UserCreateData $user): UserReadData
    {

        $opciones = [
            'cost' => 12,
        ];
        $encrypt_password = password_hash($user->password, PASSWORD_BCRYPT, $opciones);

        $user->password = $encrypt_password;

        if(empty($user->email)) {
            throw new UnexpectedValueException('Email required');
        }

        $user = $this->repository->createUser($user);

        return $user;
    }

}