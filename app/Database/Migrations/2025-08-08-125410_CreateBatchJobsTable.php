<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBatchJobsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'file_size' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
                'null'     => false,
            ],
            'estimated_rows' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'processed_rows' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
            ],
            'failed_rows' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 0,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'processing', 'completed', 'failed'],
                'default'    => 'pending',
                'null'       => false,
            ],
            'error_message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'user_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
                'null'     => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->addKey('status'); // Index for status queries
        $this->forge->addKey('user_id'); // Index for user queries
        $this->forge->addKey('created_at'); // Index for date queries

        $this->forge->createTable('batch_jobs');
    }

    public function down()
    {
        $this->forge->dropTable('batch_jobs');
    }
}
