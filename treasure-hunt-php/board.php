<?php
include 'dbconnect.php';
include 'boarddata.php';
include 'playermove.php';
include 'constant.php'
    ?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Treasure Hunt</title>
    <!-- Import du CSS de Bootstrap via un CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ebebeaafad.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= $_URLHOST_ . "/style.css" ?>">

</head>

<body data-urlhost="<?= $_URLHOST_ ?>">
    <div class="container">
        <div class="text-center mt-5">
            <img src="./images/treasure-hunt.png" alt="logo" width="300" class="mx-auto d-block">
            <a href="<?= $_URLHOST_ ?>" class="btn btn-success text-uppercase font-weight-bold mt-5 mb-5">Nouvelle
                partie</a>
        </div>
        <div class="row">
            <div class="bg-white p-4 rounded-lg shadow-sm mb-4  col-6 d-flex">
                <div class='row w-100'>
                    <div class="chat-messages mb-4 col-8">
                        <div class="font-weight-bold" id="message"></div>
                        <div class="message text-success font-weight-bold">Début de la partie !</div>
                    </div>
                    <div class='col-4'>
                        <div class="fight-box">
                            <div id="swordhit" style="width: 400px; height: 500px"></div>
                            <img id="avatarennemy" alt="" class='img-fluid h-75'>
                      
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="bg-white p-4 rounded-lg shadow-sm mb-4 d-flex justify-content-between align-items-center  col-6">
                <div class="d-flex flex-column w-100">
                    <button type="button" class="btn  align-self-end" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        <i class="fa-solid fa-circle-info" style="color: #000000;"></i>
                    </button>
                    <div class="d-flex justify-content-around">
                        <div>
                            <p class="d-inline mb-2 font-weight-bold">Joueur :
                                <?php echo $player["pseudo"] . " |" ?>
                            </p>
                            <p id="lvl" class="d-inline mb-2 font-weight-bold text-danger">Niveau :
                                <?php echo $player["lvl"] ?>
                            </p>
                            <p id="playerstats" class="font-weight-bold text-success">
                                <?php echo $player['pv']; ?> <i title="point de vie" class="fa-solid fa-heart fa-lg"
                                    style="color: #f00a0a;"></i> |
                                <?php echo $player['attk']; ?> <i title="attaque" class="fa-solid fa-burst"
                                    style="color: #000000;"></i>
                            </p>
                            <p id="playerxp" class="font-weight-bold text-info ">
                                <?= "XP : " . $player["xp"] ?>
                            </p>
                            <p id="pos" class="font-weight-bold text-warning ">
                                <?= 'POS : [' . $player["posx"] . ',' . $player['posy'] . ']' ?>
                            </p>
                            <section class="mt-3">
                                <span class="movebutton" id="ArrowUp">&uarr;</span>
                                <span class="movebutton" id="ArrowLeft">&larr;</span>
                                <span class="movebutton" id="ArrowDown">&darr;</span>
                                <span class="movebutton" id="ArrowRight">&rarr;</span>
                            </section>
                        </div>
                        <div class="avatar-box">
                            <img id="avatar" width="150" src="path_to_your_image.jpg" alt="Avatar" />
                            <div id="levelupEffect" style="width: 400px; height: 500px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Regles du jeu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                <li class="mb-2">Le joueur ce deplace en utilsant les fleches</li>
                                <li class="mb-2">Le joueur combat des monstres et remporte de l'xp une fois un certains
                                    seuille d'xp obtenu il monte de niveau gagnant aisin des pv <i title="point de vie"
                                        class="fa-solid fa-heart fa-lg" style="color: #f00a0a;"></i> et attk <i
                                        title="attaque" class="fa-solid fa-burst" style="color: #000000;"></i></li>
                                <li class="mb-2">Le but du joueur est de trouver le trésor , il est caché au harsard
                                    dans le donjon</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Import des scripts Bootstrap via un CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.6/lottie.min.js"></script>

    <script>
        function playAnimation(animation,container) {
            const lottieContainer = document.getElementById(container);

            lottieContainer.style.display = 'block';  // Display the Lottie container

            // Reset and play the Lottie animation
            animation.goToAndPlay(0, true);

            animation.addEventListener('complete', function () {
                lottieContainer.style.display = 'none';  // Hide the Lottie container after animation completes
            });
        }
        document.addEventListener('DOMContentLoaded', function () {
            let levelupAnimation = lottie.loadAnimation({
                container: document.getElementById('levelupEffect'),
                renderer: 'svg',
                loop: false,
                autoplay: false, // Important to set this to false since we'll play it programmatically
                path: 'https://lottie.host/43c552a9-a125-43c1-9283-9346730f449b/3WCXZIvJgj.json'
            });
            let swordhitAnimation = lottie.loadAnimation({
                container: document.getElementById('swordhit'),
                renderer: 'svg',
                loop: false,
                autoplay: false, // Important to set this to false since we'll play it programmatically
                path: 'https://lottie.host/fc6e778b-cc6a-4214-a220-0584f93ed725/Uwvb9QPXwr.json'
            });
            let message = document.getElementById('message');
            let lvl = document.getElementById('lvl');
            let playerstats = document.getElementById('playerstats');
            let pos = document.getElementById('pos');
            let playerxp = document.getElementById('playerxp');
            let avatar = document.getElementById('avatar');
            let arrowUp = document.getElementById('arrowUp');
            let arrowDown = document.getElementById('arrowDown');
            let arrowLeft = document.getElementById('arrowLeft');
            let arrowRight = document.getElementById('arrowRight');
            let avatarennemy = document.getElementById("avatarennemy");
            let urlhost = document.body.dataset.urlhost;
            let pv = null;
            let currentLevel = null;

            fetch(`${urlhost}/avatar.php`)
                .then((response) => {
                    return response.json()
                }).then((res) => {
                    console.log(res);
                    avatar.src = res.avatar;
                }).catch((error) => {
                    console.log(error);
                })

            document.addEventListener('click', function (e) {
                let validKeys = ['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'];
                if (validKeys.includes(e.target.id) && pv !== 0) {
                    fetch(`${urlhost}/playermove.php?direction=${e.target.id}`)
                        .then((response) => {
                            return response.json()
                        }).then((res) => {
                            handleMoveResponse(res)
                        }).catch((error) => {
                            console.log(error);
                        })
                }
            });

            function handleMoveResponse(res) {
                console.log(res);

                playerstats.innerText = "Stats : " + res.player.pv + "PV | " + res.player.attk + "PA";

                let moveText;
                if (res.message === null) {
                    moveText = "Vous etes en position : ( x= " + res.player.posx + " , y=" + res.player.posy + ")";
                } else {
                    moveText = res.message;
                }

                pv = res.player.pv;

                let moveContainer = document.createElement('div');

                let move = document.createElement('p');
                move.className = 'child';
                move.appendChild(moveContainer);
                message.prepend(move);

                var options = {
                    strings: [moveText],
                    typeSpeed: (res.player.pv <= 0 || res.message === "You win!") ? 50 : 30,
                    showCursor: false,
                    onComplete: () => {
                        setTimeout(() => {
                            if (res.player.pv <= 0) {
                                window.location.replace(`${urlhost}/lose.php?ennemy=${res.message}`);
                            }

                            if (res.message === "You win!") {
                                window.location.replace(`${urlhost}/win.php`);
                            }
                        }, 1000);
                    }
                };

                var typed = new Typed(moveContainer, options);

                if (res.ennemy?.length != 0) {
                    playAnimation(swordhitAnimation,"swordhit");
                    avatarennemy.src = urlhost + res.ennemy.avatar;
                }

                lvl.innerHTML = "Niveau : " + res.player.lvl;

                // Check if the player has leveled up
                if (currentLevel !== null && res.player.lvl > currentLevel) {
                    playAnimation(levelupAnimation,"levelupEffect");
                }

                currentLevel = res.player.lvl; // Update the current level with the level from the response


                playerxp.innerHTML = "Xp : " + res.player.xp;
                pos.innerText = "Pos : (" + res.player.posx + "," + res.player.posy + ")";

                let children = message.getElementsByClassName('child');
                if (children.length > 6) {
                    message.removeChild(children[children.length - 1]);
                }


            }
        });
    </script>
</body>

</html>