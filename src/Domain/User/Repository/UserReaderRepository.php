<?php declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Data\UserReadData;
use PDO;

class UserReaderRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function readUser(int $id): UserReadData
    {

        $query = $this->connection->prepare("SELECT 
                    id, 
                    firstname as firstName, 
                    lastname as lastName, 
                    email as email, 
                    (SELECT s.name FROM state s WHERE s.id = u.state_id LIMIT 1) as state
                    FROM user u WHERE id=:id");
        $query->execute(['id' => $id]); 
        $query->setFetchMode(PDO::FETCH_CLASS, 'App\Domain\User\Data\UserReadData');
        $fetch = $query->fetch();
        return $fetch;
    }
}