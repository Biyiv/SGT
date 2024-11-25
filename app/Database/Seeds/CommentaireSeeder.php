<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'commentaire' => 'La réunion est bien planifiée, tout le monde sera informé.',
                'tache'       => 1,
            ],
            [
                'commentaire' => 'Les mises à jour doivent être effectuées ce week-end.',
                'tache'       => 2,
            ],
            [
                'commentaire' => 'Il reste quelques bugs mineurs à corriger.',
                'tache'       => 2,
            ],
        ];

        // Insérer les commentaires
        $this->db->table('commentaire')->insertBatch($data);
    }
}
