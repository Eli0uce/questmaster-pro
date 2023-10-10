<!DOCTYPE html>
<html>

<head>
    <title>Game Over</title>
    <!-- Import du CSS de Bootstrap via un CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="p-4 rounded-lg shadow text-center d-flex flex-column d-flex flex-column">
            <?php if ($_GET['ennemy'] == "Vous avez perdu contre un(e) asian mom")  : ?>
                <img class="w-50 align-self-center" src="./images/damage.jpg" alt="">
            <?php else :?>
                <img src="./images/died.png" alt="">
            <?php endif ?>
            <?= isset($_GET['ennemy']) ?  $_GET['ennemy'] : ""; ?>
            <a href="/treasure-hunt-php" class="btn btn-danger mt-4">Réessayer</a>
        </div>
    </div>

    <!-- Import des scripts Bootstrap via un CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>