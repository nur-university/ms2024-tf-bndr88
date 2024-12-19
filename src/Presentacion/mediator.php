<?php

use Mod2Nur\Presentacion\Mediator\HandlersRegistry;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\DatabaseManager;
use Mod2Nur\Aplicacion\Paciente\Handlers\AddPacienteHandler;
use Mod2Nur\Aplicacion\Paciente\Commands\AddPacienteCommand;
use Mod2Nur\Infraestructura\RepositoriosEloquent\EloquentPacienteRepository;
use Mod2Nur\Aplicacion\Diagnostico\Handlers\AddDiagnosticoHandler;
use Mod2Nur\Aplicacion\Diagnostico\Commands\AddDiagnosticoCommand;
use Mod2Nur\Infraestructura\RepositoriosEloquent\EloquentDiagnosticoRepository;


return function (): HandlersRegistry {
    $registry = new HandlersRegistry();
    $db = Capsule::connection()->getDatabaseManager();
    $repositoryPaciente = new EloquentPacienteRepository();
    $repositoryDiagnostico = new EloquentDiagnosticoRepository();

    // Registro de Handlers para Commands y Queries
    $registry->register(AddPacienteCommand::class, new AddPacienteHandler($repositoryPaciente));
    $registry->register(AddDiagnosticoCommand::class, new AddDiagnosticoHandler($repositoryDiagnostico,$repositoryPaciente,$db));

    return $registry;
};
