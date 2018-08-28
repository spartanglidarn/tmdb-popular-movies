<?php

class TopRatedMovies {
    private const PUBLIC_FIELDS = [
        'id' => 1,
        'release_date' => 1,
        'poster_path' => 1,
        'overview' => 1,
        'original_title' => 1,
        'title' => 1,
        'original_language' => 1,
        'popularity' => 1,
        'vote_count' => 1,
    ];

    public function __construct () {
        
    }

    public function getMovies ($apiKey, $pageNr) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.themoviedb.org/3/discover/movie?api_key=". $apiKey . "&language=en-US&sort_by=popularity.desc&page=" . $pageNr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $rawMovieRespons = curl_exec($ch);
        $movieRespons = (array) json_decode($rawMovieRespons);
        curl_close($ch);
        return $movieRespons;
    }

    public function formatMovies($moviesObject) {
        $formattedObjects = [];
        foreach ($moviesObject['results'] as $movieObj) {
            $formattedObject = [];
            $movieArray = (array) $movieObj;
            foreach ($movieArray as $fieldName => $_) {
                if (isset(self::PUBLIC_FIELDS[$fieldName])) {
                    $formattedObject[$fieldName] = $movieArray[$fieldName];
                }
            }
            $formattedObjects[] = $formattedObject;
        }
        return $formattedObjects;
    }
}