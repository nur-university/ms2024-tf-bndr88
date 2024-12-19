<?php

namespace Mod2Nur\Aplicacion\Paciente\Handlers;

use Mod2Nur\Aplicacion\Paciente\Commands\RemPacienteCommand;
use Mod2Nur\Dominio\Paciente\Paciente;
use Mod2Nur\Infraestructura\RepositoriosEloquent\EloquentPacienteRepository;

class RemPacienteHandler
{
    private EloquentPacienteRepository $repository;

    public function __construct(EloquentPacienteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(RemPacienteCommand $command): void
    {
        $this->repository->delete($command->id);
    }
}