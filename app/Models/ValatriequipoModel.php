<?php
namespace App\Models;
use CodeIgniter\Model; 

class ValatriequipoModel extends Model
{
    protected $table = 'valor_atributo_equipo';
    protected $primaryKey = 'id_valor_atributo';
    protected $allowedFields = ['id_equipo', 'valor_atributo', 'id_atributo_equipo'];


    
    public function obtenerCaractEquipos($id_equipo)
    {
        return $this->db->table('valor_atributo_equipo vae')
            ->select('
                vae.id_valor_atributo,
                e.codig_patrimonial,
                e.num_serie,
                vae.valor_atributo,
                ae.equipo_atributo
            ')
            ->join('equipo e', 'e.id_equipo = vae.id_equipo')
            ->join('atributo_equipo ae', 'ae.id_atributo_equipo = vae.id_atributo_equipo')
            ->where('e.id_equipo', $id_equipo)
            ->get()
            ->getResultArray();
    }

}
