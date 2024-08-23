<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=gtnumerique', 'root', ''); 
if(isset($_POST['publier'])) {
    if(!empty($_POST['titre']) AND !empty($_POST['annonce']) AND !empty($_POST['publicateur'])) {
        $titre = htmlspecialchars($_POST['titre']);
        $annonce = htmlspecialchars($_POST['annonce']);
        $publicateur = htmlspecialchars($_POST['publicateur']);
        $insertMessage = $database->prepare('INSERT INTO annonces(titre, annonce, publicateur) VALUES (?, ?, ?)');
        $insertMessage->execute(array($titre, $annonce, $publicateur));

        $recupMessage = $database->prepare('SELECT * FROM annonces WHERE titre = ? AND annonce = ? AND publicateur = ?');
        $recupMessage->execute(array($titre, $annonce, $publicateur));

        echo "Annonce publiée";
        
        if($recupMessage->rowCount()>0) {
            $_SESSION['titre'] = $titre;
            $_SESSION['annonce'] = $annonce;
            $_SESSION['publicateur'] = $publicateur;
        }

        
    } else {
        echo "Veuillez renseigner tous les champs !";
    }


}
$recupUsers = $database->prepare('SELECT * FROM annonces');
$recupUsers->execute();
$annonce = $recupUsers->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="main.css">
    <title>Annonces</title>
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
                    <?php 
                        if($_SESSION['prenom'] === "administrateur" && $_SESSION['password'] === "admin"){
                            echo '<li class="nav-item me-3"><a href="profil-admin.php">Retourner sur l\'espace de travail</a></li>';
                        }elseif($_SESSION['prenom'] === "secretaire" && $_SESSION['password'] === "secret"){
                            echo '<li class="nav-item me-3"><a href="profil-secretaire.php">Retourner sur l\'espace de travail</a></li>';
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="content-form">
        <h2>Publier des annonces ici</h2>
        <form class="myform" method="post">
            <br>
            <div class="">
                <label for="titre" class="form-label">Titre de l'annonce</label>
                <input type="text" class="form-control" id="titre" placeholder="Titre de l'annonce..." name="titre" required>
            </div>
            <div class="">
                <label for="annonce" class="form-label">Annonce</label>
                <textarea class="form-control" placeholder="L'annonce..." id="annonce" name="annonce" style="height: 100px" required></textarea>
            </div>
            <div class="">
                <label for="publicateur" class="form-label">Publiée par : </label>
                <input type="text" class="form-control" id="publicateur" placeholder="Publicateur..." name="publicateur" required>
            </div>
            <button type="submit" class="btn btn-primary" name="publier">Publier</button>
            <br>
        </form>
    </div>

    <div class="content">
        <h1>ANNONCES PUBLIEES</h1>
            <div class=" d-flex flex-wrap">
                <?php foreach ($annonce as $annonces): ?>
                    <div class="card md-4 carte" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($annonces['titre']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($annonces['annonce']); ?></p><hr>
                            <h5 class="card-title">Publiée par : <?php echo htmlspecialchars($annonces['publicateur']); ?></h5>
                            <a href="#" class="btn btn-primary">Lire plus</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
    </div>

    <footer class="pied">
		© GTNumerique Tous droits réservés
	</footer>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>