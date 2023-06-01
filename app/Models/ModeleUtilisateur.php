<?php

namespace App\Models;
use CodeIgniter\Model;

class ModeleUtilisateur extends Model
{
    protected $table = 'tabutilisateur';
    //protected $primaryKey = 'cNo';
    public function retournerUtilisateur($pId, $MotdePasse)
    {
        return $this->where(['cIdentifiant' => $pId, 'cMotDePasse' => $MotdePasse])->first();
    }

}