<?php
echo '<h2>' . $TitreDeLaPage . '</h2>';
echo $unArticle['cTexte'];
// echo '<img src="' . base_url() . '/assets/images/' . $unArticle['cNomFichierImage'] . '" />';
echo '<img src="'.img_url($unArticle['cNomFichierImage']).'" />';
echo '<p>' . anchor('visiteur/listerLesArticles', 'Retour à la liste des articles') . '</p>';
