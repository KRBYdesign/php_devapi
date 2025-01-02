<?php

use App\Request;

namespace App\Controllers;

class TicketController
{
    public function getTicket(string $ticketId) 
    {
	var_dump($ticketId);
    }

    public function getAll()
    {
	var_dump("Getting All Tickets");
    }

    public function store(Request $request)
    {
	var_dump($request);
    }
}

