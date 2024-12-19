<?php

namespace Mod2Nur\Infraestructura\RepositoriosEloquent;

use DateTime;
use Mod2Nur\Dominio\Abstracciones\AggregateRoot;
use Mod2Nur\Dominio\Paciente\Paciente;
use Mod2Nur\Dominio\Paciente\PacienteRepository;
use Mod2Nur\Infraestructura\Modelos\Paciente as PacienteModel;

class EloquentPacienteRepository implements PacienteRepository
{
    public function save(AggregateRoot $aggregateRoot): ?Paciente
    {
        if (!$aggregateRoot instanceof Paciente) {
            throw new \InvalidArgumentException('Expected instance of Paciente');
        }

        $pacienteModel = PacienteModel::find($aggregateRoot->getId());
        if (!$pacienteModel) {
            $pacienteModel = new PacienteModel();
        }

        $pacienteModel->id = $aggregateRoot->getId();
        $pacienteModel->nombre = $aggregateRoot->getNombre();
        $pacienteModel->fechaNacimiento = $aggregateRoot->getFechaNacimiento()->format('Y-m-d');
        //$pacienteModel->save();
        if ($pacienteModel->save()) {
            return new Paciente($pacienteModel->id,$pacienteModel->nombre, new DateTime ($pacienteModel->fechaNacimiento));
        }
    }
    
    public function findById(string $id): ?AggregateRoot
    {
        $pacienteModel = PacienteModel::find($id);
        if (!$pacienteModel) {
            return null;
        }

        return new Paciente(
            $pacienteModel->id,
            $pacienteModel->nombre,
            new DateTime($pacienteModel->fechaNacimiento)
        );
    }

    public function delete(string $id): void
    {
        $pacienteModel = PacienteModel::find($id);
        if ($pacienteModel) {
            $pacienteModel->delete();
        }
    }
}

