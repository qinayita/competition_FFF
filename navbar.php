<!DOCTYPE html>
<html>
<head>
    <title>Gestion de l'équipe</title>
    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            color: blue;
            padding: 10px;
        }

        .navbar img {
            height: 100px;
        }

        .navbar .title {
            font-size: 20px;
            text-shadow: 1px 1px 2px lightblue; 
            border-top: 1px solid red; 
            padding-top: 10px; 
            margin-bottom: 10px; 
        }

        .navbar .login-btn {
            background-color: blue;
            border: none;
            color: white;
            padding: 10px 20px;
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
    <div class="navbar">
        <div>
            <img src="https://lbfc.fff.fr/wp-content/uploads/sites/11/2021/04/PEF_R_RVB.png" alt="FFF Logo">
        </div>
        <div class="title">
            <div style="margin-bottom: 5px;">&nbsp;</div> 
            Les joueurs français sélectionnés pour la Coupe d'Europe
            <div style="margin-top: 5px;">&nbsp;</div> 
        </div>
        <div>
            <?php if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']): ?>
                <a href="login.php" class="login-btn">Se connecter</a>
            <?php else: ?>
                <a href="logout.php" class="login-btn">Se déconnecter</a>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
