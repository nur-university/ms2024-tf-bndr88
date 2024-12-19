<?php

namespace Mod2Nur\Presentacion\Controladores;

use Mod2Nur\Aplicacion\Paciente\Commands\AddPacienteCommand;
use Mod2Nur\Aplicacion\Paciente\Commands\RemPacienteCommand;
use Mod2Nur\Aplicacion\Paciente\Handlers\AddPacienteHandler;
use Mod2Nur\Aplicacion\Paciente\Handlers\RemPacienteHandler;
use Mod2Nur\Infraestructura\RepositoriosEloquent\EloquentPacienteRepository;

class PacienteController
{
    private AddPacienteHandler $addHandler;
    private RemPacienteHandler $removeHandler;

    public function __construct()
    {
        // Aquí podrías usar un contenedor de inyección de dependencias
        $this->addHandler = new AddPacienteHandler(new EloquentPacienteRepository());
        $this->removeHandler = new RemPacienteHandler(new EloquentPacienteRepository());
    }

    public function store(array $data)
    {
        try {
            $command = new AddPacienteCommand($data['nombre'], $data['fechaNacimiento']);
            //$paciente = $this->addHandler->handle($command);
            $paciente = ($this->addHandler)($command);

            http_response_code(201);
            echo json_encode(['message' => 'Paciente creado', 'ID paciente registrado' => $paciente->getId()]);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $command = new RemPacienteCommand($id);
            $this->removeHandler->handle($command);

            http_response_code(200);
            echo json_encode(['message' => 'Paciente eliminado']);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
