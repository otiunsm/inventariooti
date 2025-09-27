<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModeloEquipoModel;
use App\Models\MarcaEquipoModel;

class ModeloEquipoController extends BaseController
{
    protected $modeloEquipo;

    public function __construct()
    {
        $this->modeloEquipo = new ModeloEquipoModel();
    }

    public function listarModelos()
    {
        $marcaEquipoModelo = new MarcaEquipoModel();
        $dato['marca_equipo'] = $marcaEquipoModelo->findAll();
        $dato['modelo_equipo'] = $this->modeloEquipo->obtenerModeloMarcas();
        return view('Catalogo/ModeloEquipos', $dato);
    }

    public function guardarModelos()
    {
        $this->modeloEquipo->save([
            'modelo_equipo' =>     $this->request->getPost('modelo_equipo'),
            'id_marca_equipo' =>   $this->request->getPost('id_marca_equipo'),
        ]);

        return redirect()->to(base_url('Catalogo/ModeloEquipos'))->with('mensaje', 'Modelo guardado correctamente');
    }

    public function editarModelos($id)
    {
        $this->modeloEquipo->update($id, [
            'modelo_equipo'    => $this->request->getPost('modelo_equipo'),
            'id_marca_equipo'  => $this->request->getPost('id_marca_equipo'),
        ]);

        return redirect()->to(base_url('Catalogo/ModeloEquipos'))->with('mensaje', 'Modelo actualizado correctamente');
    }

    public function eliminarModelos($id)
    {
        $this->modeloEquipo->delete($id);

        return redirect()->to(base_url('Catalogo/ModeloEquipos'))->with('mensaje', 'Modelo eliminado correctamente');
    }

    
}