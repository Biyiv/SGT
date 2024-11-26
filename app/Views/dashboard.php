<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<p>dashboard</p>
	
	<!-- Affiche les données stockées en session -->
	<?= session()->get('utilisateur')['nom'] ?>


	<a href="/logout">Se déconnecter</a>
</body>
</html>