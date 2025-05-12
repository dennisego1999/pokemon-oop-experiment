<?php

namespace App\Dto;

class Pokemon {
    public int|null $id;
    public int|null $weight;
    public int|null $height;
    public string|null $name;
    public int|null $baseExperience;

    public function __construct() {}

    public static function fromArray(array $data): self
    {
        $pokemon = new self();
        $pokemon->name = $data['name'] ?? null;
        $pokemon->baseExperience = $data['base_experience'] ?? null;
        $pokemon->height = $data['height'] ?? null;
        $pokemon->weight = $data['weight'] ?? null;
        $pokemon->id = $data['id'] ?? null;

        return $pokemon;
    }
}