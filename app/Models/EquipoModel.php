<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipoModel extends Model
{
    protected $table = 'equipo'; //nombre tabla
    protected $primaryKey = 'id_equipo'; //clave primaria
    protected $allowedFields = ['id_tipoEquipo', 'id_estadoEquipo', 'id_modeloEquipo', 'id_unidadOrganicaEquipo'];
}

