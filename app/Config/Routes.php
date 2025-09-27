<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Acceso::index');
$routes->get('/acceso', 'Acceso::index');
$routes->post('/acceso', 'Acceso::acceder');
$routes->get('/dashboard', 'Dashboard::index');


$routes->get('AequiAdminis', 'AequipoAdmin::index');
$routes->post('AequiAdminis', 'AequipoAdmin::guardarAsignacionAdmin');
$routes->get('AequiAdminis/editar/(:num)', 'AequipoAdmin::editar/$1');
$routes->post('AequiAdminis/actualizar/(:num)', 'AequipoAdmin::actualizar/$1');
$routes->get('AequiAdminis/eliminar/(:num)', 'AequipoAdmin::eliminar/$1');

$routes->get('AequiAcademi', 'AequipoAcadem::index');


/** Modulo gestion de equipos */
$routes->get('GestionEquipos', 'GestionEquipoController::index');
$routes->post('GestionEquipos/crear', 'GestionEquipoController::crear');
$routes->post('GestionEquipos/editar/(:num)', 'GestionEquipoController::editar/$1');
$routes->get('GestionEquipos/eliminar/(:num)', 'GestionEquipoController::eliminar/$1');

//para obtener los modelos por marca
$routes->get('GestionEquipos/modelos/(:num)', 'GestionEquipoController::obtenerModelosPorMarca/$1');

$routes->get('DetalleEquipos/(:num)', 'ValatriEquipoController::detalle/$1');
$routes->post('equipos/agregar-caracteristica', 'ValatriEquipoController::agregarCaract');
$routes->get('equipos/eliminar-caracteristica/(:num)/(:num)', 'ValatriEquipoController::eliminarCaract/$1/$2');

/**Historial de Movimientos */
$routes->get('HistorialMovimiento', 'HistorialMovimientoController::index');

/**Catalogo */

#Marcas de equipos
$routes->get('Catalogo/MarcaEquipos', 'MarcaEquiposController::listarMarcas');
$routes->post('Catalogo/MarcaEquipos/guardar', 'MarcaEquiposController::guardarMarcas');
$routes->post('Catalogo/MarcaEquipos/editar/(:num)', 'MarcaEquiposController::editarMarcas/$1');
$routes->post('Catalogo/MarcaEquipos/eliminar/(:num)', 'MarcaEquiposController::eliminarMarcas/$1');

#Tipos de equipos
$routes->get('Catalogo/TipoEquipos', 'TipoEquiposController::index');
$routes->post('Catalogo/TipoEquipos/guardar', 'TipoEquiposController::guardarTipoEquipo');
$routes->post('Catalogo/TipoEquipos/editar/(:num)', 'TipoEquiposController::editarTipoEquipo/$1');
$routes->post('Catalogo/TipoEquipos/eliminar/(:num)', 'TipoEquiposController::eliminarTipoEquipo/$1');

#Modelo de equipos
$routes->get('Catalogo/ModeloEquipos', 'ModeloEquipoController::listarModelos');
$routes->post('Catalogo/ModeloEquipos/guardar', 'ModeloEquipoController::guardarModelos');
$routes->post('Catalogo/ModeloEquipos/editar/(:num)', 'ModeloEquipoController::editarModelos/$1');
$routes->post('Catalogo/ModeloEquipos/eliminar/(:num)', 'ModeloEquipoController::eliminarModelos/$1');

#Caracteristicas para equipos
$routes->get('Catalogo/AtributoEquipos', 'AtributoEquipoController::listarCaract');
$routes->post('Catalogo/AtributoEquipos/guardar', 'AtributoEquipoController::guardarCaract');
$routes->post('Catalogo/AtributoEquipos/editar/(:num)', 'AtributoEquipoController::editarCaract/$1');
$routes->post('Catalogo/AtributoEquipos/eliminar/(:num)', 'AtributoEquipoController::eliminarCaract/$1');

#Estados para equipos
$routes->get('Catalogo/EstadoEquipos', 'EstadoEquipoController::listarEstados');
$routes->post('Catalogo/EstadoEquipos/guardar', 'EstadoEquipoController::guardarEstado');
$routes->post('Catalogo/EstadoEquipos/editar/(:num)', 'EstadoEquipoController::editarEstado/$1');
$routes->post('Catalogo/EstadoEquipos/eliminar/(:num)', 'EstadoEquipoController::eliminarEstado/$1');

#Unidades organicas
$routes->get('Catalogo/UnidadesOrganicasAdmin', 'UnidadOrganicaController::listarUnidadesAdmin');
$routes->post('Catalogo/UnidadOrganicaAdmin/crear', 'UnidadOrganicaController::crearUnidadesAdmin');
$routes->post('Catalogo/UnidadesOrganicasAdmin/editar/(:num)','UnidadOrganicaController::editarUnidadesAdmin/$1');
$routes->post('Catalogo/unidadOrganicaAdmin/eliminar/(:num)','UnidadOrganicaController::eliminarUnidadesAdmin/$1');


$routes->get('Catalogo/UnidadesOrganicasAcadem', 'UnidadOrganicaController::listarUnidadesAcadem');
$routes->post('Catalogo/UnidadOrganicaAcadem/crear', 'UnidadOrganicaController::crearUnidadesAcadem');
$routes->post('Catalogo/UnidadOrganicaAcadem/editar/(:num)','UnidadOrganicaController::editarUnidadesAcadem/$1');
$routes->post('Catalogo/UnidadOrganicaAcadem/eliminar/(:num)','UnidadOrganicaController::eliminarUnidadesAcadem/$1');

#Espacios fisicos de unidades organicas academicas
$routes->get('DetalleUnidad/(:num)','DetalleUnidadController::detalle/$1');
$routes->post('DetalleUnidad/crear/(:num)','DetalleUnidadController::crearLugar/$1');
$routes->post('DetalleUnidad/(:num)/editar/(:num)','DetalleUnidadController::editarLugar/$1/$2');
$routes->post('DetalleUnidad/(:num)/eliminar/(:num)', 'DetalleUnidadController::eliminarLugar/$1/$2');

#sedes UNSM
$routes->get('Catalogo/Sedes', 'SedeController::listarSedes');
$routes->post('Catalogo/Sede/guardar', 'SedeController::crearSedes');
$routes->post('Catalogo/Sede/editar/(:num)', 'SedeController::editarSede/$1');
$routes->post('Catalogo/Sede/eliminar/(:num)', 'SedeController::eliminarSede/$1');





