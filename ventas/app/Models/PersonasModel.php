<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonasModel extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre',
        'paterno',
        'materno'
    ];

    protected $useTimestamps = false;
}