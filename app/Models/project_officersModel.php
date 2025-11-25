<?php namespace App\Models;

use CodeIgniter\Model;

class project_officersModel extends Model
{
    protected $table      = 'project_officers';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ucode','pocode','orgcode','name', 'username', 'password',
    'status','create_by', 'update_by'];

    protected $useTimestamps = false;
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
