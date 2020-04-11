<?php declare(strict_types=1);

namespace App\Action\User;

use App\Domain\User\Data\UserCreateData;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\User\Service\UserCreator;
use App\Domain\User\Service\UserUpdater;

final class UserUpdateAction {

    private $userUpdater;

    public function __construct(UserUpdater $userUpdater)
    {
        $this->userUpdater = $userUpdater;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {
        $data = (array)$request->getParsedBody();

        $user = new UserCreateData();        
        $user->firstName = $data['firstName'];
        $user->lastName = $data['lastName'];
        $user->username = $data['userName'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->state = $data['state'];
        $user->id = (int)$args['id'];

        $result = $this->userUpdater->updateUser($user);

        return $response->withJson($result)->withStatus(200);
    }
}