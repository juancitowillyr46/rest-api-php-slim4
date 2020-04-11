<?php declare(strict_types=1);

namespace App\Action\User;

use App\Domain\User\Data\UserCreateData;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\User\Service\UserCreator;
use App\Domain\User\Service\UserReader;
use App\Domain\User\Service\UserReaderAll;

final class UserReadAllAction {

    private $userReaderAll;

    public function __construct(UserReaderAll $userReaderAll)
    {
        $this->userReaderAll = $userReaderAll;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {
        // $id = (int)$args['id'];

        $users = $this->userReaderAll->readAllUser();

        $result = $users;

        return $response->withJson($result)->withStatus(200);
    }
}