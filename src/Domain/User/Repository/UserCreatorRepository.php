<?php declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Data\UserReadData;
use PDO;


class UserCreatorRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }


    public function createUser(UserCreateData $user): UserReadData
    {

        $row = [
            'firstname' => $user->firstName,
            'lastname' => $user->lastName,
            'email' => $user->email,
            'username' => $user->username,
            'password' => $user->password,
            'state' => $user->state,
        ];

        $sql = "INSERT INTO user SET
                lastname=:lastname,
                firstname=:firstname,
                email=:email,
                username=:username,
                password=:password,
                state_id=:state;
                ";

        $this->connection->prepare($sql)->execute($row);

        $userDTO = new UserReadData();
        $userDTO->id = (int)$this->connection->lastInsertId();
        $userDTO->firstName = $user->firstName;
        $userDTO->lastName = $user->lastName;
        $userDTO->email = $user->email;

        return $userDTO;
    }
}