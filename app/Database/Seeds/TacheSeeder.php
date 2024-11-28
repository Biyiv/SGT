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
					"titre" => "Réunion d'équipe",
					"description" => "Réunion hebdomadaire pour discuter des projets en cours.",
					"creepar" => "Frizoks",
					"echeance" => "2024-12-05 14:00:00",
					"priorite" => 3,
					"statut" => "en retard"
				],
				[
					"titre" => "Mise à jour du site web",
					"description" => "Apporter des modifications et des mises à jour au site web de l'entreprise.",
					"creepar" => "Biyiv",
					"echeance" => "2024-11-30 14:00:00",
					"priorite" => 2,
					"statut" => "en cours"
				],
				[
					"titre" => "Correction de bug",
					"description" => "Réparer les bugs signalés dans l'application.",
					"creepar" => "Lucifer",
					"echeance" => "2024-12-01 14:00:00",
					"priorite" => 1,
					"statut" => "en attente"
				],
				[
					"titre" => "Formation interne",
					"description" => "Session de formation sur les nouveaux outils.",
					"creepar" => "Luck",
					"echeance" => "2024-12-03 14:00:00",
					"priorite" => 2,
					"statut" => "en cours"
				],
				[
					"titre" => "Audit mensuel",
					"description" => "Vérification des processus internes.",
					"creepar" => "Frizoks",
					"echeance" => "2025-01-05 14:00:00",
					"priorite" => 3,
					"statut" => "en retard"
				],
				[
					"titre" => "Préparation de la réunion trimestrielle",
					"description" => "Collecte des données pour la présentation.",
					"creepar" => "Luck",
					"echeance" => "2024-12-08 14:00:00",
					"priorite" => 1,
					"statut" => "en cours"
				],
				[
					"titre" => "Mise à jour des bases de données",
					"description" => "Maintenance des données pour éviter les erreurs.",
					"creepar" => "Lucifer",
					"echeance" => "2024-12-13 14:00:00",
					"priorite" => 2,
					"statut" => "en retard"
				],
				[
					"titre" => "Planification des vacances",
					"description" => "Créer un calendrier pour les congés des employés.",
					"creepar" => "Biyiv",
					"echeance" => "2024-12-18 14:00:00",
					"priorite" => 1,
					"statut" => "en cours"
				],
				[
					"titre" => "Validation des factures",
					"description" => "Vérifier et valider les factures reçues.",
					"creepar" => "Luck",
					"echeance" => "2024-12-05 14:00:00",
					"priorite" => 3,
					"statut" => "en retard"
				],
				[
					"titre" => "Révision du plan stratégique",
					"description" => "Analyser et réviser les objectifs stratégiques.",
					"creepar" => "Frizoks",
					"echeance" => "2024-12-12 14:00:00",
					"priorite" => 2,
					"statut" => "en cours"
				],
				[
					"titre" => "Suivi des partenaires",
					"description" => "Appeler les partenaires pour discuter des collaborations.",
					"creepar" => "Lucifer",
					"echeance" => "2024-12-07 14:00:00",
					"priorite" => 1,
					"statut" => "en attente"
				],
				[
					"titre" => "Configuration de nouveaux équipements",
					"description" => "Installer les nouveaux outils dans les bureaux.",
					"creepar" => "Luck",
					"echeance" => "2024-12-04 14:00:00",
					"priorite" => 3,
					"statut" => "en cours"
				],
				[
					"titre" => "Campagne publicitaire",
					"description" => "Créer et lancer une nouvelle campagne marketing.",
					"creepar" => "Biyiv",
					"echeance" => "2024-12-06 14:00:00",
					"priorite" => 2,
					"statut" => "en retard"
				],
				[
					"titre" => "Recrutement de stagiaires",
					"description" => "Organiser des entretiens pour les stagiaires.",
					"creepar" => "Lucifer",
					"echeance" => "2024-12-10 14:00:00",
					"priorite" => 1,
					"statut" => "en cours"
				],
				[
					"titre" => "Test du nouveau logiciel",
					"description" => "Effectuer des tests pour la nouvelle application.",
					"creepar" => "Luck",
					"echeance" => "2024-12-02 14:00:00",
					"priorite" => 3,
					"statut" => "en attente"
				],
				[
					"titre" => "Organisation du séminaire annuel",
					"description" => "Planifier les activités et réserver le lieu.",
					"creepar" => "Frizoks",
					"echeance" => "2025-01-10 14:00:00",
					"priorite" => 3,
					"statut" => "en retard"
				],
				[
					"titre" => "Suivi des ventes",
					"description" => "Analyser les chiffres et relancer les clients.",
					"creepar" => "Biyiv",
					"echeance" => "2025-01-03 14:00:00",
					"priorite" => 2,
					"statut" => "en cours"
				],
				[
					"titre" => "Élaboration du budget annuel",
					"description" => "Préparer les prévisions budgétaires pour l'année prochaine.",
					"creepar" => "Luck",
					"echeance" => "2025-01-25 14:00:00",
					"priorite" => 1,
					"statut" => "en attente"
				],
				[
					"titre" => "Mise en place de l'intranet",
					"description" => "Créer un espace collaboratif pour les employés.",
					"creepar" => "Lucifer",
					"echeance" => "2024-12-18 14:00:00",
					"priorite" => 2,
					"statut" => "en cours"
				],
				[
					"titre" => "Refonte de la charte graphique",
					"description" => "Moderniser le logo et le style visuel.",
					"creepar" => "Luck",
					"echeance" => "2024-12-16 14:00:00",
					"priorite" => 1,
					"statut" => "en retard"
				],
				[
					'titre'       => 'Planification des objectifs 2025',
					'description' => 'Définir les priorités stratégiques pour l\'année 2025.',
					'creepar'     => 'Lucifer',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+15 days')),
					'priorite'    => 3,
					'statut'      => 'en cours',
				],
				[
					'titre'       => 'Migration des serveurs cloud',
					'description' => 'Transférer les données et applications vers une infrastructure cloud sécurisée.',
					'creepar'     => 'Biyiv',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+10 days')),
					'priorite'    => 2,
					'statut'      => 'en retard',
				],
				[
					'titre'       => 'Création d\'un comité d\'innovation',
					'description' => 'Mettre en place un groupe chargé de proposer des idées innovantes.',
					'creepar'     => 'Luck',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+30 days')),
					'priorite'    => 1,
					'statut'      => 'en attente',
				],
				[
					'titre'       => 'Révision du contrat fournisseur',
					'description' => 'Analyser les termes actuels et négocier un renouvellement avantageux.',
					'creepar'     => 'Frizoks',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+7 days')),
					'priorite'    => 2,
					'statut'      => 'en cours',
				],
				[
					'titre'       => 'Formation sur la gestion de projet',
					'description' => 'Former les employés aux outils et méthodologies de gestion de projet.',
					'creepar'     => 'Lucifer',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+20 days')),
					'priorite'    => 3,
					'statut'      => 'en retard',
				],
				[
					'titre'       => 'Analyse des retours clients',
					'description' => 'Collecter et étudier les retours pour améliorer les produits.',
					'creepar'     => 'Biyiv',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+5 days')),
					'priorite'    => 1,
					'statut'      => 'en cours',
				],
				[
					'titre'       => 'Lancement d\'une enquête de satisfaction',
					'description' => 'Préparer un sondage pour évaluer la satisfaction des clients.',
					'creepar'     => 'Luck',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+12 days')),
					'priorite'    => 2,
					'statut'      => 'en attente',
				],
				[
					'titre'       => 'Sécurisation des données sensibles',
					'description' => 'Mettre en œuvre des protocoles pour renforcer la sécurité des données.',
					'creepar'     => 'Frizoks',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+8 days')),
					'priorite'    => 3,
					'statut'      => 'en retard',
				],
				[
					'titre'       => 'Déploiement d\'un nouveau logiciel RH',
					'description' => 'Installer et former les utilisateurs au nouvel outil de gestion RH.',
					'creepar'     => 'Lucifer',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+18 days')),
					'priorite'    => 1,
					'statut'      => 'en cours',
				],
				[
					'titre'       => 'Organisation d\'une réunion inter-départements',
					'description' => 'Favoriser la collaboration entre différentes équipes.',
					'creepar'     => 'Luck',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+25 days')),
					'priorite'    => 2,
					'statut'      => 'en attente',
				],
				[
					'titre'       => 'Mise en place d\'un programme de mentoring',
					'description' => 'Créer un système où les employés expérimentés accompagnent les nouveaux arrivants.',
					'creepar'     => 'Biyiv',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+14 days')),
					'priorite'    => 3,
					'statut'      => 'en cours',
				],
				[
					'titre'       => 'Optimisation de la chaîne logistique',
					'description' => 'Identifier les points faibles et proposer des solutions pour une meilleure gestion des flux.',
					'creepar'     => 'Frizoks',
					'echeance'    => date('Y-m-d H:i:s', strtotime('+3 days')),
					'priorite'    => 1,
					'statut'      => 'en retard',
				],
        ];

        // Insérer toutes les tâches
        $this->db->table('tache')->insertBatch($data);
	}
}
