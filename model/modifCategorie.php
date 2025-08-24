<?php
include "connection.php";

if (!empty($_POST['libelle_categorie']) &&  !empty($_POST['id'])){
    $sql = "UPDATE categorie_article SET libelle_categorie=? WHERE id=?";

        $req = $connection->prepare($sql);

        $req->execute(array(
            $_POST['libelle_categorie'],
            $_POST['id']
        ));

        if ($req->rowCount()!=0){
            $_SESSION['message']['text'] = "Categorie modifié avec succés";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Rien a été modifié";
            $_SESSION['message']['type'] = "warning";
        }
} else {
    $_SESSION['message']['text'] = "une information obligatoire non renseignee";
    $_SESSION['message']['type'] = "danger";
    
}
header('Location: ../vue/categorie.php');