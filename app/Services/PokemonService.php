<?php

namespace App\Services;

use App\Api\PokemonApi;
use App\Dto\PokemonDto;
use Exception;

class PokemonService {
    private PokemonApi $api;

    public function __construct()
    {
        $this->api = new PokemonApi();
    }

    /**
     * Fetches a list of Pokémon from the API with pagination support.
     *
     * @param int $limit The number of Pokémon to retrieve (default is 20).
     * @param int $offset The starting position for the retrieval (default is 0).
     * @return array An array of Pokémon objects.
     * @throws Exception
     */
    public function getAllPokemon(int $limit = 20, int $offset = 0): array
    {
        $data = $this->api->fetchData("pokemon?limit=$limit&offset=$offset");

        return array_map(fn($pokemon) => PokemonDto::fromArray($pokemon), $data['results']);
    }

    /**
     * Retrieves detailed information for a specific Pokémon by its name or ID.
     *
     * @param string|int $identifier The name or ID of the Pokémon to retrieve.
     * @return PokemonDto A Pokémon object containing the detailed data.
     * @throws Exception
     */
    public function findPokemon(string|int $identifier): PokemonDto
    {
        $data = $this->api->fetchData("pokemon/$identifier");

        return PokemonDto::fromArray($data);
    }
}