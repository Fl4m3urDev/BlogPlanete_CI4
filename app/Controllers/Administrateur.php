<?php

namespace App\Controllers; //Namespace pour utiliser class contrôleur
use CodeIgniter\Controller;
use App\Models\ModeleArticle; //Namespace pour utiliser class Modèle (new ModelArticle)
helper(['url', 'assets', 'form']);

class Administrateur extends BaseController
{
    public function ajouterUnArticle()
    {
        $session = session();
        if($session->get('statut')!= 1) // 1 : statut administrateur       
        {
            return redirect()->to('Visiteur/seConnecter');
        }
        $data['TitreDeLaPage'] = 'Ajouter un article';
        // Ci-dessous on 'pose' les règles de validation
        $rules = [
            'txtTitre' => 'required',
            'txtTexte' => 'required', // l'image n'est pas obligatoire : pas required
        ];
        $messages = [ //message à renvoyer en cas de non-respect des règles de validation
            'txtTitre' => [
                'required' => "Veuillez renseigner le titre",
            ],
            'txtTexte' => [
                'required' => "Un mot de passe est requis",
            ]
        ];

        if (!$this->validate($rules, $messages)) { // formulaire invalidé, renvoie du formulaire
            if ($_POST) $data['TitreDeLaPage'] = "Corriger votre article";
            echo view('templates/header');
            echo view('administrateur/ajouterUnArticle', $data);
            echo view('templates/footer');
        } else // formulaire validé,
        {
            $donneesAInserer = array(
                'cTitre' => $this->request->getPost('txtTitre'),
                'cTexte' => $this->request->getPost('txtTexte'),
                'cNomFichierImage' => $this->request->getPost('txtNomFichierImage')
            ); // cTitre, cTexte, cNomFichierImage : champs de la table tabarticle

            $modelArt = new ModeleArticle(); //instanciation du modèle
            $donnees['nbDeLignesAffectees'] = $modelArt->save($donneesAInserer); //appel modèle
            echo view('administrateur/rapportInsertion', $donnees);
        } // fin if
    } // ajouterUnArticle
}