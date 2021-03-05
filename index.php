<?php
require_once "helper/Database.php";
require_once "models/Person.php";

$db = new Database();

$conn = $db->getConnection();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stm = $conn->prepare("SELECT osoby.name, osoby.surname, oh.year, oh.city, oh.type, umiestnenia.discipline
                             FROM osoby
                                JOIN umiestnenia
                                    on osoby.id = umiestnenia.person_id
                                JOIN oh
                                    on umiestnenia.oh_id = oh.id
                             WHERE birth_country = 'Slovensko'");
$stm->execute();

$stm->setFetchMode(PDO::FETCH_CLASS, "Person");
$people = $stm->fetchAll();
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Slovenskí olympijskí víťazi</title>
    <meta charset="UTF-8">
    <meta name="author" content="Juraj Lapčák">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<table class="table table-striped table-dark">
    <thead>
    <tr class="table-head">
        <th scope="col">
            Meno a priezvisko víťaza
        </th>
        <th scope="col">
            Rok konania
        </th>
        <th scope="col">
            Miesto konania
        </th>
        <th scope="col">
            Typ olympiády
        </th>
        <th scope="col">
            Disciplína
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($people as $person) {
        echo "
        <tr>
            <td>" .
            $person->getName() . " " . $person->getSurname().
            "</td>
            <td>".
            $person->getYear().
            "</td>
            <td>".
            $person->getCity().
            "</td>
            <td>".
            $person->getType().
            "</td>
            <td>".
            $person->getDiscipline().
            "</td>
        </tr>
        ";
    }
    ?>
    </tbody>
</table>
</body>
</html>

