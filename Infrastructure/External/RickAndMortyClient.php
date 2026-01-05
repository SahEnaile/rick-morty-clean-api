<?php

namespace App\Infrastructure\External;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RickAndMortyIntegration
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function getCharacter(int $id): ?array
    {
        try {
            $response = $this->client->request('GET', "character/{$id}");

            return json_decode($response->getBody()->getContents(), true);
            
        } catch (RequestException $e) {
            if ($e->hasResponse() && $e->getResponse()->getStatusCode() === 404) {
                return null;
            }
            throw new \RuntimeException("Erro na integração: " . $e->getMessage());
        }
    }
}