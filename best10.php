<?php
require_once "helpers/Database.php";
require_once "models/PersonRanking.php";


$db = new Database();
$conn = $db->getConnection();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stm = $conn->prepare("SELECT umiestnenia.person_id AS id,osoby.name AS name, osoby.surname AS surname, COUNT(placing) as placings
    FROM umiestnenia
    RIGHT JOIN osoby on umiestnenia.person_id = osoby.id
    WHERE placing=1
    GROUP BY  person_id
    ORDER BY COUNT(placing)
    DESC LIMIT 10;");
$stm->execute();

$stm->setFetchMode(PDO::FETCH_CLASS, "PersonRanking");
$peopleRanking = $stm->fetchAll();
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
                    <!--                    <th scope="col" id="name" class="winners-head">-->
                    <!--                        Meno-->
                    <!--                    </th>-->
                    <th scope="col" id="name" class="winners-head">
                        Meno
                    </th>
                    <th scope="col" id="surname" class="winners-head">
                        Priezvisko
                    </th>
                    <th scope="col" id="wins" class="winners-head">
                        Počet výher
                    </th>
                    <th scope="col" id="action1" class="winners-head">
                    </th>
                    <th scope="col" id="action1" class="winners-head">
                    </th>
                </tr>
                </thead>
                <tbody id="winners-body">
                <?php
                foreach ($peopleRanking as $person) {
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
                        $person->getPlacings() .
                        "</td>
                        <td>
                        </td>
                        <td>                         
                        </td>
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

