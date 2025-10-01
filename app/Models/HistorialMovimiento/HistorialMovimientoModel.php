<?php 
namespace App\Models\HistorialMovimiento;

use CodeIgniter\Model;

class HistorialMovimientoModel extends Model 
{
    protected $table = 'historial_movimiento';
    protected $primaryKey = 'id_historial_movimiento';
    protected $allowedFields = [
        'id_asignacion',
        'id_unidad_origen',
        'id_unidad_destino',
        'fecha_movimiento',
        'id_usuario',
        'motivo',
        'created_at','updated_at','created_by','updated_by','deleted_at','deleted_by'
    ];

    // Activacion de timestamps automaticos 
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $useSoftDeletes = true;

    protected $dateFormat = 'datetime';

    /**obtener asignacion con join (para mostrar nombres y no IDS) 
    */

    public function obtenerHistorial()
    {
        $builder = $this->db->table('historial_movimiento hm');
        $builder->select("
            hm.id_historial_movimiento, ae.id_asignacion, eq.codig_patrimonial, uoo.unidad_organica AS origen,
            uod.unidad_organica AS destino, hm.fecha_movimiento, u.nombre, hm.motivo,
            hm.created_at, hm.updated_at, hm.deleted_at,
            us.nombre AS Creado_por, usu.nombre AS Actualizado_por, usua.nombre AS Eliminado_por
        ");
        $builder->join('asignacion_equipo ae','ae.id_asignacion = hm.id_asignacion');
        $builder->join('equipo eq', 'eq.id_equipo = ae.id_equipo');
        $builder->join('unidad_organica uoo','uoo.id_unidad_organica = hm.id_unidad_origen','left');
        $builder->join('unidad_organica uod','uod.id_unidad_organica = hm.id_unidad_destino');
        $builder->join('usuario u','u.id_usuario = hm.id_usuario');
        $builder->join('usuario us','us.id_usuario = hm.created_by');
        $builder->join('usuario usu','usu.id_usuario = hm.updated_by','left');
        $builder->join('usuario usua','usua.id_usuario = hm.deleted_by','left');

        $builder->orderBy('hm.fecha_movimiento', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}