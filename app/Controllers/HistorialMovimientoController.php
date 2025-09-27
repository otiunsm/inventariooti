<?php 

namespace App\Controllers;

use App\Models\HistorialMovimientoModel;

class HistorialMovimientoController extends BaseController
{
    public function index()
    {
        $modelo = new HistorialMovimientoModel();

        //Traer los movimientos
        $dato['movimientos'] = $modelo
            ->from('historial_movimiento hm')
            ->select('hm.*, ae.id_asignacion')
            ->join('asignacion_equipo ae', 'ae.id_asignacion = hm.id_asignacion')
            ->join('unidad_organica uo', 'uo.id_unidad_organica = hm.id_unidad_origen')
            ->join('unidad_organica uod', 'uod.id_unidad_organica = hm.id_unidad_destino')
            ->join('usuario us',' us.id_usuario = hm.id_usuario')
            ->findAll();

        return view('HistorialMovimiento', $dato);
    }
}

