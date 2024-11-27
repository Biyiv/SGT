<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Réinitialisation de mot de passe</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/stlConnection.css">
</head>
<body>
	<div id="app">
		<div id="error-modal" class="modal">
			<div class="modal-content">
				<span class="close-btn">&times;</span>
				<p>
					<?php 
						if(session()->getFlashdata('error')) {
							echo session()->getFlashdata('error');
						}
						if(session()->getFlashdata('success')) {
							echo session()->getFlashdata('success');
						}
					?>
				</p>
			</div>
		</div>
		<div class="form-wrapper">
			<div id="resetpwd">
				<h1>Réinitialisation du mot de passe</h1>
				<?= form_open('/resetpwd/' .$token) ?>
					<?= form_label('Mot de passe', 'mdp') ?>
					<?= form_password('mdp', '', ['placeholder' => 'Mot de passe']) ?>
					<br>
					<?= form_label('Confirmer le mot de passe', 'mdp_confirm') ?>
					<?= form_password('mdp_confirm', '', ['placeholder' => 'Confirmer le mot de passe']) ?>
					<br>
					<?= form_submit('submit', 'Modifier le mot de passe') ?>
				<?= form_close() ?>
				<div class="center-container">
					<button id="show-login">Se Connecter</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>