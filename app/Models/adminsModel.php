<?php namespace App\Models;

use CodeIgniter\Model;

class adminsModel extends Model
{
    protected $table      = 'admins';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ucode', 'username', 'password', 'name', 'status', 'create_at', 'create_by', 'update_at', 'update_by'];

    protected $useTimestamps = false;
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
?>