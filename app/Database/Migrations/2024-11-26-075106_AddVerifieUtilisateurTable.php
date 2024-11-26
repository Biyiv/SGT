<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVerifieUtilisateurTable extends Migration
{
	public function up()
	{
		$fields = [
			'verifie' => [
				'type' => 'BOOLEAN',
				'null' => false,
				'default' => false,
			],
		];
		$this->forge->addColumn('utilisateur', $fields);
	}

	public function down()
	{
		$this->forge->dropColumn('utilisateur', 'verifie');
	}
}
