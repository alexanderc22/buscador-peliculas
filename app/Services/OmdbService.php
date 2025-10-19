<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OmdbService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = env('OMDB_API_URL', 'https://www.omdbapi.com/');
        $this->apiKey = env('OMDB_API_KEY');
    }

    public function searchMovies($query, $year = null, $page = 1)
    {
        $params = [
            'apikey' => $this->apiKey,
            's' => $query,
            'page' => $page,
        ];

        if ($year) {
            $params['y'] = $year;
        }

        $response = Http::get($this->apiUrl, $params);

        return $response->json();
    }


    /*public function searchMovies($query, $year = null)
    {
        $params = [
            'apikey' => $this->apiKey,
            's' => $query,
        ];

        if ($year) {
            $params['y'] = $year;
        }

        $response = Http::get($this->apiUrl, $params);

        return $response->json();
    }*/
    

    public function getMovieById($imdbId)
    {
        $response = Http::get($this->apiUrl, [
            'apikey' => $this->apiKey,
            'i' => $imdbId,
            'plot' => 'full',
        ]);

        return $response->json();
    }
}
