const formWrapper = document.querySelector('.form-wrapper');
const showRegisterButton = document.getElementById('show-register');
const showLoginButton = document.getElementById('show-login');

if (window.location.href.includes("/register")) {
	formWrapper.style.transform = 'translateY(-50%)'; // Descend vers le formulaire d'inscription
}

showRegisterButton.addEventListener('click', () => {
    window.location.href = window.location.href.replace("/login", "/register");
});

showLoginButton.addEventListener('click', () => {
    formWrapper.style.transform = 'translateY(0)'; // Remonte vers le formulaire de connexion

    setTimeout(() => {
		window.location.href = window.location.href.replace("/register", "/login");
	}, 700); // Délai en millisecondes (100 ms)
});

document.addEventListener("DOMContentLoaded", () => {
	const modal = document.getElementById("error-modal");
	const closeBtn = document.querySelector(".close-btn");

	// Si un message d'erreur existe, affiche le modal
	if (modal.querySelector("p").innerText.trim() !== "") {
		modal.style.display = "flex";
	}

	// Ferme le modal au clic sur le bouton de fermeture
	closeBtn.addEventListener("click", () => {
		modal.style.display = "none";
	});

	// Ferme le modal en cliquant à l'extérieur du contenu
	modal.addEventListener("click", (e) => {
		if (e.target === modal) {
			modal.style.display = "none";
		}
	});
});
