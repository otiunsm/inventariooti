<?php

namespace App\Models;
use CodeIgniter\Model;

class EstadoEquipoModel extends Model
{
    protected $table = 'estado_equipo';
    protected $primaryKey = 'id_estado_equipo';
    protected $allowedFields = ['estado_equipo'];

    public function obtenerEstado()
    {
        return $this->select(
            'se.id_estado_equipo,se.estado_equipo')
                    ->from('estado_equipo se')
                    ->groupBy('id_estado_equipo')
                    ->orderBy('id_estado_equipo','DESC')
                    ->findAll();
    }

}
