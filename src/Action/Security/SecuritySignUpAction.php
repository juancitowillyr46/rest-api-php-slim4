<?php declare(strict_types=1);

namespace App\Action\Security;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Security\Data\SecuritySignUpData;
use App\Domain\Security\Service\SecuritySignUp;

final class SecuritySignUpAction 
{   
    private $securitySignUp;

    public function __construct(SecuritySignUp $securitySignUp)
    {
        $this->securitySignUp = $securitySignUp;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $data = (array)$request->getParsedBody();

        $signup = new SecuritySignUpData();
        $signup->firstName = $data['firstName'];
        $signup->lastName = $data['lastName'];
        $signup->username = $data['userName'];
        $signup->email = $data['email'];
        $signup->password = $data['password'];
        $signup->state = 1;
        
        $result = $this->securitySignUp->signUp($signup);
        
        return $response->withJson(['success' => $result])->withStatus(200);
    }

}