<?php

namespace Mod2Nur\Dominio\Diagnostico;

interface TipoDiagnosticoRepository {
    public function save(string $id, string $descripcion): bool;
    public function remove(string $id): bool;

}