<?php
ob_start();
date_default_timezone_set('Europe/Moscow');
session_start();





spl_autoload_register(function($className) {
    require __DIR__ . '/../classes/' . $className . '.php';
});

function debug($array, $die = false)
{
    echo '<pre style="font-size: 12px; color: green; ">';
    print_r($array);
    echo '</pre>';
    if ($die) die;
}


function redirect($http = false)
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }
    header("Location: $redirect");
    exit;
}