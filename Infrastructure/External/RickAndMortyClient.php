<?php

namespace App\Infrastructure\External;

use App\Domain\Interfaces\CharacterRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use RuntimeException; 
class RickAndMortyIntegration implements CharacterRepositoryInterface
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function getAllCharacter(): ?array
    {
        try {
            $response = $this->client->request('GET', "character");

            return json_decode($response->getBody()->getContents(), true);
            
        } catch (RequestException $e) {
            if ($e->hasResponse() && $e->getResponse()->getStatusCode() === 404) {
                return null;
            }
            throw new RuntimeException("Erro na integração: " . $e->getMessage());
        }
    }
}