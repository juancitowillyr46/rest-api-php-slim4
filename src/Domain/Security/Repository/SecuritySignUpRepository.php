<?php declare(strict_types=1);

namespace App\Domain\Security\Repository;

use App\Domain\Security\Data\SecuritySignUpData;
use PDO;

class SecuritySignUpRepository {

    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function signUp(SecuritySignUpData $securitySignUpData): int
    {

        $row = [
            'firstname' => $securitySignUpData->firstName,
            'lastname' => $securitySignUpData->lastName,
            'email' => $securitySignUpData->email,
            'username' => $securitySignUpData->username,
            'password' => $securitySignUpData->password,
            'state' => $securitySignUpData->state,
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


        return (int)$this->connection->lastInsertId();
    }

}