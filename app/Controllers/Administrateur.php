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
            return view('templates/header')
                . view('administrateur/ajouterUnArticle', $data)
                . view('templates/footer');
        } else {
            $donneesAInserer = array(
                'cTitre' => $this->request->getPost('txtTitre'),
                'cTexte' => $this->request->getPost('txtTexte'),
                'cNomFichierImage' => $this->request->getPost('txtNomFichierImage')
            );

            $modelArt = new ModeleArticle();
            $donnees['nbDeLignesAffectees'] = $modelArt->save($donneesAInserer);
            return view('administrateur/rapportInsertion', $donnees);
        }
    }

    public function modifierUnArticle($cNo)
    {
        $modelArt = new ModeleArticle();
        $data['unArticle'] = $modelArt->retournerArticles($cNo);
        $session = session();
        if ($session->get('statut') != 1) {
            return redirect()->to('Visiteur/seConnecter');
        }
        $data['TitreDeLaPage'] = 'Modifier un article';

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
            return view('templates/header')
                . view('administrateur/modifierUnArticle', $data)
                . view('templates/footer');
        } else {
            $donneesAInserer = array(
                'cTitre' => $this->request->getPost('txtTitre'),
                'cTexte' => $this->request->getPost('txtTexte'),
                'cNomFichierImage' => $this->request->getPost('txtNomFichierImage')
            );

            $modelArt = new ModeleArticle();
            $donnees['nbDeLignesAffectees'] = $modelArt->update($cNo, $donneesAInserer);
            return view('administrateur/rapportModification', $donnees);
        }
    }

    public function supprimerUnArticle($cNo)
    {
        $modelArt = new ModeleArticle();
        $modelArt->retournerArticles($cNo);
        $modelArt->delete($cNo);
        return redirect()->to('visiteur/listerLesArticles');
    }
}
