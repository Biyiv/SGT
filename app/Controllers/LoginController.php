<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;

class LoginController extends BaseController {

	protected $session;
	public function __construct() {
		helper('form');
		$this->session = session();
	}

	public function redirect() {
		return redirect()->to('/login');
	}

	public function login() {
		if($this->request->getMethod() == 'POST') {
			$utilisateurModel = new UtilisateurModel();
			$utilisateur = $utilisateurModel->where('mail', $this->request->getVar('identifiant'))->first();

			if (!$utilisateur) {
				$utilisateur = $utilisateurModel->where('username', $this->request->getVar('identifiant'))->first();
			}

			if ($utilisateur) {
                if ($utilisateur['active'] == 'f') {
                    $this->sendActiveMail($utilisateur);
                    $this->session->setFlashdata('error', "Votre compte n'est pas activé, un mail viens de partir");
                    return redirect()->to('/login');
                } else if (password_verify($this->request->getVar('password'), $utilisateur['mdp'])) {
                    // Si l'utilisateur a coché la case "Se souvenir de moi", on garde l'identifiant en cookie
                    if($this->request->getVar('remember')) {
                        setcookie('identifiant', $this->request->getVar('identifiant'), time() + 3600 * 24 * 30);
                    } else {
                        setcookie('identifiant', '', time() - 3600);
                    }

                    $this->session->set('utilisateur', $utilisateur);
                    return redirect()->to('/dashboard');
                } else {
                    $this->session->setFlashdata('error', 'Mot de passe incorrect');
                    return redirect()->to('/login');
                }
            } else {
                $this->session->setFlashdata('error', 'Identifiant incorrect');
                return redirect()->to('/login');
            }
		} else {
			return view('login');
		}
	}

	public function register() {
		$utilisateurModel = new UtilisateurModel();
		$username = trim($this->request->getVar('username'));
		$mail = trim($this->request->getVar('email'));

		//Vérification de l'unicité du nom d'utilisateur
		if ($utilisateurModel->where('username', $this->request->getVar('username'))->first() && $this->request->getVar('username') != "") {
			$this->session->setFlashdata('error', 'Ce nom d\'utilisateur est déjà utilisé');
			return redirect()->to('/register');
		}

		//Vérification de l'unicité de l'adresse mail
		if ($utilisateurModel->where('mail', $this->request->getVar('email'))->first() && $this->request->getVar('email') != "") {
			$this->session->setFlashdata('error', 'Cette adresse mail est déjà utilisée');
			return redirect()->to('/register');
		}

		// Vérification que le mot de passe fasse au moins 8 caractères, contienne une majuscule, une minuscule et un chiffre
		if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', $this->request->getVar('mdp'))) {
			$this->session->setFlashdata('error', 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre');
			return redirect()->to('/register');
		}

		//Vérification du mot de passe
		if ($this->request->getVar('mdp') != $this->request->getVar('mdp_confirm')) {
			$this->session->setFlashdata('error', 'Les mots de passe ne correspondent pas');
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
		$this->sendActiveMail($utilisateur);

		$this->session->setFlashdata('success', 'Votre compte a été crée avec succès. Un email vous a été envoyer pour valider votre compte, afin de pouvoir vous connecter.');
		return redirect()->to('/login');
	}

	public function sendActiveMail($utilisateur)
	{
		$token = bin2hex(random_bytes(16));
		$activeLink = site_url("active/$token");
		$utilisateurModel = new UtilisateurModel();
		$utilisateurModel->set('active_token', $token)->update($utilisateur['username']);
		$message =  "Bonjour ".$utilisateur['username'].",\n\nMerci de vous être inscrit sur SGT BALM !!! Nous avons besoin que vous activiez votre compte avant de pouvoir l'utiliser.\n\nCliquez sur le lien ci-dessous pour activer votre compte :\n$activeLink \n\nSi vous n'avez pas demandé à créer un compte, ignorez simplement ce message.\n\nMerci et à bientôt !\n\nCordialement, \n\nL'équipe de SGT BALM.";
		$emailService = \Config\Services::email();
		//envoi du mail
		$emailService->setTo($utilisateur['mail']);
		$emailService->setFrom('sgt.balm.projetsynthese@gmail.com');
		$emailService->setSubject('Activation de votre compte');
		$emailService->setMessage($message);
		if (!$emailService->send()) {
			echo $emailService->printDebugger();
		}
	}

	public function activation($token)
	{
		$utilisateurModel = new UtilisateurModel();

		// Valider et traiter les données du formulaire
		$utilisateur = $utilisateurModel->where('active_token', $token)->first();
		if (!$utilisateur) {
			$this->session->setFlashdata('error', "Le lien d'activation est invalide ou à déja été utilisé.");
			return redirect()->to('/login');
		}

		$utilisateurModel->set('active', true)->set('active_token', null)->update($utilisateur['username']);
		$this->session->setFlashdata('success', 'Votre compte a été activé avec succès. Vous pouvez maintenant vous connecter.');
		return redirect()->to('/login');
	}

	public function forgotpwd()
	{
		if($this->request->getMethod() == 'POST') {
			$utilisateurModel = new UtilisateurModel();

			$mail = $this->request->getVar('mail');
			$utilisateur = $utilisateurModel->where('mail', $mail)->first();

			if ($utilisateur) {
				// Générer un jeton de réinitialisation de MDP et enregistrer-le dans BD
				$token = bin2hex(random_bytes(16));
				$expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
				$utilisateurModel->set('reset_token', $token)->set('reset_token_expiration', $expiration)->update($utilisateur['username']);
				// Envoyer l'e-mail avec le lien de réinitialisation
				$resetLink = site_url("resetpwd/$token");
				$message = "Bonjour ".$utilisateur['username'].",\n\nVous avez demandé à réinitialiser votre mot de passe sur SGT BALM. \n\nCliquez sur le lien ci-dessous pour choisir un nouveau mot de passe :\n$resetLink \n\nSi vous n'avez pas demandé la réinitialisation de votre mot de passe, veuillez ignorer ce message. Votre mot de passe restera inchangé.\n\nPour des raisons de sécurité, ce lien expirera dans 1 heure.\n\nCordialement,\n\nL'équipe d'SGT BALM ";
				// Utilisez la classe Email de CodeIgniter pour envoyer l'e-mail
				$emailService = \Config\Services::email();
				//envoi du mail
				$emailService->setTo($mail);
				$emailService->setFrom('sgt.balm.projetsynthese@gmail.com');
				$emailService->setSubject('Réinitialisez votre mot de passe');
				$emailService->setMessage($message);
				if ($emailService->send()) {
					$this->session->setFlashdata('success', 'E-mail envoyé avec succès. (' . $mail . ')');
					return redirect()->to('/forgotpwd');
				} else {
					echo $emailService->printDebugger();
				}
			} else {
				$this->session->setFlashdata('error', 'Adresse e-mail non valide.');
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

			// Valider et traiter les données du formulaire
			$utilisateur = $utilisateurModel->where('reset_token', $token)->where('reset_token_expiration >', date('Y-m-d H:i:s'))->first();

			if (!$utilisateur) {
				$utilisateur = $utilisateurModel->where('reset_token', $token)->first();
				if ($utilisateur) {
					$utilisateurModel->set('reset_token', null)->set('reset_token_expiration', null)->update($utilisateur['username']);
					$this->session->setFlashdata('error', 'Le lien de réinitialisation est expiré.');
					return redirect()->to('/login');
				}
				$this->session->setFlashdata('error', 'Le lien de réinitialisation est invalide ou à déja été utilisé.');
				return redirect()->to('/login');
			}

			// Vérification que le mot de passe fasse au moins 8 caractères, contienne une majuscule, une minuscule et un chiffre
			if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', $this->request->getVar('mdp'))) {
				$this->session->setFlashdata('error', 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre');
				return redirect()->to("/resetpwd/$token");
			}

			//Vérification du mot de passe
			if ($this->request->getVar('mdp') != $this->request->getVar('mdp_confirm')) {
				$this->session->setFlashdata('error', 'Les mots de passe ne correspondent pas');
				return redirect()->to("/resetpwd/$token");
			}

			// Valider et traiter les données du formulaire
			$utilisateur = $utilisateurModel->where('reset_token', $token)->where('reset_token_expiration >', date('Y-m-d H:i:s'))->first();

			if (!$utilisateur) {
				$this->session->setFlashdata('error', 'Le lien de réinitialisation est invalide ou expiré.');
				return redirect()->to('/login');
			}

			// Mettre à jour le mot de passe et réinitialiser le jeton
			$hashedPassword = password_hash($this->request->getVar('mdp'), PASSWORD_DEFAULT);

			$utilisateurModel->set('mdp', $hashedPassword)->set('reset_token', null)->set('reset_token_expiration', null)->update($utilisateur['username']);
			$this->session->setFlashdata('success', 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.');
			return redirect()->to('/login');
		} else {
			return view('resetpwd', ['token' => $token]);
		}
	}

	public function logout() {
		$this->session->remove('utilisateur');
		return redirect()->to('/login')->with('success', 'Vous avez été déconnecté avec succès');
	}

}