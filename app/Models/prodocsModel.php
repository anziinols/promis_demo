<?php namespace App\Models;

use CodeIgniter\Model;

class prodocsModel extends Model
{
    protected $table      = 'project_files';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ucode','procode','orgcode','name', 'filepath',
    'create_by', 'update_by'];

    protected $useTimestamps = false;
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
