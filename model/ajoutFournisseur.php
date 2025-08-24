<?php
include "connection.php";

if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['telephone']) && !empty($_POST['adresse'])){
    $sql = "INSERT INTO fournisseur(nom, prenom, telephone, adresse) 
            VALUES (?, ?, ?, ?)";

        $req = $connection->prepare($sql);

        $req->execute(array(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['telephone'],
            $_POST['adresse']
        ));

        if ($req->rowCount()!=0){
            $_SESSION['message']['text'] = "fournisseur ajouté avec succés";
            $_SESSION['message']['type'] = "success";
        } else {
            $_SESSION['message']['text'] = "Un erreur c'est produite lors de l'ajout de fournisseur";
            $_SESSION['message']['type'] = "warning";
        }
} else {
    $_SESSION['message']['text'] = "une information obligatoire non renseignee";
    $_SESSION['message']['type'] = "danger";
    
}
header('Location: ../vue/fournisseur.php');