// Récupère l'url
var url = window.location.href;

if (url.includes("/login")) {
	var divLogin = document.getElementById("login");
	var divRegister = document.getElementById("register");

	divLogin.style.display = "block";
	divRegister.style.display = "none";
} else {
	var divLogin = document.getElementById("login");
	var divRegister = document.getElementById("register");

	divLogin.style.display = "none";
	divRegister.style.display = "block";
}