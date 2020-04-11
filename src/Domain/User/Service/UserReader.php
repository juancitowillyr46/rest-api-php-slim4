<?php declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserReadData;
use App\Domain\User\Repository\UserReaderRepository;

final class UserReader
{
    private $repository;

    public function __construct(UserReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function readUser(int $id): UserReadData
    {

        $user = $this->repository->readUser($id);

        return $user;
    }

}