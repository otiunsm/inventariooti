<?php 

namespace App\Models;
use CodeIgniter\Model;

class AtributoEquipoModel extends Model
{
    protected $table = 'atributo_equipo';
    protected $primaryKey = 'id_atributo_equipo';
    protected $allowedFields = ['equipo_atributo', 'id_tipo_equipo'];

    public function obtenerAtributoTipo()
    {
        return $this->select('
                ae.id_atributo_equipo,
                ae.equipo_atributo AS atributo,
                te.tipo_equipo AS tipo_equipo
            ')
            ->from('atributo_equipo ae')
            ->join('tipo_equipo te', 'te.id_tipo_equipo = ae.id_tipo_equipo')
            ->groupBy('id_atributo_equipo')
            ->orderBy('id_atributo_equipo','DESC')
            ->findAll();
    }

    public function atributoPorTipo($id_tipo_equipo)
    {
        return $this->where('id_tipo_equipo', $id_tipo_equipo)->findAll();
    }
}