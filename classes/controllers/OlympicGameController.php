<?php
require_once(__DIR__ . "/../helpers/Database.php");
require_once(__DIR__ . "/../models/OlympicGame.php");


class OlympicGameController
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function getAllGames(): array
    {
        $stm = $this->conn->prepare("SELECT * FROM oh");
        $stm->execute();

        $stm->setFetchMode(PDO::FETCH_CLASS, "OlympicGame");
        return $stm->fetchAll();
    }
}