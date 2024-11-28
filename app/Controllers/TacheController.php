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

		$tri = isset($_COOKIE['tri']) ? $_COOKIE['tri'] : "echeance";

		$recherche = $this->session->get('recherche') == null ? "" : $this->session->get('recherche');
		
		// Récupérer toutes les tâches, triées par échéance
		if ($tri == 'retard'){
			$recherche == "" ? $data['taches'] = $tacheModel->getPaginatedAllTaches(8) : $data['taches'] = $tacheModel->getPaginatedAllTaches(8, $recherche);
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
			$recherche == "" ? $data['taches'] = $tacheModel->getPaginatedTaches(8, $tri) : $data['taches'] = $tacheModel->getPaginatedTaches(8, $tri, 'ASC', $recherche);
		} elseif ($tri == 'priorite') {
			$recherche == "" ? $data['taches'] = $tacheModel->getPaginatedTaches(8, $tri, 'DESC') : $data['taches'] = $tacheModel->getPaginatedTaches(8, $tri, 'DESC', $recherche);
		}

		$data['pagerTaches'] = $tacheModel->pager;

		$data['commentaires'] = $commentaireModel->getPaginatedCommentaires(2);
		$data['pagerCommentaires'] = $commentaireModel->pager;

		// Charger la vue avec les données
		return view('menu', $data);
	}

	public function setTriPreference()
	{
		$tri = $this->request->getPost('tri');
		if ($tri) {
			setcookie('tri', $tri, time() + 3600 * 24 * 30);
		}

		return redirect()->to('/dashboard');
	}

	public function setRecherche()
	{
		$session = session();

		$recherche = $this->request->getPost('recherche');
		if ($recherche) {
			$session->set('recherche', $recherche);
		}

		return redirect()->to('/dashboard');
	}
	public function resetRecherche()
	{
		$session = session();
		$session->set('recherche', "");
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
			$this->session->setFlashdata('error', 'Tâche non trouvée');
			return $this->response->setStatusCode(404)->setJSON(['error' => 'Tâche non trouvée']);
		}
	
		// Récupérer les données JSON
		$data = $this->request->getJSON(true);

		$data['priorite'] = $data['priorite'] == 'importante' ? 3 : ($data['priorite'] == 'moyenne' ? 2 : 1);

		if($tacheModel->update($id, $data)) {
			$this->session->setFlashdata('success', 'Tâche modifiée avec succès');
			return $this->response->setJSON($data);
		} else {
			$this->session->setFlashdata('error', 'Erreur lors de la modification de la tâche');
			return $this->response->setStatusCode(280)->setJSON(['error' => 'Erreur lors de la modification de la tâche']);
		}
	}

	public function dmdSupprimerTache($id) {
		$tacheModel = new TacheModel();
		$tache = $tacheModel->find($id);
	
		if (!$tache) {
			$this->session->setFlashdata('error', 'Tâche non trouvée');
			return redirect()->to('/dashboard');
		}
	
		$this->session->setFlashdata('demandeSuppr', 'Voulez vous supprimer la tache : " '. $tache['titre'] . ' " ?');
		$this->session->setFlashdata('demandeSupprId', $id);
		return $this->response->setJSON(['demandeSuppr' => 'Voulez vous supprimer la tache : " '. $tache['titre'] . ' " ?' , 'demandeSupprId' => $id]);
		
	}
	public function supprimerTache($id) {
		$tacheModel = new TacheModel();
		$tache = $tacheModel->find($id);
	
		if (!$tache) {
			$this->session->setFlashdata('error', 'Tâche non trouvée');
			return redirect()->to('/dashboard');
		}
	
		if ($tacheModel->delete($id)) {
			$this->session->setFlashdata('success', 'Tâche supprimée avec succès');
			return redirect()->to('/dashboard');
		} else {
			$this->session->setFlashdata('error', 'Erreur lors de la suppression de la tâche');
			return redirect()->to('/dashboard');
		}
	}

	public function getCommentaires($id) {	
		$commentaireModel = new CommentaireModel();
		$commentaires = $commentaireModel->getCommentaires($id);

	
		if ($commentaires) {
			return $this->response->setJSON($commentaires);
		} else {
			// Retourne le string "Pas de commentaire"
			return $this->response->setJSON([]);
		}
	}

	public function ajouterCommentaire($idtache) {
		$commentaireModel = new CommentaireModel();
	
		$utilisateur = $this->session->get('utilisateur');
	
		// Récupération des données JSON
		$data = $this->request->getJSON(true);
	
		if (!$utilisateur || empty($utilisateur['username'])) {
			return $this->response->setStatusCode(280)->setJSON(['error' => 'Problème avec l\'utilisateur connecté.']);
		}
	
		// Ajouter les données nécessaires
		$data['tache'] = $idtache;
		$data['datecreation'] = date('Y-m-d H:i:s');
		$data['creepar'] = $utilisateur['username'];

	
		if ($commentaireModel->insert($data)) {
			return $this->response->setJSON(['success' => 'Commentaire ajouté avec succès']);
		} else {
			return $this->response->setStatusCode(500)->setJSON(['error' => 'Erreur lors de l\'ajout du commentaire', 'data' => $data]);
		}
	}
	

	public function supprimerCommentaire($id) {
		$commentaireModel = new CommentaireModel();
		$commentaire = $commentaireModel->find($id);
	
		if (!$commentaire) {
			return $this->response->setStatusCode(404)->setJSON(['error' => 'Commentaire non trouvé']);
		}
	
		if ($commentaireModel->delete($id)) {
			return $this->response->setJSON(['success' => 'Commentaire supprimé avec succès']);
		} else {
			return $this->response->setStatusCode(280)->setJSON(['error' => 'Erreur lors de la suppression du commentaire']);
		}
	}
}