<?php
namespace App\Controllers;

use App\Models\EquipoModel;
use App\Models\TipoEquipoModel;
use App\Models\ModeloEquipoModel;
use App\Models\EstadoEquipoModel;
use App\Models\MarcaEquipoModel;

class GestionEquipoController extends BaseController
{
    protected $equipoModel;
    protected $tipoModel;
    protected $marcaModel;
    protected $modeloModel;
    protected $estadoModel;

    public function __construct()
    {
        $this->equipoModel  = new EquipoModel();
        $this->tipoModel    = new TipoEquipoModel();
        $this->marcaModel   = new MarcaEquipoModel();
        $this->modeloModel  = new ModeloEquipoModel();
        $this->estadoModel  = new EstadoEquipoModel();
    }

    /** 📌 Listar */
    public function index()
    {
        $data = [
            'titulo'  => 'Lista de Equipos',
            'equipos' => $this->equipoModel->obtenerEquipos(),
            'tipos'   => $this->tipoModel->findAll(),
            'marcas'  => $this->marcaModel->findAll(),
            'modelos' => $this->modeloModel->findAll(),
            'estados' => $this->estadoModel->findAll(),
        ];

        return view('GestionEquipos', $data);
    }

    public function obtenerModelosPorMarca($idMarca = null)
    {
        if ($idMarca === null || !is_numeric($idMarca)) {
            return $this->response->setStatusCode(400)->setJSON([]);
        }


        $modelos = $this->modeloModel 
            ->where('id_marca_equipo',$idMarca)
            ->findAll();
        
        return $this->response->setJSON($modelos);
    }

    /** 📌 Crear */
    public function crear()
    {
        $reglas = [
            'codig_patrimonial' => [
                'rules' => 'required|is_unique[equipo.codig_patrimonial]',
                'errors' => [
                    'required' => 'El numero de codigo patrimonial debe ser obligatorio',
                    'is_unique' => 'El número de codigo patrimonial ya existe'
                ]
            ],
            'num_serie'         => [
                'rules' => 'required|is_unique[equipo.num_serie]',
                'errors' => [
                    'required' => 'El numero de serie debe ser obligatorio',
                    'is_unique' => 'El número de serie ya existe'
                ]
            ],
            'id_tipo_equipo'    => 'required',
            'id_modelo_equipo'  => 'required',
            'id_estado_equipo'  => 'required',
        ];

        if (!$this->validate($reglas)) {
            //devolvera a la vista con errores
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())
                             ->with('showModal', 'crear');
                    
        }

        $data = [
            'codig_patrimonial' => $this->request->getPost('codig_patrimonial'),
            'num_serie'         => $this->request->getPost('num_serie'),
            'id_tipo_equipo'    => $this->request->getPost('id_tipo_equipo'),
            'id_modelo_equipo'  => $this->request->getPost('id_modelo_equipo'),
            'id_estado_equipo'  => $this->request->getPost('id_estado_equipo'),

            //
        ];

        $this->equipoModel->insert($data);

        return redirect()->to(base_url('GestionEquipos'));
    }

    /** 📌 Editar */
    public function editar($id)
    {

        $reglas = [
            'codig_patrimonial' => [
                'rules' => "required|is_unique[equipo.codig_patrimonial,id_equipo,{$id}]",
                'errors' => [
                    'required' => 'El número de código patrimonial es obligatorio',
                    'is_unique' => 'El número de código patrimonial ya existe'
                ]
            ],
            'num_serie' => [
                'rules' => "required|is_unique[equipo.num_serie,id_equipo,{$id}]",
                'errors' => [
                    'required' => 'El número de serie es obligatorio',
                    'is_unique' => 'El número de serie ya existe'
                ]
            ],
            'id_tipo_equipo'   => 'required',
            'id_modelo_equipo' => 'required',
            'id_estado_equipo' => 'required',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())
                             ->with('showModal', 'editar-' . $id);
        }


        $data = [
            'codig_patrimonial' => $this->request->getPost('codig_patrimonial'),
            'num_serie'         => $this->request->getPost('num_serie'),
            'id_tipo_equipo'    => $this->request->getPost('id_tipo_equipo'),
            'id_modelo_equipo'  => $this->request->getPost('id_modelo_equipo'),
            'id_estado_equipo'  => $this->request->getPost('id_estado_equipo'),
        ];

        $this->equipoModel->update($id, $data);

        return redirect()->to(base_url('GestionEquipos'));
    }

    /** 📌 Eliminar */
    public function eliminar($id)
    {
        $this->equipoModel->delete($id);

        return redirect()->to(base_url('GestionEquipos'));
    }
}

