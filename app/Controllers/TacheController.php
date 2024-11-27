<?php

namespace App\Controllers;

use App\Models\TacheModel;
use App\Models\CommentaireModel;
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
		$tacheModel = new TacheModel();
		$commentaireModel = new CommentaireModel();

		$tri = $this->session->get('tri') == null ? "echeance" : $this->session->get('tri');
		// Récupérer toutes les tâches, triées par échéance
		if ($tri == 'retard'){
			$data['taches'] = $tacheModel->getPaginatedAllTaches(8);
			//Tri les taches par leur retard c'est à dire la date actuelle moins leur echeance
			usort($data['taches'], function($a, $b) {
				$dateA = new \DateTime($a['echeance']);
				$dateB = new \DateTime($b['echeance']);
				$now = new \DateTime();

				$diffA = $now->diff($dateA)->days;
				$diffB = $now->diff($dateB)->days;

				return $diffB - $diffA;
			});
		} elseif ($tri == 'echeance') {
			$data['taches'] = $tacheModel->getPaginatedTaches(8, $tri);
		} elseif ($tri == 'priorite') {
			$data['taches'] = $tacheModel->getPaginatedTaches(8, $tri, 'DESC');
		}

		$data['pagerTaches'] = $tacheModel->pager;
		$data['tri'] = $tri;

		$data['commentaires'] = $commentaireModel->getPaginatedCommentaires(2, 1);//mettre le num de la tache
		$data['pagerCommentaires'] = $commentaireModel->pager;

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

		if(!$this->session->get('utilisateur')) {
			return redirect()->to('/login')->with('error', 'Vous devez être connecté pour accéder à cette page');
		}

		$utilisateur = $this->session->get('utilisateur');

		$data = [
			'titre' => $this->request->getPost('titre'),
			'description' => $this->request->getPost('description'),
			'debut' => $this->request->getPost('debut'),
			'echeance' => $this->request->getPost('echeance'),
			'priorite' => $this->request->getPost('priorite'),
			'creepar' => $utilisateur['username'],
			'statut' => 'en attente'
		];

		if (!$data['creepar']) {
			return redirect()->back()->with('error', 'Problème avec l\'utilisateur connecté.');
		}

		$tacheModel->insert($data);

		return redirect()->to('/dashboard')->with('success', 'Tâche ajoutée avec succès');
	}

	public function modifierTache($id) {
		$tacheModel = new TacheModel();
		$tache = $tacheModel->find($id);
	
		if (!$tache) {
			return $this->response->setStatusCode(404)->setJSON(['error' => 'Tâche non trouvée']);
		}
	
		// Récupérer les données JSON
		$data = $this->request->getJSON(true);

	
		if($tacheModel->update($id, $data)) {
			$this->session->setFlashdata('success', 'Tâche modifiée avec succès');
			return $this->response->setJSON($data);
		} else {
			return $this->response->setStatusCode(500)->setJSON(['error' => 'Erreur lors de la modification de la tâche']);
		}
	}
}
