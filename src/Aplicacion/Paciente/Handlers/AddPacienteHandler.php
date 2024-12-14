<?php

namespace Mod2Nur\Aplicacion\Paciente\Handlers;

use Mod2Nur\Aplicacion\Paciente\Commands\AddPacienteCommand;
use Mod2Nur\Dominio\Paciente\Paciente;
use Mod2Nur\Infraestructura\RepositoriosEloquent\EloquentPacienteRepository;

class AddPacienteHandler
{
    private EloquentPacienteRepository $repository;

    public function __construct(EloquentPacienteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AddPacienteCommand $command): Paciente
    {
        $paciente = new Paciente('', $command->nombre, $command->fechaNacimiento);
        $this->repository->save($paciente);
        return $paciente;
    }
}