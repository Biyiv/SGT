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

	public function getPaginatedTaches(int $perPage = 8, string $sortField = 'echeance', string $sortOrder = 'asc', string $toutVoir, int $priorite, string $statut , ?string $keyword = null): array
	{
		// Appliquer la recherche par mot-clé si fourni
		if ($keyword) {
			$this->like('titre', $keyword); // Recherche dans le champ title
		}

		if($toutVoir) {
			if($priorite != -1 && $statut != "tout") {
				return $this->where('priorite', $priorite)->where('statut', $statut)->orderBy($sortField, $sortOrder)->paginate($perPage, 'Tache');
			} else if ($priorite != -1 && $statut == "tout") {
				return $this->where('priorite', $priorite)->orderBy($sortField, $sortOrder)->paginate($perPage, 'Tache');
			} else if ($priorite == -1 && $statut != "tout") {
				return $this->where('statut', $statut)->orderBy($sortField, $sortOrder)->paginate($perPage, 'Tache');
			} else {
				return $this->orderBy($sortField, $sortOrder)->paginate($perPage, 'Tache');
			}
		} else {
			if($priorite != -1 && $statut != "tout") {
				return $this->where('creepar', session()->get('utilisateur')['username'])->where('priorite', $priorite)->where('statut', $statut)->orderBy($sortField, $sortOrder)->paginate($perPage, 'Tache');
			} else if ($priorite != -1 && $statut == "tout") {
				return $this->where('creepar', session()->get('utilisateur')['username'])->where('priorite', $priorite)->orderBy($sortField, $sortOrder)->paginate($perPage, 'Tache');
			} else if ($priorite == -1 && $statut != "tout") {
				return $this->where('creepar', session()->get('utilisateur')['username'])->where('statut', $statut)->orderBy($sortField, $sortOrder)->paginate($perPage, 'Tache');
			} else {
				return $this->where('creepar', session()->get('utilisateur')['username'])->orderBy($sortField, $sortOrder)->paginate($perPage, 'Tache');
			}
		}

		//return $this->orderBy($sortField, $sortOrder)->paginate($perPage, 'Tache');
	}
}
