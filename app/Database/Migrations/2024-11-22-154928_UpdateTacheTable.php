<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateTacheTable extends Migration
{
	public function up()
	{
		$this->db->query("ALTER TABLE tache ADD CONSTRAINT check_priorite CHECK (priorite IN ('importante', 'neutre', 'faible'))");
		$this->db->query("ALTER TABLE tache ALTER COLUMN datecreation SET DEFAULT CURRENT_TIMESTAMP");
	}

	public function down()
	{
		$this->db->query("ALTER TABLE tache DROP CONSTRAINT check_priorite");
		$this->db->query("ALTER TABLE tache ALTER COLUMN datecreation SET DEFAULT NULL");
	}
}
