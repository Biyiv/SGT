<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTokenActiveUtilisateurTable extends Migration
{
    public function up()
    {
		$fields = [
			'active_token' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true,
			],
		];
		$this->forge->addColumn('utilisateur', $fields);
		$this->db->query("ALTER TABLE utilisateur RENAME COLUMN verifie TO active");
    }

    public function down()
    {
		$this->forge->dropColumn('utilisateur', 'active_token');
		$this->db->query("ALTER TABLE utilisateur RENAME COLUMN active TO verifie");
    }
}
