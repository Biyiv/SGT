<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Connexion</title>
	<!-- Logo d'onglet -->
	<link rel="icon" type="image/png" href="/assets/images/favico.png" />

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/stlConnection.css">
</head>
<body>
	<div id="app">
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
		<div class="form-wrapper">
			<div id="login">				
				<h1>Se Connecter</h1>
				<?= form_open('login') ?>
					<?= form_label('Identifiant', 'identifiant') ?>
					<?= form_input('identifiant', isset($_COOKIE['identifiant']) ? $_COOKIE['identifiant'] : '', ['placeholder' => 'Email ou nom d\'utilisateur', 'required' => 'required']) ?>
					<br>
					<div class="password-wrapper">
						<?= form_label('Mot de passe', 'password') ?>
						<div class="password-container">
							<?= form_password('password', '', [
								'placeholder' => 'Mot de passe',
								'required' => 'required',
								'id' => 'password1'
							]) ?>
							<button type="button" id="toggle-password" class="toggle-password">
								👁️
							</button>
						</div>
					</div>
					<br>
					<div class="remember-wrapper">
						<?= form_label('Se souvenir de moi', 'remember') ?>
						<?= form_checkbox('remember', '1', isset($_COOKIE['identifiant']) && !empty($_COOKIE['identifiant']), ['id' => 'remember']) ?>
					</div>
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
					<?= form_input('username', '', ['placeholder' => 'Nom d\'utilisateur', 'required' => 'required']) ?>
					<br>
					<?= form_label('Nom', 'nom') ?>
					<?= form_input('nom', '', ['placeholder' => 'Nom', 'required' => 'required']) ?>
					<br>
					<?= form_label('Prénom', 'prenom') ?>
					<?= form_input('prenom', '', ['placeholder' => 'Prénom', 'required' => 'required']) ?>
					<br>
					<?= form_label('Email', 'email') ?>
					<?= form_input('email', '', ['placeholder' => 'Email', 'required' => 'required']) ?>
					<br>
					<div class="password-wrapper">
						<?= form_label('Mot de passe', 'mdp') ?>
						<div class="password-container">
							<?= form_password('mdp', '', [
								'placeholder' => 'Mot de passe',
								'required' => 'required',
								'id' => 'password1'
							]) ?>
							<button type="button" id="toggle-password" class="toggle-password">
								👁️
							</button>
						</div>
					</div>
					<br>
					<div class="password-wrapper">
						<?= form_label('Confirmer le mot de passe', 'mdp_confirm') ?>
						<div class="password-container">
							<?= form_password('mdp_confirm', '', [
								'placeholder' => 'Confirmer le mot de passe',
								'required' => 'required',
								'id' => 'password1'
							]) ?>
							<button type="button" id="toggle-password" class="toggle-password">
								👁️
							</button>
						</div>
					</div>
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
					<?= form_input('mail', '', ['placeholder' => 'Email', 'required' => 'required']) ?>
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