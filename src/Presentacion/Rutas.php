<?php

namespace Mod2Nur\Presentacion;

use Mod2Nur\Presentacion\Controladores\PacienteController;

// Obtén la URI y método de la solicitud
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Instancia del controlador (puedes usar contenedores para inyección de dependencias si lo prefieres)
//require_once __DIR__ . '/../src/Controllers/PacienteController.php';

$pacienteController = new PacienteController();

/*if ($requestMethod === 'GET' && $requestUri === '/') {
    require_once __DIR__ . '/test.php';
}*/
if ($requestMethod === 'POST' && $requestUri === '/paciente/add') {
    // Crear un paciente
    $data = json_decode(file_get_contents('php://input'), true);
    $pacienteController->store($data);
    
}else if ($requestMethod === 'DELETE' && preg_match('#^/paciente/([\w-]+)$#', $requestUri, $matches)) {
    // Eliminar un paciente
    $id = $matches[1];
    $pacienteController->destroy($id);
} else {
    // Ruta no encontrada
    http_response_code(404);
    echo json_encode(['message' => 'Route not found']);
}
