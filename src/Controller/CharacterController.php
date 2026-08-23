<?php

namespace App\Controller;

use App\Domain\UseCases\GetAllCharacterUseCase;
use App\Domain\UseCases\GetCharacterUseCase;
use InvalidArgumentException;
use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class CharacterController
{
    private GetCharacterUseCase $getCharacter;
    private GetAllCharacterUseCase $getAllCharacter;

    public function __construct(
        GetCharacterUseCase $getCharacter,
        GetAllCharacterUseCase $getAllCharacter
    ) {
        $this->getCharacter = $getCharacter;
        $this->getAllCharacter = $getAllCharacter;
    }

    public function getCharacters(Request $request, Response $response, array $args): Response 
    {
        try {
            $results = $this->getAllCharacter->execute();

            $response->getBody()->write(json_encode($results));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);

        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['error' => "Erro ao tentar encontrar os personagens: " . $e->getMessage()]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500);
        }
    }

    public function getCharactersByID(Request $request, Response $response, array $args): Response 
    {
        try {
            $characterId = (int) ($args['id'] ?? 0);

            if ($characterId <= 0) {
                throw new InvalidArgumentException("ID do personagem inválido.");
            }

            $results = $this->getCharacter->execute($characterId);

            $response->getBody()->write(json_encode($results));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);

        } catch (Exception $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
    }
}