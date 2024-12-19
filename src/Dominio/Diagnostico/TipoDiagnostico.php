<?php

namespace Mod2Nur\Dominio\Diagnostico;

use Mod2Nur\Dominio\Abstracciones\Entity;

class TipoDiagnostico extends Entity {
    private string $id;
    private string $descripcion;

    public function __construct(string $id, string $descripcion) {
        $this->id = $id;
        $this->descripcion = $descripcion;
    }

    // Getters
    public function getDescripcion(): string {
        return $this->descripcion;
    }

    // Setters
    public function setDescripcion(float $descripcion): void {
        $this->descripcion = $descripcion;
    }
}
