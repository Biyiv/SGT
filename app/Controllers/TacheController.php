<?php

namespace App\Controllers;

use App\Models\TacheModel;
use App\Models\UtilisateurModel;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class TacheController extends BaseController
{
    protected $session;
    public function __construct()
    {
        helper('form');
        $this->session = session();
    }

    public function index(): string
    {
        $model = new TacheModel();

        $tri = $this->session->get('tri') == null ? "" : $this->session->get('tri');
        // Récupérer toutes les tâches, triées par échéance
        $data['taches'] = $model->getTaches($this->session->get('user'), $tri);
		$data['tri'] = $tri;

        // Charger la vue avec les données
        return view('menu', $data);
    }

	public function setTriPreference()
    {
        $session = session();

        $tri = $this->request->getPost('tri');
        if ($tri) {
            $session->set('tri', $tri);
        }

        return redirect()->to('/dashboard');
    }

    public function ajouterTache()
    {
        $tacheModel = new TacheModel();
        $utilisateurModel = new UtilisateurModel();

        if(!$this->session->get('utilisateur')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour accéder à cette page');
        }

        $utilisateur = $utilisateurModel->getUtilisateur($this->session->get('utilisateur')['username']);

        if (!$utilisateur) {
            return redirect()->to('/login')->with('error', 'Utilisateur non trouvé.');
        }

        $data = [
            'titre' => $this->request->getPost('titre'),
            'description' => $this->request->getPost('description'),
            'debut' => $this->request->getPost('debut'),
            'echeance' => $this->request->getPost('echeance'),
            'priorite' => $this->request->getPost('priorite'),
            'creepar' => $utilisateur,
            'statut' => 'En attente'
        ];

        if (!$data['creepar']) {
            return redirect()->back()->with('error', 'Problème avec l\'utilisateur connecté.');
        }

        dd($data);  
    
        $tacheModel->insert($data);

        return redirect()->to('/dashboard')->with('success', 'Tâche ajoutée avec succès');
    }
}
