<?php

namespace App;

use App\Request;

class Router
{
    protected array $getRoutes;
    protected array $postRoutes;

    public function __construct()
    {
	$this->getRoutes = array();
	$this->postRoutes = array();
    }

    public static function get(string $route)
    {
	$this->getRoutes[] = $route;
    }

    public static function post(string $route)
    {
	$this->postRoutes[] = $route;
    }

    public funciton handle(Request $request)
    {
	// handle the request
	// check the method to figure which array to pull form
	// check the uri to make sure it exists as a route
	// how do you 'remember' what callback is needed?
	// return a json_encoded response
    }
}
