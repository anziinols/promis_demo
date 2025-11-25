<?php

namespace App\Models;

use CodeIgniter\Model;

class wardModel extends Model
{
    protected $table = 'adx_ward';
    protected $primaryKey = 'id';
    protected $allowedFields = ['wardcode','name', 'country_id', 'province_id', 'district_id', 'llg_id'];
    protected $useAutoIncrement = true;
    protected $returnType = 'App\Entities\AdxWard';
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
