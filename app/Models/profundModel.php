<?php namespace App\Models;

use CodeIgniter\Model;

class profundModel extends Model
{
    protected $table      = 'profund';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ucode','procode','orgcode','amount', 'paymentdate', 'description', 'filepath', 
    'create_by', 'update_by'];

    protected $useTimestamps = false;
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
