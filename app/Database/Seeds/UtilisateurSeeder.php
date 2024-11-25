<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'Frizoks',
                'nom'      => 'Lecarpentier',
                'prenom'   => 'Luc',
                'mail'     => 'luc.lecarpentier5@gmail.com',
                'mdp'      => password_hash('pwdLuc', PASSWORD_DEFAULT),
            ],
            [
                'username' => 'Biyiv',
                'nom'      => 'Hay',
                'prenom'   => 'Baptiste',
                'mail'     => 'baptiste.hay@hotmail.fr',
                'mdp'      => password_hash('MaisTesPasNet', PASSWORD_DEFAULT),
            ],
        ];

        // Insérer les utilisateurs
        $this->db->table('utilisateur')->insertBatch($data);
    }
}
