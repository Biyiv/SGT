<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
		<div id="login">
			<?php 
				if(session()->getFlashdata('error')) {
					echo session()->getFlashdata('error');
				}
			?>
			<?= form_open('login') ?>
				<?= form_label('Email ou nom d\'utilisateur', 'identifiant') ?>
				<?= form_input('identifiant', '', ['placeholder' => 'Email ou nom d\'utilisateur']) ?>
				<br>
				<?= form_label('Mot de passe', 'password') ?>
				<?= form_password('password', '', ['placeholder' => 'Mot de passe']) ?>
				<br>
				<?= form_submit('submit', 'Se connecter') ?>
			<?= form_close() ?>
			<a href="/register">S'inscrire</a>
		</div>


		<div id="register">

			<?php 
				if(session()->getFlashdata('error')) {
					echo session()->getFlashdata('error');
				}
			?>

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
			<a href="/login">Se connecter</a>
		</div>
	</div>
</body>
<script src="/assets/js/fctConnexion.js"></script>
</html>