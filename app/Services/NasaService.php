<?php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class NasaService
{
    private $client;

    // construct the guzzle client
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.nasa.base_uri'),
            'timeout'  => 2.0,
        ]);
    }

    // Fetches photos from a Mars Rover - accepts rover type and page
    public function getRoverPhoto($rover, $page)
    {
        try {
            $response = $this->client->request('GET', "rovers/$rover/photos", [
                'query' => [
                    'sol' => 1000, // required param
                    'page' => $page, // defaults to page 1 to limit to 25
                    'api_key' => config('services.nasa.api_key'), // retrieve nasa api from .env file
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return ['error' => 'Failed to fetch data: ' . $e->getMessage()];
        }
    }
}
