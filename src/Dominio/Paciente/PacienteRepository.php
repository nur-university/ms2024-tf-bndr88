<?php

namespace Mod2Nur\Dominio\Paciente;

use Mod2Nur\Dominio\Abstracciones\AggregateRoot;
use Mod2Nur\Dominio\Abstracciones\Repository;
use Mod2Nur\Dominio\Paciente\Paciente;

interface PacienteRepository extends Repository
{
    public function findById(string $id): ?AggregateRoot; 
    public function save(AggregateRoot $aggregateRoot): ?AggregateRoot; 
    public function delete(string $id): void;
}
