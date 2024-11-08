<?php 
    /** 
     * Affichage de la partie monitoring : tableau triable par titre, nombre de vues, date de création et nombre de commentaire 
     */
?>

<h2>Edition des articles</h2>

<?php Utils::formTri(); ?>

<table class="monitoringTable">
    <tr>
        <th class="titleMonitoring">Titre de l'article</th>
        <th class="titleMonitoring">Nombre de vues</th>
        <th class="titleMonitoring">Date de création</th>
        <th class="titleMonitoring">Nombre de commentaire</th>
    </tr>
    <?php $i = 0; foreach ($articles as $article) { $classBackgroundColor = Utils::changeColor($i) ?>
        <tr class="<?= $classBackgroundColor ?>">
            <td class="rowMonitoring rowTitle"><?= $article['title'] ?></td>
            <td class="rowMonitoring"><?= $article['nombre_vues'] ?></td>
            <td class="rowMonitoring"><?= $article['date_creation'] ?></td>
            <td class="rowMonitoring"><?= $article['nombre_commentaires'] ?></td>
        </tr>
    <?php $i++; } ?>
</table>