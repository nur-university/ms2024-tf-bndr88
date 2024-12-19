<?php

namespace Mod2Nur\Infraestructura\RepositoriosEloquent;

use Mod2Nur\Dominio\Diagnostico\Diagnostico;
use Mod2Nur\Dominio\Diagnostico\DiagnosticoRepository;
use Mod2Nur\Dominio\Diagnostico\TipoDiagnostico;
use Mod2Nur\Infraestructura\Modelos\Diagnostico as DiagnosticoModel;
use Mod2Nur\Infraestructura\Modelos\TipoDiagnostico as TipoDiagnosticoModel;

class EloquentDiagnosticoRepository implements DiagnosticoRepository
{
    public function save(Diagnostico $diagnostico): void
    {
        $DiagnosticoModel = DiagnosticoModel::find($diagnostico->getId()) ?? new DiagnosticoModel();
        
        $DiagnosticoModel->id = $diagnostico->getId();
        $DiagnosticoModel->peso = $diagnostico->getPeso();
        $DiagnosticoModel->altura = $diagnostico->getAltura();
        $DiagnosticoModel->composicion = $diagnostico->getComposicion();
        $DiagnosticoModel->tipo_diagnostico_id = $diagnostico->getTipoDiagnostico()->getId();

        $DiagnosticoModel->save();
    }

    public function findById(string $id): ?Diagnostico
    {
        $DiagnosticoModel = DiagnosticoModel::find($id);

        if (!$DiagnosticoModel) {
            return null;
        }
        
        $tipoDiag = TipoDiagnosticoModel::find($DiagnosticoModel->tipoDiagnostico_id) ?? new TipoDiagnosticoModel();

        return new Diagnostico(
            id: $DiagnosticoModel->id,
            peso: $DiagnosticoModel->peso,
            altura: $DiagnosticoModel->altura,
            composicion: $DiagnosticoModel->composicion,
            estadoDiagnostico: $DiagnosticoModel->estadoDiagnostico,
            tipoDiagnostico: $tipoDiag
        );
    }

    public function delete(string $id): void
    {
        $DiagnosticoModel = DiagnosticoModel::find($id);

        if ($DiagnosticoModel) {
            $DiagnosticoModel->delete();
        }
    }
}