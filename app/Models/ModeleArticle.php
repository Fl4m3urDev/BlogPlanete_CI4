<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleArticle extends Model
{
    protected $table = 'tabarticle';
    protected $primaryKey = 'cNo';
    protected $allowedFields = ['cTitre', 'cTexte', 'cNomFichierImage'];

    public function retournerArticles($NoArticle = false)
    {
        if ($NoArticle === false)
        {
            return $this->findAll();
        }
        return $this->where(['cNo' => $NoArticle])->first();
    }
}
