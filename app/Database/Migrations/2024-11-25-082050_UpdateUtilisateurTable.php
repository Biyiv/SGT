<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateUtilisateurTable extends Migration
{
	public function up()
	{
		$fields = [
			'reset_token' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
			'reset_token_expiration' => [
				'type' => 'TIMESTAMP',
				'null' => true,
			],
		];
		$this->forge->addColumn('utilisateur', $fields);
	}
	public function down()
	{
		$this->forge->dropColumn('utilisateur', 'reset_token');
		$this->forge->dropColumn('utilisateur', 'reset_token_expiration');
	}
}
