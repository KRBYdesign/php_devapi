<?php 

require_once "./vendor/autoload.php";

use App\Request;

// var_dump($_SERVER);

$request = new Request($_SERVER);
