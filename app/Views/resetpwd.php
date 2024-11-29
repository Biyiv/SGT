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
			<div id="resetpwd">
				<h1>Réinitialisation du mot de passe</h1>
				<?= form_open('/resetpwd/' .$token) ?>
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
					<?= form_submit('submit', 'Modifier le mot de passe') ?>
				<?= form_close() ?>
				<div class="center-container">
					<button id="show-login">Se Connecter</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="/assets/js/fctConnexion.js"></script>
</html>