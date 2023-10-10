<?php
require_once 'dbconnect.php';




function executeQuery($pdo, $sql, $params = [])
{
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function insertPlayer($pdo, $pseudo, $hp, $attk, $xp, $link)
{


    $sql = "INSERT INTO wp_players (pseudo, pv, attk, xp, avatar) VALUES (:pseudo, :pv, :attk, :xp, :avatar)";
    executeQuery($pdo, $sql, [
        ':pseudo' => $pseudo,
        ':pv' => $hp,
        ':attk' => $attk,
        ':xp' => $xp,
        ':avatar' => $link
    ]);
}

function insertEnemy($pdo, $type, $pv, $attk,  $avatar)
{
    $sql = "INSERT INTO wp_ennemies (type, pv, attk, avatar) VALUES (:type, :pv, :attk, :avatar)";
    executeQuery($pdo, $sql, [
        ':type' => $type,
        ':pv' => $pv,
        ':attk' => $attk,
        ':avatar' => $avatar
    ]);
}


function insertTreasure($pdo, $treasurePosX, $treasurePosY)
{
    $sql = "INSERT INTO wp_treasures (posx, posy) VALUES (:posx, :posy)";
    executeQuery($pdo, $sql, [
        ':posx' => $treasurePosX,
        ':posy' => $treasurePosY,
    ]);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $pseudo = $_GET['pseudo'];
    $difficulty = $_GET['difficulty'];

    // Treasure positions randomized on map
    $treasurePosX = rand(1, 10);
    $treasurePosY = rand(1, 10);

    // Empty the players table
    executeQuery($pdo, "TRUNCATE TABLE wp_players");


    // Insert the new player
    $accessory = ["Blank", "Kurt", "Prescription01", "Prescription02", "Round", "Sunglasses", "Wayfarers"];
    $top = ["NoHair", "Eyepatch", "Hat", "Hijab", "Turban", "WinterHat1", "WinterHat2", "WinterHat3", "WinterHat4", "LongHairBigHair", "LongHairBob", "LongHairBun", "LongHairCurly", "LongHairCurvy", "LongHairDreads", "LongHairFrida", "LongHairFro", "LongHairFroBand", "LongHairNotTooLong", "LongHairShavedSides", "LongHairMiaWallace", "LongHairStraight", "LongHairStraight2", "LongHairStraightStrand", "ShortHairDreads01", "ShortHairDreads02", "ShortHairFrizzle", "ShortHairShaggyMullet", "ShortHairShortCurly", "ShortHairShortFlat", "ShortHairShortRound", "ShortHairShortWaved", "ShortHairSides", "ShortHairTheCaesar", "ShortHairTheCaesarSidePart"];
    $hairColor = ["Auburn", "Black", "Blonde", "BlondeGolden", "Brown", "BrownDark", "PastelPink", "Blue", "Platinum", "Red", "SilverGray"];
    $facialHair = ["Blank", "BeardMedium", "BeardLight", "BeardMajestic", "MoustacheFancy", "MoustacheMagnum"];
    $facialHairColor = ["Auburn", "Black", "Blonde", "BlondeGolden", "Brown", "BrownDark", "Platinum", "Red"];
    $clotheType = ["BlazerShirt", "BlazerSweater", "CollarSweater", "GraphicShirt", "Hoodie", "Overall", "ShirtCrewNeck", "ShirtScoopNeck", "ShirtVNeck"];
    $eyeType = ["Close", "Cry", "Default", "Dizzy", "EyeRoll", "Happy", "Hearts", "Side", "Squint", "Surprised", "Wink", "WinkWacky"];
    $eyebrowType = ["Angry", "AngryNatural", "Default", "DefaultNatural", "FlatNatural", "RaisedExcited", "RaisedExcitedNatural", "SadConcerned", "SadConcernedNatural", "UnibrowNatural", "UpDown", "UpDownNatural"];
    $mouthType = ["Concerned", "Default", "Disbelief", "Eating", "Grimace", "Sad", "ScreamOpen", "Serious", "Smile", "Tongue", "Twinkle", "Vomit"];
    $skinType = ["Concerned", "Default", "Disbelief", "Eating", "Grimace", "Sad", "ScreamOpen", "Serious", "Smile", "Tongue", "Twinkle", "Vomit"];

    $randomAccessory = $accessory[array_rand($accessory)];
    $randomTop = $top[array_rand($top)];
    $randomHairColor = $hairColor[array_rand($hairColor)];
    $randomFacialHair = $facialHair[array_rand($facialHair)];
    $randomFacialHairColor = $facialHairColor[array_rand($facialHairColor)];
    $randomClotheType = $clotheType[array_rand($clotheType)];
    $randomEyeType = $eyeType[array_rand($eyeType)];
    $randomEyebrowType = $eyebrowType[array_rand($eyebrowType)];
    $randomMouthType = $mouthType[array_rand($mouthType)];
    $randomSkinType = $skinType[array_rand($skinType)];

    $link = 'https://avataaars.io/?avatarStyle=Transparent&topType=' . $randomTop . '&accessoriesType=' . $randomAccessory . '&hairColor=' . $randomHairColor . '&facialHairType=' . $randomFacialHair . '&facialHairColor=' .  $randomFacialHairColor . '&clotheType=' . $randomClotheType . '&clotheColor=Gray02&eyeType=' . $randomEyeType . '&eyebrowType=' . $randomEyebrowType . '&mouthType=' . $randomMouthType . '&skinColor=' . $randomSkinType;


    insertPlayer($pdo, $pseudo, 10, 5, 0, $link);

    executeQuery($pdo, "TRUNCATE TABLE wp_ennemies");

    // Define enemy types and insert them depending on difficulty random enemies

    if ($difficulty === 'easy') {
        $enemyTypes = ['goblin', 'skeleton', 'zombie'];
        for ($i = 0; $i < 25; $i++) {
            $type = $enemyTypes[array_rand($enemyTypes)];
            switch ($type) {
                case "goblin":
                    $pv = rand(2, 5);
                    $attk = rand(1, 5);
                    $avatar = "/images/goblin.png";
                    break;
                case "skeleton":
                    $pv = rand(3, 11);
                    $attk = rand(3, 10);
                    $avatar = "/images/skull.png";
                    break;
                case "zombie":
                    $pv = rand(4, 11);
                    $attk = rand(4, 10);
                    $avatar = "/images/zombie.png";
                    break;
                default:
                    echo "no monster";
            }
            insertEnemy($pdo, $type, $pv, $attk,  $avatar);
        }
    } elseif ($difficulty === 'medium') {
        $enemyTypes = ['goblin', 'skeleton', 'orc', 'zombie', 'troll'];
        for ($i = 0; $i < 40; $i++) {
            $type = $enemyTypes[array_rand($enemyTypes)];
            switch ($type) {
                case "goblin":
                    $pv = rand(2, 15);
                    $attk = rand(2, 6);
                    $avatar = "/images/goblin.png";
                    break;
                case "skeleton":
                    $pv = rand(2, 15);
                    $attk = rand(2, 6);
                    $avatar = "/images/skull.png";
                    break;
                case "orc":
                    $pv = rand(2, 15);
                    $attk = rand(2, 6);
                    $avatar = "/images/troll.png";
                    break;
                case "zombie":
                    $pv = rand(2, 15);
                    $attk = rand(2, 6);
                    $avatar = "/images/zombie.png";
                    break;
                case "troll":
                    $pv = rand(2, 15);
                    $attk = rand(2, 6);
                    $avatar = "/images/troll.png";
                    break;
                default:
                    echo "no monster";
            }
            insertEnemy($pdo, $type, $pv, $attk,  $avatar);
        }
    } elseif ($difficulty === 'hard') {
        $enemyTypes = ['goblin', 'skeleton', 'orc', 'zombie', 'troll'];
        for ($i = 0; $i < 50; $i++) {
            $type = $enemyTypes[array_rand($enemyTypes)];
            switch ($type) {
                case "goblin":
                    $pv = rand(5, 10);
                    $attk = rand(2, 6);
                    $avatar = "/images/goblin.png";
                    break;
                case "skeleton":
                    $pv = rand(6, 11);
                    $attk = rand(2, 6);
                    $avatar = "/images/skull.png";
                    break;
                case "orc":
                    $pv = rand(8, 15);
                    $attk = rand(2, 6);
                    $avatar = "/images/troll.png";
                    break;
                case "zombie":
                    $pv = rand(7, 12);
                    $attk = rand(2, 6);
                    $avatar = "/images/zombie.png";
                    break;
                case "troll":
                    $pv = rand(10, 18);
                    $attk = rand(10, 15);
                    $avatar = "/images/troll.png";
                    break;
                default:
                    echo "no monster";
            }
            insertEnemy($pdo, $type, $pv, $attk,  $avatar);
        }
    } elseif ($difficulty === 'asian') {
        $type = 'asian mom';
        $pv = 9999;
        $attk = 9999;
        $avatar = "/images/asian.png";
        insertEnemy($pdo, $type, $pv, $attk,  $avatar);
    }


    // Empty the treasure table
    executeQuery($pdo, "TRUNCATE TABLE wp_treasures");

    // Insert the new treasure
    insertTreasure($pdo, $treasurePosX, $treasurePosY);
}


header('Location: board.php');
exit;
