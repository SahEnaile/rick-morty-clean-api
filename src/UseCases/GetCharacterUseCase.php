<?php

use App\Domain\Interfaces\CharacterRepositoryInterface;

Class GetCharacterUseCase {
private CharacterRepositoryInterface $repository;
    public function __construct (CharacterRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

}