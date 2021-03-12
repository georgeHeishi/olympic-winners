<?php
require_once "helpers/Database.php";
require_once "models/Person.php";

$db = new Database();

$conn = $db->getConnection();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stm = $conn->prepare("SELECT osoby.id, osoby.name, osoby.surname, oh.year, oh.city, oh.type, umiestnenia.discipline
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
    <link href="css/main-style.css" rel="stylesheet">
    <link href="css/winners-table-style.css" rel="stylesheet">
    <script src="js/table-head-script.js"></script>
</head>
<body>
<div class="container">
    <?php include('./view/header.php') ?>

    <div class="row mt-5">
        <main class="col-lg site-content">

            <table class="table table-striped table-dark">
                <thead>
                <tr class="table-head">
                    <th scope="col" id="name" class="winners-head">
                        Meno &#8593;&#8595;
                    </th>
                    <th scope="col" id="surname" class="winners-head">
                        Priezvisko &#8593;&#8595;
                    </th>
                    <th scope="col" id="year" class="winners-head">
                        Rok konania &#8593;&#8595;
                    </th>
                    <th scope="col" id="city" class="winners-head">
                        Miesto konania &#8593;&#8595;
                    </th>
                    <th scope="col" id="type" class="winners-head">
                        Typ olympiády &#8593;&#8595;
                    </th>
                    <th scope="col" id="discipline" class="winners-head">
                        Disciplína &#8593;&#8595;
                    </th>
                </tr>
                </thead>
                <tbody id="winners-body">
                <?php
                foreach ($people as $person) {
                    echo "
                    <tr>
                        <td><a href='/olympic-winners/detail.php/?id=" . $person->getId() . "'>" .
                        $person->getName() .
                        "</a>
                        </td>
                        <td><a href='/olympic-winners/detail.php/?id=" . $person->getId() . "'>" .
                        $person->getSurname() .
                        "</a>
                        </td>
                        <td>" .
                        $person->getYear() .
                        "</td>
                        <td>" .
                        $person->getCity() .
                        "</td>
                        <td>" .
                        $person->getType() .
                        "</td>
                        <td>" .
                        $person->getDiscipline() .
                        "</td>
                    </tr>
                    ";
                }
                ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<?php include('./view/footer.php') ?>

</body>
</html>

