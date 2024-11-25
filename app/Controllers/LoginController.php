<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;

class LoginController extends BaseController {

	public function __construct() {
		helper('form');
	}

	public function login() {
		if($this->request->getMethod() == 'POST') {
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

					// Si l'utilisateur a coché la case "Se souvenir de moi", on garde l'identifiant en cookie
					if($this->request->getVar('remember')) {
						setcookie('identifiant', $this->request->getVar('identifiant'), time() + 3600 * 24 * 30);
					} else {
						setcookie('identifiant', '', time() - 3600);
					}

					return redirect()->to('/login');
				}
			} else {
				session()->setFlashdata('error', 'Identifiant incorrect');
				return redirect()->to('/login');
			}
		} else {
			return view('login');
		}
	}

	public function register() {
		$utilisateurModel = new UtilisateurModel();

		//Vérification de l'unicité du nom d'utilisateur
		if ($utilisateurModel->where('username', $this->request->getVar('username'))->first() && $this->request->getVar('username') != "") {
			session()->setFlashdata('error', 'Ce nom d\'utilisateur est déjà utilisé');
			return redirect()->to('/register');
		}

		//Vérification de l'unicité de l'adresse mail
		if ($utilisateurModel->where('mail', $this->request->getVar('email'))->first() && $this->request->getVar('email') != "") {
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
		return redirect()->to('/login');
	}

	public function sendLink()
	{
		if($this->request->getMethod() == 'POST') {
			$utilisateurModel = new UtilisateurModel();

			$mail = $this->request->getVar('mail');
			$utilisateur = $utilisateurModel->getUserByEmail($mail);

			if ($utilisateur) {
				// Générer un jeton de réinitialisation de MDP et enregistrer-le dans BD
				$token = bin2hex(random_bytes(16));
				$expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
				//var_dump($utilisateur);
				//exit;
				$utilisateurModel->set('reset_token', $token)->set('reset_token_expiration', $expiration)->update($utilisateur['username']);
				// Envoyer l'e-mail avec le lien de réinitialisation
				$resetLink = site_url("resetpwd/$token");
				$message = "Cliquez sur le lien suivant pour réinitialiser votre MDP: $resetLink";
				// Utilisez la classe Email de CodeIgniter pour envoyer l'e-mail
				$emailService = \Config\Services::email();
				//envoi du mail
				$emailService->setTo($mail);
				$emailService->setFrom('luc.lecarpentier5@gmail.com');
				$emailService->setSubject('Réinitialisation du mot de passe');
				$emailService->setMessage($message);
				if ($emailService->send()) {
					session()->setFlashdata('success', 'E-mail envoyé avec succès. (' . $mail . ')');
					return redirect()->to('/forgotpwd');
				} else {
					echo $emailService->printDebugger();
				}
			} else {
				session()->setFlashdata('error', 'Adresse e-mail non valide.');
				return redirect()->to('/forgotpwd');
			}
		} else {
			return view('login');
		}
	}

	public function resetpwd($token)
	{
		if($this->request->getMethod() == 'POST') {
			$utilisateurModel = new UtilisateurModel();

			// Vérification que le mot de passe fasse au moins 8 caractères, contienne une majuscule, une minuscule et un chiffre
			if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $this->request->getVar('mdp'))) {
				session()->setFlashdata('error', 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre');
				return redirect()->to("/resetpwd/$token");
			}

			//Vérification du mot de passe
			if ($this->request->getVar('mdp') != $this->request->getVar('mdp_confirm')) {
				session()->setFlashdata('error', 'Les mots de passe ne correspondent pas');
				return redirect()->to("/resetpwd/$token");
			}

			// Valider et traiter les données du formulaire
			$utilisateur = $utilisateurModel->where('reset_token', $token)->where('reset_token_expiration >', date('Y-m-d H:i:s'))->first();

			if (!$utilisateur) {
				session()->setFlashdata('error', 'Le lien de réinitialisation est invalide ou expiré.');
				return redirect()->to('/login');
			}

			// Mettre à jour le mot de passe et réinitialiser le jeton
			$hashedPassword = password_hash($this->request->getVar('mdp'), PASSWORD_DEFAULT);

			$utilisateurModel->set('mdp', $hashedPassword)->set('reset_token', null)->set('reset_token_expiration', null)->update($utilisateur['username']);
			session()->setFlashdata('success', 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.');
			return redirect()->to('/login');
		} else {
			return view('resetpwd', ['token' => $token]);
		}
	}

	public function logout() {
		session()->remove('utilisateur');
		return redirect()->to('/login');
	}

}