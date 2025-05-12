<?php

use App\Services\PokemonService;
use App\Support\Env;

require __DIR__ . '/vendor/autoload.php';

$repository = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(Dotenv\Repository\Adapter\EnvConstAdapter::class)
    ->addAdapter(Dotenv\Repository\Adapter\PutenvAdapter::class)
    ->immutable()
    ->make();

$dotenv = Dotenv\Dotenv::create($repository, __DIR__, ['.env']);
$dotenv->load();

Env::setRepository($repository);

// Create Pokémon service
$service = new PokemonService();

try {
    $result = $service->findPokemon('bulbasaur');
    ds($result);
} catch (Exception $e) {
    echo "Error: {$e->getMessage()}";
}


echo "Hello World!";