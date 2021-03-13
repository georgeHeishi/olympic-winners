<?php
include('./view/errorDisplay.php');
require_once "./classes/models/Person.php";
require_once "./classes/controllers/PersonController.php";

$personController = new PersonController();
$peopleRanking = $personController->get10Best();
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
    <script src="js/modify-delete.js"></script>
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
                        Meno
                    </th>
                    <th scope="col" id="surname" class="winners-head">
                        Priezvisko
                    </th>
                    <th scope="col" id="wins" class="winners-head">
                        Počet výher
                    </th>
                    <th colspan="2" scope="col" id="action1" class="winners-head">
                    </th>
                </tr>
                </thead>
                <tbody id="winners-body">
                <?php
                foreach ($peopleRanking as $person) {
                    echo $person->getShortRow();
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

