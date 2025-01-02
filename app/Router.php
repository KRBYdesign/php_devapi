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

    public function get(string $route, array $handler)
    {
	$this->getRoutes[$route] = $handler;
    }

    public function post(string $route, array $handler)
    {
	$this->postRoutes[$route] = $handler;
    }

    public function handle(Request $request)
    {
	// handle the request
	// check the method to figure which array to pull form
	$method = strtolower($request->method());
	$uri = implode('/', $request->getRequestParams());
	$targetRoutes = ($method == 'get') ? $this->getRoutes : $this->postRoutes;

	if (!array_key_exists($uri, $targetRoutes)) {
	    echo "<p>Error 404 page not found</p>";
	} else {
	    echo "<p>Page Found!!!!</p>";
	}

	var_dump("Method: ", $method); echo "<br />";
	var_dump("URI: ", $uri); echo "<br />";

	foreach ($targetRoutes as $route => $action) {
	    echo "Route: $route ::: ";

	    var_dump($action);

	    echo "<br />";
	}

	// check the uri to make sure it exists as a route
	// how do you 'remember' what callback is needed?
	// return a json_encoded response
    }
}
