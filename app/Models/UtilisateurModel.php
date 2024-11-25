<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model {
	protected $table = 'utilisateur';
	protected $primaryKey = 'username';
	protected $allowedFields = ['username', 'nom', 'prenom', 'email', 'mdp'];

	public function getUtilisateur($username) {
		return $this->where('username', $username)->first();
	}
}