<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=gtnumerique', 'root', ''); 

$recupReservation = $database->prepare('SELECT * FROM reservation');
$recupReservation->execute();
$reservations = $recupReservation->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="main.css">
    <title>Reservations</title>
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
                        <li class="nav-item me-3"><a href="profil-admin.php">Retourner sur l'espace de travail</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="content">
        <h2><b>RESERVATIONS</b></h2>
            <div class=" d-flex flex-wrap">
            <?php foreach ($reservations as $reservation): ?>
                <table class="table table-bordered table-striped m-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Identifiant de la réservation</th>
                            <th>Numéro de la salle</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['id_reservation']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['num_salle']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['debut_reservation']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['fin_reservation']); ?></td>
                        </tr>
                    </tbody>
                </table>
        <?php endforeach; ?>
            </div>
    </div>

    <footer class="pied">
		© GTNumerique Tous droits réservés
	</footer>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>