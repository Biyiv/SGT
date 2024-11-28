document.addEventListener("DOMContentLoaded", () => {
	// Sélectionner les tâches et le bandeau
	const taches = document.querySelectorAll('.tache');
	const bandeau = document.getElementById('bandeau-droit');
	const fermerBandeauBtn = document.getElementById('fermer-bandeau');

	// Listes déroulantes
	const prioriteSelect = document.getElementById('select-priorite');
	const statutSelect = document.getElementById('select-statut');

	// Fonction pour ouvrir le bandeau avec les détails d'une tâche
	function afficherDetailsTache(tache) {
		const username = document.getElementById('username').textContent;
		const bandeauCrayon = document.getElementById('crayon');
		const bandeauTitre = document.getElementById('bandeau-titre');
		const bandeauDescription = document.getElementById('bandeau-description');
		const bandeauCreepar = document.getElementById('bandeau-creepar');
		const bandeauDebut = document.getElementById('bandeau-debut');
		const bandeauEcheance = document.getElementById('bandeau-echeance');
		const bandeauId = document.getElementById('bandeau-id');

		const titre = tache.querySelector('h2').textContent;
		const description = tache.querySelector('p:nth-child(2)').textContent;
		const creepar = tache.querySelector('p:nth-child(3)').textContent.split(': ')[1];
		const debut = tache.querySelector('p:nth-child(4)').textContent.split(': ')[1];
		const echeance = tache.querySelector('p:nth-child(5)').textContent.split(': ')[1];
		const priorite = tache.querySelector('.task-info p:nth-child(1) b').textContent.toLowerCase();
		const statut = tache.querySelector('.task-info p:nth-child(2) b').textContent.toLowerCase();
		const id = tache.querySelector('p:nth-child(6)').textContent;

		// Remplir les champs statiques	
		bandeauTitre.textContent = titre;
		bandeauDescription.textContent = description;
		bandeauCreepar.textContent = creepar;
		bandeauDebut.textContent = debut;
		bandeauEcheance.textContent = echeance;
		bandeauId.textContent = id;

		if(username !== creepar) {
			bandeauCrayon.style.display = 'none';
		} else {
			bandeauCrayon.style.removeProperty('display');
		}

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

		//Récupérer les commentaires de la tâche
		getCommentaires(id);

		// Afficher le bandeau
		bandeau.style.display = 'block';
	}


	// Ajouter des événements aux tâches
	taches.forEach((tache) => {
		tache.addEventListener('click', () => {
			if (tache.style.backgroundColor === hexToRgb('#007BFF')) {
				tache.style.backgroundColor = ''; // Remettre à l'état normal
				tache.style.color = 'black';
				fermerBandeau();
			} else {
				taches.forEach(t => {
					t.style.backgroundColor = '';
					t.style.color = 'black';
				});
				tache.style.backgroundColor = '#007BFF'; // Appliquer la couleur de fond
				tache.style.color = 'white';
				afficherDetailsTache(tache);
				afficherBandeau();
			}
		});
	});

	// Fermer le bandeau avec une transition
	fermerBandeauBtn.addEventListener('click', () => {
		reinitialiserBandeau(); // Réinitialiser avant de fermer le bandeau
		fermerBandeau();
	});

	// Ouvrir le bandeau avec une transition
	function afficherBandeau() {
		bandeau.style.visibility = 'visible'; // Pour éviter de garder l'élément interactif.
		document.body.classList.add('bandeau-visible');
	}

	document.getElementById('crayon').addEventListener('click', () => {

		document.getElementById('crayon').style.display = 'none';

		// Transformer le titre en input
		const titreElement = document.getElementById('bandeau-titre');
		const titreInput = document.createElement('input');
		titreInput.type = 'text';
		titreInput.id = 'bandeau-titre';
		titreInput.value = titreElement.textContent;
		titreElement.replaceWith(titreInput);
	
		// Transformer la description en textarea
		const descriptionElement = document.getElementById('bandeau-description');
		const descriptionInput = document.createElement('textarea');
		descriptionInput.id = 'bandeau-description';
		descriptionInput.textContent = descriptionElement.textContent;
		descriptionElement.replaceWith(descriptionInput);
	
		// Transformer le champ "Créé par" en input
		const creeparElement = document.getElementById('bandeau-creepar');
		const creeparInput = document.createElement('input');
		creeparInput.type = 'text';
		creeparInput.id = 'bandeau-creepar';
		creeparInput.value = creeparElement.textContent;
		creeparElement.replaceWith(creeparInput);
	
		// Transformer le champ "Début" en input de type datetime-local
		const debutElement = document.getElementById('bandeau-debut');
		const debutInput = document.createElement('input');
		debutInput.type = 'datetime-local';
		debutInput.id = 'bandeau-debut';
		// Convertir le texte en format compatible avec datetime-local
		const dateStringD = debutElement.textContent.trim();
		// Utiliser une expression régulière pour extraire les informations de la date et de l'heure
		const [dayD, monthD, yearD, hourD, minuteD] = dateStringD.match(/(\d{2})\/(\d{2})\/(\d{4}) - (\d{2}):(\d{2})/).slice(1);
		// Créer un objet Date en utilisant les informations extraites
		const formattedDateD = new Date(`${yearD}-${monthD}-${dayD}T${hourD}:${minuteD}:00`);
		formattedDateD.setHours(formattedDateD.getHours() + 1);
		// Mettre la valeur de l'input avec le format ISO 8601 (sans les secondes et le fuseau horaire)
		debutInput.value = formattedDateD.toISOString().slice(0, 16);
		debutElement.replaceWith(debutInput);
	
		// Transformer le champ "Échéance" en input de type datetime-local
		const echeanceElement = document.getElementById('bandeau-echeance');
		const echeanceInput = document.createElement('input');
		echeanceInput.type = 'datetime-local';
		echeanceInput.id = 'bandeau-echeance';
		// Convertir le texte en format compatible avec datetime-local
		const dateStringE = echeanceElement.textContent.trim();
		// Utiliser une expression régulière pour extraire les informations de la date et de l'heure
		const [dayE, monthE, yearE, hourE, minuteE] = dateStringE.match(/(\d{2})\/(\d{2})\/(\d{4}) - (\d{2}):(\d{2})/).slice(1);
		// Créer un objet Date en utilisant les informations extraites
		const formattedDateE = new Date(`${yearE}-${monthE}-${dayE}T${hourE}:${minuteE}:00`);
		formattedDateE.setHours(formattedDateE.getHours() + 1);
		// Mettre la valeur de l'input avec le format ISO 8601 (sans les secondes et le fuseau horaire)
		echeanceInput.value = formattedDateE.toISOString().slice(0, 16);
		echeanceElement.replaceWith(echeanceInput);

		const id = document.getElementById('bandeau-id').textContent;

		const priorite = document.getElementById('select-priorite');
		priorite.removeAttribute('disabled');
		
		const mtn = new Date();
		const statut = document.getElementById('select-statut');
		statut.removeAttribute('disabled'); 

		statut.innerHTML = '';

		// Vérifier si la date actuelle est supérieure à la date d'échéance
		const options = mtn > formattedDateE
			? [
				{ value: 'en retard', text: 'En retard' },
				{ value: 'termine', text: 'Terminée' },
			]
			: [
				{ value: 'en attente', text: 'En attente' },
				{ value: 'en cours', text: 'En cours' },
				{ value: 'termine', text: 'Terminée' },
			];

		options.forEach(optionData => {
			const option = document.createElement('option');
			option.value = optionData.value;
			option.textContent = optionData.text;
			statut.appendChild(option);
		});

		

		// Ajoute un bouton sauvegarder
		const sauvegarderBtn = document.createElement('button');
		sauvegarderBtn.textContent = 'Sauvegarder';
		sauvegarderBtn.id = 'sauvegarder';
		sauvegarderBtn.classList.add('btn');
		sauvegarderBtn.classList.add('btn-primary');
		sauvegarderBtn.classList.add('btn-sm');
		sauvegarderBtn.classList.add('m-2');

		const gestionnaireTaches = document.querySelector('.conteneur-taches')

		gestionnaireTaches.style.pointerEvents = 'none';

		sauvegarderBtn.addEventListener('click', () => {
			fetch('/taches/' + id, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					titre: document.getElementById('bandeau-titre').value,
					description: document.getElementById('bandeau-description').value,
					creepar: document.getElementById('bandeau-creepar').value,
					debut: document.getElementById('bandeau-debut').value,
					echeance: document.getElementById('bandeau-echeance').value,
					priorite: document.getElementById('select-priorite').value,
					statut: document.getElementById('select-statut').value,
					id: document.getElementById('bandeau-id').textContent,
				})
			}).then(() => {
				gestionnaireTaches.style.pointerEvents = 'auto';
				location.reload();
			}).catch((error) => {
				console.error('Erreur:', error);
			});
		});
		
		document.getElementById('bandeau-droit').appendChild(sauvegarderBtn);

		// Ajoute un bouton supprimer
		const supprimerBtn = document.createElement('button');
		supprimerBtn.textContent = 'Supprimer';
		supprimerBtn.id = 'supprimer';
		supprimerBtn.classList.add('btn');
		supprimerBtn.classList.add('btn-primary');
		supprimerBtn.classList.add('btn-sm');
		supprimerBtn.classList.add('m-2');

		const gestionnaireTachesSuppr = document.querySelector('.conteneur-taches')

		gestionnaireTachesSuppr.style.pointerEvents = 'none';

		supprimerBtn.addEventListener('click', () => {
			const confirmation = confirm('Voulez-vous vraiment supprimer ce commentaire ?');

			if(confirmation) {
				fetch('/supprimerTache/' + id, {
					method: 'POST',
				}).then(() => {
					gestionnaireTaches.style.pointerEvents = 'auto';
					location.reload();
				}).catch((error) => {
					console.error('Erreur:', error);
				});
			} else {
				alert('Le commentaire n\'a pas été supprimé');
			}
		});

		

		document.getElementById('bandeau-droit').appendChild(supprimerBtn);
	});

	// Fonction pour réinitialiser le bandeau en version non éditable
	function reinitialiserBandeau() {
		// Récupérer les champs en tant qu'éléments statiques
		const titreSpan = document.createElement('h2');
		titreSpan.id = 'bandeau-titre';
		document.getElementById('bandeau-titre').replaceWith(titreSpan);

		const descriptionSpan = document.createElement('span');
		descriptionSpan.id = 'bandeau-description';
		document.getElementById('bandeau-description').replaceWith(descriptionSpan);

		const creeparSpan = document.createElement('span');
		creeparSpan.id = 'bandeau-creepar';
		document.getElementById('bandeau-creepar').replaceWith(creeparSpan);

		const debutSpan = document.createElement('span');
		debutSpan.id = 'bandeau-debut';
		document.getElementById('bandeau-debut').replaceWith(debutSpan);

		const echeanceSpan = document.createElement('span');
		echeanceSpan.id = 'bandeau-echeance';
		document.getElementById('bandeau-echeance').replaceWith(echeanceSpan);

		// Désactiver les listes déroulantes
		prioriteSelect.setAttribute('disabled', 'true');
		statutSelect.setAttribute('disabled', 'true');

		// Supprimer le bouton sauvegarder s'il existe
		const sauvegarderBtn = document.getElementById('sauvegarder');
		if (sauvegarderBtn) {
			sauvegarderBtn.remove();
		}

		const supprimerBtn = document.getElementById('supprimer');
		if (supprimerBtn) {
			supprimerBtn.remove();
		}
	}

	function fermerBandeau() {
		document.body.classList.remove('bandeau-visible');

		const gestionnaireTaches = document.querySelector('.conteneur-taches')

		gestionnaireTaches.style.pointerEvents = 'auto';

		// Optionnel : Assurez-vous que l'état du bandeau est réinitialisé après la transition
		setTimeout(() => {
			bandeau.style.visibility = 'hidden'; // Pour éviter de garder l'élément interactif.
		}, 500); // Correspond à la durée de la transition CSS.

		taches.forEach(t => {
			t.style.backgroundColor = '';
			t.style.color = 'black';
		});
	}

	//Fonction pour récupérer les commentaires grâce à l'id de la tache
	function getCommentaires(id) {
		fetch(`/taches/${id}/commentaires`, {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json',
			}
		})
		.then(response => {
			return response.json();
		})
		.then(data => {
			const divCommentaires = document.querySelector('.commentaires');

			divCommentaires.innerHTML = '';

			if(data.length === 0) {
				const divCommentaire = document.createElement('div');
				divCommentaire.classList.add('commentaire');
				divCommentaire.innerHTML = `
					<h5>Aucun commentaire</h5>
				`;

				divCommentaires.appendChild(divCommentaire);
			} else {
				cpt = 0;
				data.forEach(commentaire => {
					const divCommentaire = document.createElement('div');
					divCommentaire.classList.add('commentaire');
					if(cpt > 0) {
						divCommentaire.style.display = 'none';
					}
					else {
						divCommentaire.style.display = 'block';
					}
					divCommentaire.id = cpt++;
					divCommentaire.innerHTML = `
						<h5>${commentaire.creepar}</h5>
						<p>${commentaire.commentaire}</p>
					`;
	
					divCommentaires.appendChild(divCommentaire);
				})

				if(cpt > 0) {
					const divBtns = document.createElement('div');
					divBtns.classList.add('btns');
					divBtns.innerHTML = `
						<button id="btn-precedent" class="btn btn-primary btn-sm">Précédent</button>
						<button id="btn-suivant" class="btn btn-primary btn-sm">Suivant</button>
					`;

					divCommentaires.appendChild(divBtns);

					document.getElementById('btn-precedent').addEventListener('click', () => {
						const divs = document.querySelectorAll('.commentaire');
						let cpt = 0;
						divs.forEach(div => {
							if(div.style.display === 'block' && cpt !== 0) {
								div.style.display = 'none';
								divs[cpt - 1].style.display = 'block';
							}
							cpt++;
						});
					});

					document.getElementById('btn-suivant').addEventListener('click', () => {
						const divs = document.querySelectorAll('.commentaire');
						let cpt = 0;
						divs.forEach(div => {
							if(div.style.display === 'block' && cpt !== divs.length - 1) {
								div.style.display = 'none';
								divs[cpt + 1].style.display = 'block';
								return;
							}
							cpt++;
						});
					});
				}
			}
		});
	}

	document.getElementById('supprimer-tache').addEventListener('click', supprimerCommentaire);


	function supprimerCommentaire() {

		const commentaires = document.querySelectorAll('.commentaire');

		commentaires.forEach(commentaire => {
			if(commentaire.style.display === 'block') {
				const id = commentaire.id;
				const idTache = document.getElementById('bandeau-id').textContent;

				const confirmation = confirm('Voulez-vous vraiment supprimer ce commentaire ?');

				if(confirmation) {
					fetch(`/taches/${idTache}/commentaires/${id}`, {
						method: 'DELETE',
						headers: {
							'Content-Type': 'application/json',
						}
					})
					.then(response => {
						return response.json();
					})
					.then(data => {
						getCommentaires(idTache);
					});
				} else {
					alert('Le commentaire n\'a pas été supprimé');
				}
			}
		});
	}

});