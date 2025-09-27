<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MarcaEquipoModel; 

class MarcaEquiposController extends BaseController
{
    protected $marcaEquipos;

    public function __construct()
    {
        $this->marcaEquipos = new MarcaEquipoModel();
    }

    public function listarMarcas()
    {
        $dato['marca_equipo'] = $this->marcaEquipos->obtenerMarcas();
        return view('Catalogo/MarcaEquipos', $dato);
    }

    public function guardarMarcas()
    {

        $reglas = [
            'marca_equipo' => [
                'rules' => 'required|is_unique[marca_equipo.marca_equipo]',
                'errors' => [
                    'required' => 'El nombre de la marca debe ser obligatoria',
                    'is_unique' => 'El nombre de la marca ya existe'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())
                             ->with('showModal', 'crear');
        }

        $this->marcaEquipos->save([
            'marca_equipo' => $this->request->getPost('marca_equipo')
        ]);

        return redirect()->to(base_url('Catalogo/MarcaEquipos'))->with('mensaje', 'Marca guardado correctamente');
    }

    public function editarMarcas($id)
    {
        $this->marcaEquipos->update($id, [
            'marca_equipo' => $this->request->getPost('marca_equipo')
        ]);

        return redirect()->to(base_url('Catalogo/MarcaEquipos'))->with('mensaje', 'Marca actualizado correctamente');
    }

    public function eliminarMarcas($id)
    {
        $this->marcaEquipos->delete($id);

        return redirect()->to(base_url('Catalogo/MarcaEquipos'))->with('mensaje', 'Marca eliminada correctamente');
    }


}