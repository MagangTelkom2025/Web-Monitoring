<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table      = 'tickets';
    protected $primaryKey = 'ticket_id';
    protected $useAutoIncrement = false;
protected $returnType = 'array';
    protected $allowedFields = [
        'ticket_id', 'subject', 'remark', 'priority_id', 'priority_name', 'ticket_status_name',
        'unit_id', 'unit_name', 'informant_id', 'informant_name', 'informant_hp', 'informant_email',
        'customer_id', 'customer_name', 'customer_hp', 'customer_email', 'date_origin_interaction',
        'date_start_interaction', 'date_open', 'date_close', 'date_last_update', 'is_escalated',
        'created_by_name', 'updated_by_name', 'channel_id', 'session_id', 'category_id', 'category_name',
        'date_created_at', 'sla', 'channel_name', 'mainCategory', 'category', 'subCategory',
        'detailSubCategory', 'detailSubCategory2', 'regional', 'type_queue_priority', 'group_id',
        'group_name', 'date_first_pickup_interaction', 'status_case', 'indihome_num', 'witel',
        'feedback', 'date_first_response_interaction', 'date_pickup_interaction', 'date_end_interaction',
        'case_in', 'case_out', 'account', 'account_name', 'informant_member_id', 'customer_member_id',
        'shift', 'status_date', 'sentiment_incoming', 'sentiment_outgoing', 'sentiment_all',
        'sentiment_service', 'parent_id', 'count_merged', 'source_id', 'source_name', 'msisdn',
        'from_id', 'from_username', 'ticket_id_digipos', 'ticket_Customer_Consent_', 
        'ticket_No_IndiHome_Alternatif', 'sla_second', 'informant_1', 'informant_2', 'customer_1',
        'customer_2', 'ticket_No_KTP'
    ];
}
