<?php
include "connection.php";

if (!empty($_POST['libelle_categorie'])){
    $sql = "INSERT INTO categorie_article(libelle_categorie) VALUES (?)";

        $req = $connection->prepare($sql);

        $req->execute(array(
            $_POST['libelle_categorie']
        ));

        if ($req->rowCount()!=0){
            $_SESSION['message']['text'] = "Categorie ajouté avec succés";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Un erreur c'est produite lors de l'ajout de Categorie";
            $_SESSION['message']['type'] = "warning";
        }
} else {
    $_SESSION['message']['text'] = "une information obligatoire non renseignee";
    $_SESSION['message']['type'] = "danger";
    
}
header('Location: ../vue/categorie.php');