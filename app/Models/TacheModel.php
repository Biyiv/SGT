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
	
	public function getPaginatedAllTaches(int $perPage = 8, ?string $keyword = ""): array
	{
		// Appliquer la recherche par mot-clé si fourni
		if ($keyword != "") {
			$this->like('titre', $keyword); // Recherche dans le champ title
		}
		return $this->paginate($perPage, 'default');
	}

	public function getPaginatedTaches(int $perPage = 8, string $sortField = 'echeance', string $sortOrder = 'asc', ?string $keyword = ""): array
	{
		// Appliquer la recherche par mot-clé si fourni
		if ($keyword != "") {
			$this->like('titre', $keyword); // Recherche dans le champ title
		}
		return $this->orderBy($sortField, $sortOrder)->paginate($perPage, 'Tache');
	}
}
