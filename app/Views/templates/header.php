<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Blog Planete</title>
</head>

<body>
    <div class="p-5 bg-primary text-white text-center">
        <h1>Le fabuleux blog</h1>
        <p>Une réalisation totalement interplanétaire !</p>
    </div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">

        <a class="navbar-brand" href="#">
            <img width=40 src="<?php echo base_url('assets/images/LeFeuDeLaMort.png') ?>" alt="Logo">
        </a>
        <div class="container-fluid justify-content-center">
            <ul class="navbar-nav">
                <?php $session = session();
                if (!is_null($session->get('identifiant'))) : ?>
                    <li class="nav-item text-white"><a class="nav-link">Utilisateur connecté : <?php echo $session->get('identifiant'); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo site_url('visiteur/seDeconnecter') ?>">Se déconnecter</a></li>
                    <?php if ($session->get('statut') == 2) : ?>
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