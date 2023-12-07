<?php

class Settings
{

    const SERVER_NAME ="localhost:3306";
    const DB_NAME = "feri_semestralka";
    const USERNAME = "root";
    const PASSWORD = "";

    public static function getConnection(): PDO
    {
        return new PDO(
            "mysql:host=" . self::SERVER_NAME . ";dbname=". self::DB_NAME,
            self::USERNAME,
            self::PASSWORD
        );
    }
}