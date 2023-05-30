<?php

namespace App\Controllers; //Namespace pour utiliser fct contrôleur
use App\Models\ModeleArticle; //Namespace pour utiliser fct Modèle (new ModelArticle)
use App\Models\ModeleUtilisateur; //Namespace pour utiliser fct Modèle (new ModeleUtilisateur)

helper(['assets']);
class Visiteur extends BaseController
{
    public function listerLesArticles()
    {
        $modelArt = new ModeleArticle(); //instanciation du modèle
        $data['lesArticles'] = $modelArt->retournerArticles(); //récupération des donnes via le modèle
        $data['TitreDeLaPage'] = 'Tous les articles';
        echo view('templates/header'); //envoi du header
        echo view('visiteur/listerLesArticles', $data); //envoi vue + données
        echo view('templates/footer'); //envoi du footer
    }

    public function listerLesArticlesAvecPagination()
    {
        $pager = \Config\Services::pager();
        $modelArt = new ModeleArticle(); //instanciation du modèle
        $data['lesArticles'] = $modelArt->paginate(3); //récupération des données via le modèle
        $data['pager'] = $modelArt->pager;
        $data['TitreDeLaPage'] = 'Tous les articles';
        echo view('templates/header'); //envoi du header
        echo view('visiteur/listerLesArticlesAvecPagination', $data); //envoi vue + données
        echo view('templates/footer'); //envoi du footer
    } // fin listerLesArticlesAvecPagination

    public function voirUnArticle($noArticle = NULL) // valeur par défaut de noArticle = NULL
    {
        $modelArt = new ModeleArticle(); //instanciation du modéle
        $data['unArticle'] = $modelArt->retournerArticles($noArticle); //rédupération des données via le modèle
        if (empty($data['unArticle'])) { // pas d'article correspondant au n°
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['TitreDeLaPage'] = $data['unArticle']['cTitre'];
        echo view('templates/header'); //envoi du header
        echo view('visiteur/voirUnArticle', $data); //envoi vue + données
        echo view('templates/footer'); //envoi du footer
    }

    public function seConnecter()
    {
        helper(['form']);
        $session = session();
        $data['TitreDeLaPage'] = 'Se connecter';

        $rules = [ //régles de validation
            'txtIdentifiant' => 'required',
            'txtMotDePasse' => 'required'
        ];
        $messages = [ //message à renvoyer en cas de non-respect des règles de validation
            'txtIdentifiant' => [
                'required' => 'Un Identifiant est requis'
            ],
            'txtMotDePasse' => [
                'required' => 'Un mot de passe est requis',
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            if ($_POST) $data['TitreDeLaPage'] = "Corriger votre formulaire"; //if ($this->request->getMethod()=='post') // si c'est une tentative d'enregistrement // erreur IDE !!
            echo view('templates/header', $data);
            echo view('visiteur/seConnecter'); // renvoi formulaire
        } else { // formulaire validé
            // on récupère les données du formulaire de connexion
            $Identifiant = $this->request->getPost('txtIdentifiant');
            $MdP = $this->request->getPost('txtMotDePasse');
            // on va chercher l'utilisateur correspondant aux Id et MdPasse saisis
            $modelUti = new ModeleUtilisateur(); //instanciation du modèle
            $UtilisateurRetourne = $modelUti->retournerUtilisateur($Identifiant, $MdP);

            if (!($UtilisateurRetourne == null)) {  // on a trouvé, identifiant et statut (droit) sont stockés en session
                $session->set('identifiant', $UtilisateurRetourne["cIdentifiant"]);
                $session->set('statut', $UtilisateurRetourne["cStatut"]);
                $data['Identifiant'] = $Identifiant;
                echo view('templates/header', $data);
                echo view('visiteur/connexionReussie');
            } else {
                if ($_POST) $data['TitreDeLaPage'] = "Logging inexistant";
                // utilisateur non trouvé on renvoie le formulaire de connexion
                echo view('templates/header', $data);
                echo view('visiteur/seConnecter');
            }
        }
        echo view('templates/footer');
    } // fin seConnecter

    public function seDeconnecter()
    {
        session()->destroy();
        return redirect()->to('visiteur/seConnecter');
    }
}
