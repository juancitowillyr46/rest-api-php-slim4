<?php declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserReadData;
use App\Domain\User\Repository\UserReaderAllRepository;
use App\Domain\User\Repository\UserReaderRepository;

final class UserReaderAll
{
    private $repository;

    public function __construct(UserReaderAllRepository $repository)
    {
        $this->repository = $repository;
    }

    public function readAllUser(): array
    {

        $user = $this->repository->readAllUser();

        return $user;
    }

}