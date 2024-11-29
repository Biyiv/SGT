<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdatePriorite extends Migration
{
    public function up()
	{
        $this->db->query("ALTER TABLE tache DROP COLUMN priorite;");
        $this->db->query("ALTER TABLE tache ADD COLUMN priorite INT;");
        $this->db->query("ALTER TABLE tache ADD CONSTRAINT check_priorite  CHECK (priorite BETWEEN 1 AND 3);");
        $this->db->query("ALTER TABLE tache ALTER COLUMN priorite SET DEFAULT 2");
	}

	public function down()
	{
        $this->db->query("ALTER TABLE tache DROP COLUMN priorite;");
        $this->db->query("ALTER TABLE tache ADD COLUMN priorite VARCHAR;");
        $this->db->query("ALTER TABLE tache ADD CONSTRAINT check_priorite CHECK (priorite IN ('importante', 'neutre', 'faible'))");
        $this->db->query("ALTER TABLE tache ALTER COLUMN priorite SET DEFAULT 'neutre'");
	}
}
