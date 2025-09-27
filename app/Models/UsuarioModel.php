<?php


namespace App\Models;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario'; //Nombre de la tabla en BD
    protected $primaryKey = 'id_usuario'; //Llave primaria
    protected $allowedFields = ['usuario', 'contrasena']; //Campos que se pueden insertar/actualizar
}