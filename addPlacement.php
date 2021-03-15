<?php
require_once(__DIR__ . "/classes/models/PersonDetail.php");
require_once(__DIR__ . "/classes/models/OlympicGame.php");
require_once(__DIR__ . "/classes/controllers/PersonController.php");
require_once(__DIR__ . "/classes/controllers/OlympicGameController.php");

$error = $_GET['error'] ?? null;
$errorText = "";
if (!strcmp($error, "true")) {
    $errorText = "Chyba pri vytváraní záznamu. Uistite sa či už exituje kombinácia: človek, olympíjska hra a disciplína.";
}
$personController = new PersonController();
$olympicGameController = new OlympicGameController();
$people = $personController->getAllIncomplete();
$olympicGames = $olympicGameController->getAllGames();
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
    <link href="/olympic-winners/css/main-style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="container">
        <?php include('./partials/header.php') ?>
        <div class="row mt-5">
            <main class="col-lg site-content">
                <h3>
                    Pridanie Umiestnenia
                </h3>
                <form method="post" id="placementForm" action="https://wt98.fei.stuba.sk/olympic-winners/api/placementApi.php">
                    <div class="row mt-2">
                        <div class="form-group col">
                            <label for="personid">Meno a priezvisko športovca</label>
                            <select name="personid" id="personid" class="form-select"
                                    aria-label="Default select example" required>
                                <?php foreach ($people as $person) {
                                    echo "<option value='" . $person->getId() . "'> " . $person->getName() . " " . $person->getSurname() . " </option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="form-group col">
                            <label for="ohid">Rok a miesto konania</label>
                            <select name="ohid" id="ohid" class="form-select" aria-label="Default select example" required>
                                <?php foreach ($olympicGames as $game) {
                                    echo "<option value='" . $game->getId() . "'> " . $game->getYear() . " " . $game->getCity() . " " . $game->getType() . " </option>";
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group col">
                            <label for="placing">Umiestnenie</label>
                            <input type="number" name="placing" id="placing" class="form-control" min="1" required>
                        </div>
                        <div class="form-group col">
                            <label for="discipline">Disciplína</label>
                            <input type="text" name="discipline" id="discipline" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-light mt-3">Potvrdiť</button>
                </form>
                <?php echo $errorText; ?>
            </main>
        </div>
    </div>
</div>
<?php include('./partials/footer.php') ?>

</body>
</html>
