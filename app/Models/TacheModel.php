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
		'creepar',
		'debut',
		'echeance',
		'priorite',
		'statut',
	];
	
	public function getTaches($user=null, $sort = "echeance", $direction = "ASC"): array
	{
		/*if ($user == null) {
			return [];
		}*/
		return $this->orderBy($sort, $direction)->findAll();
	}

	
	public function getTacheById($id)
	{
		return $this->where('id', $id)->first();
	}
}
