<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table      = 'ventas';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_usuario',
        'id_cliente',
        'total',
        'fecha'
    ];

    protected $returnType = 'array';
}