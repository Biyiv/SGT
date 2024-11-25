<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Menu</title>
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


<div id="creationTache">
	<?= form_open('/creationTache'); ?>
	
	<?= form_label('Titre :', 'titre'); ?>
	<?= form_input('titre', '', ['id' => 'titre']); ?>
	<br>
	<?= form_label('Description :', 'description'); ?>
	<?= form_textarea('description', '', ['id' => 'description']); ?>
	<br>
	<?= form_label('Début :', 'debut'); ?>
	<?= form_input(['type' => 'date', 'name' => 'debut', 'id' => 'debut']); ?>
	<br>
	<?= form_label('Echéance :', 'echeance'); ?>
	<?= form_input(['type' => 'date', 'name' => 'echeance', 'id' => 'echeance']); ?>
	<br>
	<?= form_label('Priorité :', 'priorite'); ?>
	<?= form_dropdown('priorite', ['1' => 'Faible', '2' => 'Moyenne', '3' => 'Importante'], '1', ['id' => 'priorite']); ?>
	<br>
	<?= form_submit('submit', 'Créer la tâche'); ?>
	<?= form_close(); ?>

</div>

<div id="modificationProfil">
	<?= 
	$utilisateur = session()->get('utilisateur');?>

	<?= form_open('/modificationProfil'); ?>
	<?= form_label('Nom :', 'nom'); ?>
	<?= form_input('nom', $utilisateur['nom'], ['id' => 'nom']); ?>
	<br>
	<?= form_label('Prénom :', 'prenom'); ?>
	<?= form_input('prenom', $utilisateur['prenom'], ['id' => 'prenom']); ?>
	<br>
	<?= form_label('Email :', 'email'); ?>
	<?= form_input('email', $utilisateur['email'], ['id' => 'email']); ?>
	<br>
	<?= form_label('Mot de passe :', 'motdepasse'); ?>
	<?= form_input('motdepasse', '', ['id' => 'motdepasse']); ?>
	<br>
	<?= form_submit('submit', 'Modifier le profil'); ?>
	<?= form_close(); ?>

</div>

</body>

</html>