<?php

namespace Mod2Nur\Aplicacion\Diagnostico\Handlers;

use Mod2Nur\Dominio\Diagnostico\Diagnostico;
use Mod2Nur\Dominio\Diagnostico\DiagnosticoRepository;
use Mod2Nur\Dominio\Paciente\PacienteRepository;
use Illuminate\Database\DatabaseManager;
use Mod2Nur\Aplicacion\Diagnostico\Commands\AddDiagnosticoCommand;
use Mod2Nur\Dominio\Diagnostico\TipoDiagnostico;
use Mod2Nur\Infraestructura\Modelos\TipoDiagnostico as TipoDiagnosticoModel;

class AddDiagnosticoHandler
{
    public function __construct(
        private DiagnosticoRepository $diagnosticoRepository,
        private PacienteRepository $pacienteRepository,
        private DatabaseManager $db
    ) {
    }

    public function __invoke(AddDiagnosticoCommand $command): bool
    {
        $paciente = $this->pacienteRepository->findById($command->pacienteId);

        if (!$paciente) {
            throw new \InvalidArgumentException('Paciente no encontrado.');
        }

        $this->db->transaction(function () use ($paciente, $command) {

            /*$tipoDiagnostico = TipoDiagnosticoModel::findById($command->tipoDiagnosticoId) ?? new TipoDiagnosticoModel();
            
            $diagnostico = new Diagnostico(
                peso: $command->peso,
                altura: $command->altura,
                composicion: $command->composicion,
                tipoDiagnosticoId: $command->tipoDiagnosticoId
            );           

            $paciente->addDiagnostico($diagnostico);
            $this->diagnosticoRepository->save($diagnostico);*/

            
        });

        return true;
    }
}
