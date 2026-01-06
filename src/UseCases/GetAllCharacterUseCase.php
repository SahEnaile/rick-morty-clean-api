<?php

namespace App\Domain\UseCases;
use App\Domain\Interfaces\CharacterRepositoryInterface;
use Exception;
Class GetAllCharacterUseCase{
private CharacterRepositoryInterface $repository;
    public function __construct (CharacterRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function execute(): array {
        $response =$this->repository->getAllCharacter();

        if(!empty($response)){
        return $response;
        } 

        throw new Exception("Erro ao trazer os personagens");
    
    }
}