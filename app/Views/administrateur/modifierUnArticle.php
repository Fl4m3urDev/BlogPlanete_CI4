<div class="container mt-4">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php
    if ($TitreDeLaPage == 'Corriger votre article') echo service('validation')->listErrors();
    echo form_open('administrateur/modifierUnArticle/' . $unArticle["NOARTICLE"]) ?>
    <?php echo csrf_field(); ?>
    <div class="mb-3 mt-3">
        <?php echo form_label('Titre de l\'article', 'txtTitre', ['class' => 'form-label']);
        echo form_input('txtTitre', $unArticle["TITRE"], ['class' => 'form-control']); ?>
    </div>
    <div class="mb-3">
        <?php echo form_label('Texte de l\'article', 'txtTexte', ['class' => 'form-label']);
        echo form_textarea('txtTexte', $unArticle["TEXTE"], ['class' => 'form-control']); ?>
    </div>
    <div class="mb-3">
        <?php echo form_label('Nom du fichier Image', 'txtNomFichierImage', ['class' => 'form-label']);
        echo form_input('txtNomFichierImage', $unArticle["NOMFICHIERIMAGE"], ['class' => 'form-control']); ?>
    </div>
    <div class="mb-3">
        <?php echo form_submit('submit', 'Modifier l\'article', 'class="btn btn-primary"');
        echo form_close(); ?>
    </div>
</div>