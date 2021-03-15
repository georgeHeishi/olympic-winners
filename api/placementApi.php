<?php
require_once(__DIR__ . "/../classes/controllers/PlacementController.php");
require_once(__DIR__ . "/../classes/models/Placement.php");
require_once(__DIR__ . "/../api/testInput.php");

$placementController = new PlacementController();

$placement = new Placement();

if(isset($_POST['personid'])) {
    $placement->setPersonId(test_input($_POST['personid']));
}
if(isset($_POST['ohid'])) {
    $placement->setOhId(test_input($_POST['ohid']));
}
if(isset($_POST['placing'])) {
    $placement->setPlacing(test_input($_POST['placing']));
}
if(isset($_POST['discipline'])) {
    $placement->setDiscipline(test_input($_POST['discipline']));
}

$result = $placementController->insertPlacement($placement);
if($result == null){
    header("Location: https://wt98.fei.stuba.sk/olympic-winners/addPerson.php/?error=true");
}
$placement->setId($result);

header("Location: https://wt98.fei.stuba.sk/olympic-winners/detail.php/?id=".$placement->getPersonId());