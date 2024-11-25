<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TacheSeeder extends Seeder
{
    public function run()
    {
		$this->db->query('TRUNCATE TABLE tache RESTART IDENTITY CASCADE');

        $data = [
            [
                'titre'       => 'Réunion d\'équipe',
                'description' => 'Réunion hebdomadaire pour discuter des projets en cours.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+1 week')),
                'priorite'    => 'importante',
				'statut'      => 'en attente',
            ],
            [
                'titre'       => 'Mise à jour du site web',
                'description' => 'Apporter des modifications et des mises à jour au site web de l\'entreprise.',
                'creepar'     => 'Frizoks',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+2 days')),
                'priorite'    => 'neutre',
				'statut'      => 'en cours',
            ],
            [
                'titre'       => 'Correction de bug',
                'description' => 'Réparer les bugs signalés dans l\'application.',
                'creepar'     => 'Biyiv',
                'echeance'    => date('Y-m-d H:i:s', strtotime('+3 days')),
                'priorite'    => 'faible',
				'statut'      => 'en attente',
            ],
        ];

        // Insérer les tâches
        $this->db->table('tache')->insertBatch($data);
    }
}
