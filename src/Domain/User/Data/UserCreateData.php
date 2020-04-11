<?php declare(strict_types=1);

namespace App\Domain\User\Data;

final class UserCreateData
{
    public $id;

    public $firstName;

    public $lastName;
    
    public $email;

    public $username;

    public $password;

    public $state;
}