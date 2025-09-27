<?php
namespace App\Controllers;

use App\Models\TipoEquipoModel;

class TipoEquiposController extends BaseController
{
    public function index()
    {
        $TipoEquipoModel = new TipoEquipoModel();
        $datos['tipo_equipo'] = $TipoEquipoModel
        ->orderBy('id_tipo_equipo', 'DESC')
        ->findAll();

        return view('catalogo/TipoEquipos', $datos);
    }

    public function guardarTipoEquipo()
    {
        $tipoEquipoModel = new \App\Models\TipoEquipoModel();

        $tipo_equipo = $this->request->getPost('tipo_equipo');

        // Verificar si ya existe
        $existe = $tipoEquipoModel->where('tipo_equipo', $tipo_equipo)->first();

        if ($existe) {
            return redirect()->to(base_url('Catalogo/TipoEquipos'))
                ->with('error', 'El tipo de equipo ya existe');
        }

        $tipoEquipoModel->insert(['tipo_equipo' => $tipo_equipo]);

        return redirect()->to(base_url('Catalogo/TipoEquipos'))
            ->with('success', 'Tipo de equipo agregado correctamente');
    }

    public function editarTipoEquipo($idTipo)
    {
        $tipoEquipoModel = new TipoEquipoModel();

        $nuevoTipo = $this->request->getPost('tipo_equipo');

        if ($tipoEquipoModel->find($idTipo)) {
            $tipoEquipoModel->update($idTipo, ['tipo_equipo' => $nuevoTipo]);
            return redirect()->to(base_url('Catalogo/TipoEquipos'))->with('success', 'Tipo de equipo actualizado');
        }
        return redirect()->to(base_url('Catalogo/TipoEquipos'))->with('error', 'El tipo de equipo no existe');
        
    }

    public function eliminarTipoEquipo($idTipo)
    {
        $TipoEquipoModel = new TipoEquipoModel();

        if ($TipoEquipoModel->find($idTipo)) {
            $TipoEquipoModel->delete($idTipo);
            return redirect()->to(base_url('Catalogo/TipoEquipos'))->with('Exito', 'Tipo de equipo Eliminado');
        }

        return redirect()->to(base_url('Catalogo/TipoEquipos'))->with('Error', 'Tipo de equipo no existe');
    }

}
