<?php
require_once(__DIR__ . "/../classes/controllers/PersonController.php");

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

$id = $data->id;

$personController = new PersonController();
$result = $personController->removeById($id);
$response = array(
    "result" => $result
);
echo json_encode($response);