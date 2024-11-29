<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TacheSeeder extends Seeder
{
    public function run()
    {
        // Vider la table tache avant de la remplir
        $this->db->query('TRUNCATE TABLE tache RESTART IDENTITY CASCADE');

        // Utilisateurs et leurs IDs respectifs
        $users = [
            [1 => 'Antoine'],
            [2 => 'Mathys'],
            [3 => 'Baptiste'],
            [4 => 'Luc'],
        ];

        $today = date('Y-m-d');

        // Liste des tâches par domaine
        $tasks = [
            "Antoine" => [
                "Rédaction du rapport d'analyse",
                "Révision des spécifications techniques",
                "Mise à jour de la documentation utilisateur",
                "Planification des réunions de suivi",
                "Analyse des besoins clients",
                "Réalisation des maquettes fonctionnelles",
                "Validation des tests d'intégration",
                "Rédaction des cahiers de tests",
                "Préparation des supports de présentation",
                "Participation à la réunion hebdomadaire",
                "Recherche sur les outils de gestion de projet",
                "Création de la roadmap produit",
                "Élaboration du cahier des charges",
                "Réalisation du bilan de projet",
                "Amélioration des processus existants",
                "Vérification des retours clients",
                "Analyse de l'expérience utilisateur",
                "Formation des nouveaux collaborateurs",
                "Gestion des droits utilisateurs",
                "Contrôle qualité des livrables",
            ],
            "Mathys" => [
                "Développement de l'interface front-end",
                "Intégration des maquettes graphiques",
                "Débogage des problèmes d'affichage",
                "Optimisation du code CSS et JavaScript",
                "Mise en place des animations UI/UX",
                "Création d'un système de design réactif",
                "Implémentation des API front-end",
                "Vérification de la compatibilité mobile",
                "Tests d'accessibilité WCAG",
                "Documentation du code front-end",
                "Maintenance des composants front-end",
                "Mise à jour des dépendances front-end",
                "Collaboration avec l'équipe design",
                "Intégration des retours utilisateurs",
                "Refactoring des modules existants",
                "Tests de performance sur le front",
                "Mise en production des changements",
                "Ajout de nouveaux composants UI",
                "Configuration des environnements front-end",
                "Participation aux code reviews front-end",
            ],
            "Baptiste" => [
                "Création de la structure de la base de données",
                "Optimisation des requêtes SQL",
                "Réalisation des sauvegardes régulières",
                "Conception d'une API RESTful",
                "Documentation des endpoints API",
                "Ajout de fonctionnalités à l'application",
                "Développement des modules back-end",
                "Débogage des erreurs côté serveur",
                "Mise en place des tests unitaires",
                "Gestion des migrations de la base de données",
                "Révision du code pour la sécurité",
                "Analyse des performances SQL",
                "Implémentation de la pagination",
                "Rédaction des scripts de maintenance",
                "Mise à jour des configurations serveur",
                "Refactoring du code back-end",
                "Création des endpoints pour les nouvelles fonctionnalités",
                "Gestion des logs applicatifs",
                "Correction des anomalies signalées",
                "Ajout des validations sur les formulaires",
            ],
            "Luc" => [
                "Création d'un dashboard analytique",
                "Intégration des graphiques dynamiques",
                "Automatisation des tâches récurrentes",
                "Développement des requêtes SQL avancées",
                "Mise en place des sauvegardes automatisées",
                "Rédaction de scripts pour les analyses de données",
                "Ajout des rôles et permissions utilisateurs",
                "Optimisation de la base de données",
                "Migration vers une nouvelle version SQL",
                "Validation des données d'entrée",
                "Création des rapports mensuels",
                "Test des fonctionnalités en production",
                "Gestion des imports/export de données",
                "Configuration des environnements de test",
                "Mise à jour des dépendances backend",
                "Développement des tableaux de bord",
                "Amélioration des performances SQL",
                "Gestion des erreurs dans les logs",
                "Support technique sur les anomalies critiques",
                "Rédaction des protocoles de sécurité",
            ],
        ];

		$cpt = 1;
		$statut = [0 => 'en attente', 1 => 'en cours', 2 => 'termine', 3 => 'en retard', ];
		$cptU = 1;
        foreach ($users as $user) {
            foreach ($tasks[$user[$cptU]] as $index => $titre) {
                $startDate = date(
					'Y-m-d',
					rand(strtotime("2024-11-01"), strtotime("2026-12-30"))
				);
				
				// Génère une date d'échéance basée sur une probabilité (non en retard ou en retard, mais logique)
				$endDate = date(
					'Y-m-d',
					rand(
						strtotime($startDate . " +1 day"),  // Minimum : 1 jour après le début
						strtotime($startDate . " +15 days") // Maximum : 15 jours après le début
					)
				);

                $task = [
                    'titre' => $titre,
                    'description' => "Cette tâche consiste à {$titre} pour le projet en cours.",
                    'debut' => $startDate,
                    'echeance' => $endDate,
					'priorite' => $cpt%3 + 1,
                    'statut' => $endDate < $today ? $statut[3] : $statut[rand(0, 2)],
                    'creepar' => $user[$cptU],
                ];

                // Insérer la tâche
                $this->db->table('tache')->insert($task);
				$cpt++;
            }
			$cptU++;
        }
    }
}
