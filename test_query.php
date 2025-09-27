<?php
// Script temporal para probar la consulta
require_once 'vendor/autoload.php';

use App\Models\AsignacionEquipoModel;

$modelo = new AsignacionEquipoModel();
$asignaciones = $modelo->obtenerAsigAdministrativas();

echo "Número de registros encontrados: " . count($asignaciones) . "\n\n";

if (!empty($asignaciones)) {
    echo "Datos encontrados:\n";
    foreach ($asignaciones as $asignacion) {
        print_r($asignacion);
        echo "---\n";
    }
} else {
    echo "No se encontraron datos.\n";
}

