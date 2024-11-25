<?php
namespace App\Models;
use CodeIgniter\Model;
class TacheModel extends Model
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
	
	public function getTaches($sort = "echeance"): array
	{
		return $this->orderBy($sort, 'ASC')->findAll();
	}

	
	public function getTacheById($id)
	{
		return $this->where('id', $id)->first();
	}
}