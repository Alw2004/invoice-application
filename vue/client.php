<?php
include "entete.php";

$client = null;

if (!empty($_GET['id'])) {
    $client = getClient($_GET['id']);
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifclient.php" : "../model/ajoutclient.php" ?>" method="post">
                <label for="nom">Nom</label>
                <input value="<?= !empty($client) && is_array($client) ? htmlspecialchars($client['nom']) : "" ?>" type="text" name="nom" id="nom" placeholder="veuillez saisir le nom">
                
                <input value="<?= !empty($client) && is_array($client) ? htmlspecialchars($client['id']) : "" ?>" type="hidden" name="id" id="id">
                
                <label for="prenom">Prenom</label>
                <input value="<?= !empty($client) && is_array($client) ? htmlspecialchars($client['prenom']) : "" ?>" type="text" name="prenom" id="prenom" placeholder="veuillez saisir le prenom">
                
                <label for="telephone">N° de Telephone</label>
                <input value="<?= !empty($client) && is_array($client) ? htmlspecialchars($client['telephone']) : "" ?>" type="text" name="telephone" id="telephone" placeholder="veuillez saisir N° de telephone">

                <label for="adresse">Adresse</label>
                <input value="<?= !empty($client) && is_array($client) ? htmlspecialchars($client['adresse']) : "" ?>" type="text" name="adresse" id="adresse" placeholder="veuillez saisir l'adresse">

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
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>N° de Telephone</th>
                    <th>Adresse</th>
                    <th>Action</th>
                </tr>
                <?php
                    $clients = getClient();

                    if (!empty($clients) && is_array($clients)){
                        foreach ($clients as $key => $value) {
                ?>
                    <tr>
                        <td><?= htmlspecialchars($value['nom']) ?></td>
                        <td><?= htmlspecialchars($value['prenom']) ?></td>
                        <td><?= htmlspecialchars($value['telephone']) ?></td>
                        <td><?= htmlspecialchars($value['adresse']) ?></td>
                        <td><a href="?id=<?= htmlspecialchars($value['id']) ?>"><i class='bx bx-edit-alt'></i></a></td>
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
