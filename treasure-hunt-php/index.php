<?php 
include 'constant.php'
?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Treasure Hunt</title>
    <!-- Import du CSS de Bootstrap via un CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="text-center">
            <img src="<?= $_URLHOST_ . "/images/treasure-hunt.png" ?>" alt="logo" width="300" class="mx-auto">
            <h1 class="font-weight-bold mt-4">Bienvenue sur Treasure Hunt</h1>
            <p class="font-weight-bold mt-2">
                Votre but est de trouver le trésor de Wanautapopotunga <br>
                Cependant, les monstres sont partout,<br>
                Serez-vous capable de les vaincre et de remporter la chasse au trésor ?
            </p>
            <p class="text-muted mt-2">Pour commencer une partie, entrez un pseudo</p>

            <form action="<?= $_URLHOST_ . "/createplayer.php" ?>" method="GET" class="mt-4" id="start-form">
                <div class="d-flex flex-column align-items-center">
                    <div class="form-group w-100">
                        <input type="text" required name="pseudo" class="form-control" placeholder="Pseudo">
                    </div>
                    <div class="form-group w-100">
                        <label for="difficulty">Choisissez la difficulté :</label>
                        <select name="difficulty" id="difficulty" class="form-control">
                            <option value="easy">Facile</option>
                            <option value="medium">Moyen</option>
                            <option value="hard">Difficile</option>
                            <option value="asian">Asian</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3 w-25">Commencer</button>
                </div>
            </form>

            <div id="loading" class="mt-4" style="display: none;">
                <div class="progress">
                    <div id="bar" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Import des scripts Bootstrap via un CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.querySelector('#start-form').addEventListener('submit', function(event) {
            document.querySelector('#loading').style.display = 'block';

            let progress = 0;
            let intervalSpeed = 10;
            let incrementSpeed = 20;
            let bar = document.getElementById('bar');

            let progressInterval = setInterval(function() {
                progress += incrementSpeed;
                bar.style.width = progress + "%";
                bar.setAttribute("aria-valuenow", progress);
                if (progress >= 100) {
                    clearInterval(progressInterval);
                }
            }, intervalSpeed);
        });
    </script>
</body>

</html>