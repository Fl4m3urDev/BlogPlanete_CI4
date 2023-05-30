<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleArticle extends Model
{
    protected $table = 'tabarticle'; //définition de la table principale
    protected $primaryKey = 'cNo'; // clé primaire
    protected $allowedFields = ['cTitre', 'cTexte', 'cNomFichierImage']; //champs modifiables

    public function retournerArticles($NoArticle = false)
    {
        if ($NoArticle === false) // pas de n° d'article en paramètre
        { // on retourne tous les articles
            return $this->findAll(); // SELECT * FROM tabarticle    
        }
        // ci-dessous on va chercher l'article dont l'id est $pNoArticle (en mode objet)
        return $this->where(['cNo' => $NoArticle])->first();
        // 'SELECT * FROM tabarticle WHERE cNo = '.$pNoArticle
    }
}
