<?php

namespace App;

class Request
{
    protected array $requestParams;
    protected array $queryParams;
    protected string $requestMethod;

    public function __construct(array $server) 
    {
	$this->requestParams = explode('/', $server["REQUEST_URI"]);
	$this->queryParams = explode('&', $server["QUERY_STRING"]);
	$this->requestMethod = $server['REQUEST_METHOD'];
    }

    public function method() : string
    {
	return $this->requestMethod;
    }
}
