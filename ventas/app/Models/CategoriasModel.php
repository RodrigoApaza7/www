<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriasModel extends Model
{
    protected $useTimestamps = false;
    protected $table = 'categorias';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre',
        'estado'
    ];

    protected $returnType = 'array';
}