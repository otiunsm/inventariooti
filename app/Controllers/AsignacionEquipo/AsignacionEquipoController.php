<?php

namespace App\Controllers\AsignacionEquipo;

use App\Controllers\BaseController;
use App\Models\AsignacionEquipo\AsignacionEquipoModel;
use App\Models\EquipoModel;
use App\Models\UnidadOrganicaModel;

class AsignacionEquipoController extends BaseController
{
    protected $asignacionModel;
    protected $equipoModel;
    protected $unidadModel;

    public function __construct()
    {
        $this->asignacionModel = new AsignacionEquipoModel();
        $this->equipoModel = new EquipoModel();
        $this->unidadModel = new UnidadOrganicaModel();
    }

    public function listarAsignaciones()
    {
        $dato = [
            'asignaciones' => $this->asignacionModel->obtenerAsignaciones(),
            'equipos'      => $this->equipoModel->findAll(),
            'unidades'     => $this->unidadModel->findAll(),
        ];

        return view('ModAsignacion/asignaciones', $dato);
    }


    public function crearAsignacion()
    {
        $idEquipo = $this->request->getPost('id_equipo');
        $idUnidad = $this->request->getPost('id_unidad_organica');


        $dato = [
            'id_equipo'          => $this->request->getPost('id_equipo'),
            'id_unidad_organica' => $this->request->getPost('id_unidad_organica'),
            'fecha_asignacion'   => $this->request->getPost('fecha_asignacion'),
            'estado_asignacion'  => $this->request->getPost('estado_asignacion'),
            'created_by'         => session()->get('id_usuario'),
        ];

        // Evitar error de validación por fecha
        $this->asignacionModel->skipValidation(true)->insert($dato);

        // Actualizar unidad_actual en tabla equipos
        $this->equipoModel->update($idEquipo, [
            'unidad_actual' => $idUnidad
        ]);

        return redirect()->to(base_url('ModAsignacion/asignaciones'))
                         ->with('exito', 'Asignación creada correctamente');
    }

    public function editarAsignacion($id)
    {
        $dato = [
            'fecha_asignacion'  => $this->request->getPost('fecha_asignacion'),
            'estado_asignacion' => $this->request->getPost('estado_asignacion'),
        ];

        $this->asignacionModel->update($id, $dato);

        return redirect()->to(base_url('ModAsignacion/asignaciones'))
                         ->with('exito', 'Asignación actualizada correctamente');
    }
}
