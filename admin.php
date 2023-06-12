<?php
include 'database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

    $stmt = $db->prepare('SELECT COUNT(*) AS player_count FROM players');
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($result['player_count'] < 23) {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $age = $_POST['age'];
        $position = $_POST['position'];


        $stmt = $db->prepare('INSERT INTO players (firstname, lastname, age, position) VALUES (?, ?, ?, ?)');
        

        $stmt->execute([$firstname, $lastname, $age, $position]);
        

        $success_message = 'Le joueur a été ajouté avec succès.';
    } else {
        $error_message = "Vous avez atteint la limite de 23 joueurs.";
    }
}

$stmt = $db->prepare('SELECT * FROM players');
$stmt->execute();
$players = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion de l'équipe</title>
    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #0046AD;
            color: white;
            padding: 10px;
            position: relative;
        }

        .navbar img {
            height: 50px;
        }

        .navbar .title {
            font-size: 20px;
        }

        .navbar .login-btn {
            background-color: #FFF700;
            border: none;
            color: black;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        ul {
            list-style-type: none;
            margin: 20px;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #F7F7F7;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        ul li h3 {
            font-size: 18px;
            color: #0046AD;
            margin-bottom: 5px;
        }

        ul li p {
            font-size: 14px;
            color: #555555;
            margin: 0;
        }

        ul li .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        ul li .actions button {
            background-color: #0046AD;
            color: white;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
        <?php if (!isset($success_message) && !isset($error_message)): ?>
            <form method="post" action="admin.php">
                <label for="firstname">Prénom :</label>
                <input type="text" id="firstname" name="firstname">

                <label for="lastname">Nom :</label>
                <input type="text" id="lastname" name="lastname">

                <label for="age">Âge :</label>
                <input type="number" id="age" name="age">

                <label for="position">Position :</label>
                <select id="position" name="position">
                    <option value="Gardien">Gardien</option>
                    <option value="Défenseur">Défenseur</option>
                    <option value="Millieu">Millieu</option>
                    <option value="Attaquant">Attaquant</option>
                </select>

                <input type="submit" value="Ajouter" name="add">
            </form>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (isset($success_message)): ?>
        <p><?= $success_message ?></p>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <p><?= $error_message ?></p>
    <?php endif; ?>

    <h2>Liste des joueurs</h2>
    <ul>
        <?php foreach ($players as $player): ?>
            <li>
                <h3><?= $player['firstname'] ?> <?= $player['lastname'] ?></h3>
                <p><?= $player['age'] ?> ans, <?= $player['position'] ?></p>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <div class="actions">
                        <form method="post" action="admin.php">
                            <input type="hidden" name="id" value="<?= $player['id'] ?>">
                            <button type="submit" name="delete">Supprimer</button>
                        </form>
                        <form method="post" action="admin.php">
                            <input type="hidden" name="id" value="<?= $player['id'] ?>">
                            <input type="text" name="firstname" value="<?= $player['firstname'] ?>">
                            <input type="text" name="lastname" value="<?= $player['lastname'] ?>">
                            <input type="number" name="age" value="<?= $player['age'] ?>">
                            <select name="position">
                                <option value="Gardien"<?= $player['position'] === 'Gardien' ? ' selected' : '' ?>>Gardien</option>
                                <option value="Défenseur"<?= $player['position'] === 'Défenseur' ? ' selected' : '' ?>>Défenseur</option>
                                <option value="Millieu"<?= $player['position'] === 'Millieu' ? ' selected' : '' ?>>Millieu</option>
                                <option value="Attaquant"<?= $player['position'] === 'Attaquant' ? ' selected' : '' ?>>Attaquant</option>
                            </select>
                            <button type="submit" name="edit">Modifier</button>
                        </form>
                    </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>







