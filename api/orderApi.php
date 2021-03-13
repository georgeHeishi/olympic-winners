<?php
require_once(__DIR__ . "/../classes/controllers/PersonController.php");
require_once(__DIR__ . "/../classes/models/Person.php");

$order = $_GET['order'];
$column = (!strcmp($_GET['column'], 'type')) ? "type " . $order . ", year " . $order : $_GET['column'] . " " . $order;

$personController = new PersonController();

$people = $personController->sortByColumn($column);
$results = array();
foreach ($people as $person) {
    array_push($results, $person->toArray());
}
$response = array(
    "status" => "success",
    "error" => false,
    "results" => json_encode($results),
);
echo json_encode($response);