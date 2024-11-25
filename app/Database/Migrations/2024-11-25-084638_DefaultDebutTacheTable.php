<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DefaultDebutTacheTable extends Migration
{
    public function up()
    {
		$this->db->query("ALTER TABLE tache ALTER COLUMN debut SET DEFAULT CURRENT_TIMESTAMP"); 
    }

    public function down()
    {
		$this->db->query("ALTER TABLE tache ALTER COLUMN debut SET DEFAULT NULL");
    }
}
