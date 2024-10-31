<?php 
    /** 
     * Affichage de la partie monitoring : liste des articles avec un bouton "modifier" pour chacun. 
     * Et un formulaire pour ajouter un article. 
     */
?>

<h2>Edition des articles</h2>

<table class="monitoringTable">
    <tr>
        <th class="titleMonitoring">Titre de l'article</th>
        <th class="titleMonitoring">Nombre de vues</th>
        <th class="titleMonitoring">Nombre de commentaire</th>
        <th class="titleMonitoring">Date de création</th>
    </tr>
    <?php  $i = 0; foreach ($articles as $article) { $classBackgroundColor = Utils::changeColor($i) ?>
        <tr class="<?= $classBackgroundColor ?>">
            <td class="rowMonitoring rowTitle"><?= $article->getTitle() ?></td>
            <td class="rowMonitoring"><?= $article->getNombreVues() ?></td>
            <td class="rowMonitoring"><?= $nbComment[$i] ?></td>
            <td class="rowMonitoring"><?= Utils::convertDateToFrenchFormat($article->getDateCreation()) ?></td>
        </tr>
    <?php $i++; } ?>
</table>