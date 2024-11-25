<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsTacheTable extends Migration
{
    public function up()
    {
		$fields = [
			'statut' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false,
				'default' => 'en attente',
			],
		];
		$this->forge->addColumn('tache', $fields);

		$this->db->query("ALTER TABLE tache ALTER COLUMN datecreation SET DEFAULT NULL");
		$this->db->query("ALTER TABLE tache RENAME COLUMN datecreation TO debut");
    }

    public function down()
    {
		$this->forge->dropColumn('tache', 'statut');
		$this->db->query("ALTER TABLE tache ALTER COLUMN datecreation SET DEFAULT CURRENT_TIMESTAMP"); 
		$this->db->query("ALTER TABLE tache RENAME COLUMN debut TO datecreation");
    }
}
