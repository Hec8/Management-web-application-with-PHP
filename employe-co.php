<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=gtnumerique', 'root', '');


$recupUsers = $database->prepare('SELECT * FROM personnel');
$recupUsers->execute();
$users = $recupUsers->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="main.css">
	<title>GTNumerique</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
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
    <h2><b>PERSONNEL</b></h2>
        <h1>Voici la liste des utilisateurs inscrits sur le site</h1>
        <table class="table table-bordered table-striped m-3">
        <tr>
            <th>Identifiant ou Prenom</th>
            <th>Poste</th>
            <th>Email</th>
            <th>Mot de passe</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['prenom']); ?></td>
            <td><?php echo htmlspecialchars($user['poste']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td>**********</td>
            <td>
                <a href="supprimer-utilisateur.php?id_personnel=<?php echo $user['id_personnel']; ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div>


    <footer class="pied">
		© GTNumerique Tous droits réservés
	</footer>

	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>