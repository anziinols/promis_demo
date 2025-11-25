<?php namespace App\Models;

use CodeIgniter\Model;

class notificationsModel extends Model
{
    protected $table      = 'notifications';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'ucode', 'orgcode', 'title', 'message', 'recipient_type', 'recipient_po_id', 
        'recipient_po_name', 'status', 'is_read', 'priority', 'create_by', 'update_by'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

