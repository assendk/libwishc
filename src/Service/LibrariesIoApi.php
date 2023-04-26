<?php

namespace App\Service;

use GuzzleHttp\Client;

class LibrariesIoApi
{
    private $client;
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => 'https://libraries.io/api/',
        ]);
    }

    public function search(string $keyword, int $perPage = 3, int $page = 1)
    {
        $response = $this->client->get('search', [
            'query' => [
                'q' => $keyword,
                'api_key' => $this->apiKey,
                'per_page' => $perPage,
                'page' => $page
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}