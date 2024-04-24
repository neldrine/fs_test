<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class NasaService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.nasa.base_uri'),
            'timeout'  => 2.0,
        ]);
    }

    // Fetches photos from Mars Rovers
    public function getRoverPhotos($rovers, $page = 1)
    {
        $results = [];

        // ['Curiosity', 'Opportunity', 'Spirit']
        $rovers = (array) $rovers; // Ensure $rovers is always an array - refactored so we can pass 1, 2 or all rovers

        foreach ($rovers as $rover) {
            $results[$rover] = $this->fetchPhotos($rover, $page);
        }

        return $results;
    }

    // Helper function to fetch photos from NASA API
    private function fetchPhotos($rover, $page)
    {
        try {
            $response = $this->client->request('GET', "rovers/$rover/photos", [
                'query' => [
                    'sol' => 1000,
                    'page' => $page,
                    'api_key' => config('services.nasa.api_key'),
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true)['photos'];
        } catch (GuzzleException $e) {
            return ['error' => 'Failed to fetch data: ' . $e->getMessage()];
        }
    }
}
