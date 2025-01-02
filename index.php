<?php 

require_once "./vendor/autoload.php";

use App\Request;
use App\Router;
use App\Controllers\TicketController;
use App\Controllers\PageController;

// var_dump($_SERVER);

$router = new Router();

$request = new Request($_SERVER);

// establish the available routes
$router->get('/', [PageController::class, 'index']);
$router->get('api/tickets', [TicketController::class, 'getAll']);
$router->get('api/ticket/:ticket_id', [TicketController::class, 'getTicket']);

$router->post('api/tickets', [TicketController::class, 'store']);

$router->handle($request);
