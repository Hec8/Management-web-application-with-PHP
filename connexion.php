<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=gtnumerique', 'root', ''); 
    if(isset($_POST['soumettre'])) {
        if(!empty($_POST['prenom']) AND ($_POST['password'])) {
            $prenom = htmlspecialchars($_POST['prenom']);
            $password = $_POST['password'];
            $recupUser = $database->prepare('SELECT * FROM personnel WHERE prenom = ? AND password = ?');
            $recupUser->execute(array($prenom, $password));
            
            if($recupUser->rowCount()>0) {
                $_SESSION['prenom'] = $prenom;
                $_SESSION['password'] = $password;
                $_SESSION['id_personnel'] = $recupUser->fetch()['id_personnel'];
                header('Location: index-co.php');
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect";
            }
            
        } else {
            echo "Veuillez renseigner tous les champs !";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="main.css">
    <title>Login</title>
</head>
<body>
    
    <header class="header">
        <nav class="navbar navbar-expand-lg .bg-light" id="navig">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/WhatsApp Image 2024-08-05 à 12.42.53_179eb500.jpg" alt="Logo" width="100" height="55">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
						<li class="nav-item me-3"><a href="contact-us.php">Nous contacter</a></li>
                        <li class="nav-item me-3"><a href="connexion.php">Se connecter</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="content-form">
        <form class="myform" method="post">
            <br>
            <img src="assets/img/login.png" class="image" alt="Login">
            <h3 class="titre">Se connecter</h3><br>
            <h6>Se connecter en tant qu'administrateur, secrétaire ou employé</h6>
            <div class="">
                <label for="prenom" class="form-label">Prenom ou rôle</label><img class="icon" src="assets/img/user.png" alt="user">
                <input type="text" class="form-control" id="prenom" placeholder="Prénom pour l'employé / rôle pour l'administrateur" name="prenom" required>
            </div>
            <div class="">
                <label for="pass" class="form-label">Mot de passe</label><img class="icon" src="assets/img/lock.png" alt="pass"><a href="#">Mot de passe oublié ?</a>
                <input type="password" class="form-control" id="pass" placeholder="Entrez votre mot de passe" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="soumettre">Se connecter</button>
            <br>
        </form>
    </div>

    <footer class="pied">
		© GTNumerique Tous droits réservés
	</footer>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>