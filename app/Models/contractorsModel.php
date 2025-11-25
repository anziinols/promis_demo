<?php

namespace App\Models;

use CodeIgniter\Model;

class contractorsModel extends Model
{
    protected $table  = 'contractor_details';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType  = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'ucode','concode', 'name','con_logo','category','services','ipanumber','ipadate','ipafile','ircnumber','ircfile','cocnumber',
        'cocfile','profiledate','file_profile', 'country', 'province', 'district','llg','phones','emails','address','weblinks', 
        'status', 'statusnotes', 'gps', 'lat', 'lon', 'create_by', 'create_org', 'update_by', 'update_org','notice_flag',
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
