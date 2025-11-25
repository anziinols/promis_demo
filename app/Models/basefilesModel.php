<?php namespace App\Models;

use CodeIgniter\Model;

class basefilesModel extends Model
{
    protected $table = 'basefiles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kmlucode', 'name', 'filepath', 'create_at', 'create_by', 'status', 'road_id', 'road_code'];
}
