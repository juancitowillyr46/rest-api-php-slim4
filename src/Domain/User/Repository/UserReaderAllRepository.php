<?php declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserReadData;
use PDO;

class UserReaderAllRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function readAllUser(): array
    {
        $sql = "SELECT 
                    id, 
                    firstname as firstName, 
                    lastname as lastName, 
                    email as email, 
                    (SELECT s.name FROM state s WHERE s.id = u.state_id LIMIT 1) as state
                FROM user u";
        $users = $this->connection->query($sql);
        $fechAll = $users->fetchAll(PDO::FETCH_CLASS, "App\Domain\User\Data\UserReadData");

        return $fechAll;
    }
}