<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTacheTable extends Migration
{
    public function up()
    {
		$this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'titre' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
			'creepar' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
			'datecreation' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'echeance' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'priorite' => [
				'type'       => 'VARCHAR',
				'null'       => false,
				'default'    => 'neutre',
			],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('creepar', 'utilisateur', 'username', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tache');
    }

    public function down()
    {
		$this->forge->dropTable('tache'); // Suppression de la table en cas de rollback
    }
}
