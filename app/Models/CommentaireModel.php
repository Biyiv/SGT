<?php
namespace App\Models;
use CodeIgniter\Model;
class CommentaireModel extends Model
{
	protected $table = 'commentaire';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'commentaire',
		'tache',
		'datecreation',
		'creepar'
	];
	
	
	public function getCommentaireById($id)
	{
		return $this->where('id', $id)->first();
	}

	public function getCommentaireByTache($tacheId)
	{
		return $this->select('commentaire.*')
				->join('tache', 'tache.id = commentaire.tache')
				->where('commentaire.tache', $tacheId)
				->findAll();
	}

	public function getPaginatedCommentaires(int $perPage = 2, int $numTache = 1): array
	{
		return $this->paginate($perPage, 'Commentaire');
	}

	public function getCommentaires($id) {
		return $this->where('tache', $id)->findAll();
	}
}