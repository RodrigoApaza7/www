<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $useAutoIncrement = true;
    protected $table      = 'productos';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre',
        'precio',
        'stock',
        'categoria_id',
        'estado'
    ];

    protected $returnType = 'array';
}