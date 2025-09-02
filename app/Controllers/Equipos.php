<?php 
namespace App\Controllers;

use App\Models\EquipoModel;
use App\Models\TipoEquipoModelo;
use App\Models\ModeloEquipo;
use CodeIgniter\Controller;

class Equipos extends Controller
{
    private function cargarListasSelect(): array
    {
        $db = \Config\Database::connect();

        return [
            'tipos'    => $db->table('tipo_equipo')->select('id_tipo, nombre')->get()->getResultArray(),
            'estados'  => $db->table('estadoequipo')->select('id_estado, estado')->get()->getResultArray(),
            'modelos'  => $db->table('modelo')->select('id_modelo, modelo')->get()->getResultArray(),
            'unidades' => $db->table('unidad_organica')->select('id_unidadOrganica, nombre')->get()->getResultArray(),
        ];
    }

    public function index()
    {
        $modelo = new EquipoModel();

        $data = [
            'equipos'      => $modelo->obtenerJoin(),   // muestra nombres
            'equipoEditar' => null,                      // formulario vacío
        ] + $this->cargarListasSelect();               // 👈 agrega $tipos, $estados, $modelos, $unidades

        return view('equipos/index', $data);
    }

    public function guardar()
    {
        $modelo = new EquipoModel();
        $tipoModelo = new TipoEquipoModelo();
        $modeloModelo = new ModeloEquipo();

        $idTipo = $this->request->getPost('id_tipoEquipo');
        $idModelo = $this->request->getPost('id_modeloEquipo');
        //si se elige nuevo, insertamos en tipo_equipo

        if ($idTipo === 'nuevo') {
            $nuevoTipo = $this->request->getPost('nuevo_tipo');
            $idTipo = $tipoModelo->insert(['nombre' => $nuevoTipo]);
        }

        if ($idModelo === 'nuevo') {
            $nuevoModelo = $this->request->getPost('nuevo_modelo');
            $idModelo = $modeloModelo->insert(['modelo' => $nuevoModelo]);
        }

        $data = [
            'id_tipoEquipo'           => $idTipo,
            'id_estadoEquipo'         => $this->request->getPost('id_estadoEquipo'),
            'id_modeloEquipo'         => $this->request->getPost('id_modeloEquipo'),
            'id_unidadOrganicaEquipo' => $this->request->getPost('id_unidadOrganicaEquipo'),
        ];

        $modelo->insert($data);
        return redirect()->to(base_url('equipos'));
    }

    public function editar($id)
    {
        $modelo = new EquipoModel();
        $equipo = $modelo->find($id);

        if (!$equipo) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Equipo no encontrado');
        }

        $data = [
            'equipos'      => $modelo->obtenerJoin(),
            'equipoEditar' => $equipo,                   // carga datos en el form
        ] + $this->cargarListasSelect();

        return view('equipos/index', $data);
    }

    public function actualizar($id)
    {
        $modelo = new EquipoModel();

        $data = [
            'id_tipoEquipo'           => $this->request->getPost('id_tipoEquipo'),
            'id_estadoEquipo'         => $this->request->getPost('id_estadoEquipo'),
            'id_modeloEquipo'         => $this->request->getPost('id_modeloEquipo'),
            'id_unidadOrganicaEquipo' => $this->request->getPost('id_unidadOrganicaEquipo'),
        ];

        $modelo->update($id, $data);
        return redirect()->to(base_url('equipos'));
    }

    public function eliminar($id)
    {
        $modelo = new EquipoModel();
        $modelo->delete($id);
        return redirect()->to(base_url('equipos'));
    }
}
