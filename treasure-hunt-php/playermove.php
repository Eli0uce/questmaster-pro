<?php
require_once 'dbconnect.php';


$mapx = range(0, 10);
$mapy = range(0, 10);
$victory = 0;

function fetchDataFromDatabase($pdo, $query, $messageOnEmpty)
{
    try {
        $stmt = $pdo->query($query);
        $result = $stmt->fetch();

        if (!$result) {
            echo $messageOnEmpty;
        }
        return $result;
    } catch (\PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

$player = fetchDataFromDatabase($pdo, 'SELECT * FROM wp_players ORDER BY id ASC LIMIT 1', "No players found in the table.");
$treasure = fetchDataFromDatabase($pdo, 'SELECT * FROM wp_treasures', "No treasures found in the table.");

// var_dump($treasure);

if (isset($_GET['direction'])) {
    $direction = $_GET['direction'];
    $posX = $player['posx'];
    $posY = $player['posy'];

    $maxpv = $player['pv'];

    $treasurePosX = $treasure['posx'];
    $treasurePosY = $treasure['posy'];

    function randomAction($player, $maxpv, $pdo,&$enemy = null)
    {
     
        $randomValue = mt_rand(1, 100); // Generates a random number between 1 and 100
        if ($randomValue <= 30) { // 20% chance
            $stmt = $pdo->query('SELECT * FROM wp_ennemies ORDER BY RAND() LIMIT 1');
            $enemy = $stmt->fetch(PDO::FETCH_OBJ);

            if (!$enemy) {
                return "Vous avez pourfendu tous les ennemis";
            }

            // // Ensure both players have a non-zero attack value
            // if ($player['attk'] <= 0 || $enemy->attk <= 0) {
            //     return "One of the combatants has no attack power!";
            // }

            while ($player['pv'] > 0 && $enemy->pv > 0) {
                $enemy->pv -= $player['attk'];
                if ($enemy->pv > 0) {
                    $player['pv'] -= $enemy->attk;
                }

                // Ensure health does not drop below 0
                $player['pv'] = max(0, $player['pv']);
                $enemy->pv = max(0, $enemy->pv);
            }

            // Update the player's health in the database
            $stmt = $pdo->prepare("UPDATE wp_players SET pv = :pv WHERE id = :id");
            if (!$stmt->execute(['pv' => $player['pv'], 'id' => $player['id']])) {
                return "Error updating player health.";
            }

            if ($player['pv'] <= 0) {
                return 'Vous avez perdu contre un(e) ' . $enemy->type;
            } else {

                $player['xp'] += $enemy->attk;
                $player['pv'] = $maxpv;

                if ($player['xp'] >= $player['lvl'] * 10) {
                    $player['xp'] = 0;
                    $player['lvl'] = $player['lvl'] + 1;
                    $player["pv"] += 2;
                    $player['attk'] += 1;
                }

                $stmt = $pdo->prepare("UPDATE wp_players SET pv = :pv, attk = :attk ,lvl = :lvl ,xp = :xp WHERE id = :id");
                if (!$stmt->execute(['pv' => $player['pv'], 'attk' => $player['attk'], 'lvl' => $player['lvl'], 'xp' => $player['xp'], 'id' => $player['id']])) {
                    return "Error updating player data.";
                }

                $stmt = $pdo->prepare("DELETE FROM wp_ennemies WHERE id = :id");
                if (!$stmt->execute(['id' => $enemy->id])) {
                    return "Error deleting defeated enemy.";
                }
                return 'Vous avez gagné contre un(e) ' . $enemy->type;
            }
        }
    }
    $enemy = [];
    switch ($direction) {
        case 'ArrowUp':
            if ($posY == 10) {
                $message = "movement impossible";
            } else {
                $message = randomAction($player, $maxpv,  $pdo,$enemy);
                $sql = "UPDATE wp_players SET posy = posy + 1 WHERE id = :playerId";
            }
            break;
        case 'ArrowDown':
            if ($posY == 0) {
                $message = "movement impossible";
            } else {
                $message = randomAction($player, $maxpv, $pdo,  $enemy );
                $sql = "UPDATE wp_players SET posy = posy - 1 WHERE id = :playerId";
            }
            break;
        case 'ArrowLeft':
            if ($posX == 0) {
                $message = "movement impossible";
            } else {
                $message = randomAction($player, $maxpv, $pdo,  $enemy );
                $sql = "UPDATE wp_players SET posx = posx - 1 WHERE id = :playerId";
            }
            break;
        case 'ArrowRight':
            if ($posX == 10) {
                $message = "Vous essayer d'avancer dans un mur";
            } else {
                $message = randomAction($player, $maxpv, $pdo,  $enemy );
                $sql = "UPDATE wp_players SET posx = posx + 1 WHERE id = :playerId";
            }
            break;
        default:
            // Invalid direction or you may want to handle it differently
            exit('Invalid direction');
    }

    if ($posX == $treasurePosX && $posY == $treasurePosY) {
        $message = "You win!";
    }


    if (isset($sql)) {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['playerId' => $player['id']]);

        // Refetch player data after updating
        $stmt = $pdo->query('SELECT * FROM wp_players WHERE id = ' . $player['id']);
        $player = $stmt->fetch();
    }


    $output = array(
        'player' => $player,
        'message' => $message ?? null,
        "ennemy"=>$enemy
    );

    echo json_encode($output);
}
