<?php

namespace Mod2Nur\Aplicacion\Diagnostico\Commands;

class AddDiagnosticoCommand
{
    public function __construct(
        public string $pacienteId,
        public float $peso,
        public float $altura,
        public string $composicion,
        public string $estadoDiagnostico,
        public string $tipoDiagnosticoId
    ) {
    }
}
