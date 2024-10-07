<div class="px-4 py-2">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <div class="mt-4">
        <table class="table table-secondary table-striped table-bordered border-dark">
            <tbody>
                <?php foreach ($lesArticles as $unArticle) : ?>
                    <tr>
                        <td><?php echo anchor('visiteur/voirUnArticle/' . $unArticle["NOARTICLE"], $unArticle["TITRE"], array('class' => 'link-dark link-offset-2 link-underline link-underline-opacity-0')); ?></td>
                        <?php $session = session(); ?>
                        <?php if ($session->get('statut') == 2) : ?>
                            <td><a class="text-white" href="<?php echo site_url('administrateur/modifierUnArticle/' . $unArticle["NOARTICLE"]) ?>"><button class="btn btn-primary">Modifier</button></a></td>
                            <td><a class="text-white" href="<?php echo site_url('administrateur/supprimerUnArticle/' . $unArticle["NOARTICLE"]) ?>"><button class="btn btn-primary">Supprimer</button></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach ?>
        </table>
    </div>
    <p>Pour avoir afficher le détail d'un article, cliquer sur son titre</p>
</div>