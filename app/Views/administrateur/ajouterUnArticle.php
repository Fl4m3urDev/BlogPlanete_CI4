<div class="px-4 py-2">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php
    if ($TitreDeLaPage == 'Corriger votre article') echo service('validation')->listErrors();
    echo form_open('administrateur/ajouterUnArticle') ?>
    <?php echo csrf_field(); ?>
    <label for="txtTitre">Titre de l'article</label>
    <input type="input" name="txtTitre" value="<?php echo set_value('txtTitre'); ?>" /><br />

    <label for="txtTexte">Texte de l'article</label>
    <textarea name="txtTexte"><?php echo set_value('txtTexte'); ?></textarea><br />

    <label for="txtNomFichierImage">Nom du fichier Image</label>
    <input type="input" name="txtNomFichierImage" value="<?php echo set_value('txtNomFichierImage'); ?>" /><br />

    <input type="submit" name="submit" value="Ajouter un article" />
    <?php echo form_close(); ?>
</div>