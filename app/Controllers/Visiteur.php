<?php

namespace App\Controllers;

use App\Models\ModeleArticle;
use App\Models\ModeleUtilisateur;
use App\Models\ModeleAvis;

helper(['assets']);
class Visiteur extends BaseController
{
    public function listerLesArticles()
    {
        $modelArt = new ModeleArticle();
        $data['lesArticles'] = $modelArt->retournerArticles();
        $data['TitreDeLaPage'] = 'Tous les articles';
        return view('templates/header')
        .view('visiteur/listerLesArticles', $data)
        .view('templates/footer');
    }

    public function listerLesArticlesAvecPagination()
    {
        $pager = \Config\Services::pager();
        $modelArt = new ModeleArticle();
        $data['lesArticles'] = $modelArt->paginate(3);
        $data['pager'] = $modelArt->pager;
        $data['TitreDeLaPage'] = 'Tous les articles';
        return view('templates/header')
        .view('visiteur/listerLesArticlesAvecPagination', $data)
        .view('templates/footer');
    }

    public function voirUnArticle($noArticle = NULL)
    {
        $modelArt = new ModeleArticle();
        $data['unArticle'] = $modelArt->retournerArticles($noArticle);
        $modelAvis = new ModeleAvis();
        $data['lesAvis'] = $modelAvis->retournerAvisParArticles($noArticle);
        if (empty($data['unArticle']) ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['TitreDeLaPage'] = $data['unArticle']['TITRE'];
        return view('templates/header')
        .view('visiteur/voirUnArticle', $data)
        .view('templates/footer');
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
                $session->set('identifiant', $UtilisateurRetourne["IDENTIFIANT"]);
                $session->set('roles', $UtilisateurRetourne["ROLES"]);
                $data['Identifiant'] = $Identifiant;
                echo view('templates/header', $data);
                echo view('visiteur/connexionReussie');
            } else {
                if ($_POST) $data['TitreDeLaPage'] = "Logging inexistant";
                return view('templates/header', $data)
                .view('visiteur/seConnecter');
            }
        }
        return view('templates/footer');
    }

    public function seDeconnecter()
    {
        session()->destroy();
        return redirect()->to('visiteur/seConnecter');
    }
}
