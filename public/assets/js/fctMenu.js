const modalTache = document.getElementById('creationTacheModal');
const openModalBtnTache = document.getElementById('openModalBtnTache');
const closeModalBtnTache = document.getElementById('closeModalBtnTache');

const modalProfil = document.getElementById('creationProfilModal');
const openModalBtnProfil = document.getElementById('openModalBtnProfil');
const closeModalBtnProfil = document.getElementById('closeModalBtnProfil');

// Ouvrir le modal
openModalBtnTache.addEventListener('click', () => {
	modalTache.style.display = 'flex';
});
// Ouvrir le modal
openModalBtnProfil.addEventListener('click', () => {
	modalProfil.style.display = 'flex';
});

// Fermer le modal
closeModalBtnTache.addEventListener('click', () => {
	modalTache.style.display = 'none';
});
// Fermer le modal
closeModalBtnProfil.addEventListener('click', () => {
	modalProfil.style.display = 'none';
});

// Fermer le modal si l'utilisateur clique en dehors du modal
window.addEventListener('click', (event) => {
	if (event.target === modalTache) {
		modalTache.style.display = 'none';
	}
	if (event.target === modalProfil) {
		modalProfil.style.display = 'none';
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