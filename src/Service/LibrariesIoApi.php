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

    public function getPackageDetails(string $platform, string $name)
    {
        // exmaple: https://libraries.io/api/github/gruntjs/grunt?api_key=083faf6705582803ac8e45d3bb802279
//        $name = rawurlencode($name);
//        $name = str_replace('/', '%2F', $name);
        $response = $this->client->get("$platform/$name", [
                'query' => [
                    'api_key' => $this->apiKey
                ],
            ]
        );

        $query = $response->getRequestTarget();
        echo "Query: $query\n";



        return json_decode($response->getBody(), true);
    }
}
