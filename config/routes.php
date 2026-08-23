<?php

use App\Controller\CharacterController;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function(App $app, ContainerInterface $container) {
    
    $app->group('/api', function (RouteCollectorProxy $group) {
        
        $group->get('/character', [CharacterController::class, 'getCharacters']);
        $group->get('/character/{id}', [CharacterController::class, 'getCharactersByID']);

    });
};