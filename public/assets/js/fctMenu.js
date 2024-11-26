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