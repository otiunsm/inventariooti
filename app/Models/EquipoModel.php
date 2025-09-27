<?php
namespace App\Models;

use CodeIgniter\Model;

class EquipoModel extends Model
{
    protected $table = 'equipo';
    protected $primaryKey = 'id_equipo';
    protected $allowedFields = [
        'id_tipo_equipo',
        'codig_patrimonial',
        'num_serie',
        'id_modelo_equipo',
        'id_estado_equipo'
    ];

    // ✅ Listar equipos con JOINs
    public function obtenerEquipos()
    {
        return $this->db->table($this->table . ' e')
            ->select('
                e.id_equipo AS Id,
                e.codig_patrimonial AS codigoPatrimonial,
                e.num_serie AS numeroSerie,
                te.tipo_equipo AS tipoEquipo,
                mae.marca_equipo AS marcaEquipo,
                me.modelo_equipo AS modeloEquipo,
                es.estado_equipo AS estadoEquipo,
                e.id_tipo_equipo,
                e.id_modelo_equipo,
                e.id_estado_equipo
            ')
            ->join('tipo_equipo te', 'te.id_tipo_equipo = e.id_tipo_equipo')
            ->join('modelo_equipo me', 'me.id_modelo_equipo = e.id_modelo_equipo')
            ->join('marca_equipo mae', 'mae.id_marca_equipo = me.id_marca_equipo')
            ->join('estado_equipo es', 'es.id_estado_equipo = e.id_estado_equipo')
            ->orderBy('e.id_equipo', 'DESC')
            ->get()
            ->getResultArray();
    }

    // ✅ Obtener un solo equipo
    public function obtenerEquipoPorId($id)
    {
        return $this->where('id_equipo', $id)->first();
    }

    public function obtenerConTipo($id_equipo)
    {
        return $this->db->table($this->table . ' e')
        ->select('e.*, te.tipo_equipo')
        ->join('tipo_equipo te', 'te.id_tipo_equipo = e.id_tipo_equipo')
        ->where('e.id_equipo', $id_equipo)
        ->get()
        ->getRowArray();
    }
}

