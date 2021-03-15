<?php
require_once(__DIR__ . "/../classes/controllers/PersonController.php");
require_once(__DIR__ . "/../classes/models/PersonDetail.php");
require_once(__DIR__ . "/../api/testInput.php");

$personController = new PersonController();

if(empty(test_input($_POST['id']))){
    $person = new PersonDetail();
}else{
    $person = $personController->getById($_POST['id']);
}

if(isset($_POST['name'])){
    $person->setName(test_input($_POST['name']));
}
if(isset($_POST['surname'])){
    $person->setSurname(test_input($_POST['surname']));
}
if(isset($_POST['birthdate'])){
    $person->setDbBirthDate(test_input($_POST['birthdate']));
}
if(isset($_POST['birthplace'])){
    $person->setBirthPlace(test_input($_POST['birthplace']));
}
if(isset($_POST['birthcountry'])){
    $person->setBirthCountry(test_input($_POST['birthcountry']));
}
if(isset($_POST['deathdate'])){
    $person->setDbDeathDate(test_input($_POST['deathdate']));
}
if(isset($_POST['deathplace'])){
    $person->setDeathPlace(test_input($_POST['deathplace']));
}
if(isset($_POST['deathcountry'])){
    $person->setDeathCountry(test_input($_POST['deathcountry']));
}
if(empty(test_input($_POST['id']))) {
    $result = $personController->insertPerson($person);
    if($result == null){
        header("Location: https://wt98.fei.stuba.sk/olympic-winners/addPlacement.php/?error=true");
    }
    $person->setId($result);

}else{
    $personController->editPerson($person);
}

header("Location: https://wt98.fei.stuba.sk/olympic-winners/detail.php/?id=".$person->getId());