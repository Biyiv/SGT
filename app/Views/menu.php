<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Menu</title>
</head>
	<h1>Liste des taches</h1>
	
	<?php if (!empty($taches) && is_array($taches)): ?>
	<?php foreach ($taches as $tache) : ?>
	<div>
		<h2><?= esc($tache['titre']) ?></h2>
		<p><?= esc($tache['description']) ?></p>
		<p>Créé par : <?= esc($tache['creepar']) ?></p>
		<p><?= esc($tache['debut']) ?></p>
		<p><?= esc($tache['echeance']) ?></p>
		<p>Priorité : <?= esc($tache['priorite']) ?></p>
		<p>Statut : <?= esc($tache['statut']) ?></p>
		
	</div>
	<?php endforeach; ?>
	<?php else : ?>
	<p>Aucune tache trouvé.</p>
	<?php endif; ?>

</body>
</html>