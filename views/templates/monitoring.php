<?php 
    /** 
     * Affichage de la partie monitoring : tableau triable par titre, nombre de vues, date de création et nombre de commentaire 
     */
?>

<h2>Edition des articles</h2>

<table class="monitoringTable">
    <tr>
        <th class="titleMonitoring">
            <form action="index.php" method="post" class="tri">
                <input type="hidden" name="action" value="monitoringArticle">
                <input type="hidden" name="categorie" value="title">
                <input type="hidden" name="ordre" value= <?= Utils::changeOrdre() ?>>
                <button class="categorieTri">
                    Titre de l'article
                    <i class="fa-solid <?= Utils::changeIcon("title") ?> "></i>
                </button>
            </form>
        </th>

        <th class="titleMonitoring">
            <form action="index.php" method="post" class="tri">
                <input type="hidden" name="action" value="monitoringArticle">
                <input type="hidden" name="categorie" value="nombre_vues">
                <input type="hidden" name="ordre" value= <?= Utils::changeOrdre() ?>>
                <button class="categorieTri">
                    Nombre de vues
                    <i class="fa-solid <?= Utils::changeIcon("nombre_vues") ?> "></i>
                </button>
            </form>
        </th>

        <th class="titleMonitoring">
            <form action="index.php" method="post" class="tri">
                <input type="hidden" name="action" value="monitoringArticle">
                <input type="hidden" name="categorie" value="date_creation">
                <input type="hidden" name="ordre" value= <?= Utils::changeOrdre() ?>>
                <button class="categorieTri">
                    Date de création
                    <i class="fa-solid <?= Utils::changeIcon("date_creation") ?> "></i>
                </button>
            </form>
        </th>

        <th class="titleMonitoring">
            <form action="index.php" method="post" class="tri">
                <input type="hidden" name="action" value="monitoringArticle">
                <input type="hidden" name="categorie" value="nombre_commentaires">
                <input type="hidden" name="ordre" value= <?= Utils::changeOrdre() ?>>
                <button class="categorieTri">
                    Nombre de commentiares
                    <i class="fa-solid <?= Utils::changeIcon("nombre_commentaires") ?> "></i>
                </button>
            </form>
        </th>
    </tr>
    <?php foreach ($articles as $index => $article) { $classBackgroundColor = Utils::changeColor($index) ?>
        <tr class="<?= $classBackgroundColor ?>">
            <td class="rowMonitoring rowTitle"><?= $article['article']->getTitle() ?></td>
            <td class="rowMonitoring"><?= $article['article']->getNombreVues() ?></td>
            <td class="rowMonitoring"><?= Utils::convertDateToFrenchFormat($article['article']->getDateCreation()) ?></td>
            <td class="rowMonitoring"><?= $article['nombre_commentaires'] ?></td>
        </tr>
    <?php } ?>
</table>