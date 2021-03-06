<?php
require_once "../helpers/Database.php";
require_once "../models/Person.php";

$collum = (!strcmp($_GET['collum'], 'type')) ? "type, year" : $_GET['collum'];
$order = $_GET['order'];

$db = new Database();
$conn = $db->getConnection();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stm = $conn->prepare("SELECT osoby.name AS name, osoby.surname AS surname, oh.year AS year, oh.city AS city, oh.type AS type, umiestnenia.discipline AS discipline
                             FROM osoby
                                JOIN umiestnenia
                                    on osoby.id = umiestnenia.person_id
                                JOIN oh
                                    on umiestnenia.oh_id = oh.id
                             WHERE birth_country = 'Slovensko'
                             ORDER BY ".$collum . " " . $order);
$stm->execute();

$stm->setFetchMode(PDO::FETCH_CLASS, "Person");
$people = $stm->fetchAll();
$results = array();
foreach ($people as $person) {
    array_push($results, $person->toArray());
}
$response = array(
    "status" => "success",
    "error" => false,
    "results" => json_encode($results)
);
echo json_encode($response);