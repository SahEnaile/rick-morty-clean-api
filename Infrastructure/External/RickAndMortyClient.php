<?php

namespace App\Infrastructure\External;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Domain\DTO\TokenDTO;
class RickAndMortyIntegration
{
    private Client $client;
    private string $baseUri = 'https://rickandmortyapi.com/api/';
    private TokenDTO $token;
    public function __construct(TokenDTO $token)
    {
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'timeout'  => 5.0,
            'headers'  => [
                'Accept' => 'application/json',
            ]
        ]);
        
        $this->token = $token;
    }
    public function getCharacter(int $id): ?array
    {
        try {
            $response = $this->client->request('GET', "character/{$id}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token->getToken(),
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
            
        } catch (RequestException $e) {
            if ($e->hasResponse() && $e->getResponse()->getStatusCode() === 404) {
                return null;
            }
            throw new \RuntimeException("Erro na integração: " . $e->getMessage());
        }
    }
}