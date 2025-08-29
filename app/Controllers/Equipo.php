<?php 
namespace App\Controllers;

use App\Models\EquipoModel;

class Equipo extends BaseController
{
    public function index()
    {
        $equipoModel = new EquipoModel();
        $data['equipo'] = $equipoModel->findAll(); //Obtiene los registros

        return view('equipos/index', $data); //manda los datos a la vista
    }
}
