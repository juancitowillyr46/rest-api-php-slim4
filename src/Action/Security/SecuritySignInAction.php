<?php declare(strict_types=1);

namespace App\Action\Security;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Security\Data\SecuritySignInData;
use App\Domain\Security\Service\SecuritySignIn;

final class SecuritySignInAction 
{   
    private $securitySignIn;

    public function __construct(SecuritySignIn $securitySignIn)
    {
        $this->securitySignIn = $securitySignIn;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $data = (array)$request->getParsedBody();

        $signin = new SecuritySignInData();
        $signin->username = $data['username'];
        $signin->password = $data['password'];
     
        $result = $this->securitySignIn->signIn($signin);
        
        return $response->withJson(['token' => $result])->withStatus(200);
    }

}