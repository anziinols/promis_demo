<?php namespace App\Models;

use CodeIgniter\Model;

class selectionModel extends Model
{
    protected $table = 'selection';
    protected $primaryKey = 'id';
    protected $allowedFields = ['box', 'value', 'item'];
}
