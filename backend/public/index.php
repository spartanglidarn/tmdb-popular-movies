<?php
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
switch ($request_uri[0]) {
    case '/':
        require '../app/home.php';
        break;
    case '/get-top-rated-movies':
        require '../app/getTopRated.php';
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        require '../views/404.php';
        break;
}