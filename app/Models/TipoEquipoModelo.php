<?php
    namespace App\Models;

    use CodeIgniter\Model;

    class TipoEquipoModelo extends Model
    {
        protected $table = 'tipo_equipo';
        protected $primaryKey = 'id_tipo';
        protected $allowedFields = ['nombre'];
    }
?>