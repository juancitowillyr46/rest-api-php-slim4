<?php declare(strict_types=1);

use App\Domain\Security\Service\JwtCustom;
use Psr\Container\ContainerInterface;
use Selective\Config\Configuration;
use Slim\App;
use Slim\Factory\AppFactory;
use \Firebase\JWT\JWT;

return [
    Configuration::class => function() {
        return new Configuration(require __DIR__ . '/settings.php');
    },
    PDO::class => function (ContainerInterface $container) {
        $config = $container->get(Configuration::class);
        $host = $config->getString('db.host');
        $database = $config->getString('db.database');
        $username = $config->getString('db.username');
        $password = $config->getString('db.password');
        $charset = $config->getString('db.charset');
        $flags = $config->getArray('db.flags');
        $dsn = "mysql:host=$host;dbname=$database;charset=$charset";
        return new PDO($dsn, $username, $password, $flags);
    },
    App::class => function (ContainerInterface $container){
        AppFactory::setContainer($container);
        $app = AppFactory::create();
        return $app;
    },
    JwtCustom::class => function (ContainerInterface $container) {
        $config = $container->get(Configuration::class);
        $secret = $config->getString('jwt.secret');
        $exp = $config->getString('jwt.exp');
        return new JwtCustom($secret, $exp);
    }
];