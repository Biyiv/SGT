<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\TacheModel;

class EmailNotificationController extends BaseController {

	protected $session;
	public function __construct() {
		helper('form');
		$this->session = session();
	}

	public function envoyerNotificationParMail()
	{
		$utilisateurModel = new UtilisateurModel();
		$tacheModel = new TacheModel();

		$utilisateurs = $utilisateurModel->findAll();

		foreach ($utilisateurs as $utilisateur) {
			$taches = $tacheModel->where('creepar', $utilisateur['username'])->findAll();
			$cpt = 0;
			$messageTaches = "";
			foreach ($taches as $tache) {
				if($tache['echeance'] < date('Y-m-d H:i:s')) {
					$priorite = $tache['priorite'];
					switch ($priorite) {
						case 1:
							$priorite = 'Faible';
							break;
						case 2:
							$priorite = 'Neutre';
							break;
						case 3:
							$priorite = 'Importante';
							break;
					}
					$messageTaches .= "\n\nTitre de la tache : ".$tache['titre']." \nDescription : ".$tache['description']." \nDate de début : ".$tache['debut']." \nDate d'échéance : ".$tache['echeance']." \nImportance : ".$priorite;
					$cpt++;
				}
				
			}
			if($cpt > 0) {
				$message = "Bonjour " . $utilisateur['username'] . ",\n\nVous avez " . $cpt . " taches en retard" . $messageTaches . " \n\nCordialement,\n\nL'équipe d'SGT BALM ";
				// Utilisez la classe Email de CodeIgniter pour envoyer l'e-mail
				$emailService = \Config\Services::email();
				//envoi du mail
				$emailService->setTo($utilisateur['mail']);
				$emailService->setFrom('sgt.balm.projetsynthese@gmail.com');
				$emailService->setSubject('Notification : Votre tache est en retard');
				$emailService->setMessage($message);
				$emailService->send();
			}
		}
	}
}