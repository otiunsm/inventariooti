<?php
namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    // Muestra el formulario de login
    public function login()
    {
        return view('login'); // Tu login.php
    }

    // Valida usuario y contraseña
    public function validar()
    {
        $session = session();

        // Obtener datos del formulario
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('contrasena');

        // Instanciar modelo
        $usuarioModel = new UsuarioModel();

        // Buscar usuario en la base de datos
        $user = $usuarioModel->where('usuario', $usuario)->first();

        // Verificar si existe usuario
        if($user) {
            // Comparar contraseña ingresada con hash de BD
            if(password_verify($password, $user['contrasena'])) {
                // Guardar datos en sesión
                $session->set([
                    'id_usuario' => $user['id_usuario'],
                    'usuario' => $user['usuario'],
                    'logged_in' => true
                ]);

                return redirect()->to('dashboard');
            } else {
                // Contraseña incorrecta
                $session->setFlashdata('error', 'Contraseña incorrecta');
                return redirect()->back();
            }
        } else {
            // Usuario no encontrado
            $session->setFlashdata('error', 'Usuario no encontrado');
            return redirect()->back();
        }
    }

    // Cierra sesión
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
