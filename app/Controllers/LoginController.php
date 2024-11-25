<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;

class LoginController extends BaseController {

	public function __construct() {
		helper('form');
	}

	public function login() {
		$utilisateurModel = new UtilisateurModel();
		$utilisateur = $utilisateurModel->where('email', $this->request->getVar('identifiant'))->first();

		if (!$utilisateur) {
			$utilisateur = $utilisateurModel->where('username', $this->request->getVar('identifiant'))->first();
		}

		if ($utilisateur) {
			if (password_verify($this->request->getVar('password'), $utilisateur['password'])) {
				session()->set('utilisateur', $utilisateur);
				return redirect()->to('/home');
			} else {
				session()->setFlashdata('error', 'Mot de passe incorrect');
				return redirect()->to('/login');
			}
		} else {
			return view('login');
		}
	}

	public function register() {
		$utilisateurModel = new UtilisateurModel();
		$utilisateur = [
			'username' => $this->request->getVar('username'),
			'nom' => $this->request->getVar('nom'),
			'prenom' => $this->request->getVar('prenom'),
			'email' => $this->request->getVar('email'),
			'mdp' => password_hash($this->request->getVar('mdp'), PASSWORD_DEFAULT)
		];

		$utilisateurModel->insert($utilisateur);
		return redirect()->to('/login');
	}

	public function logout() {
		session()->remove('utilisateur');
		return redirect()->to('/login');
	}

}