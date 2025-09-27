<?php 
namespace App\Controllers;

use App\Models\EquipoModel;
use App\Models\ValatriequipoModel;
use App\Models\AtributoEquipoModel;

class ValatriEquipoController extends BaseController
{

    public function detalle($id_equipo) {
        $valatriequipoModel = new ValatriequipoModel();
        $atributoModel = new AtributoEquipoModel();
        $equipoModel = new EquipoModel();
    
        $equipo = $equipoModel->obtenerConTipo($id_equipo);
        $atributos = $atributoModel->atributoPorTipo($equipo['id_tipo_equipo']);
        $caracteristicas = $valatriequipoModel->obtenerCaractEquipos($id_equipo);

        return view('DetalleEquipos', [
            'equipo' => $equipo,
            'atributos' => $atributos,
            'caracteristicas' => $caracteristicas,
            'id_equipo' => $id_equipo,
        ]);
    }

    public function agregarCaract()
    {
        $atributoModelo = new AtributoEquipoModel();
        $valorModelo = new ValatriequipoModel();

        $idEquipo = $this->request->getPost('id_equipo');
        $idAtributo = $this->request->getPost('id_atributo_equipo');
        $valor = $this->request->getPost('valor_atributo');

        //Validacion basica
        if (empty($idEquipo) || empty($idAtributo) || empty($valor)) {
            return redirect()->back()->with('error', 'Todos los campos son obligatorios');
        }

        // validar el duplicado por equipo + atributo + valor
        $existe = $valorModelo->where('id_equipo',$idEquipo)
                              ->where('id_atributo_equipo',$idAtributo)
                              ->first();

        if ($existe) {
            $valorModelo->update($existe['id_valor_atributo'],['valor_atributo' => $valor]);
            return redirect()
                ->to(base_url('DetalleEquipos/'.$idEquipo))
                ->with('Exito', 'Fue actualizado correctamente');
        } else {

            $valorModelo->insert([
                'id_equipo' => $idEquipo,
                'id_atributo_equipo' => $idAtributo,
                'valor_atributo' => $valor
            ]);

            return redirect()
            ->to(base_url('DetalleEquipos/'.$idEquipo))
            ->with('Exito', 'Caracteristica agregada correctamente');
        }

        // Insertar el valor y atributo para ese equipo
        $valorModelo->insert([
            'id_equipo' => $idEquipo,
            'id_atributo_equipo' => $idAtributo,
            'valor_atributo' => $valor
        ]);

        return redirect()
            ->to(base_url('DetalleEquipos/'.$idEquipo))
            ->with('Exito', 'Caracteristicas agregada correctamente. ');

    }

    public function eliminarCaract($id_valor_atributo, $id_equipo)
    {
        $valorEquipoModelo = new ValatriEquipoModel();

        //Para eliminar un registro
        $valorEquipoModelo->delete($id_valor_atributo);

        return redirect()
            ->to(base_url('DetalleEquipos/'.$id_equipo))
            ->with('Exito', 'Caracteristica eliminada correctamente');
    }
}
