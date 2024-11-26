<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="/assets/css/stlMenu.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div id="error-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>
                    <?= session()->getFlashdata('error') 
                        ? 'Erreur' 
                        : (session()->getFlashdata('success') ? 'Succès' : 'Information') ?>
                </h2>
                <button class="close-btn">&times;</button>
            </div>
            <p>
                <?= session()->getFlashdata('error') 
                    ? session()->getFlashdata('error') 
                    : session()->getFlashdata('success') ?>
            </p>
        </div>
    </div>
    <h1>Liste des tâches</h1>

    <?= form_open('/setTriPreference', ['method' => 'post']); ?>
        <!-- CSRF Protection -->
        <?= csrf_field() ?>
        <?php $prioriteLst = ['1' => 'Faible', '2' => 'Moyenne', '3' => 'Importante'] ?>
        <!-- Liste déroulante pour le tri -->
        <?= form_label('Trier par :', 'tri'); ?>
        <?= form_dropdown(
            'tri',
            [
                'echeance' => 'Échéance',
                'priorite' => 'Priorité',
                'retard' => 'Retard'
            ],
            $tri,
            ['id' => 'tri', 'onchange' => 'this.form.submit()']
        ); ?>
    <?= form_close(); ?>

    <div class="conteneur-taches">
    <?php if (!empty($taches) && is_array($taches)): ?>
        <?php foreach ($taches as $tache): ?>
            <div class="tache" id="<?= esc($tache['id']) ?>">
                <h2><?= esc($tache['titre']) ?></h2>
                <p><?= esc($tache['description']) ?></p>
                <p>Créé par : <?= esc($tache['creepar']) ?></p>
                <p>Début : <?= esc($tache['debut']) ?></p>
                <p>Échéance : <?= esc($tache['echeance']) ?></p>
                <p>
                    Priorité : 
                    <b class="<?= esc($prioriteLst[$tache['priorite']]) ?>">
                        <?= esc($prioriteLst[$tache['priorite']]) ?>
                    </b>
                </p>
                <?php $statut = explode(' ', $tache['statut']) ?>
                <p>
                    Statut : 
                    <b class="<?= esc(end($statut)) ?>">
                        <?= esc($tache['statut']) ?>
                    </b>
                </p>
				<?php if ($tache['statut'] == "en retard"): ?>
					<img class="panneauDanger" src="/assets/images/Danger.png" alt="Panneau de danger">
				<?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune tâche trouvée.</p>
    <?php endif; ?>
    </div>

    <!-- Modal Trigger Button -->
    <button id="openModalBtn">Créer une Tâche</button>

    <!-- Modal -->
    <div id="creationTacheModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeModalBtn">&times;</span>
            
            <!-- Formulaire de création de tâche -->
            <?= form_open('/ajouterTache'); ?>
            
                <?= form_label('Titre :', 'titre'); ?>
                <?= form_input('titre', '', ['id' => 'titre', 'required' => 'required']); ?>
                <br>
                
                <?= form_label('Description :', 'description'); ?>
                <?= form_textarea('description', '', ['id' => 'description', 'required' => 'required']); ?>
                <br>
                
                <?= form_label('Début :', 'debut'); ?>
                <?= form_input(['type' => 'datetime-local', 'name' => 'debut', 'id' => 'debut', 'value' => date('Y-m-d\TH:i')]); ?>
                <br>
                
                <?= form_label('Échéance :', 'echeance'); ?>
                <?= form_input(['type' => 'datetime-local', 'name' => 'echeance', 'id' => 'echeance', 'value' => date('Y-m-d\TH:i')]); ?>
                <br>
                
                <?= form_label('Priorité :', 'priorite'); ?>
                <?= form_dropdown('priorite', ['1' => 'Faible', '2' => 'Moyenne', '3' => 'Importante'], '1', ['id' => 'priorite']); ?>
                <br>
                
                <?= form_submit('submit', 'Créer la tâche'); ?>
            <?= form_close(); ?>
        </div>
    </div>

    <!-- Script JS pour ouvrir et fermer le modal -->
    <script src="/assets/js/fctMenu.js"></script>
</body>

</html>