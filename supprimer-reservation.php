<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=gtnumerique', 'root', '');

if(isset($_GET['id_reservation'])) {
    $id = $_GET['id_reservation'];
    $deleteReservation = $database->prepare('DELETE FROM reservation WHERE id_reservation= ?');
    $deleteReservation->execute(array($id));
    header('Location: reservation.php');
}
?>