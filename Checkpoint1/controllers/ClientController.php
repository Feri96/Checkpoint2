<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/models/Client.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/helpers/Settings.php";

class ClientController
{
    public function addClient(Client $client): bool{
        try {
            $pdo = Settings::getConnection();

            $sql = "INSERT INTO clients (first_name,last_name,email,birth_date,city)
                    VALUES ( :first_name, :last_name, :email, :birth_date, :city)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":first_name",$client->getFirstName());
            $stmt->bindValue(":last_name",$client->getLastName());
            $stmt->bindValue(":email",$client->getMail());
            $stmt->bindValue(":birth_date",$client->getBirthDate());
            $stmt->bindValue(":city",$client->getCity());

            $stmt->execute();
            return true;
        }catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function selectAllClients(int $limit): array
    {
        $clients = [];
        try {
            $pdo = Settings::getConnection();
            $sql = "SELECT * FROM clients LIMIT :limit";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);

            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($items as $item) {
                $clients[] = new Client($item->client_id, $item->first_name, $item->last_name, $item->email, $item->birth_date, $item->city);
            }
            //var_dump($clients);
            return $clients;

        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function selectClientById(int $client_id): array
    {
        $clients = [];
        try {
            $pdo = Settings::getConnection();
            $sql = "SELECT * FROM clients WHERE client_id = :client_id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":client_id", $client_id, PDO::PARAM_INT);

            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach ($items as $item){
                $clients[] = new Client($item->client_id, $item->first_name, $item->last_name, $item->email,$item->birth_date, $item->city);
            }
            return $clients;
        }catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function deleteClient(int $client_id):bool
    {
        try{
            $pdo = Settings::getConnection();
            $sql = "DELETE FROM clients WHERE client_id = :client_id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":client_id", $client_id, PDO::PARAM_INT);

            return $stmt->execute();
        }catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function editClient(Client $client):bool {
        try{
            $pdo = Settings::getConnection();
            $sql = "UPDATE clients SET client_id = :client_id, first_name = :first_name, last_name = :last_name, email = :email, birth_date = :birth_date, city = :city WHERE client_id = :client_id";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(":client_id",$client->getClientId());
            $stmt->bindValue(":first_name",$client->getFirstName());
            $stmt->bindValue(":last_name",$client->getLastName());
            $stmt->bindValue(":email",$client->getMail());
            $stmt->bindValue(":birth_date",$client->getBirthDate());
            $stmt->bindValue(":city",$client->getCity());
            var_dump($client);
            return $stmt->execute();
        }catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        }
    }


}