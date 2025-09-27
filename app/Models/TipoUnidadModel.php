<?php

namespace App\Models;
use CodeIgniter\Model;

class TipoUnidadModel extends Model
{
    protected $table = 'tipo_unidad_organica';
    protected $primaryKey = 'id_tipo_unidad';
    protected $allowedFields = ['tipo_unidad'];
}