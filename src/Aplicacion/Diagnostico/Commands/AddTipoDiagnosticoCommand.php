<?php

namespace Mod2Nur\Aplicacion\Diagnostico\Commands;

class AddTipoDiagnosticoCommand {
    private string $id;
    private string $descripcion;

    public function __construct(string $id, string $descripcion) {
        $this->id = $id;
        $this->descripcion = $descripcion;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }
}