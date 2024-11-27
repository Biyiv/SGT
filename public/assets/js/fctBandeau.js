document.addEventListener("DOMContentLoaded", () => {
	// Sélectionner les tâches et le bandeau
	const taches = document.querySelectorAll('.tache');
	const bandeau = document.getElementById('bandeau-droit');
	const divDonnees = document.getElementById('donnees');
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
		const priorite = tache.querySelector('.task-info p:nth-child(1) b').textContent.toLowerCase();
		const statut = tache.querySelector('.task-info p:nth-child(2) b').textContent.toLowerCase();

		// Remplir les champs statiques	
		bandeauTitre.textContent = titre;
		bandeauDescription.textContent = description;
		bandeauCreepar.textContent = creepar;
		bandeauDebut.textContent = debut;
		bandeauEcheance.textContent = echeance;

		console.log(priorite);
		
		//Pour chaque value de la liste déroulante priorité, on vérifie si la priorité de la tâche est égale à la value
		//Si c'est le cas, on sélectionne l'option
		for (let i = 0; i < prioriteSelect.options.length; i++) {
			if (prioriteSelect.options[i].value.trim() == priorite.trim()) {
				prioriteSelect.options[i].selected = true;
			}
		}

		//Pour chaque value de la liste déroulante statut, on vérifie si le statut de la tâche est égale à la value
		//Si c'est le cas, on sélectionne l'option
		for (let i = 0; i < statutSelect.options.length; i++) {
			if (statutSelect.options[i].value.trim() == statut.trim()) {
				statutSelect.options[i].selected = true;
			}
		}

		// Afficher le bandeau
		bandeau.style.display = 'block';
	}

	console.log(taches);

	// Ajouter des événements aux tâches
	taches.forEach((tache) => {
		id = tache.id;
		tache.addEventListener('click', () => afficherDetailsTache(tache));
		tache.addEventListener('click', () => {
			afficherBandeau();
		});
	});

	// Fermer le bandeau avec une transition
	fermerBandeauBtn.addEventListener('click', () => {
		document.body.classList.remove('bandeau-visible');

		// Optionnel : Assurez-vous que l'état du bandeau est réinitialisé après la transition
		setTimeout(() => {
			bandeau.style.visibility = 'hidden'; // Pour éviter de garder l'élément interactif.
		}, 500); // Correspond à la durée de la transition CSS.
	});

	// Ouvrir le bandeau avec une transition
	function afficherBandeau() {
		bandeau.style.visibility = 'visible'; // Pour éviter de garder l'élément interactif.
		document.body.classList.add('bandeau-visible');
	}

	document.getElementById('crayon').addEventListener('click', () => {
		// Transformer le titre en input
		const titreElement = document.getElementById('bandeau-titre');
		const titreInput = document.createElement('input');
		titreInput.type = 'text';
		titreInput.id = 'input-titre';
		titreInput.value = titreElement.textContent;
		titreElement.replaceWith(titreInput);
	
		// Transformer la description en textarea
		const descriptionElement = document.getElementById('bandeau-description');
		const descriptionInput = document.createElement('textarea');
		descriptionInput.id = 'input-description';
		descriptionInput.textContent = descriptionElement.textContent;
		descriptionElement.replaceWith(descriptionInput);
	
		// Transformer le champ "Créé par" en input
		const creeparElement = document.getElementById('bandeau-creepar');
		const creeparInput = document.createElement('input');
		creeparInput.type = 'text';
		creeparInput.id = 'input-creepar';
		creeparInput.value = creeparElement.textContent;
		creeparElement.replaceWith(creeparInput);
	
		// Transformer le champ "Début" en input de type datetime-local
		const debutElement = document.getElementById('bandeau-debut');
		const debutInput = document.createElement('input');
		debutInput.type = 'datetime-local';
		debutInput.id = 'input-debut';
		// Convertir le texte en format compatible avec datetime-local
		debutInput.value = new Date(debutElement.textContent).toISOString().slice(0, 16);
		debutElement.replaceWith(debutInput);
	
		// Transformer le champ "Échéance" en input de type datetime-local
		const echeanceElement = document.getElementById('bandeau-echeance');
		const echeanceInput = document.createElement('input');
		echeanceInput.type = 'datetime-local';
		echeanceInput.id = 'input-echeance';
		// Convertir le texte en format compatible avec datetime-local
		echeanceInput.value = new Date(echeanceElement.textContent).toISOString().slice(0, 16);
		echeanceElement.replaceWith(echeanceInput);

		// Ajoute un bouton sauvegarder
		const sauvegarderBtn = document.createElement('button');
		sauvegarderBtn.textContent = 'Sauvegarder';
		sauvegarderBtn.id = 'sauvegarder';
		sauvegarderBtn.classList.add('btn');
		sauvegarderBtn.classList.add('btn-primary');
		sauvegarderBtn.classList.add('btn-sm');
		sauvegarderBtn.classList.add('m-2');

		sauvegarderBtn.addEventListener('click', () => {
			fetch('/taches/' + id, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					titre: document.getElementById('input-titre').value,
					description: document.getElementById('input-description').value,
					creepar: document.getElementById('input-creepar').value,
					debut: document.getElementById('input-debut').value,
					echeance: document.getElementById('input-echeance').value,
					priorite: document.getElementById('select-priorite').value,
					statut: document.getElementById('select-statut').value
				})
			}).then(() => {
				//location.reload();
			}).catch((error) => {
				console.error('Erreur:', error);
			});
		});

		document.getElementById('bandeau-droit').appendChild(sauvegarderBtn);
	});
	
});