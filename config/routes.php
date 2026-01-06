<?php

use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function(App $app, Container $container) {
    $app->group('/api', function(RouteCollectorProxy $app) {
        $app->get('character' )
    } );
}