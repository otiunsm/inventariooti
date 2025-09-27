<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EstadoEquipoModel;

class EstadoEquipoController extends BaseController
{
    protected $estadoEquipo;

    public function __construct()
    {
        $this->estadoEquipo = new EstadoEquipoModel();
    }

    public function listarEstados()
    {
        $datos['estado_equipos'] = $this->estadoEquipo->obtenerEstado();

        return view('Catalogo/EstadoEquipos', $datos);
    }

    public function guardarEstado()
    {
        $this->estadoEquipo->save([
            'estado_equipo' => $this->request->getPost('estado_equipo'),
        ]);

        return redirect()->to(base_url('Catalogo/EstadoEquipos'))->with('mensaje', 'Estado Registrado correctamente');
    }

    public function editarEstado($id)
    {
        $this->estadoEquipo->update($id, [
            'estado_equipo' => $this->request->getPost('estado_equipo'),
        ]);

        return redirect()->to(base_url('Catalogo/EstadoEquipos'))->with('mensaje', 'Estado actualizado correctamente');

    }

    public function eliminarEstado($id)
    {
        $this->estadoEquipo->delete($id);

        return redirect()->to(base_url('Catalogo/EstadoEquipos'))->with('mensaje', 'Estado eliminado correctamente');
    }
}