<?php declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Data\UserReadData;
use App\Domain\User\Repository\UserUpdaterRepository;
use UnexpectedValueException;

final class UserUpdater
{
    private $repository;

    public function __construct(UserUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateUser(UserCreateData $user): UserReadData
    {
        if(empty($user->email)) {
            throw new UnexpectedValueException('Username required');
        }

        $user = $this->repository->updateUser($user);

        return $user;
    }

}