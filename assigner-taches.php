<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=gtnumerique', 'root', ''); 
if(isset($_POST['publier'])) {
    if(!empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['id_personnel'])) {
        $titre = htmlspecialchars($_POST['titre']);
        $contenu = htmlspecialchars($_POST['contenu']);
        $id_personnel = htmlspecialchars($_POST['id_personnel']);

        // Insérer toutes les données en une seule requête
        $InsertTache = $database->prepare('INSERT INTO taches (titre, contenu, id_personnel) VALUES (?, ?, ?)');
        $InsertTache->execute(array($titre, $contenu, $id_personnel));

        if ($InsertTache) {
            echo "Tâche assignée avec succès !";
        } else {
            echo "Une erreur s'est produite lors de l'ajout de la tâche.";
        }

        $recupTache = $database->prepare('SELECT * FROM taches WHERE titre = ? AND contenu = ? AND id_personnel = ?');
        $recupTache->execute(array($titre, $contenu, $id_personnel));
        
    } else {
        echo "Veuillez renseigner tous les champs !";
    }
}
$recupPersonnel = $database->prepare('SELECT * FROM personnel');
$recupPersonnel->execute();
$employes = $recupPersonnel->fetchAll();

$recupTaches = $database->prepare('SELECT * FROM taches');
$recupTaches->execute();
$taches = $recupTaches->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="main.css">
    <title>Assigner taches</title>
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
        <h2>Assignez les tâches ici</h2>
        <form class="myform" method="post">
            <br>
            <div class="">
                <select class="form-select" aria-label="Default select example" name="id_personnel">
                    <option selected disabled value>Sélectionner l'employé</option>
                    <?php foreach ($employes as $employe): ?>
                        <option value="<?php echo ($employe['id_personnel']); ?>"><?php echo htmlspecialchars($employe['prenom']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="">
                <label for="titre" class="form-label">Titre de la tâche</label>
                <input type="text" class="form-control" id="titre" placeholder="Titre de la tâche..." name="titre" required>
            </div>
            <div class="">
                <label for="contenu" class="form-label">Contenu de la tâche</label>
                <textarea class="form-control" placeholder="La tâche..." id="contenu" name="contenu" style="height: 100px" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="publier">Publier</button>
            <br>
        </form>
    </div>

    <div class="content">
        <h1>TACHES ASSIGNEES</h1>
        <div class=" d-flex flex-wrap">
            <?php foreach ($taches as $tache): ?>
                <div class="card md-4 carte" style="width: 18rem;">
                    <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($tache['titre']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($tache['contenu']); ?></p><hr>
                            <h6 class="card-text">Id employé : <?php echo htmlspecialchars($tache['id_personnel']); ?></h6>
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