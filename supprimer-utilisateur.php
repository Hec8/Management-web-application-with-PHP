<?php
session_start();
$database = new PDO('mysql:host=localhost;dbname=gtnumerique', 'root', '');

if(isset($_GET['id_personnel'])) {
    $id = $_GET['id_personnel'];
    $deleteUser = $database->prepare('DELETE FROM personnel WHERE id_personnel= ?');
    $deleteUser->execute(array($id));
    header('Location: employe-co.php');
}
?>
