<?php
    session_start();
    $database = new PDO('mysql:host=localhost;dbname=gtnumerique', 'root', '');
    $id_personnel = $_SESSION['id_personnel']; // Supposons que l'ID de l'employé est stocké dans la session
    // Récupérer les tâches assignées
    $recupTaches = $database->prepare('SELECT * FROM taches WHERE id_personnel = ?');
    $recupTaches->execute([$id_personnel]);
    $taches = $recupTaches->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="main.css">
    <title>Tâches</title>
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
                        <li class="nav-item me-3"><a href="profil-employe.php">Retourner sur l'espace de travail</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="content">
        <h2>Consultez vos tâches ici</h2>
        <div class="d-flex flex-wrap">
            <?php if (count($taches) > 0): ?>
                <?php foreach ($taches as $tache): ?>
                    <div class="card md-4" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($tache['titre']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($tache['contenu']); ?></p>
                            <a href="#" class="btn btn-primary">Accomplir</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune tâche ne vous est assignée.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer class="pied">
		© GTNumerique Tous droits réservés
	</footer>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>