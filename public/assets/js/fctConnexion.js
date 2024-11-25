const formWrapper = document.querySelector('.form-wrapper');
const showRegisterButtons = document.querySelectorAll('.show-register');
const showLoginButtons = document.querySelectorAll('.show-login');
const showForgotpwdButtons = document.querySelectorAll('.show-forgotpwd');

// Position initiale en fonction de l'URL
if (window.location.href.includes("/register")) {
    formWrapper.style.transform = 'translateY(-37%)'; // Descend vers le formulaire d'inscription
} else if (window.location.href.includes("/forgotpwd")) {
    formWrapper.style.transform = 'translateY(-70%)'; // Descend vers le formulaire "mot de passe oublié"
}

// Gestion des boutons pour afficher le formulaire d'inscription
showRegisterButtons.forEach(button => {
    button.addEventListener('click', () => {
        window.location.href = window.location.href.replace("/login", "/register");
    });
});

// Gestion des boutons pour afficher le formulaire de connexion
showLoginButtons.forEach(button => {
    button.addEventListener('click', () => {
        formWrapper.style.transform = 'translateY(0)'; // Retourne au formulaire de connexion
        setTimeout(() => {
            window.location.href = window.location.href.replace("/register", "/login").replace("/forgotpwd", "/login");
        }, 700); // Délai pour assurer la transition
    });
});

// Gestion des boutons pour afficher le formulaire "mot de passe oublié"
showForgotpwdButtons.forEach(button => {
    button.addEventListener('click', () => {
        window.location.href = window.location.href.replace("/login", "/forgotpwd");
    });
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
