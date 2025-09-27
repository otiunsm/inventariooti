<?php
namespace App\Controllers;

use App\Models\AsignacionEquipoModel; 
use App\Models\EquipoModel; 
use App\Models\HistorialMovimientosModel;

class AequipoAdmin extends BaseController
{
    public function index()
    {
        $AsignacionEquipoModel = new AsignacionEquipoModel();
        $asignaciones = $AsignacionEquipoModel->getEquipoAsignadosAdmin();

        $db = db_connect();
        $unidades = $db->table('unidad_organica')
                       ->where('id_tipo_unidad_organica', 1)
                       ->get()->getResultArray();

        $equipos = (new EquipoModel())->findAll();

        return view('AequiAdministrativos', [
            'titulo' =>'Asignación - Unidades Administrativas',
            'asignaciones' => $asignaciones,
            'unidades' => $unidades,
            'equipos' => $equipos,
        ]);
    }

    public function guardarAsignacionAdmin()
    {
        $AsignacionEquipoModel = new AsignacionEquipoModel();
        $HistorialModel = new HistorialMovimientosModel();

        $datos = [
            'id_equipo' => $this->request->getPost('id_equipo'), 
            'id_unidad_organica' => $this->request->getPost('id_unidad_organica'),
            'fecha_asignacion' => $this->request->getPost('fecha'),
            'estado_asignacion' => $this->request->getPost('estado'),
        ];

        $id_asignacion = $AsignacionEquipoModel->insert($datos);

        $HistorialModel->insert([
            'id_asignacion' => $id_asignacion,
            'accion' => 'Agregar',
            'id_usuario' => session()->get('id_usuario') ?? 1,
            'detalles' => json_encode($datos)
        ]);

        return redirect()->to(base_url('AequiAdminis'))
                         ->with('Exito', '✅ Registro agregado correctamente y guardado en historial.');
    }

    public function actualizar($id_asignacion)
    {
        $AsignacionEquipoModel = new AsignacionEquipoModel();
        $HistorialModel = new HistorialMovimientosModel();

        $datos = [
            'id_equipo' => $this->request->getPost('id_equipo'),
            'id_unidad_organica' => $this->request->getPost('id_unidad_organica'),
            'fecha_asignacion' => $this->request->getPost('fecha'),
            'estado_asignacion' => $this->request->getPost('estado'),
        ];

        $HistorialModel->insert([
            'id_asignacion' => $id_asignacion,
            'accion' => 'Editar',
            'id_usuario' => session()->get('id_usuario') ?? 1,
            'detalles' => json_encode($datos)
        ]);

        $AsignacionEquipoModel->update($id_asignacion, $datos);

        return redirect()->to(base_url('AequiAdminis'))
                        ->with('Exito', '✅ Registro actualizado correctamente y guardado en historial.');
    }

    public function eliminar($id_asignacion)
    {
        $AsignacionEquipoModel = new AsignacionEquipoModel();
        $HistorialModel = new HistorialMovimientosModel();

        $HistorialModel->insert([
            'id_asignacion' => $id_asignacion,
            'accion' => 'Eliminar',
            'id_usuario' => session()->get('id_usuario') ?? 1,
            'detalles' => json_encode($AsignacionEquipoModel->find($id_asignacion))
        ]);

        $AsignacionEquipoModel->delete($id_asignacion);

        return redirect()->to(base_url('AequiAdminis'))
                        ->with('Exito', '✅ Registro eliminado correctamente y guardado en historial.');
    }
}

