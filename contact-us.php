<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=gtnumerique', 'root', ''); 
if(isset($_POST['soumettre'])) {
    if(!empty($_POST['nom']) AND ($_POST['prenom']) AND ($_POST['email']) AND ($_POST['message'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        $insertMessage = $database->prepare('INSERT INTO contact_form(nom, prenom, email, message) VALUES (?, ?, ?, ?)');
        $insertMessage->execute(array($nom, $prenom, $email, $message));

        $recupMessage = $database->prepare('SELECT * FROM contact_form WHERE nom = ? AND prenom = ? AND email = ? AND message = ?');
        $recupMessage->execute(array($nom, $prenom, $email, $message));
        
        if($recupMessage->rowCount()>0) {
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['email'] = $email;
            $_SESSION['message'] = $message;
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
	<title>GTNumerique</title>
</head>
<body>

<header class="header">
        <nav class="navbar navbar-expand-lg .bg-light " id="navig">
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
            <h2>Formulaire de contact</h2>
            <div class="">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom.." name="nom" required>
            </div>
            <div class="">
                <label for="prenom" class="form-label">Prénoms</label>
                <input type="text" class="form-control" id="prenom" placeholder="Entrez vos prénoms.." name="prenom" required>
            </div>
            <div class="">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Votre mail pour la newsletter.." name="email" required>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Votre message" id="message" name="message" style="height: 100px"></textarea>
                <label for="message">Message</label>
            </div>
            <button type="submit" class="btn btn-primary" name="soumettre">Envoyer</button>
            <br>
        </form>
    </div>

    <div class="content">
        <h2>Nous sommes également joignables à travers nos réseaux sociaux</h2>
        <div className='social'>
            <ul>
                <li class="hover-link"><a href="#"><img src="assets/img/fb.png"></img></a></li>
                <li class="hover-link"><a href="#"><img src="assets/img/linkedin.png"></img></a></li>
                <li class="hover-link"><a href="#"><img src="assets/img/whatsapp.png"></img></a></li>
            </ul>
        </div>
    </div>

    <footer class="pied">
		© GTNumerique Tous droits réservés
	</footer>

	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>