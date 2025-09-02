<?php
namespace App\Models;

use CodeIgniter\Model;

class ModeloEquipo extends Model
{
    protected $table = 'modelo';
    protected $primaryKey = 'id_modelo';
    protected $allowedFields = ['modelo'];
}
?>