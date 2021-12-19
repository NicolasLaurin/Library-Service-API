<?php
require_once("../model/clients.php");

class ClientsController
{
	function getAllClients()
	{
		$clients = new Clients();
		return $clients->getAllClients();
	}

	function getClientByID($clientID)
	{
		$clients = new Clients();
		return $clients->getClientByID($clientID);
	}
}
