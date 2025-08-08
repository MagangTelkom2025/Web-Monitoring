<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTicketSourceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 50],
'created_at' => ['type' => 'DATETIME', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ticket_source');
    }

    public function down()
    {
        $this->forge->dropTable('ticket_source');
    }
}
