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
		<div class="form-wrapper">
			<div id="login">
				<div id="error-modal" class="modal">
					<div class="modal-content">
						<span class="close-btn">&times;</span>
						<p>
							<?php 
								if(session()->getFlashdata('error')) {
									echo session()->getFlashdata('error');
								}
							?>
						</p>
					</div>
				</div>
				
				<h1>Se Connecter</h1>
				<?= form_open('login') ?>
					<?= form_label('Email ou nom d\'utilisateur', 'identifiant') ?>
					<?= form_input('identifiant', '', ['placeholder' => 'Email ou nom d\'utilisateur']) ?>
					<br>
					<?= form_label('Mot de passe', 'password') ?>
					<?= form_password('password', '', ['placeholder' => 'Mot de passe']) ?>
					<br>
					<?= form_submit('submit', 'Se connecter') ?>
				<?= form_close() ?>
				<div class="center-container">
					<button id="show-register">S'inscrire</button>
				</div>
			</div>

			<div id="register">
				<div id="error-modal" class="modal">
					<div class="modal-content">
						<span class="close-btn">&times;</span>
						<p>
							<?php 
								if(session()->getFlashdata('error')) {
									echo session()->getFlashdata('error');
								}
							?>
						</p>
					</div>
				</div>

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
					<button id="show-login">Se connecter</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="/assets/js/fctConnexion.js"></script>
</html>