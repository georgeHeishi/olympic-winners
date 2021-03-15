<?php
require_once(__DIR__ . "/../classes/controllers/PersonController.php");
require_once(__DIR__ . "/../classes/models/PersonDetail.php");

$personController = new PersonController();

if(empty($_POST['id'])){
    $person = new PersonDetail();
}else{
    $person = $personController->getById($_POST['id']);
}

if(isset($_POST['name'])){
    $person->setName($_POST['name']);
}
if(isset($_POST['surname'])){
    $person->setSurname($_POST['surname']);
}
if(isset($_POST['birthdate'])){
    $person->setDbBirthDate($_POST['birthdate']);
}
if(isset($_POST['birthplace'])){
    $person->setBirthPlace($_POST['birthplace']);
}
if(isset($_POST['birthcountry'])){
    $person->setBirthCountry($_POST['birthcountry']);
}
if(isset($_POST['deathdate'])){
    $person->setDbDeathDate($_POST['deathdate']);
}
if(isset($_POST['deathplace'])){
    $person->setDeathPlace($_POST['deathplace']);
}
if(isset($_POST['deathcountry'])){
    $person->setDeathCountry($_POST['deathcountry']);
}
if(empty($_POST['id'])) {
    $person->setId($personController->insertPerson($person));
}else{
    $personController->editPerson($person);
}

header("Location: https://wt98.fei.stuba.sk/olympic-winners/detail.php/?id=".$person->getId());