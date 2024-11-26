<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Menu</title>

	<link rel="stylesheet" href="/assets/css/stlMenu.css">
</head>
<h1>Liste des taches</h1>

<?= form_open('/setTriPreference', ['method' => 'post']); ?>
<!-- CSRF Protection -->
<?= csrf_field() ?>

<!-- Liste déroulante pour le tri -->
<?= form_label('Trier par :', 'tri'); ?>
<?= form_dropdown(
	'tri',
	[
		'echeance' => 'Échéance',
		'priorite' => 'Priorité',
	],
	$tri,
	['id' => 'tri', 'onchange' => 'this.form.submit()']
); ?>
<?= form_close(); ?>

<?php if (!empty($taches) && is_array($taches)): ?>
	<?php foreach ($taches as $tache): ?>
		<div>
			<h2><?= esc($tache['titre']) ?></h2>
			<p><?= esc($tache['description']) ?></p>
			<p>Créé par : <?= esc($tache['creepar']) ?></p>
			<p>Début : <?= esc($tache['debut']) ?></p>
			<p>Echéance : <?= esc($tache['echeance']) ?></p>
			<p>Priorité : <?= esc($tache['priorite']) ?></p>
			<p>Statut : <?= esc($tache['statut']) ?></p>

		</div>
	<?php endforeach; ?>
<?php else: ?>
	<p>Aucune tache trouvé.</p>
<?php endif; ?>

<!-- Modal Trigger Button (optionnel, si tu veux un bouton pour ouvrir le modal) -->
<button id="openModalBtn">Créer une Tâche</button>

<!-- Modal -->
<div id="creationTacheModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        
        <!-- Formulaire de création de tâche -->
        <?= form_open('/ajouterTache'); ?>
        
        <?= form_label('Titre :', 'titre'); ?>
        <?= form_input('titre', '', ['id' => 'titre', 'required' => 'required']); ?>
        <br>
        
        <?= form_label('Description :', 'description'); ?>
        <?= form_textarea('description', '', ['id' => 'description', 'required' => 'required']); ?>
        <br>
        
        <?= form_label('Début :', 'debut'); ?>
        <?= form_input(['type' => 'date', 'name' => 'debut', 'id' => 'debut', 'required' => 'required']); ?>
        <br>
        
        <?= form_label('Echéance :', 'echeance'); ?>
        <?= form_input(['type' => 'date', 'name' => 'echeance', 'id' => 'echeance', 'required' => 'required']); ?>
        <br>
        
        <?= form_label('Priorité :', 'priorite'); ?>
        <?= form_dropdown('priorite', ['1' => 'Faible', '2' => 'Moyenne', '3' => 'Importante'], '1', ['id' => 'priorite']); ?>
        <br>
        
        <?= form_submit('submit', 'Créer la tâche'); ?>
        <?= form_close(); ?>
    </div>
</div>

<!-- Script JS pour ouvrir et fermer le modal -->
<script src="/assets/js/fctMenu.js"></script>

</body>

</html>