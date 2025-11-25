<?php

namespace App\Models;

use CodeIgniter\Model;

class provinceModel extends Model
{
    protected $table = 'adx_province';
    protected $primaryKey = 'id';
    protected $allowedFields = ['provincecode','name', 'country_id'];
}
