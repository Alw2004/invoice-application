<?php
include "connection.php";

function getArticle($id=null, $searchDATA = array()){
    if (!empty($id)){
        $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire, date_fabrication, date_expiration, id_categorie, a.id, images  FROM article AS a, categorie_article AS c WHERE a.id_categorie=c.id AND a.id =?";
        $req = $GLOBALS['connection']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } elseif(!empty($searchDATA)){
        $search ="";
        extract($searchDATA);
        if (!empty($nom_article))  $search .="AND a.nom_article LIKE '%$nom_article%' ";
        if (!empty($id_categorie))  $search .="AND a.id_categorie = $id_categorie ";
        if (!empty($quantite))  $search .="AND a.quantite = $quantite ";
        if (!empty($prix_unitaire))  $search .="AND a.prix_unitaire = $prix_unitaire ";
        if (!empty($date_fabrication))  $search .="AND DATE(a.date_fabrication) = '$date_fabrication'  ";
        if (!empty($date_expiration))  $search .="AND DATE(a.date_expiration) = '$date_expiration' ";

        $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire, date_fabrication, date_expiration, id_categorie, a.id, images FROM article AS a, categorie_article AS c WHERE c.id=a.id_categorie $search";
        $req = $GLOBALS['connection']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
        
    }
    else {
        $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire, date_fabrication, date_expiration, id_categorie, a.id, images FROM article AS a, categorie_article AS c WHERE a.id_categorie=c.id";
        $req = $GLOBALS['connection']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getClient($id=null){
    if (!empty($id)){
        $sql = "SELECT * FROM client WHERE id =?";
        $req = $GLOBALS['connection']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM client";
        $req = $GLOBALS['connection']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getVente($id = null) {
    global $connection; // Make sure $connection is properly defined in your script

    if (!empty($id)) {
        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, prix_unitaire, adresse, telephone 
                FROM client AS c, vente AS v, article AS a 
                WHERE v.id_article = a.id 
                  AND v.id_client = c.id 
                  AND v.id = ? AND etat=?";
        $req = $connection->prepare($sql);
        $req->execute(array($id,1));
        return $req->fetch();
    } else {
        $sql = "SELECT v.id, nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle 
                FROM client AS c, vente AS v, article AS a 
                WHERE v.id_article = a.id 
                AND v.id_client = c.id AND etat=?";
        $req = $connection->prepare($sql);
        $req->execute(array(1));
        return $req->fetchAll();
    }
}

function getFournisseur($id=null){
    if (!empty($id)){
        $sql = "SELECT * FROM fournisseur WHERE id =?";
        $req = $GLOBALS['connection']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM fournisseur";
        $req = $GLOBALS['connection']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}
function getCommande($id = null) {
    global $connection; // Make sure $connection is properly defined in your script

    if (!empty($id)) {
        $sql = "SELECT a.nom_article, f.nom, f.prenom, co.quantite, co.prix, co.date_commande, co.id, a.prix_unitaire, f.adresse, f.telephone 
                FROM fournisseur AS f, commande AS co, article AS a 
                WHERE co.id_article = a.id 
                  AND co.id_fournisseur = f.id 
                  AND co.id = ?";
        $req = $connection->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    } else {
        $sql = "SELECT a.nom_article, f.nom, f.prenom, co.quantite, co.prix, co.date_commande, co.id, a.id AS idArticle 
                FROM fournisseur AS f, commande AS co, article AS a 
                WHERE co.id_article = a.id 
                  AND co.id_fournisseur = f.id";
        $req = $connection->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getAllCommande(){
    $sql = "SELECT COUNT(*) AS nbre FROM commande";
    $req = $GLOBALS['connection']->prepare($sql);
    $req->execute();
    return $req->fetch();
} 

function getAllVente(){
    $sql = "SELECT COUNT(*) AS nbre FROM vente WHERE etat=?";
    $req = $GLOBALS['connection']->prepare($sql);
    $req->execute(array(1));
    return $req->fetch();
} 

function getAllArticle(){
    $sql = "SELECT COUNT(*) AS nbre FROM article";
    $req = $GLOBALS['connection']->prepare($sql);
    $req->execute();
    return $req->fetch();
} 

function getCA(){
    $sql = "SELECT SUM(prix) AS prix FROM vente";
    $req = $GLOBALS['connection']->prepare($sql);
    $req->execute();
    return $req->fetch();
} 

function getLastVente() {
    global $connection; // Make sure $connection is properly defined in your script

    
        $sql = "SELECT v.id, nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle 
                FROM client AS c, vente AS v, article AS a 
                WHERE v.id_article = a.id 
                AND v.id_client = c.id AND etat=?
                ORDER BY date_vente DESC LIMIT 10";
        $req = $connection->prepare($sql);
        $req->execute(array(1));
        return $req->fetchAll();
    
}

function getMostVente() {
    global $connection; // Make sure $connection is properly defined in your script

    
        $sql = "SELECT  nom_article, SUM(prix) AS prix
                FROM client AS c, vente AS v, article AS a 
                WHERE v.id_article = a.id  AND v.id_client = c.id AND etat=?
                GROUP BY a.id
                ORDER BY SUM(prix) DESC LIMIT 10";
        $req = $connection->prepare($sql);
        $req->execute(array(1));
        return $req->fetchAll();
    
}

function getCategorie($id=null){
    if (!empty($id)){
        $sql = "SELECT * FROM categorie_article WHERE id =?";
        $req = $GLOBALS['connection']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM categorie_article";
        $req = $GLOBALS['connection']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}