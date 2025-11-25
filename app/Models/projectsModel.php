<?php

namespace App\Models;

use CodeIgniter\Model;

class projectsModel extends Model
{
    protected $table      = 'projects';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'ucode', 'procode', 'orgcode', 'name', 'pro_date', 'country', 'province', 'district', 'llg', 'pro_site', 'description', 'pro_update_at', 'pro_update_by',
        'status', 'statusnotes', 'status_at', 'status_by',
        'fund', 'budget', 'budget_at', 'budget_by', 'payment_total', 'payment_at', 'payment_by',
        'mapping', 'kmlfile', 'gps', 'lat', 'lon', 'gps_at', 'gps_by',
        'pro_officer_id', 'pro_officer_name', 'pro_officer_scope', 'pro_officer_at', 'pro_officer_by',
        'contractor_id', 'contractor_code', 'contractor_name', 'contract_file', 'contractor_at', 'contractor_by',
        'create_by', 'create_org', 'update_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
