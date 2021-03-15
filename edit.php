<?php
include('./partials/errorDisplay.php');
require_once "./classes/models/PersonDetail.php";
require_once "./classes/controllers/PersonController.php";

$id = $_GET['id'] ?? null;
$personController = new PersonController();
$person = $personController->getById($id);
if (is_null($person)) {
    header("Location: https://wt98.fei.stuba.sk/olympic-winners/best10.php");
}
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
    <link href="../css/main-style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <?php include('./partials/header.php') ?>
    <div class="row mt-5">
        <main class="col-lg site-content">
            <h3>
                <?php echo "ID." . $person->getId() . " " . $person->getName() . " " . $person->getSurname() ?>
            </h3>
            <?php include('./partials/personForm.php') ?>
        </main>
    </div>
</div>
<?php include('./partials/footer.php') ?>
</body>
</html>