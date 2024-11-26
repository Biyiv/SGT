<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>

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
			<div id="login">				
				<h1>Se Connecter</h1>
				<?= form_open('login') ?>
					<?= form_label('Identifiant', 'identifiant') ?>
					<?= form_input('identifiant', '', ['placeholder' => 'Email ou nom d\'utilisateur']) ?>
					<br>
					<?= form_label('Mot de passe', 'password') ?>
					<?= form_password('password', '', ['placeholder' => 'Mot de passe']) ?>
					<br>
					<?= form_checkbox('remember', '1', false, ['id' => 'remember']) ?>
					<?= form_label('Se souvenir de moi', 'remember') ?>
					<br>
					<?= form_submit('submit', 'Se connecter') ?>
				<?= form_close() ?>
				<div class="center-container">
					<button class="show-register">S'inscrire</button>
					<button class="show-forgotpwd">Mot de passe oublié</button>
				</div>
			</div>

			<div id="register">
				<h1>S'inscrire</h1>
				<?= form_open('register') ?>
					<?= form_label('Nom d\'utilisateur', 'username') ?>
					<?= form_input('username', '', ['placeholder' => 'Nom d\'utilisateur']) ?>
					<br>
					<?= form_label('Nom', 'nom') ?>
					<?= form_input('nom', '', ['placeholder' => 'Nom']) ?>
					<br>
					<?= form_label('Prénom', 'prenom') ?>
					<?= form_input('prenom', '', ['placeholder' => 'Prénom']) ?>
					<br>
					<?= form_label('Email', 'email') ?>
					<?= form_input('email', '', ['placeholder' => 'Email']) ?>
					<br>
					<?= form_label('Mot de passe', 'mdp') ?>
					<?= form_password('mdp', '', ['placeholder' => 'Mot de passe']) ?>
					<br>
					<?= form_label('Confirmer le mot de passe', 'mdp_confirm') ?>
					<?= form_password('mdp_confirm', '', ['placeholder' => 'Confirmer le mot de passe']) ?>
					<br>
					<?= form_submit('submit', 'S\'inscrire') ?>
				<?= form_close() ?>
				<div class="center-container">
					<button class="show-login">Se connecter</button>
				</div>
			</div>

			<div id="forgotpwd">
				<h1>Réinitialisation du mot de passe</h1>
				<?= form_open('forgotpwd') ?>
					<?= form_label('Email', 'mail') ?>
					<?= form_input('mail', '', ['placeholder' => 'Email']) ?>
					<br>
					<?= form_submit('submit', 'Envoyer un lien de réinitialisation') ?>
				<?= form_close() ?>
				<div class="center-container">
					<button class="show-login">Se connecter</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="/assets/js/fctConnexion.js"></script>
</html>