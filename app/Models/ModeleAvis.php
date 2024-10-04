<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleAvis extends Model
{
    protected $table = 'avis';
    protected $primaryKey = 'NOAVIS';
    protected $allowedFields = ['NOARTICLE', 'NOUTILISATEUR', 'TITRE', 'CONTENU'];

    public function retournerAvis($NoAvis = false)
    {
        if ($NoAvis === false)
        {
            return $this->findAll();
        }
        return $this->where(['NOAVIS' => $NoAvis])
        ->first();
    }

    public function retournerAvisParArticles($NoArticle)
    {
        return $this->where(['avis.NOARTICLE' => $NoArticle])
        ->join('article', 'article.NOARTICLE = avis.NOARTICLE')
        ->join('utilisateur', 'utilisateur.NOUTILISATEUR = avis.NOUTILISATEUR')
        ->select('article.TITRE, utilisateur.IDENTIFIANT, avis.TITRE, avis.CONTENU')
        ->findAll();
    }

    // public function insererAvis($sql)
    // {
    //     $sql = "INSERT INTO avis (NOAVIS, NOUTILISATEUR, TITRE, CONTENU) "
    //     . "VALUES (" . $_GET['NOAVIS'] . ", " . $_SESSION['IDENTIFIANT']->NOUTILISATEUR . ", " . $_GET['TITRE'] . ", " . $_GET['CONTENU'] . ")";
    //     return $sql;
    // }
}