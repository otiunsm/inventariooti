<?php
namespace App\Models;
use CodeIgniter\Model;

class AsignacionEquipoModel extends Model
{
    protected $table = 'asignacion_equipo';
    protected $primaryKey = 'id_asignacion';
    protected $allowedFields = [
        'id_equipo',
        'id_unidad_organica',
        'fecha_asignacion',
        'estado_asignacion'
    ];

    // Listar asignaciones administrativas
    public function getEquipoAsignadosAdmin()
    {
        return $this->db->table($this->table . ' ae')
            ->select("
                ae.id_asignacion AS Id_asignacion,
                e.codig_patrimonial AS codigoPatrimonial,
                uo.unidad_organica AS unidadDestino,
                ae.fecha_asignacion AS fecha,
                ae.estado_asignacion AS estado
            ")
            ->join('equipo e', 'e.id_equipo = ae.id_equipo')
            ->join('unidad_organica uo', 'uo.id_unidad_organica = ae.id_unidad_organica')
            ->where('uo.id_tipo_unidad_organica', 1) // Administrativas
            ->orderBy('ae.id_asignacion', 'DESC')
            ->get()
            ->getResultArray();
    }

    // Listar asignaciones académicas
    public function getEquipoAsignadosAcadem()
    {
        return $this->db->table($this->table . ' ae')
            ->select("
                ae.id_asignacion AS Id_asignacion,
                e.codig_patrimonial AS codigoPatrimonial,
                uo.unidad_organica AS unidadDestino,
                ae.fecha_asignacion AS fecha,
                ae.estado_asignacion AS estado
            ")
            ->join('equipo e', 'e.id_equipo = ae.id_equipo')
            ->join('unidad_organica uo', 'uo.id_unidad_organica = ae.id_unidad_organica')
            ->where('uo.id_tipo_unidad_organica', 2) // Académicas
            ->orderBy('ae.id_asignacion', 'DESC')
            ->get()
            ->getResultArray();
    }
}

    
