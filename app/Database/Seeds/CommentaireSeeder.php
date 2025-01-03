<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('TRUNCATE TABLE commentaire RESTART IDENTITY CASCADE');

        $data = [
            // Tâche 1 : 2 commentaires
            [
                'commentaire' => 'La réunion est bien planifiée, tout le monde sera informé.',
                'tache'       => 1,
                'creepar'     => 'Mathys',
            ],
            [
                'commentaire' => 'Assurez-vous que tous les participants confirment leur présence.',
                'tache'       => 1,
                'creepar'     => 'Antoine',
            ],

            // Tâche 2 : 1 commentaire
            [
                'commentaire' => 'Les mises à jour doivent être effectuées ce week-end.',
                'tache'       => 2,
                'creepar'     => 'Mathys',
            ],

            // Tâche 3 : Aucun commentaire

            // Tâche 4 : 1 commentaire
            [
                'commentaire' => 'N’oubliez pas d’envoyer les rapports avant la réunion.',
                'tache'       => 4,
                'creepar'     => 'Antoine',
            ],

            // Tâche 5 : 3 commentaires
            [
                'commentaire' => 'Les matériaux nécessaires ont été commandés hier.',
                'tache'       => 5,
                'creepar'     => 'Mathys',
            ],
            [
                'commentaire' => 'Le fournisseur a confirmé la livraison pour demain.',
                'tache'       => 5,
                'creepar'     => 'Antoine',
            ],
            [
                'commentaire' => 'Préparer l’espace de stockage pour les nouveaux équipements.',
                'tache'       => 5,
                'creepar'     => 'Mathys',
            ],

            // Tâche 6 : Aucun commentaire

            // Tâche 7 : 2 commentaires
            [
                'commentaire' => 'Un suivi sera nécessaire après la formation.',
                'tache'       => 7,
                'creepar'     => 'Antoine',
            ],
            [
                'commentaire' => 'La session de formation s’est bien déroulée.',
                'tache'       => 7,
                'creepar'     => 'Mathys',
            ],

            // Tâche 8 : Aucun commentaire

            // Tâche 9 : 1 commentaire
            [
                'commentaire' => 'La rédaction de la documentation avance bien.',
                'tache'       => 9,
                'creepar'     => 'Antoine',
            ],

            // Tâche 10 : 2 commentaires
            [
                'commentaire' => 'Il faut encore valider les spécifications techniques.',
                'tache'       => 10,
                'creepar'     => 'Mathys',
            ],
            [
                'commentaire' => 'La documentation est en cours de finalisation.',
                'tache'       => 10,
                'creepar'     => 'Antoine',
            ],

            // Tâche 11 : Aucun commentaire

            // Tâche 12 : 1 commentaire
            [
                'commentaire' => 'Le test utilisateur a révélé des points à améliorer.',
                'tache'       => 12,
                'creepar'     => 'Mathys',
            ],

            // Tâche 13 : Aucun commentaire

            // Tâche 14 : 3 commentaires
            [
                'commentaire' => 'Le prototype sera prêt d’ici deux jours.',
                'tache'       => 14,
                'creepar'     => 'Antoine',
            ],
            [
                'commentaire' => 'Les équipes travaillent efficacement sur le design.',
                'tache'       => 14,
                'creepar'     => 'Mathys',
            ],
            [
                'commentaire' => 'Des ajustements mineurs sont nécessaires pour le prototype.',
                'tache'       => 14,
                'creepar'     => 'Antoine',
            ],

            // Tâche 15 : 1 commentaire
            [
                'commentaire' => 'Une réunion de suivi est prévue pour demain.',
                'tache'       => 15,
                'creepar'     => 'Mathys',
            ],

            // Tâche 16 : Aucun commentaire

            // Tâche 17 : 2 commentaires
            [
                'commentaire' => 'Le rapport d’avancement doit être finalisé ce soir.',
                'tache'       => 17,
                'creepar'     => 'Antoine',
            ],
            [
                'commentaire' => 'Les données collectées semblent complètes.',
                'tache'       => 17,
                'creepar'     => 'Mathys',
            ],

            // Tâche 18 : Aucun commentaire

            // Tâche 19 : 1 commentaire
            [
                'commentaire' => 'Une nouvelle échéance a été fixée pour le projet.',
                'tache'       => 19,
                'creepar'     => 'Antoine',
            ],

            // Tâche 20 : 1 commentaire
            [
                'commentaire' => 'Le travail collaboratif porte ses fruits.',
                'tache'       => 20,
                'creepar'     => 'Mathys',
            ],
        ];

        // Insérer les commentaires
        $this->db->table('commentaire')->insertBatch($data);
    }
}
