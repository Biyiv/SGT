<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUtilisateurTable extends Migration
{
    public function up()
	{
		$this->forge->addField([
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'nom' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'prenom' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'mail' => [
				'type' => 'VARCHAR',
				'constraint' => '320',
			],
			'mdp' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
		]);
		$this->forge->addKey('username', true); // Clé primaire
		$this->forge->addUniqueKey('mail');
		$this->forge->createTable('utilisateur'); // Création de la table
	}

	public function down()
	{
		$this->forge->dropTable('utilisateur'); // Suppression de la table en cas de rollback
	}
}
