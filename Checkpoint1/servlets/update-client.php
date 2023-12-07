<?php

require_once "../models/Client.php";
require_once "../controllers/ClientController.php";

if(isset($_REQUEST["first_name"]) && isset($_REQUEST["last_name"]) && isset($_REQUEST["email"]) && isset($_REQUEST["birth_date"]) && isset($_REQUEST["city"])) {
    $client = new Client($_REQUEST["client_id"], $_REQUEST["first_name"],
        $_REQUEST["last_name"], $_REQUEST["email"], $_REQUEST["birth_date"], $_REQUEST["city"]);
    $clientController = new ClientController();
    var_dump($client);
    try {
        $clientController->editClient($client);
        header("Location: /views/table-client.php");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}else {
        die("Nesprávne parametre!");
}

