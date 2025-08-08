<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ticket_id'                     => ['type' => 'BIGINT', 'unsigned' => true, 'null' => false],
            'subject'                        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'remark'                         => ['type' => 'TEXT', 'null' => true],
            'priority_id'                    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'priority_name'                  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'ticket_status_name'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'unit_id'                        => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'unit_name'                      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'informant_id'                   => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'informant_name'                 => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'informant_hp'                   => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'informant_email'                => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'customer_id'                    => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'customer_name'                  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'customer_hp'                    => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'customer_email'                 => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'date_origin_interaction'        => ['type' => 'DATETIME', 'null' => true],
            'date_start_interaction'         => ['type' => 'DATETIME', 'null' => true],
            'date_open'                      => ['type' => 'DATETIME', 'null' => true],
            'date_close'                     => ['type' => 'DATETIME', 'null' => true],
            'date_last_update'               => ['type' => 'DATETIME', 'null' => true],
            'is_escalated'                   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_by_name'                => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_by_name'                => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'channel_id'                     => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'session_id'                     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'category_id'                    => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'category_name'                  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'date_created_at'                => ['type' => 'DATETIME', 'null' => true],
            'sla'                            => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'channel_name'                   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'mainCategory'                   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'category'                       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'subCategory'                    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'detailSubCategory'              => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'detailSubCategory2'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'regional'                       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'type_queue_priority'            => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'group_id'                       => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'group_name'                     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'date_first_pickup_interaction'  => ['type' => 'DATETIME', 'null' => true],
            'status_case'                    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'indihome_num'                   => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'witel'                          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'feedback'                       => ['type' => 'TEXT', 'null' => true],
            'date_first_response_interaction'=> ['type' => 'DATETIME', 'null' => true],
            'date_pickup_interaction'        => ['type' => 'DATETIME', 'null' => true],
            'date_end_interaction'           => ['type' => 'DATETIME', 'null' => true],
            'case_in'                        => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'case_out'                       => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'account'                        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'account_name'                   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'informant_member_id'            => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'customer_member_id'             => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'shift'                          => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'status_date'                    => ['type' => 'DATETIME', 'null' => true],
            'sentiment_incoming'             => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'sentiment_outgoing'             => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'sentiment_all'                  => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'sentiment_service'              => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'parent_id'                      => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'count_merged'                   => ['type' => 'INT', 'null' => true],
            'source_id'                      => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'source_name'                    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'msisdn'                         => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'from_id'                        => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'from_username'                  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'ticket_id_digipos'              => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'ticket_Customer_Consent_'       => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'ticket_No_IndiHome_Alternatif'  => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'sla_second'                     => ['type' => 'INT', 'null' => true],
            'informant_1'                    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'informant_2'                    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'customer_1'                     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'customer_2'                     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'ticket_No_KTP'                  => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
        ]);

        $this->forge->addKey('ticket_id', true); // Primary Key
        $this->forge->createTable('tickets', true);
    }

    public function down()
    {
        $this->forge->dropTable('tickets', true);
    }
}
