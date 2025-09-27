<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AtributoEquipoModel;
use App\Models\TipoEquipoModel;

class AtributoEquipoController extends BaseController
{
    protected $atributoEquipo;
    protected $tipoEquipo;

    public function __construct()
    {
        $this->atributoEquipo = new AtributoEquipoModel();
        $this->tipoEquipo = new TipoEquipoModel();
        
    }

    public function listarCaract()
    {

        $datos['atributo_equipo'] = $this->atributoEquipo->obtenerAtributoTipo();
        $datos['tipo_equipo'] = $this->tipoEquipo->findall();

        return view('Catalogo/AtributoEquipos', $datos);
    }

    public function guardarCaract()
    {
        $this->atributoEquipo->save([
            'equipo_atributo' => $this->request->getPost('caract_equipo'),
            'id_tipo_equipo'     => $this->request->getPost('tipo_equipo'),
        ]);
        return redirect()->to(base_url('Catalogo/AtributoEquipos'))->with('mensaje','Caracteristica guarda correctamente');
    }

    public function editarCaract($id)
    {
        $this->atributoEquipo->update($id, [
            'equipo_atributo' =>$this->request->getPost('atributo_equipo'),
            'id_tipo_equipo'  =>$this->request->getPost('id_tipo_equipo'),
        ]);

        return redirect()->to(base_url('Catalogo/AtributoEquipos'))->with('mensaje', 'Caracteristica actualizada correctamente');

    }

    public function eliminarCaract($id)
    {
        $this->atributoEquipo->delete($id);

        return redirect()->to(base_url('Catalogo/AtributoEquipos'))->with('mensaje', 'Caracteristica eliminada correctamente');
    }
}