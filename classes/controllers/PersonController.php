<?php
require_once(__DIR__ . "/../helpers/Database.php");
require_once(__DIR__ . "/../models/PersonDetail.php");
require_once(__DIR__ . "/../models/Person.php");
require_once(__DIR__ . "/../models/Placement.php");

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

    public function getAllIncomplete(): array
    {
        $stm = $this->conn->prepare("SELECT id, name, surname FROM osoby");
        $stm->execute();
        $stm->setFetchMode(PDO::FETCH_CLASS, "Person");
        return $stm->fetchAll();
    }

    public function getById($id)
    {
        try {
            $stm = $this->conn->prepare("SELECT osoby.* FROM osoby WHERE id=:id");
            $stm->bindParam(":id", $id);
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_CLASS, "PersonDetail");
            $person = $stm->fetch();
            $personId = $person->getId();

            $stm = $this->conn->prepare("SELECT u.*, oh.type, oh.year,oh.city 
                                                FROM umiestnenia u 
                                                JOIN oh ON u.oh_id = oh.id 
                                                WHERE u.person_id=:personId");
            $stm->bindParam(":personId", $personId, PDO::PARAM_INT);
            $stm->execute();
            $placements = $stm->fetchAll(PDO::FETCH_CLASS, "Placement");

            $person->setPlacements($placements);
            return $person;
        } catch (Error $e) {
            return null;
        }
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

    public function editPerson(PersonDetail $person)
    {
        $stm = $this->conn->prepare("update osoby set name=:name, 
                                                            surname=:surname,       
                                                            birth_date=:birth_date, 
                                                            birth_place=:birth_place,   
                                                            birth_country=:birth_country,
                                                            death_date=:death_date,
                                                            death_place=:death_place,   
                                                            death_country=:death_country 
                                            where id = :id;");
        $id = $person->getId();
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        $this->insertParameters($person, $stm);
        $stm->execute();
    }

    public function insertPerson(PersonDetail $person): ?string
    {
        $stm = $this->conn->prepare("insert into osoby (name, surname, birth_date, birth_place, birth_country, death_date, death_place, death_country) 
                                            values (:name, :surname, :birth_date, :birth_place, :birth_country, :death_date, :death_place, :death_country)");
        $this->insertParameters($person, $stm);
        try {
            $stm->execute();
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            return null;
        }
    }

    private function insertParameters(PersonDetail $person, $stm)
    {
        $name = $person->getName();
        $surname = $person->getSurname();
        $birth_date = $person->getBirthDate();
        $birth_place = $person->getBirthPlace();
        $birth_country = $person->getBirthCountry();
        $death_date = $person->getDeathDate();
        $death_place = $person->getDeathPlace();
        $death_country = $person->getDeathCountry();
        $stm->bindParam(":name", $name, PDO::PARAM_STR);
        $stm->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stm->bindParam(":birth_date", $birth_date, PDO::PARAM_STR);
        $stm->bindParam(":birth_place", $birth_place, PDO::PARAM_STR);
        $stm->bindParam(":birth_country", $birth_country, PDO::PARAM_STR);
        $stm->bindParam(":death_date", $death_date, PDO::PARAM_STR);
        $stm->bindParam(":death_place", $death_place, PDO::PARAM_STR);
        $stm->bindParam(":death_country", $death_country, PDO::PARAM_STR);
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