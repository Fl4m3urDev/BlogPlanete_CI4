<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleArticle extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'NOARTICLE';
    protected $allowedFields = ['TITRE', 'TEXTE', 'NOMFICHIERIMAGE'];

    public function retournerArticles($NoArticle = false)
    {
        if ($NoArticle === false)
        {
            return $this->findAll();
        }
        return $this->where(['NOARTICLE' => $NoArticle])->first();
    }
}
