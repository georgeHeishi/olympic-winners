<?php
require_once(__DIR__ . "/../helpers/Database.php");
require_once(__DIR__ . "/../models/Placement.php");

class PlacementController
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function insertPlacement(Placement $placement): ?string
    {
        $stm = $this->conn->prepare("insert into umiestnenia (person_id, oh_id, placing, discipline)
                                                    values(:person_id, :oh_id, :placing, :discipline)");
        $person_id = $placement->getPersonId();
        $oh_id = $placement->getOhId();
        $placing = $placement->getPlacing();
        $discipline = $placement->getDiscipline();
        $stm->bindParam(":person_id", $person_id, PDO::PARAM_INT);
        $stm->bindParam(":oh_id", $oh_id, PDO::PARAM_INT);
        $stm->bindParam(":placing", $placing, PDO::PARAM_INT);
        $stm->bindParam(":discipline", $discipline, PDO::PARAM_STR);
        try {
            $stm->execute();
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            return null;
        }
    }
}