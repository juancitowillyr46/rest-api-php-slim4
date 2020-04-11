<?php declare(strict_types=1);

namespace App\Domain\User\Data;

final class UserReadData
{
    public $id = 0;
    
    public $firstName;

    public $lastName;
    
    public $email;

    public function __construct()
    {
        $this->id = (int) $this->id;
    }

}