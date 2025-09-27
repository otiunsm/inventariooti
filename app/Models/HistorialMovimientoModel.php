<?php 

namespace App\Models;

use CodeIgniter\Model;

class HistorialMovimientoModel extends Model
{
    protected $table =      'historial_movimiento';
    protected $primaryKey = 'id_historial_movimiento';

    protected $allowedFields = [
        'id_asignacion',
        'id_unidad_origen',
        'id_unidad_destino',
        'fecha_movimiento',
        'id_usuario',
        'motivo'
    ];
}

