<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePriorityLevelTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'level_name'  => ['type' => 'VARCHAR', 'constraint' => 20],
            'level_value' => ['type' => 'INT'],
'created_at' => ['type' => 'DATETIME', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('priority_level');
    }

    public function down()
    {
        $this->forge->dropTable('priority_level');
    }
}
