<div class="container mt-4">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php
    if ($TitreDeLaPage == 'Corriger votre avis') echo service('validation')->listErrors();
    echo form_open('administrateur/modifierUnAvis/' . $unAvis["NOAVIS"]) ?>
    <?php echo csrf_field(); ?>
    <div class="mb-3 mt-3">
        <?php echo form_label('Titre de l\'avis', 'txtTitre', ['class' => 'form-label']);
        echo form_input('txtTitre', $unAvis["TITRE"], ['class' => 'form-control']); ?>
    </div>
    <div class="mb-3">
        <?php echo form_label('Texte de l\'avis', 'txtTexte', ['class' => 'form-label']);
        echo form_textarea('txtTexte', $unAvis["CONTENU"], ['class' => 'form-control']); ?>
    </div>
    <div class="mb-3">
        <?php echo form_submit('submit', 'Modifier l\'avis', 'class="btn btn-primary"');
        echo form_close(); ?>
    </div>
</div>