<?php

namespace Mod2Nur\Aplicacion\Diagnostico\Handlers;

use Mod2Nur\Aplicacion\Diagnostico\Commands\AddTipoDiagnosticoCommand;
use Mod2Nur\Dominio\Diagnostico\TipoDiagnosticoRepository;

class AddTipoDiagnosticoHandler {
    private TipoDiagnosticoRepository $repository;

    public function __construct(TipoDiagnosticoRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke(AddTipoDiagnosticoCommand $command): bool {
        return $this->repository->save($command->getId(), $command->getDescripcion());
    }
}