<?php declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->get('/', \App\Action\HomeAction::class);
    $app->post('/signin', \App\Action\Security\SecuritySignInAction::class);
    $app->post('/signup', \App\Action\Security\SecuritySignUpAction::class);

    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->group('/users', function (RouteCollectorProxy $group) {
            $group->get('', \App\Action\User\UserReadAllAction::class);
            $group->post('', \App\Action\User\UserCreateAction::class);
            $group->get('/{id}', \App\Action\User\UserReadAction::class);
            $group->put('/{id}', \App\Action\User\UserUpdateAction::class);
            $group->delete('/{id}', \App\Action\User\UserDeleteAction::class);
        });
    });

};