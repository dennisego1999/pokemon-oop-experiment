<?php

namespace App\Api;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PokemonApi
{
    private string|null $base_url;
    private Client $client;

    public function __construct()
    {
        $this->base_url = env('API_BASE_URL', 'https://pokeapi.co/api/v2/');
        $this->client = new Client();
    }

    /**
     * Generates a complete URL by appending the given endpoint to the base URL.
     *
     * @param string|null $endpoint The specific endpoint to append to the base URL. Defaults to null.
     * @return string|null The complete URL.
     */
    public function url(string $endpoint = null): string|null
    {
        if(empty($endpoint) || empty($this->base_url)) {
            return $this->base_url;
        }

        return $this->base_url.$endpoint;
    }

    /**
     * Fetches data from a specified API endpoint.
     *
     * @param string $endpoint The API endpoint to fetch data from.
     * @return array The decoded response body as an associative array.
     * @throws Exception If there is an error during the API request or response handling.
     */
    public function fetchData(string $endpoint): array
    {
        try {
            // Get url
            $url = $this->url($endpoint);

            // Make GET request to the API
            $response = $this->client->get($url);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new Exception("API request failed: " . $e->getMessage());
        }
    }
}