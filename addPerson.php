<?php
$error = $_GET['error'] ?? null;
$errorText = "";
if (!strcmp($error, "true")) {
    $errorText = "Chyba pri vytváraní záznamu. Uistite sa či už existuje osoba s daným menom a priezviskom.";
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
    <link href="/olympic-winners/css/main-style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="container">
        <?php include('./partials/header.php') ?>
        <div class="row mt-5">
            <main class="col-lg site-content">
                <h3>
                    Pridanie Osoby
                </h3>
                <?php include('./partials/personForm.php') ?>
                <h5 class="mt-5" style="color: orangered">
                    <?php echo $errorText; ?>
                </h5>
            </main>
        </div>
    </div>
</div>
<?php include('./partials/footer.php') ?>
</body>
</html>