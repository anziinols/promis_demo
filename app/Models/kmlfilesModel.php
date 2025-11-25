<?php namespace App\Models;

use CodeIgniter\Model;

class kmlfilesModel extends Model
{
    protected $table = 'kmlfiles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['proucode', 'name', 'filepath', 'create_at', 'create_by', 'status', 'orgcode', 'procode'];
}
