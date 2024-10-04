<div class="container mt-4">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php
    if ($TitreDeLaPage == 'Corriger votre avis') echo service('validation')->listErrors();
    echo form_open_multipart('administrateur/ajouterUnAvis') ?>
    <?php echo csrf_field(); ?>
    <div class="mb-3 mt-3">
        <?php echo form_label('Titre de l\'avis', 'txtTitre', ['class' => 'form-label']);
        echo form_input('txtTitre', set_value('txtTitre'), ['class' => 'form-control']); ?>
    </div>
    <div class="mb-3">
        <?php echo form_label('Texte de l\'avis', 'txtTexte', ['class' => 'form-label']);
        echo form_textarea('txtTexte', set_value('txtTexte'), ['class' => 'form-control']); ?>
    </div>
    <div class="mb-3">
        <?php echo form_submit('submit', 'Ajouter un avis', 'class="btn btn-primary"');
        echo form_close(); ?>
    </div>
</div>