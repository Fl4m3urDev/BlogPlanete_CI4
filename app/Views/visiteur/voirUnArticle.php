<div class="px-4 py-2">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php echo $unArticle['TEXTE']; ?>
    <br><br>
    <img width=250 height=250 src="<?php echo img_url($unArticle['NOMFICHIERIMAGE']); ?>" />
    <br><br>
    <p><?php echo anchor('visiteur/listerLesArticles', 'Retour à la liste des articles'); ?></p>
    <br>
    <?php foreach ($lesAvis as $unAvis) { ?>
        <?php
        echo "<li class='list-group-item'><div class='d-flex flex-column'><b>" . $unAvis["TITRE"] . "</b>"; ?>
        <?php
        echo "<em>" . $unAvis["CONTENU"] . "</em>"; ?>
        <?php
        echo "Par : " . $unAvis["IDENTIFIANT"] . "</div></li>"; ?>
    <?php } ?>
    <br>
    <?php $session = session();
    if ($session->get('statut') == 1 or $session->get('statut') == 2) : ?>
        <p><a class="text-black" href="<?php echo site_url('administrateur/ajouterUnAvis/' . $unArticle["NOARTICLE"]) ?>">Ajouter un avis</a></p>
    <?php endif; ?>
</div>