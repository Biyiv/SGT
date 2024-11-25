<?php
namespace App\Models;
use CodeIgniter\Model;
class UserModelB extends Model
{
	protected $table = 'tache';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'titre',
		'description',
		'creerpar',
		'debut',
		'echeance',
		'priorite',
		'statut',
	];
	
	
	public function getTacheById($id)
	{
		return $this->where('id', $id)->first();
	}
}
