<?php
namespace App\Models;

use CodeIgniter\Model;

class EquipoModel extends Model
{
    protected $table = 'equipo';
    protected $primaryKey = 'id_equipo';

    protected $allowedFields = [
        'id_tipoEquipo',
        'id_estadoEquipo',
        'id_modeloEquipo',
        'id_unidadOrganicaEquipo'
    ];

    public function obtenerJoin()
    {
        return $this->db->table('equipo')
            ->select('
                equipo.id_equipo,
                tipo_equipo.nombre            AS tipo,
                estadoequipo.estado           AS estado,
                modelo.modelo                 AS modelo,
                unidad_organica.nombre        AS unidad
            ')
            ->join('tipo_equipo',      'tipo_equipo.id_tipo = equipo.id_tipoEquipo')
            ->join('estadoequipo',     'estadoequipo.id_estado = equipo.id_estadoEquipo')
            ->join('modelo',           'modelo.id_modelo = equipo.id_modeloEquipo')
            ->join('unidad_organica',  'unidad_organica.id_unidadOrganica = equipo.id_unidadOrganicaEquipo')
            ->get()
            ->getResultArray();
    }
}
