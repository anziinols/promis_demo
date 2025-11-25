<?php

namespace App\Models;

use CodeIgniter\Model;

class roadsModel extends Model
{
    protected $table = 'roads';
    protected $primaryKey = 'id';
    protected $allowedFields = ['roaducode', 'roadcode', 'name', 'description', 'country', 'province', 'district',
     'length', 'llg', 'ward', 'num_lanes', 'class', 'surface_type', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
}
