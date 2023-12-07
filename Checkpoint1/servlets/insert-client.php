<?php

    require_once $_SERVER["DOCUMENT_ROOT"]."/models/Client.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/controllers/ClientController.php";

    $client = new Client(
        0,
        $_REQUEST["first_name"],
        $_REQUEST["last_name"],
        $_REQUEST["email"],
        $_REQUEST["birth_date"],
        $_REQUEST["city"]
    );

    $clientController = new ClientController();
    try {
        $clientController->addClient($client);
        header("Location: /views/table-client.php");
    } catch (PDOException $exception) {
        // You can handle the PDOException directly
        throw $exception; // Optionally, rethrow the caught exception
    } catch (Throwable $exception) {
        // Catch any other exceptions that may occur
        throw new Exception($exception->getMessage());
    }