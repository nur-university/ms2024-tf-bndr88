<?php

namespace Mod2Nur\Presentacion;

use Mod2Nur\Presentacion\Mediator\Mediator;
use Mod2Nur\Presentacion\Mediator\CommandBus;
use Mod2Nur\Presentacion\Controladores\PacienteController;
use Mod2Nur\Presentacion\Controladores\TipoDiagController;

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// $pacienteController = new PacienteController();  (Sin Mediator)
/****
 * MEDIATOR
 */
$registryFactory = require __DIR__ . '/mediator.php';
$registry = $registryFactory();

// Crear el Mediator con el registro
$mediator = new Mediator($registry);

// Crear el CommandBus con el Mediator
$commandBus = new CommandBus($mediator);

// Pasar el CommandBus al controlador
$pacienteController = new PacienteController($commandBus);
$tipoDiagController = new TipoDiagController($commandBus);


/*-------------------------*/

// PARA SIN MEDIATOR ----> $pacienteController = new PacienteController();

/*if ($requestMethod === 'GET' && $requestUri === '/') {
    require_once __DIR__ . '/test.php';
}*/
if ($requestMethod === 'POST' && $requestUri === '/paciente/add') {
    // Crear un paciente
    $data = json_decode(file_get_contents('php://input'), true);
    //$pacienteController->store($data);  PARA SIN MEDIATOR
    $pacienteController->addPaciente($data);
    echo 'con AgregarPaciente';
    
}else if ($requestMethod === 'DELETE' && preg_match('#^/paciente/([\w-]+)$#', $requestUri, $matches)) {
    // Eliminar un paciente
    $id = $matches[1];
    $pacienteController->destroy($id);
}else if ($requestMethod === 'POST' && $requestUri === '/tipoDiag/add') {
    // Registrar un Tipo de Diagnostico
    $data = json_decode(file_get_contents('php://input'), true);
    $tipoDiagController->addTipoDiagnostico($data);
    echo 'con AgregarPaciente';
} else {
    // Ruta no encontrada
    http_response_code(404);
    echo json_encode(['message' => 'Route not found']);
}
