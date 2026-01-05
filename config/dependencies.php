<?php

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use GuzzleHttp\Client;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([

        Client::class => function (ContainerInterface $container) {
            return new Client([
                'base_uri' => 'https://rickandmortyapi.com/api/',
                'timeout'  => 5.0,
            ]);
        },

    ]);
};