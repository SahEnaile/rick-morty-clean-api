<?php

use App\Domain\Interfaces\CharacterRepositoryInterface;
use InvalidArgumentException;
use Exception;
Class GetCharacterUseCase {
    private CharacterRepositoryInterface $repository;

    public function __construct( CharacterRepositoryInterface $repository) {
        $this->repository = $repository;
    }
    public function execute(int $id) 
{
    if ($id <= 0) {
        throw new InvalidArgumentException("ID inválido.");
    }

    $response = $this->repository->getCharacter($id);

    if (empty($response)) {
        throw new Exception("Personagem não encontrado.");
    }

    return $response;
}
}