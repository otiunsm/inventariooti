<?php

namespace App\Models\AsignacionEquipo;

use CodeIgniter\Model;

class AsignacionEquipoModel extends Model 
{
    protected $table = 'asignacion_equipo';
    protected $primaryKey = 'id_asignacion';
    protected $allowedFields = [
        'id_equipo',
        'id_unidad_organica',
        'fecha_asignacion',
        'estado_asignacion',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    // Activación de timestamps automáticos
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;

    protected $dateFormat = 'date'; // solo fecha, no datetime

    public function obtenerAsignaciones()
    {
        $builder = $this->db->table('asignacion_equipo ae');
        $builder->select("
            ae.id_asignacion,
            e.codig_patrimonial,
            uo.unidad_organica, 
            ae.fecha_asignacion,
            ae.estado_asignacion,
            ae.created_at, ae.updated_at, ae.deleted_at,
            u.nombre AS Creado_por, us.nombre AS Actualizado_por, usu.nombre AS Eliminado_por
        ");
        $builder->join('equipo e', 'e.id_equipo = ae.id_equipo');
        $builder->join('unidad_organica uo', 'uo.id_unidad_organica = ae.id_unidad_organica');
        $builder->join('usuario u', 'u.id_usuario = ae.created_by', 'left');
        $builder->join('usuario us', 'us.id_usuario = ae.updated_by', 'left');
        $builder->join('usuario usu', 'usu.id_usuario = ae.deleted_by', 'left');
        $builder->orderBy('ae.fecha_asignacion', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
