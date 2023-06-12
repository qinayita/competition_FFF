<?php
include 'database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
    $stmt->execute(['username' => $username, 'password' => $password]);

    if ($stmt->fetch()) {
        $_SESSION['logged_in'] = true;
        header('Location: admin.php');
        exit();
    } else {
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
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

        form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #0046AD;
            border-radius: 5px;
            background-color: #f2f2f2;
            max-width: 400px;
            margin: 0 auto;
        }

        form label {
            display: block;
            margin-bottom: 10px;
        }

        form input[type="text"],
        form input[type="password"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            margin-bottom: 10px;
            width: 100%;
        }

        form input[type="submit"] {
            background-color: #0046AD;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        form p.error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .home-btn {
            background-color: #0046AD;
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <form method="post" action="login.php">
        <label for="username">Identifiant :</label>
        <input type="text" id="username" name="username">

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password">

        <input type="submit" value="Connexion">
    </form>

    <?php if (isset($error_message)): ?>
        <p class="error-message"><?= $error_message ?></p>
    <?php endif; ?>

    <a href="admin.php" class="home-btn">Accueil</a>
</body>
</html>


