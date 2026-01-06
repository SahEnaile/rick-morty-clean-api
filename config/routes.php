<?php

use App\Controller\CharacterController;
use DI\Container;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function(App $app, Container $container) {
    
    $app->group('/api', function (RouteCollectorProxy $group) {
        
        $group->get('/character', [CharacterController::class, 'getCharacters']);
        $group->get('/character/{id}', [CharacterController::class, 'getCharactersByID']);

    });
};