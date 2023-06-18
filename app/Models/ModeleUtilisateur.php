<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleUtilisateur extends Model
{
    protected $table = 'utilisateur';
    //protected $primaryKey = 'cNo';

    public function retournerUtilisateur($pId, $MotdePasse)
    {
        return $this->where(['IDENTIFIANT' => $pId, 'MOTDEPASSE' => $MotdePasse])->first();
    }

    public function retournerUtilisateurParNo($NoUtilisateur)
    {
        return $this->where(['NOUTILISATEUR' => $NoUtilisateur])->first();
    }
}
