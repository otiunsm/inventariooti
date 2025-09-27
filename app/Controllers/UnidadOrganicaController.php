<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnidadOrganicaModel;
use App\Models\SedeModel;
use App\Models\TipoUnidadModel;

class UnidadOrganicaController extends BaseController 
{
    protected $unidadOrganica;
    protected $tipoUnidad;
    protected $sedeUnidad;

    public function __construct()
    {
        $this->unidadOrganica = new UnidadOrganicaModel();
        $this->tipoUnidad = new TipoUnidadModel();
        $this->sedeUnidad = new SedeModel();
    }

    // Administrativas
    public function listarUnidadesAdmin()
    {
        $dato['unidad_organica'] = $this->unidadOrganica->obtenerAdministrativas();
        $dato['tipo_unidad'] = $this->tipoUnidad->findAll();
        $dato['sede_unidad'] = $this->sedeUnidad->findAll();
        $dato['titulo'] = "Unidades Orgánicas Administrativas";
        
        return view('Catalogo/UnidadesOrganicasAdmin', $dato);
    }

    public function crearUnidadesAdmin()
    {
        $this->unidadOrganica->save([
            'unidad_organica' => $this->request->getPost('unidad_organica'),
            'id_tipo_unidad_organica' => 1,
            'id_sede' => $this->request->getPost('id_sede'),
        ]);

        return redirect()->to(base_url('Catalogo/UnidadesOrganicasAdmin'))
                         ->with('mensaje', 'Unidad guardada correctamente');
    }

    public function editarUnidadesAdmin($id)
    {
        $this->unidadOrganica->update($id, [
            'unidad_organica' => $this->request->getPost('unidad_organica'),
            'id_tipo_unidad_organica' => 1,
            'id_sede' => $this->request->getPost('sede')
        ]);

        return redirect()->to(base_url('Catalogo/UnidadesOrganicasAdmin'))
                         ->with('mensaje', 'Unidad actualizada correctamente');
    }

    public function eliminarUnidadesAdmin($id)
    {
        $this->unidadOrganica->delete($id);

        return redirect()->to(base_url('Catalogo/UnidadesOrganicasAdmin'))->with('mensaje','Unidad eliminada correctamente');
    }


    // Académicas 
    public function listarUnidadesAcadem()
    {
        $dato['unidad_organica'] = $this->unidadOrganica->obtenerAcademicas();
        $dato['tipo_unidad'] = $this->tipoUnidad->findAll();
        $dato['sede_unidad'] = $this->sedeUnidad->findAll();
        $dato['titulo'] = "Unidades Orgánicas Académicas";

        return view('Catalogo/UnidadesOrganicasAcadem', $dato);
    }

    public function crearUnidadesAcadem()
    {
        $this->unidadOrganica->save([
            'unidad_organica' => $this->request->getPost('unidad_organica'),
            'id_tipo_unidad_organica' => 2,
            'id_sede' => $this->request->getPost('id_sede'),
        ]);

        return redirect()->to(base_url('Catalogo/UnidadesOrganicasAcadem'))
                         ->with('mensaje', 'Unidad guardada correctamente');
    }

    public function editarUnidadesAcadem($id)
    {
        $this->unidadOrganica->update($id, [
            'unidad_organica' => $this->request->getPost('unidad_organica'),
            'id_tipo_unidad_organica' => 2,
            'id_sede' => $this->request->getPost('sede')
        ]);

        return redirect()->to(base_url('Catalogo/UnidadesOrganicasAcadem'))
                         ->with('mensaje', 'Unidad actualizada correctamente');
    }

    public function eliminarUnidadesAcadem($id)
    {
        $this->unidadOrganica->delete($id);

        return redirect()->to(base_url('Catalogo/UnidadesOrganicasAcadem'))->with('mensaje','Unidad eliminada correctamente');
    }

    
}
