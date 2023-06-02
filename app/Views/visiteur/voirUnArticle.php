<div class="px-4 py-2">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php echo $unArticle['cTexte']; ?>
    <br><br>
    <?php // echo '<img src="' . base_url() . '/assets/images/' . $unArticle['cNomFichierImage'] . '" />'; 
    ?>
    <img width=250 height=250 src="<?php echo img_url($unArticle['cNomFichierImage']); ?>" />
    <br>
    <p><?php echo anchor('visiteur/listerLesArticles', 'Retour à la liste des articles'); ?></p>
</div>