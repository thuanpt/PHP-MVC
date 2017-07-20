<?php

require_once "../vendor/autoload.php";

// Lay request URI.
$request = $_SERVER['REQUEST_URI'];
$array = explode("/", $request);
$id = intval(end($array));

$router = [
    '/home/index' => 'HomeController@index',
    '/home/news'  => 'HomeController@news',
    '/api/staff' => 'HomeController@apiStaff',
    '/api/staff/add' => 'HomeController@addStaff',
    "/api/staff/$id" => 'HomeController@apiStaffById',
];

function checkRouting($router, $requestUri)
{
    if (isset($router[$requestUri]))
    {
        return true;
    }

    return false;
}

if (checkRouting($router, $request))
{
    $home = new \App\Controllers\HomeController();

    if ($request == '/home/index')
    {
        $home->index();
    }

    if ($request == '/home/news')
    {
        $home->news();
    }

    if ($request == '/api/staff')
    {
        $home->apiStaff();
    }

    if ($request == "/api/staff/$id")
    {
        $home->apiStaffById($id);
    }

    if ($request == '/api/staff/add')
    {
        $home->addStaff();
    }
} else {
    $home = new \App\Controllers\HomeController();
    $home->errorNotFind();
}