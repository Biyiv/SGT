<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TacheSeeder extends Seeder
{
    public function run()
    {
        // Réinitialiser la table `tache`
        $this->db->query('TRUNCATE TABLE tache RESTART IDENTITY CASCADE');

        // Données des tâches
        $data = [
            [
                'titre'       => 'Réunion d\'équipe',
                'description' => 'Réunion hebdomadaire pour discuter des projets en cours.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+1 week')),
                'priorite'    => 3,
                'statut'      => 'en retard',
            ],
            [
                'titre'       => 'Mise à jour du site web',
                'description' => 'Apporter des modifications et des mises à jour au site web de l\'entreprise.',
                'creepar'     => 'Frizoks',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+2 days')),
                'priorite'    => 2,
                'statut'      => 'en cours',
            ],
            [
                'titre'       => 'Correction de bug',
                'description' => 'Réparer les bugs signalés dans l\'application.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+3 days')),
                'priorite'    => 1,
                'statut'      => 'termine',
            ],
            [
                'titre'       => 'Formation interne',
                'description' => 'Session de formation sur les nouveaux outils.',
                'creepar'     => 'Frizoks',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+5 days')),
                'priorite'    => 2,
                'statut'      => 'en cours',
            ],
            [
                'titre'       => 'Audit mensuel',
                'description' => 'Vérification des processus internes.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+1 month')),
                'priorite'    => 3,
                'statut'      => 'en retard',
            ],
            [
                'titre'       => 'Préparation de la réunion trimestrielle',
                'description' => 'Collecte des données pour la présentation.',
                'creepar'     => 'Frizoks',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+10 days')),
                'priorite'    => 1,
                'statut'      => 'en cours',
            ],
            [
                'titre'       => 'Mise à jour des bases de données',
                'description' => 'Maintenance des données pour éviter les erreurs.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+15 days')),
                'priorite'    => 2,
                'statut'      => 'en retard',
            ],
            [
                'titre'       => 'Planification des vacances',
                'description' => 'Créer un calendrier pour les congés des employés.',
                'creepar'     => 'Frizoks',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+20 days')),
                'priorite'    => 1,
                'statut'      => 'en cours',
            ],
            [
                'titre'       => 'Validation des factures',
                'description' => 'Vérifier et valider les factures reçues.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+7 days')),
                'priorite'    => 3,
                'statut'      => 'en retard',
            ],
            [
                'titre'       => 'Révision du plan stratégique',
                'description' => 'Analyser et réviser les objectifs stratégiques.',
                'creepar'     => 'Frizoks',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+14 days')),
                'priorite'    => 2,
                'statut'      => 'en cours',
            ],
            [
                'titre'       => 'Suivi des partenaires',
                'description' => 'Appeler les partenaires pour discuter des collaborations.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+8 days')),
                'priorite'    => 1,
                'statut'      => 'termine',
            ],
            [
                'titre'       => 'Configuration de nouveaux équipements',
                'description' => 'Installer les nouveaux outils dans les bureaux.',
                'creepar'     => 'Frizoks',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+6 days')),
                'priorite'    => 3,
                'statut'      => 'en cours',
            ],
            [
                'titre'       => 'Campagne publicitaire',
                'description' => 'Créer et lancer une nouvelle campagne marketing.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+9 days')),
                'priorite'    => 2,
                'statut'      => 'en retard',
            ],
            [
                'titre'       => 'Recrutement de stagiaires',
                'description' => 'Organiser des entretiens pour les stagiaires.',
                'creepar'     => 'Frizoks',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+12 days')),
                'priorite'    => 1,
                'statut'      => 'en cours',
            ],
            [
                'titre'       => 'Test du nouveau logiciel',
                'description' => 'Effectuer des tests pour la nouvelle application.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+4 days')),
                'priorite'    => 3,
                'statut'      => 'termine',
            ],
            [
                'titre'       => 'Organisation du séminaire annuel',
                'description' => 'Planifier les activités et réserver le lieu.',
                'creepar'     => 'Frizoks',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+30 days')),
                'priorite'    => 3,
                'statut'      => 'en retard',
            ],
            [
                'titre'       => 'Suivi des ventes',
                'description' => 'Analyser les chiffres et relancer les clients.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+25 days')),
                'priorite'    => 2,
                'statut'      => 'en cours',
            ],
            [
                'titre'       => 'Élaboration du budget annuel',
                'description' => 'Préparer les prévisions budgétaires pour l\'année prochaine.',
                'creepar'     => 'Frizoks',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+45 days')),
                'priorite'    => 1,
                'statut'      => 'termine',
            ],
            [
                'titre'       => 'Mise en place de l\'intranet',
                'description' => 'Créer un espace collaboratif pour les employés.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+20 days')),
                'priorite'    => 2,
                'statut'      => 'en cours',
            ],
            [
                'titre'       => 'Refonte de la charte graphique',
                'description' => 'Moderniser le logo et le style visuel.',
                'creepar'     => 'Frizoks',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+18 days')),
                'priorite'    => 1,
                'statut'      => 'en retard',
            ],
        ];

        // Insérer toutes les tâches
        $this->db->table('tache')->insertBatch($data);
    }
}
