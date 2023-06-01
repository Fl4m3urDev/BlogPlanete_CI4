<h2><?php echo $TitreDeLaPage ?></h2>
<?php foreach ($lesArticles as $unArticle) :
    echo '<h3>' . anchor('visiteur/voirUnArticle/' . $unArticle["cNo"], $unArticle["cTitre"]) . '</h3>';
endforeach ?>
<p>Pour avoir afficher le détail d'un article, cliquer sur son titre</p>