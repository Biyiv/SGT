<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model {
	protected $table = 'utilisateur';
	protected $primaryKey = 'username';
	protected $allowedFields = ['username', 'nom', 'prenom', 'mail', 'mdp', 'reset_token', 'reset_token_expiration', 'active', 'active_token'];

	protected $useAutoIncrement = false;

	public function getUtilisateur($username) {
		return $this->where(['username' => $username])->first();
	}
}