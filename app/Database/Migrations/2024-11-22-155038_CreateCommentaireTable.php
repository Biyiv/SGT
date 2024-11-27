<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommentaireTable extends Migration
{
    public function up()
    {
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'commentaire' => [
				'type' => 'TEXT',
				'null' => false,
			],
			'tache' => [
				'type'       => 'INT',
				'unsigned'   => true,
				'null'       => false,
			],
			'datecreation' => [
				'type'    => 'DATETIME',
				'null'    => true,
			],
		]);
		
		$this->forge->addKey('id', true); // Clé primaire
		$this->forge->addForeignKey('tache', 'tache', 'id', 'CASCADE', 'CASCADE'); // Clé étrangère
		$this->forge->createTable('commentaire');
    }

    public function down()
    {
		$this->forge->dropTable('commentaire'); // Suppression de la table en cas de rollback
    }
}
