<?php 

namespace App\Models;

use CodeIgniter\Model;

class ModeloEquipoModel extends Model
{
    protected $table = 'modelo_equipo';
    protected $primaryKey = 'id_modelo_equipo';
    protected $returnType = 'array';
    protected $allowedFields = ['modelo_equipo','id_marca_equipo'];

    public function obtenerModeloMarcas() 
    {
        return $this->select('m.id_modelo_equipo, m.modelo_equipo, m.id_marca_equipo, me.marca_equipo AS marca')
                    ->from('modelo_equipo m')
                    ->join('marca_equipo me', 'me.id_marca_equipo = m.id_marca_equipo')
                    ->groupBy('id_modelo_equipo')
                    ->orderBy('id_modelo_equipo', 'DESC')
                    ->findAll();
    }

    
}
