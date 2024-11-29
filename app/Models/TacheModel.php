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
	
	public function getPaginatedRetardTaches(int $perPage = 8, ?string $keyword = null): array
	{
		// Appliquer la recherche par mot-clé si fourni
		if ($keyword) {
			$this->like('titre', $keyword); // Recherche dans le champ title
		}
		return $this->where('statut', 'en retard')->paginate($perPage, 'Tache');
	}

	public function getPaginatedTaches(int $perPage = 8, string $sortField = 'echeance', string $sortOrder = 'asc', ?string $keyword = null): array
	{
		// Appliquer la recherche par mot-clé si fourni
		if ($keyword) {
			$this->like('titre', $keyword); // Recherche dans le champ title
		}
		return $this->orderBy($sortField, $sortOrder)->paginate($perPage, 'Tache');
	}
}
