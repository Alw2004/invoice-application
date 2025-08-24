<?php
include "entete.php";

$article = null;

if (!empty($_GET['id'])) {
    $article = getArticle($_GET['id']);
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifArticle.php" : "../model/ajoutArticle.php" ?>" method="post" enctype="multipart/form-data">
                <label for="nom_article">Nom de l'article </label>
                <input value="<?= !empty($article) && is_array($article) ? htmlspecialchars($article['nom_article']) : "" ?>" type="text" name="nom_article" id="nom_article" placeholder="veuillez saisir le nom">
                
                <input value="<?= !empty($article) && is_array($article) ? htmlspecialchars($article['id']) : "" ?>" type="hidden" name="id" id="id">

                <label for="id_categorie">Categorie </label>
                <select name="id_categorie" id="id_categorie">
                    <?php
                        $categories = getCategorie();
                        if (!empty ($categories) && is_array($categories)){
                            foreach ($categories as $key => $value) {
                                
                            
                        
                    ?>    
                    <option <?= !empty($article) && is_array($article) && $article['id_categorie'] == $value['id'] ? "selected" : "" ?> value="<?=$value['id'] ?>"><?=$value['libelle_categorie'] ?></option>
                    
                    <?php
                            }
                        }
                    ?>
                </select>
                
                <label for="quantite">Quantite</label>
                <input value="<?= !empty($article) && is_array($article) ? htmlspecialchars($article['quantite']) : "" ?>" type="number" name="quantite" id="quantite" placeholder="veuillez saisir la quantite">

                <label for="prix_unitaire">Prix unitaire</label>
                <input value="<?= !empty($article) && is_array($article) ? htmlspecialchars($article['prix_unitaire']) : "" ?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="veuillez saisir le prix">

                <label for="date_fabrication">Date de fabrication</label>
                <input value="<?= !empty($article) && is_array($article) ? htmlspecialchars($article['date_fabrication']) : "" ?>" type="datetime-local" name="date_fabrication" id="date_fabrication">

                <label for="date_expiration">Date d'expiration</label>
                <input value="<?= !empty($article) && is_array($article) ? htmlspecialchars($article['date_expiration']) : "" ?>" type="datetime-local" name="date_expiration" id="date_expiration">
                
                <label for="images">Image</label>
                <input value="<?= !empty($article) && is_array($article) ? htmlspecialchars($article['images']) : "" ?>" type="file" name="images" id="images">
                
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
        <div style="display: block;" class="box">
            <form action="" method=""get>
                <table class="mtable">
                    <tr>
                        <th>Nom article</th>
                        <th>Categorie</th>
                        <th>Quantite</th>
                        <th>Prix unitaire</th>
                        <th>Date Fabrication</th>
                        <th>Date expiration</th>
                    </tr>
                </table>
            <table class="mtable">
                <td>
                <input  type="text" name="nom_article" id="nom_article" placeholder="veuillez saisir le nom">
                </td>
                <td>
                    <select name="id_categorie" id="id_categorie">
                        <?php
                            $categories = getCategorie();
                            if (!empty ($categories) && is_array($categories)){
                                foreach ($categories as $key => $value) {
                                    
                                
                            
                        ?>    
                        <option <?= !empty($article) && is_array($article) && $article['id_categorie'] == $value['id'] ? "selected" : "" ?> value="<?=$value['id'] ?>"><?=$value['libelle_categorie'] ?></option>
                        
                        <?php
                                }
                            }
                        ?>
                    </select>
                </td>
                <td>
                <input type="number" name="quantite" id="quantite" placeholder="veuillez saisir la quantite">
                </td>
                <td>
                <input type="number" name="prix_unitaire" id="prix_unitaire" placeholder="veuillez saisir le prix">
                </td>
                <td>
                <input type="date" name="date_fabrication" id="date_fabrication">
                </td>
                <td>
                <input type="date" name="date_expiration" id="date_expiration">
                </td>
            </table>
            
            <button type="submit">Valider</button>
            <br>
            </form>
            <br>
            <table class="mtable">
                <tr>
                    <th>Nom article</th>
                    <th>Categorie</th>
                    <th>Quantite</th>
                    <th>Prix unitaire</th>
                    <th>Date Fabrication</th>
                    <th>Date expiration</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php
                if (!empty($_GET)) {
                    $articles = getArticle(null, $_GET);
                } else {
                    $articles = getArticle();
                }

                        if (!empty($articles) && is_array($articles)){
                            foreach ($articles as $key => $value) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($value['nom_article']) ?></td>
                            <td><?= htmlspecialchars($value['libelle_categorie']) ?></td>
                            <td><?= htmlspecialchars($value['quantite']) ?></td>
                            <td><?= htmlspecialchars($value['prix_unitaire']) ?></td>
                            <td><?= date('d/m/Y H:i:s' , strtotime($value['date_fabrication'])) ?></td>
                            <td><?= date('d/m/Y H:i:s' , strtotime($value['date_expiration'])) ?></td>
                            <td><img width="100" height="100" src="<?= htmlspecialchars($value['images'])?>" alt="<?= $value['nom_article']?>"></td>
                            <td><a href="?id=<?= htmlspecialchars($value['id']) ?>"><i class='bx bx-edit-alt'></i></a></td>
                        </tr>
                    <?php
                            }
                        }
                    ?>
        </div>
    </div>
</div>
</section>
<?php
 include "pied.php";
?>
