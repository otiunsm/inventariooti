<?php

namespace App\Controllers;

use App\Models\AsignacionEquipoModel;

class AequipoAcadem extends BaseController
{
    public function index()
    {
        $asignacionEquipoModel = new AsignacionEquipoModel();
        $asignaciones = $asignacionEquipoModel->getEquipoAsignadosAcadem();

        return view('AequiAcademico', [
                    'titulo' => 'Asignación - Unidades Academicas',
                    'asignaciones' => $asignaciones
        ]);
    }
}