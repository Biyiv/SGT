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
	
	public function getTaches($sort = "echeance", $direction = "ASC"): array
	{
		return $this->orderBy($sort, $direction)->findAll();
	}

	public function getTacheById($id)
	{
		return $this->where('id', $id)->first();
	}

	public function getPaginatedAllTaches(int $perPage, ?string $keyword = null): array
	{
		// Appliquer la recherche par mot-clé si fourni
		if ($keyword) {
			$this->like('titre', $keyword); // Recherche dans le champ title
		}
		return $this->paginate($perPage, 'default');
	}

	public function getPaginatedTaches(int $perPage, string $sortField = 'echeance', string $sortOrder = 'asc', ?string $keyword = null): array
	{
		// Appliquer la recherche par mot-clé si fourni
		if ($keyword) {
			$this->like('titre', $keyword); // Recherche dans le champ title
		}
		return $this->orderBy($sortField, $sortOrder)->paginate($perPage, 'default');
	}
}
