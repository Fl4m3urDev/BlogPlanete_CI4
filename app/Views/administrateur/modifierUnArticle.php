<div class="px-4 py-2">
    <h2><?php echo $TitreDeLaPage ?></h2>
    <?php
    if ($TitreDeLaPage == 'Corriger votre article') echo service('validation')->listErrors();
    echo form_open('administrateur/modifierUnArticle/'.$unArticle["cNo"]) ?>
    <?php echo csrf_field(); ?>
    <label for="txtTitre">Titre de l'article</label>
    <input type="input" name="txtTitre" value="<?php echo $unArticle["cTitre"]; ?>" /><br />

    <label for="txtTexte">Texte de l'article</label>
    <textarea name="txtTexte"><?php echo $unArticle["cTexte"]; ?></textarea><br />

    <label for="txtNomFichierImage">Nom du fichier Image</label>
    <input type="input" name="txtNomFichierImage" value="<?php echo $unArticle["cNomFichierImage"]; ?>" /><br />

    <input type="submit" name="submit" value="Modifier l'article" />
    <?php echo form_close(); ?>
</div>