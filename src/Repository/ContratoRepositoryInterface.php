<?php

namespace App\Repository;

use App\Entity\Contrato;

interface ContratoRepositoryInterface
{
    public function guardar($cont,$fecha,$valor):void;
    public function obtenerContratos();
}
