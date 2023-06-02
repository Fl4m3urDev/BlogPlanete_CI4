<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Blog simple</title>
</head>

<body>
    <div class="p-5 bg-primary text-white text-center">
        <h1>Le fabuleux blog</h1>
        <p>Une réalisation totalement interplanétaire !</p>
    </div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">

        <a class="navbar-brand" href="#">
            <img width=40 src="<?php echo img_url('LeFeuDeLaMort.png') ?>" alt="Logo">
        </a>
        <div class="container-fluid justify-content-center">
            <ul class="navbar-nav">
                <?php $session = session();
                if (!is_null($session->get('identifiant'))) : ?>
                    <?php echo 'Utilisateur connecté : <B>' . $session->get('identifiant') . '</B>&nbsp;&nbsp;'; ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('visiteur/seDeconnecter') ?>">Se déconnecter</a></li>
                    <?php if ($session->get('statut') == 1) : ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('administrateur/ajouterUnArticle') ?>">Ajouter un article</a></li>
                    <?php endif; ?>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('visiteur/seConnecter') ?>">Se Connecter</a></li>
                <?php endif; ?>
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                        Lister
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo site_url('visiteur/listerLesArticles') ?>">Lister tous les Articles</a></li>
                        <li><a class="dropdown-item" href="<?php echo site_url('visiteur/listerLesArticlesAvecPagination') ?>">Lister les Articles (par 3)</a></li>
                    </ul>
                </div>
        </div>
        </ul>
    </nav>