<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeleArticle;
use App\Models\ModeleAvis;

helper(['url', 'assets', 'form']);

class Administrateur extends BaseController
{
    public function ajouterUnArticle()
    {
        $session = session();
        if ($session->get('statut') != 2) {
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
                'required' => "Veuillez renseigner le texte",
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            if ($_POST) $data['TitreDeLaPage'] = "Corriger votre article";
            return view('templates/header')
                . view('administrateur/ajouterUnArticle', $data)
                . view('templates/footer');
        } else {
            $donneesAInserer = array(
                'TITRE' => $this->request->getPost('txtTitre'),
                'TEXTE' => $this->request->getPost('txtTexte'),
                'NOMFICHIERIMAGE' => $this->request->getPost('txtNomFichierImage')
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
        if ($session->get('statut') != 2) {
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
                'required' => "Veuillez renseigner le texte",
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            if ($_POST) $data['TitreDeLaPage'] = "Corriger votre article";
            return view('templates/header')
                . view('administrateur/modifierUnArticle', $data)
                . view('templates/footer');
        } else {
            $donneesAInserer = array(
                'TITRE' => $this->request->getPost('txtTitre'),
                'TEXTE' => $this->request->getPost('txtTexte'),
                'NOMFICHIERIMAGE' => $this->request->getPost('txtNomFichierImage')
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

    public function ajouterUnAvis()
    {
        $session = session();
        if ($session->get('statut') != 1 && $session->get('statut') != 2) {
            return redirect()->to('Visiteur/seConnecter');
        }
        $modelArt = new ModeleArticle();
        $data['unArticle'] = $modelArt->retournerArticles();
        $modelAvis = new ModeleAvis();
        $data['unAvis'] = $modelAvis->retournerAvis();
        $data['TitreDeLaPage'] = 'Ajouter un avis';

        $rules = [
            'txtTitre' => 'required',
            'txtTexte' => 'required',
        ];
        $messages = [
            'txtTitre' => [
                'required' => "Veuillez renseigner le titre",
            ],
            'txtTexte' => [
                'required' => "Veuillez renseigner l'avis",
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            if ($_POST) $data['TitreDeLaPage'] = "Corriger votre avis";
            return view('templates/header')
                . view('administrateur/ajouterUnAvis', $data)
                . view('templates/footer');
        } else {
            $donneesAInserer = array(
                'TITRE' => $this->request->getPost('txtTitre'),
                'CONTENU' => $this->request->getPost('txtTexte'),
            );

            $donnees['nbDeLignesAffectees'] = $modelAvis->insererAvis($donneesAInserer);
            return redirect()->to('visiteur/listerLesArticles');
        }
    }

}
