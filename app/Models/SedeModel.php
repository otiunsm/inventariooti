<?php 

namespace App\Models;
use CodeIgniter\Model;

class SedeModel extends Model
{
    protected $table = 'sede';
    protected $primaryKey = 'id_sede';
    protected $allowedFields = ['sede'];

    public function mostrarSede()
    {
        return $this->select('s.id_sede, s.sede')
                    ->from('sede s')
                    ->groupBy('id_sede')
                    ->orderBy('id_sede', 'DESC')
                    ->findAll();
    }
}