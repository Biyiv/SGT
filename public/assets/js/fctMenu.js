const modalTache = document.getElementById('creationTacheModal');
const openModalBtnTache = document.getElementById('openModalBtnTache');
const closeModalBtnTache = document.getElementById('closeModalBtnTache');

const modalProfil = document.getElementById('creationProfilModal');
const openModalBtnProfil = document.getElementById('openModalBtnProfil');
const closeModalBtnProfil = document.getElementById('closeModalBtnProfil');

const taches = document.querySelectorAll('.tache');
const bandeau = document.getElementById('bandeau-droit');

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


	const modalDmd = document.getElementById("dmd-modal");

	// Si un message d'erreur existe, affiche le modal
	if (modalDmd.querySelector("h2").innerText.trim() !== "") {
		modalDmd.style.display = "flex";
	}

	// Ferme le modal en cliquant à l'extérieur du contenu
	modalDmd.addEventListener("click", (e) => {
		if (e.target === modal) {
			modalDmd.style.display = "none";
		}
	});
});

function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? "rgb(" + [
        parseInt(result[1], 16),
        parseInt(result[2], 16),
        parseInt(result[3], 16)
    ].join(', ') + ")" : null;
}