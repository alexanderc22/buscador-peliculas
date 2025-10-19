<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OmdbService;

class MovieController extends Controller
{
    protected $omdbService;

    public function __construct(OmdbService $omdbService)
    {
        $this->omdbService = $omdbService;
    }

    public function index()
    {
        return view('dashboard');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $year = $request->input('year');
        $page = $request->input('page', 1);
        $movies = [];
        $totalResults = 0;
        $perPage = 5;

        if ($query) {
            $result = $this->omdbService->searchMovies($query, $year, $page);
            $movies = $result['Search'] ?? [];
            $totalResults = isset($result['totalResults']) ? (int)$result['totalResults'] : 0;
        }

        return view('dashboard', compact('movies', 'query', 'year', 'page', 'totalResults', 'perPage'));
    }

    /*public function search(Request $request)
    {
        $query = $request->input('query');
        $year = $request->input('year');
        $movies = [];

        if ($query) {
            $result = $this->omdbService->searchMovies($query, $year);
            $movies = $result['Search'] ?? [];
        }

        return view('dashboard', compact('movies', 'query', 'year'));
    }*/

    /*public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([
                'error' => 'Debe proporcionar un parámetro "query".'
            ], 400);
        }

        $data = $this->omdbService->searchMovies($query);

        return response()->json($data);
    }*/

    public function searchApi(Request $request)
    {
        $query = $request->input('q');
        $year = $request->input('year');

        if (!$query) {
            return response()->json(['error' => 'Missing query parameter'], 400);
        }

        $result = $this->omdbService->searchMovies($query, $year);

        return response()->json($result);
    }

    public function show($id)
    {
        $movie = $this->omdbService->getMovieById($id);

        if (!$movie || isset($movie['Error'])) {
            return response()->json(['error' => 'Movie not found'], 404);
        }

        return response()->json($movie);
    }
}
