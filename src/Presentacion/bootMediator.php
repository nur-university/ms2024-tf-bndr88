<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Mod2Nur\Presentacion\Mediator\Mediator;
use Mod2Nur\Presentacion\Mediator\CommandBus;

// Cargar el registro de handlers
$registryFactory = require __DIR__ . '/../src/Presentacion/config/mediator.php';
$registry = $registryFactory();

// Crear el Mediator con el registro
$mediator = new Mediator($registry);

// Crear el CommandBus con el Mediator
$commandBus = new CommandBus($mediator);

// Pasar el CommandBus al controlador
use Mod2Nur\Presentacion\Controladores\PacienteController;

$pacienteController = new PacienteController($commandBus);

