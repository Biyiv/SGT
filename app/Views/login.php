<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id="login">
		<?= form_open('login') ?>
			<?= form_label('Email ou nom d\'utilisateur', 'identifiant') ?>
			<?= form_input('email', '', ['placeholder' => 'Email ou nom d\'utilisateur']) ?>
			<br>
			<?= form_label('Mot de passe', 'password') ?>
			<?= form_password('password', '', ['placeholder' => 'Mot de passe']) ?>
			<br>
			<?= form_submit('submit', 'Se connecter') ?>
		<?= form_close() ?>
	</div>


	<div id="register">
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
			<?= form_submit('submit', 'S\'inscrire') ?>
		<?= form_close() ?>
	</div>
</body>
<script src="/assets/js/fctConnexion.js"></script>
</html>