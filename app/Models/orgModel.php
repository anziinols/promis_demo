<?php namespace App\Models;

use CodeIgniter\Model;

class orgModel extends Model
{
    protected $table      = 'dakoii_org';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['orgcode', 'name', 'description', 'loc_level_locked', 'loc_code_locked','loc_name_locked', 'orglogo','is_locationlocked', 
            'country_code', 'province_code','district_code', 'llg_code', 'country_name', 'province_name','district_name', 'llg_name', 
            'center_gps_zoom', 'center_gps_longitude', 'center_gps_latitude','address','phones','emails',
            'is_active','create_by','update_by'];

    protected $useTimestamps = true;
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
