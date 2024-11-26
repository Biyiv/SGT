<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model {
	protected $table = 'utilisateur';
	protected $primaryKey = 'username';
	protected $allowedFields = ['username', 'nom', 'prenom', 'mail', 'mdp'];

	protected $useAutoIncrement = false;
}