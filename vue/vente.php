<?php
include "entete.php";

$article = null;

if (!empty($_GET['id'])) {
    $article = getVente($_GET['id']);
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifVente.php" : "../model/ajoutVente.php" ?>" method="post">
                
                <input value="<?= !empty($article) && is_array($article) ? htmlspecialchars($article['id']) : "" ?>" type="hidden" name="id" id="id">

                <label for="id_article">Article </label>
                <select onchange="setPrix()" name="id_article" id="id_article">
                   <?php
                    $articles = getArticle();
                    if(!empty($articles) && is_array($articles)){
                        foreach ($articles as $key => $value) {
                            ?>
                            <option data-prix="<?= htmlspecialchars($value['prix_unitaire']) ?>" value="<?= htmlspecialchars($value['id']) ?>"> <?= htmlspecialchars($value['nom_article'] . "-" . $value['quantite'] . " disponible") ?> </option>
                            <?php
                        }
                    }
                ?>
                </select>

                <label for="id_client">Client </label>
                <select name="id_client" id="id_client">
                   <?php
                    $clients = getClient();
                    if(!empty($clients) && is_array($clients)){
                        foreach ($clients as $key => $value) {
                            ?>
                            <option value="<?= htmlspecialchars($value['id']) ?>"> <?= htmlspecialchars($value['nom'] . " " . $value['prenom']) ?> </option>
                            <?php
                        }
                    }
                ?>
                </select>
                
                <label for="quantite">Quantite</label>
                <input onkeyup="setPrix()" value="<?= !empty($article) && is_array($article) ? htmlspecialchars($article['quantite']) : "" ?>" type="number" name="quantite" id="quantite" placeholder="veuillez saisir la quantite">

                <label for="prix">Prix </label>
                <input value="<?= !empty($article) && is_array($article) ? htmlspecialchars($article['prix']) : "" ?>" type="number" name="prix" id="prix" placeholder="veuillez saisir le prix">

                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['message']['text'])){
                ?>
                    <div class="alert <?= htmlspecialchars($_SESSION['message']['type']) ?>">
                        <?= htmlspecialchars($_SESSION['message']['text']) ?>
                    </div>
                <?php
                } 
                ?>
            </form>
        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Article</th>
                    <th>Client</th>
                    <th>Quantite</th>
                    <th>Prix</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <?php
                    $vente = getVente();

                    if (!empty($vente) && is_array($vente)){
                        foreach ($vente as $key => $value) {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($value['nom_article']) ?></td>
                        <td><?= htmlspecialchars($value['nom']." ".$value['prenom']) ?></td>
                        <td><?= htmlspecialchars($value['quantite']) ?></td>
                        <td><?= htmlspecialchars($value['prix']) ?></td>
                        <td><?= date('d/m/Y H:i:s' , strtotime($value['date_vente'])) ?></td>
                        <td>
                            <a href="recuVente.php?id=<?= htmlspecialchars($value['id']) ?>"><i class='bx bx-receipt'></i></a>
                            <a onclick="annuleVente(<?=$value['id'] ?>, <?=$value['idArticle'] ?>, <?=$value['quantite'] ?>)" style="color: red" ><i class='bx bx-stop-circle'></i></a>
                        </td>
                    </tr>
                <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</div>
</section>
<?php
 include "pied.php";
?>
<script>

    function annuleVente(idVente, idArticle, quantite) {
        if (confirm('Voulez-vous vraiment annuler cette vente?')) {
            window.location.href = "../model/annuleVente.php?idVente="+idVente+"&idArticle="+idArticle+"&quantite="+quantite;
        }
    }
    function setPrix() {
    var article = document.querySelector('#id_article');
    var quantite = document.querySelector('#quantite');
    var prix = document.querySelector('#prix');
    var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');

    if (prixUnitaire !== null) {
        prix.value = Number(quantite.value) * Number(prixUnitaire);
    } 
}

</script>