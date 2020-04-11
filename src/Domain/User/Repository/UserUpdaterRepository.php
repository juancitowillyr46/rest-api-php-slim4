<?php declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Data\UserReadData;
use PDO;

class UserUpdaterRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function updateUser(UserCreateData $user): UserReadData
    {
        $row = [
            'id' => $user->id,
            'firstname' => $user->firstName,
            'lastname' => $user->lastName,
            'email' => $user->email,
            'username' => $user->username,
            'password' => $user->password,
            'state' => $user->state,
        ];

        $sql = "UPDATE user SET
                lastname=:lastname,
                firstname=:firstname,
                email=:email,
                username=:username,
                password=:password,
                state_id=:state
            WHERE id=:id;
        ";

        $query = $this->connection->prepare($sql)->execute($row);

        if($query) {
            $query = $this->connection->prepare("SELECT 
                                                        id, 
                                                        firstname as firstName, 
                                                        lastname as lastName, 
                                                        email as email, 
                                                        (SELECT s.name FROM state s WHERE s.id = u.state_id LIMIT 1) as state
                                                    FROM user u WHERE id=:id");
            $query->execute(['id' => $user->id]); 
            $query->setFetchMode(PDO::FETCH_CLASS, 'App\Domain\User\Data\UserReadData');
            $fetch = $query->fetch();
        }
        return $fetch;
    }
}