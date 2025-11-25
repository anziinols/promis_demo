<?php namespace App\Models;

use CodeIgniter\Model;

class districtModel extends Model
{
    protected $table = 'adx_district';
    protected $primaryKey = 'id';
    protected $allowedFields = ['districtcode','name', 'country_id', 'province_id'];

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $validationRules = [
        'name' => 'required',
        'country_id' => 'required',
        'province_id' => 'required'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
}
