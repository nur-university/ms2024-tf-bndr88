<?php

namespace Mod2Nur\Infraestructura\RepositoriosEloquent;

use Mod2Nur\Dominio\Abstracciones\AggregateRoot;
use Mod2Nur\Dominio\Diagnostico\TipoDiagnostico;
use Mod2Nur\Dominio\Diagnostico\TipoDiagnosticoRepository;
use Mod2Nur\Infraestructura\Modelos\TipoDiagnostico as TipoDiagModel;

class EloquentTipoDiagnosticoRepository implements TipoDiagnosticoRepository {
    public function save(string $id, string $descripcion): bool
    {
        $TipoDiagModel = TipoDiagModel::find($id) ?? new TipoDiagModel();
        
        /*$TipoDiagModel->id = $diagnostico->getId();
        $TipoDiagModel->peso = $diagnostico->getPeso();
        $TipoDiagModel->altura = $diagnostico->getAltura();
        $TipoDiagModel->composicion = $diagnostico->getComposicion();
        $TipoDiagModel->tipo_diagnostico_id = $diagnostico->getTipoDiagnostico()->getId();*/

        return $TipoDiagModel->save();
    }

    public function remove(string $id): bool
    {
        $pacienteModel = TipoDiagModel::find($id);
        if ($pacienteModel) {
            return $pacienteModel->delete();
        }
    }
}