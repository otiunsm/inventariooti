<?php

namespace App\Controllers;
use App\Models\UsuarioModel;

class Acceso extends BaseController
{
    public function index()
    {
        return view('acceso');
    }

    public function acceder()
    {
        $session = session();
        $usuarioModelo = new UsuarioModel();

        $usuario = $this->request->getPost('usuario');
        $contrasena = $this->request->getPost('contrasena');

        $datoUsuario = $usuarioModelo->where('usuario', $usuario)->first();

        if ($datoUsuario) {
            $pass = $datoUsuario['contrasena'];
            if (password_verify($contrasena, $pass)) {
                //crear sesión
                $session->set([
                    'idusuario' => $datoUsuario['id_usuario'],
                    'usuario' => $datoUsuario['usuario'],
                    'logged_in' => true       
                ]);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('Error', 'Contraseña incorrecta');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('Error', 'Usuario no encontrado');
            return redirect()->back();
        }
    }

    public function sinAcceder()
    {
        session()->destroy();
        return redirect()->to('/acceso');
    }

}