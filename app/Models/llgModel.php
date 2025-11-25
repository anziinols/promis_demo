<?php

namespace App\Models;

use CodeIgniter\Model;

class llgModel extends Model
{
    protected $table = 'adx_llg';
    protected $primaryKey = 'id';
    protected $allowedFields = ['llgcode','name', 'country_id', 'province_id', 'district_id'];
}
