<?php declare(strict_types=1);

namespace App\Action\User;

use App\Domain\User\Data\UserCreateData;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\User\Service\UserCreator;

final class UserCreateAction {

    private $userCreator;

    public function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $data = (array)$request->getParsedBody();

        $user = new UserCreateData();
        $user->firstName = $data['firstName'];
        $user->lastName = $data['lastName'];
        $user->username = $data['userName'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->state = $data['state'];
        $result = $this->userCreator->createUser($user);
        
        return $response->withJson($result)->withStatus(201);
    }
}