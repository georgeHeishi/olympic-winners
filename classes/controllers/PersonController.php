<?php
require_once(__DIR__ . "/../helpers/Database.php");

class PersonController
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function getAllPeople(): array
    {
        $stm = $this->conn->prepare("SELECT osoby.id, osoby.name, osoby.surname, oh.year, oh.city, oh.type, umiestnenia.discipline
                                            FROM osoby
                                            JOIN umiestnenia
                                            on osoby.id = umiestnenia.person_id
                                            JOIN oh
                                            on umiestnenia.oh_id = oh.id
                                            WHERE birth_country = 'Slovensko'");
        $stm->execute();

        $stm->setFetchMode(PDO::FETCH_CLASS, "Person");
        return $stm->fetchAll();
    }

    public function sortByColumn($column): array
    {
        $stm = $this->conn->prepare("SELECT osoby.id as id, osoby.name AS name, osoby.surname AS surname, oh.year AS year, oh.city AS city, oh.type AS type, umiestnenia.discipline AS discipline
                             FROM osoby
                                JOIN umiestnenia
                                    on osoby.id = umiestnenia.person_id
                                JOIN oh
                                    on umiestnenia.oh_id = oh.id
                             WHERE birth_country = 'Slovensko'
                             ORDER BY " . $column);
        $stm->execute();

        $stm->setFetchMode(PDO::FETCH_CLASS, "Person");
        return $stm->fetchAll();
    }

    public function get10Best(): array
    {
        $stm = $this->conn->prepare("SELECT umiestnenia.person_id AS id,osoby.name AS name, osoby.surname AS surname, COUNT(placing) as placings
                                            FROM umiestnenia
                                            RIGHT JOIN osoby on umiestnenia.person_id = osoby.id
                                            WHERE placing=1
                                            GROUP BY  person_id
                                            ORDER BY COUNT(placing)
                                            DESC LIMIT 10;");
        $stm->execute();

        $stm->setFetchMode(PDO::FETCH_CLASS, "Person");
        return $stm->fetchAll();
    }

    public function removeById($id): bool
    {
        try {
            $stm = $this->conn->prepare("DELETE FROM osoby WHERE id = :id");
            $stm->bindParam(":id", $id);
            $stm->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}