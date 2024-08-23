<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=gtnumerique', 'root', ''); 
if(isset($_POST['envoi'])) {
    if(!empty($_POST['prenom']) AND !empty($_POST['poste']) AND !empty($_POST['email']) AND !empty($_POST['password'])) {
        $prenom = htmlspecialchars($_POST['prenom']);
        $poste = htmlspecialchars($_POST['poste']);
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];
        $insertUser = $database->prepare('INSERT INTO personnel(prenom, poste, email, password) VALUES (?, ?, ?, ?)');
        $insertUser->execute(array($prenom, $poste, $email, $password));

        if ($InsertUser) {
            echo "Utilisateur créé avec succès !";
        } else {
            echo "Une erreur s'est produite lors de la création du compte.";
        }

        $recupUser = $database->prepare('SELECT * FROM personnel WHERE prenom = ? AND poste = ? AND email = ? AND password = ?');
        $recupUser->execute(array($prenom, $poste, $email, $password));
        
        if($recupUser->rowCount()>0) {
            $_SESSION['prenom'] = $prenom;
            $_SESSION['poste'] = $poste;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['id_personnel'] = $recupUser->fetch()['id_personnel'];
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
    <title>Register</title>
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
                    <li class="nav-item me-3"><a href="profil-secretaire.php">Retourner sur l'espace de travail</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="content-form">
        <form class="myform" method="post">
            <br>
            <img src="assets/img/login.png" class="image" alt="Login">
            <h3 class="titre">INSCRIPTION</h3>
            <h4>Inscrire un nouvel employé</h4>
            <div class="">
                <label for="prenom" class="form-label">Prénom ou rôle</label><img class="icon" src="assets/img/user.png" alt="user">
                <input type="text" class="form-control" id="prenom" placeholder="Entrez votre prenom..." name="prenom" required>
            </div>
            <div class="">
                <label for="poste" class="form-label">Poste</label><img class="icon" src="assets/img/user.png" alt="user">
                <input type="poste" class="form-control" id="poste" placeholder="Entrez votre poste en minuscule..." name="poste" required>
            </div>
            <div class="">
                <label for="email" class="form-label">Email</label><img class="icon" src="assets/img/mail.png" alt="user">
                <input type="email" class="form-control" id="email" placeholder="Entrez votre email..." name="email" required>
            </div>
            <div class="">
                <label for="pass" class="form-label">Mot de passe</label><img class="icon" src="assets/img/lock.png" alt="pass">
                <input type="password" class="form-control" id="pass" placeholder="Entrez votre mot de passe..." name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="envoi">Inscrire</button>
            <br>
        </form>
    </div>

    <footer class="pied">
		© GTNumerique Tous droits réservés
	</footer>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>