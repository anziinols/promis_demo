<?php

namespace App\Models;

use CodeIgniter\Model;

class contractorsNoticesModel extends Model
{
    protected $table  = 'contractor_notices';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType  = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'orgcode','ucode', 'concode', 'notice_flag', 'notice_title', 'notice_description', 'notice_date', 'file_path', 'create_at',
        'create_by', 'update_at', 'update_by', 'create_org', 'update_org', 'status', 'statusnotes'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
