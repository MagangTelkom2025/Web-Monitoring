<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTicketSubcategoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'category_id' => ['type' => 'BIGINT', 'unsigned' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 100],
'created_at' => ['type' => 'DATETIME', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'ticket_category', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ticket_subcategory');
    }

    public function down()
    {
        $this->forge->dropTable('ticket_subcategory');
    }
}
