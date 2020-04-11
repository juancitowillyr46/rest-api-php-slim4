<?php declare(strict_types=1);

namespace App\Action\User;

use App\Domain\User\Data\UserCreateData;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\User\Service\UserCreator;
use App\Domain\User\Service\UserReader;

final class UserReadAction {

    private $userReader;

    public function __construct(UserReader $userReader)
    {
        $this->userReader = $userReader;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {
        $id = (int)$args['id'];

        $user = $this->userReader->readUser($id);

        $result = $user;

        return $response->withJson($result)->withStatus(200);
    }
}