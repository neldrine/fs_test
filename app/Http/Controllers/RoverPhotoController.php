<?php

namespace App\Http\Controllers;

use App\Services\NasaService;
use Illuminate\Http\Request;

class RoverPhotoController extends Controller
{

    public function __construct(NasaService $nasaService)
    {
        $this->nasaService = $nasaService;
    }

    public function index(Request $request)
    {
        // Default to 'Curiosity' if not specified
        $roverInput = $request->input('rover', 'Curiosity');
        $page = $request->input('page', 1);

        // Convert comma-separated string into an array, trim whitespace
        $rovers = array_map('trim', explode(',', $roverInput));

        // Filter out any invalid rover names to avoid errors and malicious input
        $validRovers = ['Curiosity', 'Opportunity', 'Spirit'];
        $rovers = array_intersect($rovers, $validRovers);

        // If no valid rovers are specified, use the default 'Curiosity'
        if (empty($rovers)) {
            $rovers = ['Curiosity'];
        }

        $photos = $this->nasaService->getRoverPhotos($rovers, $page);
        return response()->json($photos);
    }
}
