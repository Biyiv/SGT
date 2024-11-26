<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Menu</title>
	<link rel="stylesheet" href="/assets/css/stlMenu.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div id="error-modal" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				<h2>
					<?= session()->getFlashdata('error') 
						? 'Erreur' 
						: (session()->getFlashdata('success') ? 'Succès' : 'Information') ?>
				</h2>
				<button class="close-btn">&times;</button>
			</div>
			<p>
				<?= session()->getFlashdata('error') 
					? session()->getFlashdata('error') 
					: session()->getFlashdata('success') ?>
			</p>
		</div>
	</div>

	<nav class="navbar">
		<div class="left-section">
			<div>
				<?= form_open('/setTriPreference', ['method' => 'post']); ?>
					<!-- CSRF Protection -->
					<?= csrf_field() ?>
					<?php $prioriteLst = ['1' => 'Faible', '2' => 'Moyenne', '3' => 'Importante'] ?>
					<!-- Liste déroulante pour le tri -->
					<?= form_label('Trier par :', 'tri'); ?>
					<?= form_dropdown(
						'tri',
						[
							'echeance' => 'Échéance',
							'priorite' => 'Priorité',
							'retard' => 'Retard'
						],
						$tri,
						['id' => 'tri', 'onchange' => 'this.form.submit()']
					); ?>
				<?= form_close(); ?>
			</div>
			<div>
				<hr>
			</div>
			<div>
				<!-- Modal Trigger Button -->
				<button id="openModalBtn">Créer une Tâche</button>
			</div>
		</div>
		<div class="right-section">
			<div>
				<h1><?= esc(session()->get('utilisateur')['username']) ?></h1>
			</div>
			<div>
				<img src="/assets/images/poisson.png" alt="Image de profil">
			</div>
		</div>
	</nav>

	<div class="conteneur-taches">
		<?php if (!empty($taches) && is_array($taches)): ?>
			<?php foreach ($taches as $tache): ?>
				<div class="tache" id="<?= esc($tache['id']) ?>">
					<h2><?= esc($tache['titre']) ?></h2>
					<p><?= esc($tache['description']) ?></p>
					<p>Créé par : <?= esc($tache['creepar']) ?></p>
					<p>Début : <?= esc($tache['debut']) ?></p>
					<p>Échéance : <?= esc($tache['echeance']) ?></p>
					<p>
						Priorité : 
						<b class="<?= esc($prioriteLst[$tache['priorite']]) ?>">
							<?= esc($prioriteLst[$tache['priorite']]) ?>
						</b>
					</p>
					<?php $statut = explode(' ', $tache['statut']) ?>
					<p>
						Statut : 
						<b class="<?= esc(end($statut)) ?>">
							<?= esc($tache['statut']) ?>
						</b>
					</p>
					<?php if ($tache['statut'] == "en retard"): ?>
						<img class="panneauDanger" src="/assets/images/Danger.png" alt="Panneau de danger">
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p>Aucune tâche trouvée.</p>
		<?php endif; ?>
	</div>

	<!-- Modal Trigger Button -->
	<button id="openModalBtnTache">Créer une Tâche</button>

	<!-- Modal -->
	<div id="creationTacheModal" class="modal">
		<div class="modal-content">
			<span class="close-btn" id="closeModalBtnTache">&times;</span>
			
			<!-- Formulaire de création de tâche -->
			<?= form_open('/ajouterTache'); ?>
			
				<?= form_label('Titre :', 'titre'); ?>
				<?= form_input('titre', '', ['id' => 'titre', 'required' => 'required']); ?>
				<br>
				
				<?= form_label('Description :', 'description'); ?>
				<?= form_textarea('description', '', ['id' => 'description', 'required' => 'required']); ?>
				<br>
				
				<?= form_label('Début :', 'debut'); ?>
				<?= form_input(['type' => 'datetime-local', 'name' => 'debut', 'id' => 'debut', 'value' => date('Y-m-d\TH:i')]); ?>
				<br>
				
				<?= form_label('Échéance :', 'echeance'); ?>
				<?= form_input(['type' => 'datetime-local', 'name' => 'echeance', 'id' => 'echeance', 'value' => date('Y-m-d\TH:i', strtotime('+1 day'))]); ?> 
				<br>
				
				<?= form_label('Priorité :', 'priorite'); ?>
				<?= form_dropdown('priorite', ['1' => 'Faible', '2' => 'Moyenne', '3' => 'Importante'], '1', ['id' => 'priorite']); ?>
				<br>
				
				<?= form_submit('submit', 'Créer la tâche'); ?>
			<?= form_close(); ?>
		</div>
	</div>

	<!-- Modal Trigger Button -->
	<button id="openModalBtnProfil">Profil</button>

	<!-- Modal -->
	<div id="creationProfilModal" class="modal">
		<div class="modal-content">
			<span class="close-btn" id="closeModalBtnProfil">&times;</span>
			
			<!-- Formulaire de création de tâche -->
			<?= form_open('/modifProfil'); ?>
				<?= form_label('Nom d\'utilisateur', 'username') ?>
				<?= form_input('username', session()->get('utilisateur')['username'], ['placeholder' => 'Nom d\'utilisateur', 'required' => 'required']) ?>
				<br>
				<?= form_label('Nom', 'nom') ?>
				<?= form_input('nom', session()->get('utilisateur')['nom'], ['placeholder' => 'Nom', 'required' => 'required']) ?>
				<br>
				<?= form_label('Prénom', 'prenom') ?>
				<?= form_input('prenom', session()->get('utilisateur')['prenom'], ['placeholder' => 'Prénom', 'required' => 'required']) ?>
				<br>
				<?= form_label('Email', 'email') ?>
				<?= form_input('email', session()->get('utilisateur')['mail'], ['placeholder' => 'Email', 'required' => 'required']) ?>
				<br>
				<?= form_label('Mot de passe actuel', 'mdp_actuel') ?>
				<?= form_password('mdp_actuel', '', ['placeholder' => 'Mot de passe actuel']) ?>
				<br>
				<?= form_label('Nouveau mot de passe', 'nouveau_mdp') ?>
				<?= form_password('nouveau_mdp', '', ['placeholder' => 'Nouveau mot de passe']) ?>
				<br>
				<?= form_label('Confirmer le nouveau mot de passe', 'mdp_confirm') ?>
				<?= form_password('mdp_confirm', '', ['placeholder' => 'Confirmer le nouveau mot de passe']) ?>
				<br>
				<?= form_submit('submit', 'Sauvegarder') ?>
			<?= form_close(); ?>
		</div>
	</div>


	<div id="bandeau-droit">
		<button id="fermer-bandeau">Fermer</button>
		<h2 id="bandeau-titre"></h2>
		<p id="bandeau-description"></p>
		<p><strong>Créé par :</strong> <span id="bandeau-creepar"></span></p>
		<p><strong>Début :</strong> <span id="bandeau-debut"></span></p>
		<p><strong>Échéance :</strong> <span id="bandeau-echeance"></span></p>
		<p><strong>Priorité :</strong>
			<span id="bandeau-priorite">
				<select name="select-priorite" id="select-priorite">
					<option value="faible">Faible</option>
					<option value="moyenne">Moyenne</option>
					<option value="importante">Importante</option>
				</select>
			</span>
		</p>
		<p><strong>Statut :</strong>
			<span id="bandeau-statut">
				<select name="select-statut" id="select-statut">
					<option value="en attente">En attente</option>
					<option value="en cours">En cours</option>
					<option value="terminee">Terminée</option>
				</select>
			</span>
		</p>

		<div class="commentaire">

		</div>
	</div>



	<!-- Script JS pour ouvrir et fermer le modal -->
	<script src="/assets/js/fctMenu.js"></script>
</body>

</html>