<?php

namespace App\Controllers\HistorialMovimiento;

use App\Controllers\BaseController;
use App\Models\HistorialMovimiento\HistorialMovimientoModel;

class HistorialMovimientoController extends BaseController
{
    public function index()
    {
        $model = new HistorialMovimientoModel();
        $dato['movimientos'] = $model->obtenerHistorial();

        return view('ModMovimientos/HistorialMovimientos', $dato);
    }
}