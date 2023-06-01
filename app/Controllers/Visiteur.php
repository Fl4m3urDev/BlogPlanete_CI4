<?php

namespace App\Controllers;

use App\Models\ModeleArticle;
use App\Models\ModeleUtilisateur;

helper(['assets']);
class Visiteur extends BaseController
{
    public function listerLesArticles()
    {
        $modelArt = new ModeleArticle();
        $data['lesArticles'] = $modelArt->retournerArticles();
        $data['TitreDeLaPage'] = 'Tous les articles';
        echo view('templates/header');
        echo view('visiteur/listerLesArticles', $data);
        echo view('templates/footer');
    }

    public function listerLesArticlesAvecPagination()
    {
        $pager = \Config\Services::pager();
        $modelArt = new ModeleArticle();
        $data['lesArticles'] = $modelArt->paginate(3);
        $data['pager'] = $modelArt->pager;
        $data['TitreDeLaPage'] = 'Tous les articles';
        echo view('templates/header');
        echo view('visiteur/listerLesArticlesAvecPagination', $data);
        echo view('templates/footer');
    }

    public function voirUnArticle($noArticle = NULL)
    {
        $modelArt = new ModeleArticle();
        $data['unArticle'] = $modelArt->retournerArticles($noArticle);
        if (empty($data['unArticle'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['TitreDeLaPage'] = $data['unArticle']['cTitre'];
        echo view('templates/header');
        echo view('visiteur/voirUnArticle', $data);
        echo view('templates/footer');
    }

    public function seConnecter()
    {
        helper(['form']);
        $session = session();
        $data['TitreDeLaPage'] = 'Se connecter';

        $rules = [
            'txtIdentifiant' => 'required',
            'txtMotDePasse' => 'required'
        ];
        $messages = [
            'txtIdentifiant' => [
                'required' => 'Un Identifiant est requis'
            ],
            'txtMotDePasse' => [
                'required' => 'Un mot de passe est requis',
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            if ($_POST) $data['TitreDeLaPage'] = "Corriger votre formulaire";
            echo view('templates/header', $data);
            echo view('visiteur/seConnecter');
        } else {
            $Identifiant = $this->request->getPost('txtIdentifiant');
            $MdP = $this->request->getPost('txtMotDePasse');
            $modelUti = new ModeleUtilisateur();
            $UtilisateurRetourne = $modelUti->retournerUtilisateur($Identifiant, $MdP);
            if (!($UtilisateurRetourne == null)) {
                $session->set('identifiant', $UtilisateurRetourne["cIdentifiant"]);
                $session->set('statut', $UtilisateurRetourne["cStatut"]);
                $data['Identifiant'] = $Identifiant;
                echo view('templates/header', $data);
                echo view('visiteur/connexionReussie');
            } else {
                if ($_POST) $data['TitreDeLaPage'] = "Logging inexistant";
                echo view('templates/header', $data);
                echo view('visiteur/seConnecter');
            }
        }
        echo view('templates/footer');
    }

    public function seDeconnecter()
    {
        session()->destroy();
        return redirect()->to('visiteur/seConnecter');
    }
}
