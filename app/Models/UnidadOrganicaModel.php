<?php 

namespace App\Models;
use CodeIgniter\Model;

class UnidadOrganicaModel extends Model
{
    protected $table = 'unidad_organica';
    protected $primaryKey = 'id_unidad_organica'; // CORREGIDO
    protected $allowedFields = [
        'unidad_organica',
        'id_tipo_unidad_organica',
        'id_sede'
    ];

    // Administrativas
    public function obtenerAdministrativas()
{
    return $this->db->table('unidad_organica uo')
                ->select('
                    uo.id_unidad_organica,
                    uo.unidad_organica AS unidad,
                    tuo.tipo_unidad AS tipo,
                    s.sede AS sede,
                    s.id_sede
                ')
                ->join('tipo_unidad_organica tuo','tuo.id_tipo_unidad = uo.id_tipo_unidad_organica')
                ->join('sede s','s.id_sede = uo.id_sede')
                ->where('uo.id_tipo_unidad_organica', 1)
                ->orderBy('uo.id_unidad_organica','DESC')
                ->get()
                ->getResultArray();
}


    // Académicas
    public function obtenerAcademicas()
    {
        return $this->db->table('unidad_organica uo')
                ->select('
                    uo.id_unidad_organica,
                    uo.unidad_organica AS unidad,
                    tuo.tipo_unidad AS tipo,
                    s.sede AS sede,
                    s.id_sede
                ')
                ->join('tipo_unidad_organica tuo','tuo.id_tipo_unidad = uo.id_tipo_unidad_organica')
                ->join('sede s','s.id_sede = uo.id_sede')
                ->where('uo.id_tipo_unidad_organica', 2)
                ->orderBy('uo.id_unidad_organica','DESC')
                ->get()
                ->getResultArray();
    }
}
