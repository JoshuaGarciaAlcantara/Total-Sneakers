<?php
    $route = [];
    function route(string $path, callable $myCall){
        global $routes;
        $routes[$path]= $myCall;

    }
?>