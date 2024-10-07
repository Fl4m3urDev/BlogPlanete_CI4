<div class="px-4 py-2">
    <div class="card mt-4 mb-3" style="max-width: 100%;">
        <div class="row g-0">
            <div class="col-md-4">
                <img width=250 height=250 src="<?php echo base_url('assets/images/' . $unArticle['NOMFICHIERIMAGE']); ?>" class="img-fluid rounded-start" />
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $TitreDeLaPage ?></h2>
                    <p class="card-text"><?php echo $unArticle['TEXTE']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($lesAvis as $unAvis) { ?>
        <div class="card border-dark mb-3">
            <div class="card-header">
                <b>De : <?php echo $unAvis["IDENTIFIANT"] ?></b>
                <div class="float-end">
                    <?php $session = session();
                    if ($session->get('statut') == 1 or $session->get('statut') == 2 || $session->get('NOUTILISATEUR') == $unAvis['NOUTILISATEUR']) : ?>
                        <a class="text-white" href="<?php echo site_url('administrateur/modifierUnAvis/' . $unAvis["NOAVIS"]) ?>"><button class="btn btn-primary">Modifier</button></a>
                        <a class="ms-2 text-white" href="<?php echo site_url('administrateur/supprimerUnAvis/' . $unAvis["NOAVIS"]) ?>"><button class="btn btn-primary">Supprimer</button></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo "<div class='card-body'><h5 class='card-title'>" . $unAvis["TITRE"] . "</h5>"; ?>
            <?php echo "<p class='card-text'>" . $unAvis["CONTENU"] . "</p></div>"; ?>
        </div>
    <?php } ?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <?php $session = session();
        if ($session->get('statut') == 1 or $session->get('statut') == 2) : ?>
            <p><a class="link-dark link-offset-2 link-underline link-underline-opacity-0" href="<?php echo site_url('administrateur/ajouterUnAvis/' . $unArticle["NOARTICLE"]) ?>">Ajouter un avis</a></p>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <p><?php echo anchor('visiteur/listerLesArticles', 'Retour à la liste des articles', array('class' => 'link-dark link-offset-2 link-underline link-underline-opacity-0')); ?></p>
    </div>
</div>