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


	// Sélectionner les tâches et le bandeau
	const taches = document.querySelectorAll('.tache');
	const bandeau = document.getElementById('bandeau-droit');
	const fermerBandeauBtn = document.getElementById('fermer-bandeau');

	// Champs du bandeau
	const bandeauTitre = document.getElementById('bandeau-titre');
	const bandeauDescription = document.getElementById('bandeau-description');
	const bandeauCreepar = document.getElementById('bandeau-creepar');
	const bandeauDebut = document.getElementById('bandeau-debut');
	const bandeauEcheance = document.getElementById('bandeau-echeance');

	// Listes déroulantes
	const prioriteSelect = document.getElementById('select-priorite');
	const statutSelect = document.getElementById('select-statut');

	// Fonction pour ouvrir le bandeau avec les détails d'une tâche
	function afficherDetailsTache(tache) {
		const titre = tache.querySelector('h2').textContent;
		const description = tache.querySelector('p:nth-child(2)').textContent;
		const creepar = tache.querySelector('p:nth-child(3)').textContent.split(': ')[1];
		const debut = tache.querySelector('p:nth-child(4)').textContent.split(': ')[1];
		const echeance = tache.querySelector('p:nth-child(5)').textContent.split(': ')[1];
		const priorite = tache.querySelector('p:nth-child(6) b').textContent.toLowerCase();
		const statut = tache.querySelector('p:nth-child(7) b').textContent.toLowerCase();

		// Remplir les champs statiques
		bandeauTitre.textContent = titre;
		bandeauDescription.textContent = description;
		bandeauCreepar.textContent = creepar;
		bandeauDebut.textContent = debut;
		bandeauEcheance.textContent = echeance;

		
		
		//Pour chaque value de la liste déroulante priorité, on vérifie si la priorité de la tâche est égale à la value
		//Si c'est le cas, on sélectionne l'option
		for (let i = 0; i < prioriteSelect.options.length; i++) {
			if (prioriteSelect.options[i].value.trim() == priorite.trim()) {
				console.log(prioriteSelect.options[i].value);
				prioriteSelect.options[i].selected = true;
			}
		}

		//Pour chaque value de la liste déroulante statut, on vérifie si le statut de la tâche est égale à la value
		//Si c'est le cas, on sélectionne l'option
		for (let i = 0; i < statutSelect.options.length; i++) {
			console.log(statutSelect.options[i].value);
			if (statutSelect.options[i].value.trim() == statut.trim()) {
				statutSelect.options[i].selected = true;
			}
		}

		// Afficher le bandeau
		bandeau.style.display = 'block';
	}

	// Ajouter des événements aux tâches
	taches.forEach((tache) => {
		tache.addEventListener('click', () => afficherDetailsTache(tache));
		tache.addEventListener('click', () => {
			afficherBandeau();
		});
	});

	// Fermer le bandeau
	fermerBandeauBtn.addEventListener('click', () => {
		bandeau.style.display = 'none';
		document.body.classList.remove('bandeau-visible');
	});


	// Ouvrir le bandeau
	function afficherBandeau() {
		document.body.classList.add('bandeau-visible');
	}
});