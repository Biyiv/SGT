<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;

class LoginController extends BaseController {

	public function __construct() {
		helper('form');
	}

	public function login() {
		$utilisateurModel = new UtilisateurModel();
		$utilisateur = $utilisateurModel->where('mail', $this->request->getVar('identifiant'))->first();

		if (!$utilisateur) {
			$utilisateur = $utilisateurModel->where('username', $this->request->getVar('identifiant'))->first();
		}


		if ($utilisateur) {
			if (password_verify($this->request->getVar('password'), $utilisateur['mdp'])) {
				session()->set('utilisateur', $utilisateur);
				return redirect()->to('/dashboard');
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

		//Vérification de l'unicité du nom d'utilisateur
		if ($utilisateurModel->where('username', $this->request->getVar('username'))->first()) {
			session()->setFlashdata('error', 'Ce nom d\'utilisateur est déjà utilisé');
			return redirect()->to('/register');
		}

		//Vérification de l'unicité de l'adresse mail
		if ($utilisateurModel->where('mail', $this->request->getVar('email'))->first()) {
			session()->setFlashdata('error', 'Cette adresse mail est déjà utilisée');
			return redirect()->to('/register');
		}

		// Vérification que le mot de passe fasse au moins 8 caractères, contienne une majuscule, une minuscule et un chiffre
		if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $this->request->getVar('mdp'))) {
			session()->setFlashdata('error', 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre');
			return redirect()->to('/register');
		}

		//Vérification du mot de passe
		if ($this->request->getVar('mdp') != $this->request->getVar('mdp_confirm')) {
			session()->setFlashdata('error', 'Les mots de passe ne correspondent pas');
			return redirect()->to('/register');
		}

		$utilisateur = [
			'username' => $this->request->getVar('username'),
			'nom' => $this->request->getVar('nom'),
			'prenom' => $this->request->getVar('prenom'),
			'mail' => $this->request->getVar('email'),
			'mdp' => password_hash($this->request->getVar('mdp'), PASSWORD_DEFAULT)
		];

		$utilisateurModel->insert($utilisateur);
		return redirect()->to('/login')->with('success', 'Utilisateur créé avec succès');
	}

	public function logout() {
		session()->remove('utilisateur');
		return redirect()->to('/login');
	}

}