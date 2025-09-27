<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnidadOrganicaModel;
use App\Models\LugarFisicoModel;

class DetalleUnidadController extends BaseController
{
    protected $unidadOrganica;
    protected $lugarFisico;

    public function __construct()
    {
        $this->unidadOrganica = new UnidadOrganicaModel();
        $this->lugarFisico = new LugarFisicoModel();
    }

    //Mostrar detalle de la unidad con sus lugares fisicos
    public function detalle($idUnidad)
    {
        $unidad = $this->unidadOrganica->find($idUnidad);
        $lugares = $this->lugarFisico->obtenerPorUnidad($idUnidad);

        if(!$unidad) {
            return redirect()->to(base_url('Catalogo/UnidadesOrganicasAcadem'))
                             ->with('error', 'Unidad no encontrada');
        }

        return view('Catalogo/DetalleUnidad', [
            'unidad' => $unidad,
            'lugares' => $lugares
        ]);
    }

    public function crearLugar($idUnidad)
    {
        $this->lugarFisico->save([
            'espacio_fisico' => $this->request->getPost('lugar_fisico'),
            'id_unidad_organica' => $idUnidad
        ]);

        return redirect()->to(base_url('DetalleUnidad/'.$idUnidad))
                         ->with('mensaje','Espacio físico agregado correctamente');
    }

    public function editarLugar($idUnidad, $idLugar)
    {
        $dato = [
            'espacio_fisico' => $this->request->getPost('lugar_fisico'),
        ];

        $this->lugarFisico->update($idLugar, $dato);

        return redirect()->to(base_url('DetalleUnidad/'.$idUnidad))
                         ->with('mensaje','Espacio físico actualizado correctamente');
    }

    public function eliminarLugar($idUnidad, $idLugar)
    {
        $this->lugarFisico->delete($idLugar);

        return redirect()->to(base_url('DetalleUnidad/' .$idUnidad))
                        ->with('mensaje', 'Espacio físico eliminado correctamente');
    }
}