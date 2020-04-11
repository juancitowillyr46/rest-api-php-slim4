<?php declare(strict_types=1);

namespace App\Middleware;

use App\Domain\Security\Service\JwtCustom;
use Exception;
use Psr\Http\Server\MiddlewareInterface;
use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Server\RequestHandlerInterface;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ResponseFactoryInterface;
use Slim\Psr7\Factory\ResponseFactory;

final class JwtMiddleware implements MiddlewareInterface
{
    private $jwtCustom;
    private $responseFactory;

    public function __construct(JwtCustom $jwtCustom, ResponseFactory $responseFactory)
    {
        $this->jwtCustom = $jwtCustom;
        $this->responseFactory = $responseFactory;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $authorization = explode(' ', (string)$request->getHeaderLine('Authorization'));
        $token = $authorization[1] ?? '';
        
        try {

            $verify = $this->jwtCustom->decodeToken($token);

            // Append valid token
            $request = $request->withAttribute('token', $verify->sub);

            // Append the user id as request attribute
            $request = $request->withAttribute('uid', $verify->sub);


        } catch (Exception $ex)
        {
            return $this->responseFactory->createResponse()
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(401, $ex->getMessage());

        }

        return $handler->handle($request);
        
    }
}