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
        $rover = $request->input('rover', 'curiosity');
        $page = $request->input('page', 1);
        $photos = $this->nasaService->getRoverPhoto($rover, $page);
        return response()->json($photos);
    }
}
