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
}