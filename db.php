<?php
$host = 'localhost'; // serveur MySQL
$dbname = 'u132254256_catalogcoaxis';
$username = 'u132254256_manonpinto'; //tilisateur MySQL
$password = 'Decembre2004!'; //mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
