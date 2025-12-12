<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre',
        'email',
        'password',
        'rol',
        'creado_en'
    ];

    protected $returnType = 'array';
}