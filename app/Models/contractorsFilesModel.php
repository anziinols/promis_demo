<?php

namespace App\Models;

use CodeIgniter\Model;

class contractorsFilesModel extends Model
{
    protected $table  = 'contractor_files';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType  = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'ucode', 'concode', 'file_name', 'file_number', 'issued_date', 'expiry_date', 'file_path', 'create_at',
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
