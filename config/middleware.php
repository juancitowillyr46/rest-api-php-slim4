<?php declare(strict_types=1);

use Selective\Config\Configuration;
use Slim\App;

return function (App $app) {

    // parse JSON, form data and XML
    $app->addBodyParsingMiddleware();

    // Agregando middleware a las rutas
    $app->addRoutingMiddleware();

    $container = $app->getContainer();

    // Agregando el manejo de errores en los middleware
    $settings = $container->get(Configuration::class)->getArray('error_handler_middleware');
    $displayErrorDetails = (bool)$settings['display_error_details'];
    $logErrors = (bool)$settings['log_errors'];
    $logErrorDetails = (bool)$settings['log_error_details'];

    $app->addErrorMiddleware($displayErrorDetails, $logErrors, $logErrorDetails);
};