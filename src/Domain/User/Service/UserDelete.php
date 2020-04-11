<?php declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Data\UserReadData;
use App\Domain\User\Repository\UserDeleteRepository;
use App\Domain\User\Repository\UserUpdaterRepository;
use UnexpectedValueException;

final class UserDelete
{
    private $repository;

    public function __construct(UserDeleteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteUser($id): UserReadData
    {
        $user = $this->repository->deleteUser($id);

        return $user;
    }

}