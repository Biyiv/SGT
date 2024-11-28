<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddContraintCheckDate extends Migration
{
    public function up()
    {
		$this->db->query("ALTER TABLE tache ADD CONSTRAINT echeance_sup_debut CHECK (tache.echeance >= tache.debut);");
    }

    public function down()
    {
		$this->db->query("ALTER TABLE tache DROP CONSTRAINT echeance_sup_debut"); 
    }
}

