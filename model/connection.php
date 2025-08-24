<?php
session_start();

$nom_serveur = "localhost";
$nom_base_de_donne = "gestion_stock_dclick";
$utilisateur = "root";
$motpass = "";

try {
    $connection = new PDO("mysql:host=$nom_serveur;dbname=$nom_base_de_donne", $utilisateur, $motpass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connection;
} catch (Exception $e) {
    die("Erreur de connection : ".$e->getMessage());
}
