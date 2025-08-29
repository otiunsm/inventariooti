<?php
namespace App\Controllers;
use CodeIgniter\Controller;


class DashboardController extends Controller
{
    public function index()
    {
        //Solo deja pasar si el usuario esta logeado
        if (!session()->get('logged_in')) {
            return redirect()->to('/login'); //si no esta logueado, vuelve al login
        }
        helper('url');
        return view('dashboard'); //Muestra la vista dashboard.php
    }
}