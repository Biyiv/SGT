<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateCommentaireTable extends Migration
{
    public function up()
    {
		$this->db->query("ALTER TABLE commentaire ALTER COLUMN datecreation SET DEFAULT CURRENT_TIMESTAMP"); 
    }

    public function down()
    {
		$this->db->query("ALTER TABLE commentaire ALTER COLUMN datecreation SET DEFAULT NULL");
    }
}
