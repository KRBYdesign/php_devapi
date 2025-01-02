<?php

namespace App\Controllers;

class PageController
{
    public function index()
    {
	return file_get_contents('resources/Views/index.php');	
    }
}
