<?php

namespace App\Models;

use CodeIgniter\Model;

class MarcaEquipoModel extends Model
{
    protected $table = 'marca_equipo';
    protected $primaryKey = 'id_marca_equipo';

    protected $allowedFields = ['marca_equipo'];

    public function obtenerMarcas()
    {
        return $this->select('me.id_marca_equipo, me.marca_equipo')
                    ->from('marca_equipo me')
                    ->groupBy('id_marca_equipo')
                    ->orderBy('id_marca_equipo', 'DESC')
                    ->findAll();
    }

}