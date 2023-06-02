<div class="px-4 py-2">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php foreach ($lesArticles as $unArticle) : ?>
        <h3><?php echo anchor('visiteur/voirUnArticle/' . $unArticle["cNo"], $unArticle["cTitre"]); ?></h3>
    <?php endforeach ?>
    <p>Pour avoir afficher le détail d'un article, cliquer sur son titre</p>
    <p><?= $pager->links() ?></p>
</div>