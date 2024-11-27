<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsCommentaireCree extends Migration
{
    public function up()
    {
		$fields = [
			'creepar' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => false,
			],
		];
        $this->forge->addForeignKey('creepar', 'utilisateur', 'username', 'CASCADE', 'CASCADE');
		$this->forge->addColumn('commentaire', $fields);
    }

    public function down()
    {
		$this->forge->dropColumn('commentaire', 'creepar');
    }
}
