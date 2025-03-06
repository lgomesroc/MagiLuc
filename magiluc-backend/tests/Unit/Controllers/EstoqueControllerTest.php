<?php

namespace Tests\Unit\Controllers;

use App\Controllers\EstoqueController;
use Tests\TestCase;

class EstoqueControllerTest extends TestCase
{
    public function testConsultarVolumeTotalPorTipo()
    {
        $controller = new EstoqueController();
        $this->assertNull($controller->consultarVolumeTotalPorTipo()); // Teste básico
    }
}