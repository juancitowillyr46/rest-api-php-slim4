<?php declare(strict_types=1);

namespace App\Action\User;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\User\Service\UserDelete;

final class UserDeleteAction {

    private $userDelete;

    public function __construct(UserDelete $userDelete)
    {
        $this->userDelete = $userDelete;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {
        $id = (int)$args['id'];

        $user = $this->userDelete->deleteUser($id);

        return $response->withJson($user)->withStatus(200);
    }
}