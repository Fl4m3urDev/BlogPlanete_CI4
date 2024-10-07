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
            if ($_POST) {
                $data['TitreDeLaPage'] = "Corriger votre article";
            }
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

    public function modifierUnArticle($NoArticle)
    {
        $modelArt = new ModeleArticle();
        $data['unArticle'] = $modelArt->retournerArticles($NoArticle);
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
            if ($_POST) {
                $data['TitreDeLaPage'] = "Corriger votre article";
            }
            return view('templates/header')
                . view('administrateur/modifierUnArticle', $data)
                . view('templates/footer');
        } else {
            $donneesAInserer = array(
                'TITRE' => $this->request->getPost('txtTitre'),
                'TEXTE' => $this->request->getPost('txtTexte'),
                'NOMFICHIERIMAGE' => $this->request->getPost('txtNomFichierImage')
            );
            $donnees['nbDeLignesAffectees'] = $modelArt->update($NoArticle, $donneesAInserer);
            return view('administrateur/rapportModification', $donnees);
        }
    }

    public function supprimerUnArticle($NoArticle)
    {
        $modelArt = new ModeleArticle();
        $modelArt->retournerArticles($NoArticle);
        $modelArt->delete($NoArticle);
        return redirect()->to('visiteur/listerLesArticles');
    }

    public function ajouterUnAvis($NoArticle)
    {
        $session = session();
        if ($session->get('statut') != 1 && $session->get('statut') != 2) {
            return redirect()->to('Visiteur/seConnecter');
        }
        if ($NoArticle === null) {
            return redirect()->to('visiteur/listerLesArticles');
        }
        $modelArt = new ModeleArticle();
        $data['unArticle'] = $modelArt->retournerArticles($NoArticle);
        $data['NOUTILISATEUR'] = $session->get('NOUTILISATEUR');
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
            if ($_POST) {
                $data['TitreDeLaPage'] = "Corriger votre avis";
            }
            return view('templates/header')
                . view('administrateur/ajouterUnAvis', $data)
                . view('templates/footer');
        } else {
            $donneesAInserer = [
                'NOARTICLE' => $NoArticle,
                'NOUTILISATEUR' => $data['NOUTILISATEUR'],
                'TITRE' => $this->request->getPost('txtTitre'),
                'CONTENU' => $this->request->getPost('txtTexte')
            ];

            $modelAvis = new ModeleAvis();
            $modelAvis->save($donneesAInserer);
            return redirect()->to('visiteur/voirUnArticle/' . $NoArticle);
        }
    }

    public function modifierUnAvis($NoAvis)
    {
        $modelAvis = new ModeleAvis();
        $data['unAvis'] = $modelAvis->retournerAvis($NoAvis);
        if (!$data['unAvis']) {
            return redirect()->to('visiteur/listerLesArticles')->with('message', 'Avis non trouvé');
        }
        $NoArticle = $data['unAvis']['NOARTICLE'];
        $session = session();
        if ($session->get('statut') != 1 && $session->get('statut') != 2) {
            return redirect()->to('Visiteur/seConnecter');
        }
        if ($NoArticle === null) {
            return redirect()->to('visiteur/listerLesArticles');
        }
        $modelArt = new ModeleArticle();
        $data['unArticle'] = $modelArt->retournerArticles($NoArticle);
        $data['NOUTILISATEUR'] = $session->get('NOUTILISATEUR');
        $data['TitreDeLaPage'] = 'Modifier un avis';

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
            if ($_POST) {
                $data['TitreDeLaPage'] = "Corriger votre avis";
            }
            return view('templates/header')
            . view('administrateur/modifierUnAvis', $data)
                . view('templates/footer');
        } else {
            $donneesAInserer = [
                'NOARTICLE' => $NoArticle,
                'NOUTILISATEUR' => $data['NOUTILISATEUR'],
                'TITRE' => $this->request->getPost('txtTitre'),
                'CONTENU' => $this->request->getPost('txtTexte')
            ];

            if ($session->get('statut') == 1 || $session->get('statut') == 2 || $session->get('NOUTILISATEUR') == $data['unAvis']['NOUTILISATEUR']) {
                $modelAvis->update($NoAvis, $donneesAInserer);
                return redirect()->to('visiteur/voirUnArticle/' . $NoArticle);
            } else {
                return redirect()->to('visiteur/listerLesArticles')->with('error', 'Vous n\'êtes pas autorisé à modifier cet avis');
            }
        }
    }

    public function supprimerUnAvis($NoAvis)
    {
        $session = session();
        $modelAvis = new ModeleAvis();
        $unAvis = $modelAvis->retournerAvis($NoAvis);
        if (!$unAvis) {
            return redirect()->to('visiteur/listerLesArticles')->with('error', 'Avis introuvable');
        }
        if ($session->get('statut') == 1 || $session->get('statut') == 2 || $session->get('NOUTILISATEUR') == $unAvis['NOUTILISATEUR']) {
            $modelAvis->delete($NoAvis);
            return redirect()->to('visiteur/listerLesArticles')->with('success', 'Avis supprimé avec succès');
        } else {
            return redirect()->to('visiteur/listerLesArticles')->with('error', 'Vous n\'êtes pas autorisé à supprimer cet avis');
        }
    }

}