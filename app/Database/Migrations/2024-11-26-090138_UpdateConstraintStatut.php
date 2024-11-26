<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateConstraintStatut extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE tache DROP CONSTRAINT check_statut");
		$this->db->query("ALTER TABLE tache ADD CONSTRAINT check_statut CHECK (statut IN ('en attente', 'en cours', 'termine', 'en retard'))");
    }

    public function down()
    {
		$this->db->query("ALTER TABLE tache DROP CONSTRAINT check_statut");
        $this->db->query("ALTER TABLE tache ADD CONSTRAINT check_statut CHECK (statut IN ('en attente', 'en cours', 'termine'))");
    }
}
