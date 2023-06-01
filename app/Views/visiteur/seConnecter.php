<div class="container mt-5">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php
    if ($TitreDeLaPage == 'Corriger votre formulaire') echo service('validation')->listErrors();
    echo form_open('visiteur/seconnecter');
    echo csrf_field(); ?>
    <div class="mb-3 mt-3">
        <?php echo form_label('Identifiant', 'txtIdentifiant', ['class' => 'form-label']);
        echo form_input('txtIdentifiant', set_value('txtIdentifiant'), ['class' => 'form-control', 'placeholder' => 'Votre mail']); ?>
    </div>
    <div class="mb-3">
        <?php echo form_label('Mot de passe', 'txtMotDePasse', ['class' => 'form-label']);
        echo form_password('txtMotDePasse', set_value('txtMotDePasse'), ['class' => 'form-control', 'placeholder' => 'Votre mdp']); ?>
    </div>
    <div class="mb-3">
        <?php echo form_submit('submit', 'Se connecter', 'class="btn btn-primary"');
        echo form_close(); ?>
    </div>
</div>