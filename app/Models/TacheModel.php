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
		'echeance',
		'priorite',
		'creerpar',
		'datecreation',
	];
	
	
	public function getTacheById($id)
	{
		return $this->where('id', $id)->first();
	}
}