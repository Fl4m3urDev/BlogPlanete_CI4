<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeleArticle;

helper(['url', 'assets', 'form']);

class Administrateur extends BaseController
{
    public function ajouterUnArticle()
    {
        $session = session();
        if ($session->get('statut') != 1) {
            return redirect()->to('Visiteur/seConnecter');
        }
        $data['TitreDeLaPage'] = 'Ajouter un article';

        $rules = [
            'txtTitre' => 'required',
            'txtTexte' => 'required',
        ];
        $messages = [
            'txtTitre' => [
                'required' => "Veuillez renseigner le titre",
            ],
            'txtTexte' => [
                'required' => "Un mot de passe est requis",
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            if ($_POST) $data['TitreDeLaPage'] = "Corriger votre article";
            echo view('templates/header');
            echo view('administrateur/ajouterUnArticle', $data);
            echo view('templates/footer');
        } else {
            $donneesAInserer = array(
                'cTitre' => $this->request->getPost('txtTitre'),
                'cTexte' => $this->request->getPost('txtTexte'),
                'cNomFichierImage' => $this->request->getPost('txtNomFichierImage')
            );

            $modelArt = new ModeleArticle();
            $donnees['nbDeLignesAffectees'] = $modelArt->save($donneesAInserer);
            echo view('administrateur/rapportInsertion', $donnees);
        }
    }
}
