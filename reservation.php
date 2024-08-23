<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=gtnumerique', 'root', ''); 
if(isset($_POST['envoi'])) {
    if(!empty($_POST['num_salle']) AND !empty($_POST['debut_reservation']) AND !empty($_POST['fin_reservation'])) {
        $num_salle = htmlspecialchars($_POST['num_salle']);
        $debut_reservation = htmlspecialchars($_POST['debut_reservation']);
        $fin_reservation = htmlspecialchars($_POST['fin_reservation']);
        $insertReservation = $database->prepare('INSERT INTO reservation(num_salle, debut_reservation, fin_reservation) VALUES (?, ?, ?)');
        $insertReservation->execute(array($num_salle, $debut_reservation, $fin_reservation));

        if ($insertReservation) {
            echo "Réservation enregistrée avec succès !";
        } else {
            echo "Une erreur s'est produite lors de l'enregistrement de la réservation.";
        }

        $recupReservation = $database->prepare('SELECT * FROM reservation WHERE num_salle = ? AND debut_reservation = ? AND fin_reservation = ?');
        $recupReservation->execute(array($num_salle, $debut_reservation, $fin_reservation));
        
        if($recupReservation->rowCount()>0) {
            $_SESSION['num_salle'] = $num_salle;
            $_SESSION['debut_reservation'] = $debut_reservation;
            $_SESSION['fin_reservation'] = $fin_reservation;
            $_SESSION['id_reservation'] = $recupReservation->fetch()['id_reservation'];
        }
        
    } else {
        echo "Veuillez renseigner tous les champs !";
    }
}

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
    <title>Enregistrement de reservation</title>
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
            <h3 class="titre"><b>RESERVATION</b></h3>
            <h6>Enregistrer une nouvelle réservation</h6>
            <div class="">
                <label for="num_salle" class="form-label">Numéro de Salle</label><img class="icon" src="assets/img/house.png" alt="house">
                <input type="text" class="form-control" id="num_salle" placeholder="Ex : 5" name="num_salle" required>
            </div>
            <div class="">
                <label for="debut" class="form-label">Date de début de reservation</label><img class="icon" src="assets/img/calendar.png" alt="date">
                <input type="date" class="form-control" id="debut" placeholder="Entrez la date de début..." name="debut_reservation" required>
            </div>
            <div class="">
                <label for="fin" class="form-label">Date de fin de reservation</label><img class="icon" src="assets/img/calendar.png" alt="date_end">
                <input type="date" class="form-control" id="fin" placeholder="Entrez la date de fin..." name="fin_reservation" required>
            </div>
            <button type="submit" class="btn btn-primary" name="envoi">Enregistrer</button>
            <br>
        </form>
    </div>

    <div class="content">
        <h2><b>RESERVATIONS ENREGISTREES</b></h2>
            <div class=" d-flex flex-wrap">
            <?php foreach ($reservations as $reservation): ?>
                <table class="table table-bordered table-striped m-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Identifiant de la réservation</th>
                            <th>Numéro de la salle</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['id_reservation']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['num_salle']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['debut_reservation']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['fin_reservation']); ?></td>
                            <td>
                                <a href="supprimer-reservation.php?id_reservation=<?php echo $reservation['id_reservation']; ?>">Supprimer réservation</a>
                            </td>
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