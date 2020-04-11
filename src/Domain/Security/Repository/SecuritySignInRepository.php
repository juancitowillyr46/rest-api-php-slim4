<?php declare(strict_types=1);

namespace App\Domain\Security\Repository;

use App\Domain\Security\Data\SecuritySignInData;
use App\Domain\Security\Data\SecuritySignInDtoData;
use PDO;
// use \Firebase\JWT\JWT;

class SecuritySignInRepository {

    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function signIn(SecuritySignInData $securitySignInData): SecuritySignInDtoData
    {

        $user = null;

        $row = [
            'email' => $securitySignInData->username
        ];

        $query = $this->connection->prepare("SELECT 
                                                u.id as id,
                                                u.email as username, 
                                                u.password as password 
                                            FROM user u WHERE email=:email");
        $query->execute($row); 
        $query->setFetchMode(PDO::FETCH_CLASS, 'App\Domain\Security\Data\SecuritySignInDtoData');

        $user = $query->fetch();

        if ($user && password_verify($securitySignInData->password, $user->password))
        {
            return $user;
        }

        return $user;
    }

}