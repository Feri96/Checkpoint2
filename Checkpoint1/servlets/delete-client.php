<?php

    require_once "../controllers/ClientController.php";

    $client_id = $_REQUEST["client_id"];
    $clientController = new ClientController();
if (isset($client_id)) {
    try {
        $clientController->deleteClient((int)$client_id);
        header("Location: /views/table-client.php");
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }
} else {
    die("Zaznam neexistuje!");
}