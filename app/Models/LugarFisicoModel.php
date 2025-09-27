<?php
namespace App\Models;

use CodeIgniter\Model;

class LugarFisicoModel extends Model
{
    protected $table = 'lugar_fisico';
    protected $primaryKey = 'id_lugar';
    protected $allowedFields = ['espacio_fisico','id_unidad_organica'];

    public function obtenerPorUnidad($idUnidad)
    {
        return $this->db->table('lugar_fisico lf')
                        ->select('
                            lf.id_lugar,
                            lf.espacio_fisico,
                            uo.unidad_organica
                        ')
                        ->join('unidad_organica uo','uo.id_unidad_organica = lf.id_unidad_organica')
                        ->where('lf.id_unidad_organica',$idUnidad)
                        ->orderBy('lf.id_lugar','DESC')
                        ->get()
                        ->getResultArray();
    }
}