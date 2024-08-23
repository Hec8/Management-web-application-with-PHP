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

    <div class="content">
        <?php
            session_start();
            if($_SESSION['prenom'] === "administrateur" && $_SESSION['password'] === "admin"){
                echo ("Mr le Directeur, vous êtes connecté ");
            }elseif($_SESSION['prenom'] === "secretaire" && $_SESSION['password'] === "secret"){
                echo ("Mr/Mme le/la Secrétaire, vous êtes connecté(e)");
            }else {
                echo ("Employé ".$_SESSION['prenom'].", ");
            }
        ?>
        <br>
        <h2>Bienvenue sur le site de GT Numérique</h2>

        <?php 
            if($_SESSION['prenom'] === "administrateur" && $_SESSION['password'] === "admin"){
                echo '<a href="profil-admin.php">Accéder à l\'espace de travail</a>';
            }elseif($_SESSION['prenom'] === "secretaire" && $_SESSION['password'] === "secret"){
                echo '<a href="profil-secretaire.php">Accéder à l\'espace de travail</a>';
            }else {
                echo '<a href="profil-employe.php">Voir votre profil </a>';
            }
        ?>
    </div>

            

    <footer class="pied">
		© GTNumerique Tous droits réservés
	</footer>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>