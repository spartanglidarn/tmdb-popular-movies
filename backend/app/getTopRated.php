<?php
    require_once 'controllers/TopRatedMovies.php';
    use app\controllers\TopRatedMovies as TopRatedMovies;
    $apiKey = getenv('TMDB_API_KEY');
    const MAX_RESULT = 100;
    $returnData = [];
    $i = 0;
    $pageNr = 1;
    while ($i < MAX_RESULT) {
        // Saftey check. If MAX_RESULT is less then the number of movies found on tmdb break the loop
        if ($i === $checkCount) {
            break;
        }
        $checkCount = $i;
        $TopRatedMovies = new \TopRatedMovies();
        $movieRespons = $TopRatedMovies->getMovies($apiKey, $pageNr);
        $formattedMovieData = $TopRatedMovies->formatMovies($movieRespons);
        $returnData = array_merge($returnData, $formattedMovieData);
        $i = count($returnData);
        $pageNr ++;
    }
    $numberOfMovies = count($returnData);
    if ($numberOfMovies > MAX_RESULT) {
        $removableMovies = $numberOfMovies - MAX_RESULT;
        for ($x = 0; $x < $removableMovies; $x++){
            array_pop($returnData);
        }
    }
    echo json_encode($returnData);