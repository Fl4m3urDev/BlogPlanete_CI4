<?php

namespace App\Models; //espace de noms
use CodeIgniter\Model;

class ModeleUtilisateur extends Model
{
    protected $table = 'tabutilisateur'; //definition de la table principale
    //protected $primaryKey = 'cNo';
    public function retournerUtilisateur($pId, $MotdePasse)
    {
        return $this->where(['cIdentifiant' => $pId, 'cMotDePasse' => $MotdePasse])->first();
        // <=> SELECT * FROM tabutilisateur  WHERE cIdentifiant='$pId' and cMotDePasse='$MotdePasse'
    } // retournerUtilisateur

} // Fin Classe