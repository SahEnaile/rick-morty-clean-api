<?php

namespace App\Domain\Interfaces;

interface CharacterRepositoryInterface
{
    public function getAllCharacter(): ?array;
    public function getCharacter(int $id): ?array;
}