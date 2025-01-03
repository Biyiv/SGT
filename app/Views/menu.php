<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Menu</title>
	<link rel="icon" type="image/png" href="/assets/images/favico.png" />
	<link rel="stylesheet" href="/assets/css/stlMenu.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php if (session()->getFlashdata('show_modal')): ?>
	<script>
		// Afficher le modal correspondant au flashdata
		window.addEventListener("DOMContentLoaded", function() {
			let modalName = "<?= session()->getFlashdata('show_modal'); ?>";
			let modal = document.getElementById(modalName); // Récupérer le modal en utilisant le nom
			if (modal) {
				modal.style.display = "flex"; // Afficher le modal
			}
		});
	</script>
<?php endif; ?>

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
		<button class="navbar-toggle" aria-expanded="false" onclick="toggleNavbar(this)">☰</button>
		<div class="navbar-content">
			<div class="left-section">
				<div>
					<!-- Modal Trigger Button -->
					<button id="openModalBtnFiltres"><h5>Filtres</h5></button>
				</div>
				<div>
					<hr>
				</div>
				<div>
					<?= form_open('/setTriPreference', ['method' => 'post']); ?>
						<!-- CSRF Protection -->
						<?= csrf_field() ?>
						<?php $prioriteLst = ['1' => 'Faible', '2' => 'Moyenne', '3' => 'Importante'] ?>
						<!-- Liste déroulante pour le tri -->
						<?= form_label('<h5>Trier par :</h5>', 'tri'); ?>
						<?= form_dropdown(
							'tri',
							[
								'echeance' => 'Échéance',
								'priorite' => 'Priorité',
								'creepar' => 'Créateur',
								'titre' => 'Alphabétique'
							],
							$tri = isset($_COOKIE['tri']) ? $_COOKIE['tri'] : "echeance",
							['id' => 'tri', 'onchange' => 'this.form.submit()']
						); ?>
					<?= form_close(); ?>
				</div>
				<div>
					<hr>
				</div>
				<div>
					<?= form_open('/recherche', ['method' => 'post']); ?>
						<!-- CSRF Protection -->
						<?= csrf_field() ?>
						<!-- Liste déroulante pour le tri -->
						<?= form_label('<h5>Rechercher :</h5>', 'recherche'); ?>
						<?= form_input('recherche',isset($_SESSION['recherche']) ? $_SESSION['recherche'] : '',['id' => 'recherche', 'onchange' => 'this.form.submit()']); ?>
					<?= form_close(); ?>
				</div>
				<div>
					<hr>
				</div>
				<div>
					<!-- Modal Trigger Button -->
					<button id="openModalBtnTache"><h5>Créer une Tâche</h5></button>
				</div>
				<div>
					<hr>
				</div>
			</div>
			<div class="right-section">
				<div>
					<button id="openModalBtnProfil"><h1><?= strlen(session()->get('utilisateur')['username']) > 9 ? substr(session()->get('utilisateur')['username'], 0, 9) . ' ...' : session()->get('utilisateur')['username']; ?></h1></button>
				</div>
				<div>
					<a href="/logout"><img id="logout" src="/assets/images/logout.png" alt="Image de profil"></a>
				</div>
			</div>
		</div>
	</nav>

	<div class="conteneur-taches">
		<?php if (!empty($taches) && is_array($taches)): ?>
			<?php foreach ($taches as $tache): ?>
				<div class="tache" id="<?= esc($tache['id']) ?>">
					<h2 class="truncate-title"><?= $tache['titre']; ?></h2>
					<p class="truncate-description"><?= $tache['description']; ?></p>
					<p><strong>Créé par : </strong><?= esc($tache['creepar']) ?></p>
					<?php 
						$debut =  new DateTime($tache['debut']);
						$echeance =  new DateTime($tache['echeance']);
					?>
					<p><strong>Début : </strong><?= esc($debut->format('d/m/Y - H:i')) ?></p>
					<p><strong>Échéance : </strong><?= esc($echeance->format('d/m/Y - H:i')) ?></p>
					<p class="tache-id" id=""><?= esc($tache['id']) ?></p>
					<div class="task-info">
						<div>
							<p>
								<strong>Priorité : </strong>
								<b class="<?= esc($prioriteLst[$tache['priorite']]) ?>">
									<?= esc($prioriteLst[$tache['priorite']]) ?>
								</b>
							</p>
							<?php $statut = explode(' ', $tache['statut']) ?>
							<p>
								<strong>Statut : </strong>
								<b class="<?= esc(end($statut)) ?>">
									<?= esc($tache['statut']) ?>
								</b>
							</p>
						</div>
						<?php if ($tache['statut'] == "en retard"): ?>
							<img class="panneauDanger" src="/assets/images/Danger.png" alt="Panneau de danger">
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p>Aucune tâche trouvée.</p>
		<?php endif; ?>
	</div>
	<!-- Affichage des liens de pagination -->
	<div id="paginationTache">
		<?= $pagerTaches->links('Tache', 'custom') ?>
	</div>

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
				<?= form_input(['type' => 'datetime-local', 'name' => 'debut', 'id' => 'debut', 'value' => date('Y-m-d\TH:i', strtotime('+1 hour'))]); ?>
				<br>
				
				<?= form_label('Échéance :', 'echeance'); ?>
				<?= form_input(['type' => 'datetime-local', 'name' => 'echeance', 'id' => 'echeance', 'value' => date('Y-m-d\TH:i' , strtotime('+25 hours'))]); ?> 
				<br>
				
				<?= form_label('Priorité :', 'priorite'); ?>
				<?= form_dropdown('priorite', ['1' => 'Faible', '2' => 'Moyenne', '3' => 'Importante'], '1', ['id' => 'priorite']); ?>
				<br>
				
				<?= form_submit('submit', 'Créer la tâche'); ?>
			<?= form_close(); ?>
		</div>
	</div>

	<!-- Modal -->
	<div id="creationProfilModal" class="modal">
		<div class="modal-content">
			<span class="close-btn" id="closeModalBtnProfil">&times;</span>
			
			<!-- Formulaire de modification de profil -->
			<?= form_open("/modifProfil/" . session()->get('utilisateur')['username']); ?>
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

	<!-- Modal -->
	<div id="creationFiltresModal" class="modal">
		<div class="modal-content">
			<span class="close-btn" id="closeModalBtnFiltres">&times;</span>
			
			<!-- Formulaire de modification de profil -->
			<?= form_open("/modifFiltres"); ?>
				<?= form_label('Nombre de taches par page', 'nbTache') ?>
				<?= form_input('nbTache', isset($_COOKIE['nbTache']) ? $_COOKIE['nbTache'] : 8, [ 'min' => 1, 'placeholder' => 'Nombre de taches par page', 'required' => 'required'], 'number') ?>
				<br>
				<?= form_label('Afficher uniquement mes tâches', 'toutVoir') ?>
				<?= form_checkbox('toutVoir', '1', isset($_COOKIE['toutVoir']) ? $_COOKIE['toutVoir'] : 1) ?>
				<br>
				<?= form_label('Affichage selon la priorité', 'filtrePriorite'); ?>
				<?= form_dropdown(
					'filtrePriorite',
					[-1 => 'Tout', 1 => 'Faible', 2 => 'Moyenne', 3 => 'Importante'],
					isset($_COOKIE['filtrePriorite']) ? $_COOKIE['filtrePriorite'] : -1,
					['id' => 'filtrePriorite']
				); ?>
				<br>
				<?= form_label('Affichage selon le statut', 'filtreStatut'); ?>
				<?= form_dropdown(
					'filtreStatut',
					['tout' => 'Tout','en attente' => 'En attente', 'en cours' => 'En cours', 'en retard' => 'En retard', 'termine' => 'Terminé'],
					isset($_COOKIE['filtreStatut']) ? $_COOKIE['filtreStatut'] : "tout",
					['id' => 'filtreStatut']
				); ?>
				<br>
				<?= form_submit('submit', 'Appliquer') ?>
			<?= form_close(); ?>
		</div>
	</div>


	<div id="bandeau-droit">
		<button id="fermer-bandeau">&times;</button>
		<span id="username"><?= session()->get('utilisateur')['username'] ?></span>
		<img src="/assets/images/crayon.png" alt="modification" id="crayon">
		<div id="donnees">
			<h2 id="bandeau-titre"></h2><br>
			<p id="bandeau-description"></p>
			<p><strong>Créé par :</strong> <span id="bandeau-creepar"></span></p>
			<p><strong>Début :</strong> <span id="bandeau-debut"></span></p>
			<p><strong>Échéance :</strong> <span id="bandeau-echeance"></span></p>
			<p><span id="bandeau-id"></span></p>
		</div>

		<p><strong>Priorité :</strong>
			<span id="bandeau-priorite">
				<select name="select-priorite" id="select-priorite" disabled>
					<option value="faible">Faible</option>
					<option value="moyenne">Moyenne</option>
					<option value="importante">Importante</option>
				</select>
			</span>
		</p>
		<p><strong>Statut :</strong>
			<span id="bandeau-statut">
				<select name="select-statut" id="select-statut" disabled>
					<option value="en attente">En attente</option>
					<option value="en cours">En cours</option>
					<option value="en retard">En retard</option>
					<option value="termine">Terminée</option>
				</select>
			</span>
		</p>

		<div class="commentaires">
			
		</div>
		
		
		<div class="conteneur-btn">
			<button id="supprimer-commentaire" class="btn btn-primary btn-sm">Supprimer le commentaire</button>
			<div class="modal" id="commentaire-modal">
				<div class="modal-content commentaire-form">
					<textarea name="commentaire" id="commentaire" cols="43" rows="3"></textarea><br>
					<div class="button-container">
						<button id="closeModalBtnCommentaire" class="btn btn-primary btn-sm w-auto">Annuler</button>
						<button id="valider-commentaire" class="btn btn-primary btn-sm w-auto">Valider</button>
					</div>
				</div>
			</div>
			<button id="ajouter-commentaire" class="btn btn-primary btn-sm">Ajouter un commentaire</button>
		</div>

		<div class="conteneur-btn"></div>
	</div>



	<!-- Script JS pour ouvrir et fermer le modal -->
	<script src="/assets/js/fctMenu.js"></script>
	<script src="/assets/js/fctBandeau.js"></script>
</body>

</html>