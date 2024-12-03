<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    public function run()
    {
        // Vider la table utilisateur avant de la remplir
        $this->db->query('TRUNCATE TABLE utilisateur RESTART IDENTITY CASCADE');

        $data = [
            [
                'username' => 'Antoine',
                'nom'      => 'Caron',
                'prenom'   => 'Antoine',
                'mail'     => 'toivimic.caron@gmail.com',
                'mdp'      => password_hash('pwdAntoine01', PASSWORD_DEFAULT),
                'active'   => true,
            ],
            [
                'username' => 'Mathys',
                'nom'      => 'Poret',
                'prenom'   => 'Mathys',
                'mail'     => 'drmama1243@gmail.com',
                'mdp'      => password_hash('pwdMathys02', PASSWORD_DEFAULT),
                'active'   => true,
            ],
            [
                'username' => 'Baptiste',
                'nom'      => 'Hay',
                'prenom'   => 'Baptiste',
                'mail'     => 'baptiste.hay@hotmail.fr',
                'mdp'      => password_hash('pwdBaptiste03', PASSWORD_DEFAULT),
                'active'   => true,
            ],
            [
                'username' => 'Luc',
                'nom'      => 'Lecarpentier',
                'prenom'   => 'Luc',
                'mail'     => 'luc.lecarpentier5@gmail.com',
                'mdp'      => password_hash('pwdLuc05', PASSWORD_DEFAULT),
                'active'   => true,
            ],
        ];

        // Insérer les utilisateurs
        $this->db->table('utilisateur')->insertBatch($data);
    }
}
