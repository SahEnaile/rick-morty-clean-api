<?php

namespace App\Domain\Interfaces;

interface CharacterRepositoryInterface
{
    public function getCharacter(int $id): ?array;
}