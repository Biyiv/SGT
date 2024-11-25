<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<div>
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
</body>
</html>