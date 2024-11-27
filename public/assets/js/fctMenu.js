const modal = document.getElementById('creationTacheModal');
const openModalBtn = document.getElementById('openModalBtn');
const closeModalBtn = document.getElementById('closeModalBtn');

// Ouvrir le modal
openModalBtn.addEventListener('click', () => {
	modal.style.display = 'flex';
});

// Fermer le modal
closeModalBtn.addEventListener('click', () => {
	modal.style.display = 'none';
});

// Fermer le modal si l'utilisateur clique en dehors du modal
window.addEventListener('click', (event) => {
	if (event.target === modal) {
		modal.style.display = 'none';
	}
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