<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SedeModel;

class SedeController extends BaseController 
{
    protected $Sedes;

    public function __construct()
    {
        $this->Sedes = new SedeModel();
    }

    public function listarSedes()
    {
       $datos['sedes'] = $this->Sedes->mostrarSede();
       return view('Catalogo/Sedes', $datos);
    }

    public function crearSedes()
    {
        $reglas = [
            'sede' => [
                'rules' => 'required|is_unique[sede.sede]',
                'errors' => [
                    'required' => 'El nombre de la sede debe ser obligatoria',
                    'is_unique' => 'El nombre de la sede ya existe'
                ]
            ]
        ];

        if(!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())
                             ->with('showModal', 'crear');
        }

        $this->Sedes->save([
            'sede' =>$this->request->getPost('sede')
        ]);

        return redirect()->to(base_url('Catalogo/Sedes'))->with('mensaje', 'Sede guardado correctamente');
    }

    public function editarSede($id)
    {
        $this->Sedes->update($id, [
            'sede' =>$this->request->getPost('sede')
        ]);

        return redirect()->to(base_url('Catalogo/Sedes'))->with('mensaje', 'Sede actualizada correctamente');
    }

    public function eliminarSede($id)
    {
        $this->Sedes->delete($id);

        return redirect()->to(base_url('Catalogo/Sedes'))->with('mensaje', 'Sede eliminada correctamente');

    }
}